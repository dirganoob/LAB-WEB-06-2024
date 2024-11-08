// Efek Partikel Naik
const container = document.querySelector('.sparkles');
const totalSparkles = 150;

for (let i = 0; i < totalSparkles; i++) {
    const sparkle = document.createElement('div');
    sparkle.classList.add('sparkle');
    sparkle.style.left = `${Math.random() * 100}%`;
    sparkle.style.top = `${Math.random() * 100}%`;
    sparkle.style.animationDuration = `${Math.random() * 3 + 2}s`;
    sparkle.style.animationDelay = `${Math.random() * 5}s`;
    container.appendChild(sparkle);
}

// Pindah Halaman ke startGame.html
function goToPage() {
    var button = document.querySelector('.btn');
    setTimeout(function () {
        window.location.href = 'startGame.html';
    }, 500);
}

let playerMoney = 5000;
let bet = 100;
let deck = [];
let playerHand = [];
let dealerHand = [];

const suits = ['C', 'D', 'H', 'S'];
const values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

// Membuat tumpukan kartu
function createDeck() {
    deck = [];
    for (let suit of suits) {
        for (let value of values) {
            deck.push({ value, suit });
        }
    }
}

// Mengacak posisi kartu
function shuffleDeck() {
    for (let i = deck.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [deck[i], deck[j]] = [deck[j], deck[i]];
    }
}

// Reset kartu dan score
function resetCardsAndScores() {
    document.getElementById('player-cards').innerHTML = '';
    document.getElementById('dealer-cards').innerHTML = '';
    document.getElementById('player-score').innerText = '';
    document.getElementById('dealer-score').innerText = '';
}

// Menampilkan kartu
function displayCards(hand, elementId, hideSecondCard = false) {
    const handContainer = document.getElementById(elementId);
    handContainer.innerHTML = '';

    hand.forEach((card, index) => {
        const cardImage = document.createElement('img');
        if (hideSecondCard && index === 1) {
            cardImage.src = 'cards/back.png';
            const questionMark = document.createElement('span');
            questionMark.style.color = 'white';
            questionMark.style.fontSize = '30px';
            handContainer.appendChild(questionMark);
        } else {
            cardImage.src = `cards/${card.value}-${card.suit}.png`;
        }

        cardImage.alt = `${card.value} of ${card.suit}`;
        cardImage.style.width = '100px';
        cardImage.classList.add('new-card');

        handContainer.appendChild(cardImage);
    });
};

// Update menambah bet
function updateBet(betAmount) {
    bet += betAmount;
    document.getElementById('bet-display').innerText = `Bet: $${bet}`;
}

// Update mengurang bet
function reduceBet(betAmount) {
    if (bet - betAmount >= 100) {
        bet -= betAmount;
        document.getElementById('bet-display').innerText = `Bet: $${bet}`;
    }
}

// Menghitung score
function calculateScore(hand) {
    let score = 0;
    let aceCount = 0;

    hand.forEach(card => {
        if (card.value === 'A') {
            score += 11;
            aceCount++;
        } else if (['K', 'Q', 'J'].includes(card.value)) {
            score += 10;
        } else {
            score += parseInt(card.value);
        }
    });

    while (score > 21 && aceCount > 0) {
        score -= 10;
        aceCount--;
    }
    return score;
}

// Update score dan memperlihatkan score
function updateScores() {
    const playerScore = calculateScore(playerHand);
    document.getElementById('player-score').innerText = `Player Score: ${playerScore}`;

    if (dealerHand.length > 0) {
        const dealerVisibleScore = calculateScore([dealerHand[0]]);
        const dealerHiddenScore = '?';
        const dealerScoreText = `Dealer Score: ${dealerVisibleScore} + ${dealerHiddenScore}`;
        document.getElementById('dealer-score').innerText = dealerScoreText;
    }
}


// Menampilkan kartu baru
function displayNewCards(hand, elementId) {
    const handContainer = document.getElementById(elementId);
    const existingCards = handContainer.childElementCount;

    for (let i = existingCards; i < hand.length; i++) {
        const card = hand[i];
        const cardImage = document.createElement('img');
        cardImage.src = `cards/${card.value}-${card.suit}.png`;
        cardImage.alt = `${card.value} of ${card.suit}`;
        cardImage.style.width = '100px';
        cardImage.classList.add('new-card');
        handContainer.appendChild(cardImage);
    }
}

// Tombol 'Hit'
function hit() {
    if (deck.length > 0) {
        const newCard = deck.pop();
        playerHand.push(newCard);
        displayNewCards(playerHand, 'player-cards');
        const playerScore = calculateScore(playerHand);
        updateScores();

        if (playerScore > 21) {
            const finalDealerScore = calculateScore(dealerHand);
            document.getElementById('dealer-score').innerText = `Dealer Score: ${finalDealerScore}`;
            endGame('Player busts! Dealer wins.');
        }
    } else {
        alert("No cards left in the deck.");
    }
}

// Tombol 'Stay'
function stay() {
    document.getElementById('hit-button').disabled = true;
    document.getElementById('stay-button').disabled = true;
    displayCards(dealerHand, 'dealer-cards', false);

    let dealerScore = calculateScore(dealerHand);
    while (dealerScore < 17 && deck.length > 0) {
        dealerHand.push(deck.pop());
        dealerScore = calculateScore(dealerHand);
        displayNewCards(dealerHand, 'dealer-cards');
    }
    updateScores();
    determineWinner();
}

// Memulai game baru
document.getElementById('deal-button').addEventListener('click', () => {
    if (bet > playerMoney) {
        alert('Your bet exceeds your available money!');
        return;
    }

    createDeck();
    shuffleDeck();
    resetCardsAndScores();  // Reset kartu dan score

    playerHand = [deck.pop(), deck.pop()];
    dealerHand = [deck.pop(), deck.pop()];

    displayCards(playerHand, 'player-cards');
    displayCards(dealerHand, 'dealer-cards', true); // Sembunyikan kartu
    updateScores();

    document.getElementById('hit-button').disabled = false;
    document.getElementById('stay-button').disabled = false;
    document.getElementById('result').innerText = '';
});

// Penentuan pemenang
function determineWinner() {
    const playerScore = calculateScore(playerHand);
    const dealerScore = calculateScore(dealerHand);
    if (dealerScore > 21) {
        endGame('Dealer busts! Player wins.');
    } else if (playerScore > dealerScore) {
        endGame('Player wins!');
    } else if (playerScore < dealerScore) {
        endGame('Dealer wins.');
    } else {
        endGame('It\'s a draw.');
    }
}


// Mengakhiri game dan menampilkan hasil
function endGame(result) {
    document.getElementById('result').innerText = result;
    displayCards(dealerHand, 'dealer-cards', false);  // Menampilkan kartu bandar

    // Menghitung dan menampilkan score bandar
    const finalDealerScore = calculateScore(dealerHand);
    document.getElementById('dealer-score').innerText = `Dealer Score: ${finalDealerScore}`;

    if (result.includes('Player wins')) {
        playerMoney += bet * 2;
    } else {
        playerMoney -= bet;
    }
    document.getElementById('money-display').innerText = `Money: $${playerMoney}`;

    if (playerMoney <= 0) {
        window.location.href = 'gameover.html';
        resetGame();
    }
    document.getElementById('hit-button').disabled = true;
    document.getElementById('stay-button').disabled = true;
}

// Reset game
function resetGame() {
    playerMoney = 5000;
    bet = 100;  // Reset bet jadi $100
    document.getElementById('money-display').innerText = `Money: $${playerMoney}`;
    document.getElementById('bet-display').innerText = `Bet: $100`;
    resetCardsAndScores(); 
}

document.querySelectorAll('.bet-image').forEach(img => {
    img.addEventListener('click', (e) => {
        const betAmount = parseInt(e.target.getAttribute('data-bet'));
        updateBet(betAmount);
    });
});

document.querySelectorAll('.reduce-bet-image').forEach(img => {
    img.addEventListener('click', (e) => {
        const betAmount = parseInt(e.target.getAttribute('data-bet'));
        reduceBet(betAmount);
    });
});

document.getElementById('deal-button').addEventListener('click', () => {
    if (bet > playerMoney) {
        alert('Your bet exceeds your available money!');
        return;
    }

    createDeck();
    shuffleDeck();
    resetCardsAndScores();  // Reset kartu dan score sebelum bermain

    playerHand = [deck.pop(), deck.pop()];
    dealerHand = [deck.pop(), deck.pop()];

    displayCards(playerHand, 'player-cards');
    displayCards(dealerHand, 'dealer-cards', true); 
    updateScores();

    document.getElementById('hit-button').disabled = false;
    document.getElementById('stay-button').disabled = false;
});

document.getElementById('hit-button').addEventListener('click', hit);
document.getElementById('stay-button').addEventListener('click', stay);
