let botSums = 0;
let mySums = 0;
let cards;
let playerMoney = 5000;

const startGameButton = document.getElementById("btn-start-game");
const takeCardButton = document.getElementById("btn-take");
const holdCardsButton = document.getElementById("btn-hold");

const mySumsElement = document.getElementsByClassName("my-sums")[0];
const myCardsElement = document.getElementsByClassName("my-cards")[0];
const myMoney = document.getElementById("my-money");
const inputMoney = document.getElementsByTagName("input")[0];

const botSumsElement = document.getElementsByClassName("bot-sums")[0];
const botCardsElement = document.getElementsByClassName("bot-cards")[0];

const resultElement = document.getElementById("result");

window.onload = () => {
  buildCards();
  shuffleCards();
  takeCardButton.setAttribute("disabled", true);
  holdCardsButton.setAttribute("disabled", true);
  myMoney.textContent = playerMoney;
};

// Membangun set kartu (52 kartu)
function buildCards() {
  let cardTypes = {
    "H": "hearts",
    "B": "diamonds",
    "S": "spades",
    "K": "clubs"
  };
  let cardValues = [
    "ace", "2", "3", "4", "5", "6", "7", "8", "9", "10", "king", "queen", "jack"
  ];
  cards = [];

  for (let type in cardTypes) {
    for (let j = 0; j < cardValues.length; j++) {
      let cardName = `${cardValues[j]}_of_${cardTypes[type]}`;
      cards.push(cardName);
    }
  }
}

// Mengocok kartu
function shuffleCards() {
  for (let i = 0; i < cards.length; i++) {
    let randomNum = Math.floor(Math.random() * cards.length);
    let temp = cards[i];
    cards[i] = cards[randomNum];
    cards[randomNum] = temp;
  }
}

// Memulai game
startGameButton.addEventListener("click", function () {
  resetGame();

  if (inputMoney.value >= 100 && inputMoney.value <= playerMoney) {
    distributeInitialCards();

      // Hapus back-card setelah hold
    const myBackCard = document.querySelector(".my-cards .back-card");
    if (myBackCard) {
      myBackCard.remove(); // Menghapus gambar back-card untuk bot
    }
    takeCardButton.disabled = false;
    holdCardsButton.disabled = false;
    startGameButton.textContent = "Play Again";
    startGameButton.setAttribute("disabled", true);
  } else {
    resultElement.textContent = inputMoney.value < 100 ? "Minimum bet is $100" : "Your money is not enough";
  }
});

// Mendapatkan nilai kartu
function getValueOfCard(card) {
  let cardDetail = card.split("_");
  let value = cardDetail[0];

  if (isNaN(value)) {
    // Kartu AS
    if (value === "ace") return 11;
    // Kartu K, Q, J
    return 10;
  }
  return parseInt(value);
}

// Distribusi kartu awal (2 kartu)
function distributeInitialCards() {
  for (let i = 0; i < 2; i++) {
    let cardImg = document.createElement("img");
    let card = cards.pop();
    cardImg.src = `/images/cards/${card}.png`;
    mySums += getValueOfCard(card);
    mySumsElement.textContent = `Your Sum: ${mySums}`; // Menampilkan jumlah
    myCardsElement.append(cardImg);
  }
  if (mySums > 21) handleBust(); // Kondisi kalah jika lebih dari 21
}

// Reset permainan
function resetGame() {
  botSums = 0;
  mySums = 0;

  // Hapus semua gambar kartu
  const allCardsImage = document.querySelectorAll("img");
  allCardsImage.forEach(img => img.remove());

  // Bangun ulang deck dan kocok kartu
  buildCards();
  shuffleCards();

  // Tetap tampilkan "Your Sum" dan "Bot Sum" saat reset
  mySumsElement.textContent = `Your Sum: ${mySums}`;
  botSumsElement.textContent = `Bot Sum: ${botSums}`;

  // Tambahkan kembali kartu belakang (back-card) ke area pemain dan dealer
  const myBackCard = document.createElement("img");
  myBackCard.src = "/images/back-card.png"; 
  myBackCard.alt = "Back Card";
  myBackCard.classList.add("back-card"); 

  const botBackCard = document.createElement("img");
  botBackCard.src = "/images/back-card.png";
  botBackCard.alt = "Back Card";
  botBackCard.classList.add("back-card");

  // Tambahkan gambar back-card ke dalam area masing-masing
  myCardsElement.appendChild(myBackCard);
  botCardsElement.appendChild(botBackCard);

  // Kosongkan hasil (result)
  resultElement.textContent = "";
}

// Menangani jika pemain melebihi 21
function handleBust() {
  takeCardButton.disabled = true;
  holdCardsButton.disabled = true;
  startGameButton.disabled = false;
  resultElement.textContent = "You Lose";
  playerMoney -= inputMoney.value;
  myMoney.textContent = playerMoney;
  checkGameOver();
}

// Pemain mengambil kartu tambahan
takeCardButton.addEventListener("click", function () {
  let cardImg = document.createElement("img");
  let card = cards.pop();
  cardImg.src = `/images/cards/${card}.png`;
  mySums += getValueOfCard(card);
  mySumsElement.textContent = `Your Sum: ${mySums}`; // Menampilkan jumlah yang diperbarui
  myCardsElement.append(cardImg);

  if (mySums > 21) handleBust();
});

// Pemain hold kartu, giliran dealer
holdCardsButton.addEventListener("click", function () {
  takeCardButton.disabled = true;
  holdCardsButton.disabled = true;
  startGameButton.disabled = false;

  // Hapus back-card setelah hold
  const botBackCard = document.querySelector(".bot-cards .back-card");
  if (botBackCard) {
    botBackCard.remove(); // Menghapus gambar back-card untuk bot
  }

  dealerTurn();
});

// Giliran bandar (dealer)
function dealerTurn() {
  const addBotCards = () => {
    setTimeout(() => {
      let cardImg = document.createElement("img");
      let card = cards.pop();
      cardImg.src = `/images/cards/${card}.png`;
      botSums += getValueOfCard(card);
      botCardsElement.append(cardImg);
      botSumsElement.textContent = `Bot Sum: ${botSums}`; // Menampilkan jumlah bot yang diperbarui

      // Dealer harus hit jika < 17
      if (botSums < 17) {
        addBotCards();
      } else {
        checkWinner();
      }
    }, 1000);
  };
  addBotCards();
}

// Mengecek pemenang
function checkWinner() {
  let message = "";
  if (mySums > 21 || mySums < botSums && botSums <= 21) {
    message = "You Lose";
    playerMoney -= inputMoney.value;
  } else if (botSums > 21 || mySums > botSums) {
    message = "You Win";
    playerMoney += inputMoney.value * 2;
  } else {
    message = "Draw";
  }

  resultElement.textContent = message;
  myMoney.textContent = playerMoney;
  checkGameOver();
}

// Mengecek apakah game over
function checkGameOver() {
  if (playerMoney <= 0) {
    resultElement.textContent = "Game Over. You ran out of money!";
    startGameButton.setAttribute("disabled", true);
    takeCardButton.setAttribute("disabled", true);
    holdCardsButton.setAttribute("disabled", true);
  }
}
