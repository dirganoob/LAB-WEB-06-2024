let playerBalance = 5000;
let deck = [];
let playerHand = [];
let dealerHand = [];
let betAmount = 0;
let isGameOver = false;


function createDeck() {
    const suits = ['hearts', 'diamonds', 'clubs', 'spades'];
    const values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
    deck = [];

    for (let suit of suits) {
        for (let value of values) {
            deck.push({ value, suit });
        }
    }
}

function shuffleDeck() {
    for (let i = deck.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [deck[i], deck[j]] = [deck[j], deck[i]];
    }
}


function dealCard(hand) {
    hand.push(deck.pop());
}


function calculateHandValue(hand) {
    let value = 0;
    let hasAce = false;

    for (let card of hand) {
        if (card.value === 'J' || card.value === 'Q' || card.value === 'K') {
            value += 10;
        } else if (card.value === 'A') {
            value += 11;
            hasAce = true;
        } else {
            value += parseInt(card.value);
        }
    }

    if (value > 21 && hasAce) {
        value -= 10;
    }

    return value;
}


function updateBalance() {
    document.getElementById('balance').textContent = `$${playerBalance}`;
}


function displayCards() {
    const playerCardsDiv = document.getElementById('player-cards');
    const dealerCardsDiv = document.getElementById('dealer-cards');

    playerCardsDiv.innerHTML = '';
    dealerCardsDiv.innerHTML = '';

    for (let card of playerHand) {
        playerCardsDiv.innerHTML += `<img src="assets/${card.value}_${card.suit}.png" alt="${card.value} of ${card.suit}">`;
    }

    for (let i = 0; i < dealerHand.length; i++) {
        if (i === 0 && !isGameOver) {
            dealerCardsDiv.innerHTML += `<img src="assets/Hidden_card.png" alt="Hidden card">`;
        } else {
            dealerCardsDiv.innerHTML += `<img src="assets/${dealerHand[i].value}_${dealerHand[i].suit}.png" alt="${dealerHand[i].value} of ${dealerHand[i].suit}">`;
        }
    }
}


function placeBet() {
    if (isGameOver) {
        return;
    }

    betAmount = parseInt(document.getElementById('bet-amount').value);
    if (betAmount > playerBalance || betAmount < 100) {
        alert("Invalid bet amount");
        return;
    }

    createDeck();
    shuffleDeck();

    playerHand = [];
    dealerHand = [];

    dealCard(playerHand);
    dealCard(dealerHand);
    dealCard(playerHand);
    dealCard(dealerHand);

    isGameOver = false;

    displayCards();
    updateBalance();
    document.getElementById('message').textContent = '';

    // Show hit and stay buttons, hide play again button
    document.getElementById('hit').style.display = 'inline-block';
    document.getElementById('stay').style.display = 'inline-block';
    document.getElementById('play-again').style.display = 'none';
}

// Hit: Add a card to player's hand
function hit() {
    if (isGameOver) {
        return;
    }

    dealCard(playerHand);
    displayCards();

    const playerValue = calculateHandValue(playerHand);
    if (playerValue > 21) {
        document.getElementById('message').textContent = 'You bust! You lose.';
        playerBalance -= betAmount;
        endGame();
    }
}

// Stay: End player's turn, dealer plays
function stay() {
    if (isGameOver) {
        return;
    }

    isGameOver = true;

    while (calculateHandValue(dealerHand) < 17) {
        dealCard(dealerHand);
    }

    const playerValue = calculateHandValue(playerHand);
    const dealerValue = calculateHandValue(dealerHand);

    displayCards();

    if (dealerValue > 21 || playerValue > dealerValue) {
        document.getElementById('message').textContent = 'You win!';
        playerBalance += betAmount;
    } else if (playerValue < dealerValue) {
        document.getElementById('message').textContent = 'You lose!';
        playerBalance -= betAmount;
    } else {
        document.getElementById('message').textContent = 'It\'s a push!';
    }

    endGame();
}

// End game: Reset for next round
function endGame() {
    isGameOver = true;
    updateBalance();
    
    if (playerBalance <= 0) {
        document.getElementById('message').textContent = 'Game Over! You\'re out of money.';
        $('#gameOverModal').modal('show');
    }

    // Hide hit and stay buttons, show play again button
    document.getElementById('hit').style.display = 'none';
    document.getElementById('stay').style.display = 'none';
    document.getElementById('play-again').style.display = 'inline-block';
}

// Reset game for a new round
function resetGame() {
    isGameOver = false;
    document.getElementById('message').textContent = '';

    // Reset player and dealer hands
    playerHand = [];
    dealerHand = [];

    // Hide play again button, show hit and stay buttons
    document.getElementById('play-again').style.display = 'none';
    document.getElementById('hit').style.display = 'inline-block';
    document.getElementById('stay').style.display = 'inline-block';

    // Allow player to place bet again
    placeBet();
}

// Event listeners
document.getElementById('place-bet').addEventListener('click', placeBet);
document.getElementById('hit').addEventListener('click', hit);
document.getElementById('stay').addEventListener('click', stay);
document.getElementById('play-again').addEventListener('click', resetGame);
document.getElementById('restartGame').addEventListener('click', function() {
    playerBalance = 5000;
    updateBalance();
    $('#gameOverModal').modal('hide');
    resetGame();
});