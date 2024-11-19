let botSums = 0;
let mySums = 0;

let botASCards = 0;
let myASCards = 0;

let cards;
let isCanHit = true;
let availableMoney = 5000; 

const startGameButton = document.getElementById("btn-start-game");
const takeCardButton = document.getElementById("btn-hit");
const holdCardsButton = document.getElementById("btn-stay");

const mySumsElement = document.getElementsByClassName("my-sums")[0];
const myCardsElement = document.getElementsByClassName("my-cards")[0];
const myMoney = document.getElementById("my-money");
const inputMoney = document.getElementsByTagName("input")[0];

const botSumsElement = document.getElementsByClassName("bot-sums")[0];
const botCardsElement = document.getElementsByClassName("bot-cards")[0];

const resultElement = document.getElementById("result");

window.onload = () => {
  buildUserCards();
  shuffleCards();
  myMoney.textContent = availableMoney;
  takeCardButton.setAttribute("disabled", true);
  holdCardsButton.setAttribute("disabled", true);
};

function buildUserCards() {
  let cardTypes = ["H", "B", "S", "K"];
  let cardValues = ["A", 
                    "2", 
                    "3", 
                    "4", 
                    "5", 
                    "6", 
                    "7", 
                    "8",
                    "9", 
                    "10", 
                    "K", 
                    "Q", 
                    "J"];
  cards = [];

  for (let i = 0; i < cardTypes.length; i++) {
    for (let j = 0; j < cardValues.length; j++) {
      cards.push(cardValues[j] + "-" + cardTypes[i]);
    }
  }
}

function shuffleCards() {
  for (let i = 0; i < cards.length; i++) {
    let randomNum = Math.floor(Math.random() * cards.length);
    let temp = cards[i];
    cards[i] = cards[randomNum];
    cards[randomNum] = temp;
  }
}

startGameButton.addEventListener("click", function () {
  const betAmount = parseInt(inputMoney.value);

  if (!inputMoney.value) {
    alert("Silakan masukkan jumlah taruhan terlebih dahulu.");
    return;
  }

  if (betAmount < 100) {
    alert("Minimal taruhan adalah Rp 100");
    return;
  }

  if (availableMoney < betAmount) {
    alert("Uang Anda Tidak Cukup");
    return;
  }

  if (startGameButton.textContent === "Try Again") {
    resetGame();
  }

  takeCardButton.disabled = false;
  holdCardsButton.disabled = false;
  startGameButton.textContent = "Try Again";
  startGameButton.setAttribute("disabled", true);

  dealInitialCards(betAmount);
});

function resetGame() {
  botSums = 0;
  mySums = 0;
  botASCards = 0;
  myASCards = 0;
  isCanHit = true;

  const allCardsImage = document.querySelectorAll("img");
  for (let i = 0; i < allCardsImage.length; i++) {
    allCardsImage[i].remove();
  }

  let cardImg = document.createElement("img");
  cardImg.src = "./images/cards/BACK.png";
  cardImg.className = "hidden-card";
  botCardsElement.append(cardImg);

  mySumsElement.textContent = "0";
  botSumsElement.textContent = "0";

  resultElement.textContent = "";

  inputMoney.value = "";

  takeCardButton.setAttribute("disabled", true);
  holdCardsButton.setAttribute("disabled", true);
  startGameButton.removeAttribute("disabled");
  startGameButton.textContent = "Start Game";

  buildUserCards();
  shuffleCards();
}

function dealInitialCards(betAmount) {
  for (let i = 0; i < 2; i++) {
    let playerCardImg = document.createElement("img");
    let playerCard = cards.pop();
    playerCardImg.src = `./images/cards/${playerCard}.png`;
    mySums += getValueOfCard(playerCard);
    myASCards += checkASCard(playerCard);
    mySumsElement.textContent = mySums;
    myCardsElement.append(playerCardImg);

    let botCardImg = document.createElement("img");
    let botCard = cards.pop();
    botCardImg.src = `./images/cards/${botCard}.png`;
    botSums += getValueOfCard(botCard);
    botASCards += checkASCard(botCard);
    botSumsElement.textContent = botSums;

    if (i === 0) {
      botCardImg.className = "hidden-card";
      botCardsElement.append(botCardImg);
    } else {
      botCardsElement.append(botCardImg);
    }
  }
}

takeCardButton.addEventListener("click", function () {
  if (!isCanHit) return;

  let cardImg = document.createElement("img");
  let card = cards.pop();
  cardImg.src = `./images/cards/${card}.png`;
  mySums += getValueOfCard(card);
  myASCards += checkASCard(card);
  mySumsElement.textContent = mySums;
  myCardsElement.append(cardImg);

  if (reduceASCardValue(mySums, myASCards) > 21) {
    endGame("YOU LOSE");
    availableMoney -= parseInt(inputMoney.value);
    myMoney.textContent = availableMoney;
  }

  if (mySums > 21) {
    endGame("YOU LOSE");
    myMoney.textContent = availableMoney -= parseInt(inputMoney.value);
  }
});

holdCardsButton.addEventListener("click", function () {
  setTimeout(() => {
    document.getElementsByClassName("hidden-card")[0].remove();
  }, 1000);

  const addBotCards = () => {
    setTimeout(() => {
      let cardImg = document.createElement("img");
      let card = cards.pop();
      cardImg.src = `./images/cards/${card}.png`;
      botSums += getValueOfCard(card);
      botASCards += checkASCard(card);
      botCardsElement.append(cardImg);
      botSumsElement.textContent = botSums;

      if (botSums < 17) {
        addBotCards();
      } else {
        finalizeGame(); 
      }
    }, 1000);
  };

  addBotCards();
});

function finalizeGame() {
  botSums = reduceASCardValue(botSums, botASCards);
  mySums = reduceASCardValue(mySums, myASCards);
  isCanHit = false;

  let message ="";
  const betAmount = parseInt(inputMoney.value) || 0;

  if (mySums > 21) {
    message = "YOU LOSE";
    if (availableMoney >= betAmount) {
      availableMoney -= betAmount;
    } else {
      alert("Uang Anda Tidak Cukup untuk taruhan ini!");
      availableMoney = 0;
    }
  } else if (botSums > 21) {
    message = "YOU WIN!!!!";
    availableMoney += betAmount * 2; 
  } else if (botSums > mySums) {
    message = "YOU LOSE";
    if (availableMoney >= betAmount) {
      availableMoney -= betAmount;
    } else {
      alert("Uang Anda Tidak Cukup untuk taruhan ini!");
      availableMoney = 0; // Tetap 0 jika tidak cukup
    }
  } else if (mySums > botSums) {
    message = "YOU WIN!!!!";
    availableMoney += betAmount * 2; 
  } else {
    message = "DRAW"; 
  }

  if (availableMoney < 0) {
    availableMoney = 0;
  }

  myMoney.textContent = availableMoney;
  resultElement.textContent = message;
  
  startGameButton.disabled = false;
  takeCardButton.disabled = true;
  holdCardsButton.disabled = true;

  if (availableMoney <= 0) {
    alert("Game Over! Uang Anda Habis.");
    resetGame();
  }
}

function endGame(message) {
  takeCardButton.disabled = true;
  holdCardsButton.disabled = true;
  startGameButton.disabled = false;
  resultElement.textContent = message;
}

if (availableMoney < 0) {
  availableMoney = 0;
}
myMoney.textContent = availableMoney;



function getValueOfCard(card) {
  let cardDetail = card.split("-");
  let value = cardDetail[0];

  if (isNaN(value)) {
    if (value == "A") return 11; 
    else return 10; 
  }

  return parseInt(value);
}

function checkASCard(card) {
  if (card[0] == "A") return 1;
  else return 0;
}

function reduceASCardValue(sums, asCards) {
  while (sums > 21 && asCards > 0) {
    sums -= 10;
    asCards -= 1;
  }
  return sums;
}



