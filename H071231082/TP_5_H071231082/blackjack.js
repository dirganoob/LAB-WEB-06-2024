let dealerSum = 0;
let yourSum = 0;

let dealerAceCount = 0;
let yourAceCount = 0;

let hidden;
let deck;

let canHit = true; 
let balance = 5000; 
let betAmount = 0; 

window.onload = function() {
    buildDeck();
    shuffleDeck();
    document.getElementById("balance").innerText = balance.toLocaleString();
    document.getElementById("start-game").addEventListener("click", startNewRound);
}

function buildDeck() {
    let values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
    let types = ["C", "D", "H", "S"];
    deck = [];

    for (let i = 0; i < types.length; i++) {
        for (let j = 0; j < values.length; j++) {
            deck.push(values[j] + "-" + types[i]);
        }
    }
}

function shuffleDeck() {
    for (let i = 0; i < deck.length; i++) {
        let j = Math.floor(Math.random() * deck.length);
        let temp = deck[i];
        deck[i] = deck[j];
        deck[j] = temp;
    }
}

function startNewRound() {
    betAmount = parseInt(document.getElementById("bet-amount").value);
    
    if (isNaN(betAmount) || betAmount < 100) {
        alert("Please enter a valid bet amount (minimum $100).");
        return;
    }
    if (betAmount > balance) {
        alert("You don't have enough money to make this bet.");
        return;
    }

    balance -= betAmount; 
    document.getElementById("balance").innerText = balance.toLocaleString();

    resetGameState();

    document.getElementById("hit").style.display = "inline-block";
    document.getElementById("stay").style.display = "inline-block";
    document.getElementById("start-game").style.display = "none";
    document.getElementById("bet-amount").disabled = true;

    startGame();
}

function resetGameState() {
    dealerSum = 0;
    yourSum = 0;
    dealerAceCount = 0;
    yourAceCount = 0;
    canHit = true;

    document.getElementById("dealer-cards").innerHTML = '<img id="hidden" src="./cards/BACK.png" class="card-img">';
    document.getElementById("your-cards").innerHTML = '';
    document.getElementById("results").innerText = '';
    document.getElementById("dealer-sum").innerText = '';
    document.getElementById("your-sum").innerText = '';

    buildDeck(); 
    shuffleDeck();
}

function startGame() {
    hidden = deck.pop();
    dealerSum += getValue(hidden);
    dealerAceCount += checkAce(hidden);

    let cardImg = document.createElement("img");
    let card = deck.pop();
    cardImg.src = "./cards/" + card + ".png";
    dealerSum += getValue(card);
    dealerAceCount += checkAce(card);
    document.getElementById("dealer-cards").append(cardImg);

    for (let i = 0; i < 2; i++) {
        let cardImg = document.createElement("img");
        let card = deck.pop();
        cardImg.src = "./cards/" + card + ".png";
        yourSum += getValue(card);
        yourAceCount += checkAce(card);
        document.getElementById("your-cards").append(cardImg);
    }

    yourSum = reduceAce(yourSum, yourAceCount);

    if (yourSum === 21) {
        endGame("Blackjack! You Win!", false); 
        balance += betAmount * 2; 
        document.getElementById("balance").innerText = balance.toLocaleString();
        showStartButton();
    }

    document.getElementById("hit").addEventListener("click", hit);
    document.getElementById("stay").addEventListener("click", stay);
    document.getElementById("your-sum").innerText = yourSum;
}

function hit() {
    if (!canHit) {
        return;
    }

    let cardImg = document.createElement("img");
    let card = deck.pop();
    cardImg.src = "./cards/" + card + ".png";
    yourSum += getValue(card);
    yourAceCount += checkAce(card);
    document.getElementById("your-cards").append(cardImg);

    if (reduceAce(yourSum, yourAceCount) > 21) {
        canHit = false;
        endGame("You Lose!", true); 
    }
}

function stay() {
    canHit = false;
    dealerPlay();
    endGame(evaluateGame(), true);
}

function dealerPlay() {
    document.getElementById("hidden").src = "./cards/" + hidden + ".png";
    dealerSum = reduceAce(dealerSum, dealerAceCount); 

    if (dealerSum === 21) { 
        endGame("Dealer Blackjack! You Lose!", true);
        return; 
    }

    while (dealerSum < 17) {
        let cardImg = document.createElement("img");
        let card = deck.pop();
        cardImg.src = "./cards/" + card + ".png";
        dealerSum += getValue(card);
        dealerAceCount += checkAce(card);
        document.getElementById("dealer-cards").append(cardImg);
        dealerSum = reduceAce(dealerSum, dealerAceCount); // Recalculate after each card
    } 
}

function endGame(message, revealDealerCards) {
    dealerSum = reduceAce(dealerSum, dealerAceCount);
    yourSum = reduceAce(yourSum, yourAceCount);

    canHit = false;

    if (revealDealerCards) {
        document.getElementById("hidden").src = "./cards/" + hidden + ".png";
        document.getElementById("dealer-sum").innerText = dealerSum;
    }

    document.getElementById("your-sum").innerText = yourSum;
    document.getElementById("balance").innerText = balance.toLocaleString();
    document.getElementById("results").innerText = message;

    showStartButton();

    if (balance <= 0) {
        console.log("Game Over! Player has run out of money."); 
        $('#gameOverModal').modal('show');     
    }
}

function evaluateGame() {
    yourSum = reduceAce(yourSum, yourAceCount);
    let message = "";

    if (yourSum > 21) {
        message = "You Lose!";
    } else if (dealerSum > 21) {
        message = "You Win!";
        balance += betAmount * 2; 
    } else if (yourSum === dealerSum) {
        message = "Tie!";
        balance += betAmount; 
    } else if (yourSum > dealerSum) {
        message = "You Win!";
        balance += betAmount * 2; 
    } else {
        message = "You Lose!";
    }

    document.getElementById("balance").innerText = balance.toLocaleString();
    document.getElementById("results").innerText = message;

    return message;
}

function showStartButton() {
    document.getElementById("hit").style.display = "none";
    document.getElementById("stay").style.display = "none";
    document.getElementById("start-game").style.display = "inline-block";
    document.getElementById("bet-amount").disabled = false;
}

function getValue(card) {
    let data = card.split("-");
    let value = data[0];

    if (isNaN(value)) {
        if (value === "A") {
            return 11;
        }
        return 10;
    }
    return parseInt(value);
}

function checkAce(card) {
    if (card[0] === "A") {
        return 1;
    }
    return 0;
}

function reduceAce(playerSum, playerAceCount) {
    while (playerSum > 21 && playerAceCount > 0) {
        playerSum -= 10;
        playerAceCount -= 1;
    }
    return playerSum;
}