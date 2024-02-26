function changeHandsText() {
    $(".game-panel-janken-player-rock").css("border","5px solid var(--main-background-color)");
    $(".game-panel-janken-player-paper").css("border","5px solid var(--main-background-color)");
    $(".game-panel-janken-player-scissors").css("border","5px solid whvar(--main-background-color)ite");
    $(".game-panel-janken-cpu-rock").css("border","5px solid var(--main-background-color)");
    $(".game-panel-janken-cpu-paper").css("border","5px solid var(--main-background-color)");
    $(".game-panel-janken-cpu-scissors").css("border","5px solid var(--main-background-color)");

    switch (playerHand) {
        case Hands.ROCK:
            $(".game-panel-janken-player-rock").css("border","5px solid #31A9EE");
            break;
        case Hands.PAPER:
            $(".game-panel-janken-player-paper").css("border","5px solid #31A9EE");
            break;
        case Hands.SCISSORS:
            $(".game-panel-janken-player-scissors").css("border","5px solid #31A9EE");
            break;
    }

    switch (cpuHand) {
        case Hands.ROCK:
            $(".game-panel-janken-cpu-rock").css("border","5px solid #31A9EE");
            break;
        case Hands.PAPER:
            $(".game-panel-janken-cpu-paper").css("border","5px solid #31A9EE");
            break;
        case Hands.SCISSORS:
            $(".game-panel-janken-cpu-scissors").css("border","5px solid #31A9EE");
            break;
    }
}

function changeStepsCountText() {
    $(".steps-count").text(stepsCount);
}

function changeJankenCountText() {
    $(".janken-count").text(jankenCount);
}

function changeTreasureCountText() {
    $(".treasure-count").text(treasureCount);
}

function getJankenResult() {
    switch (true) {
        case playerHand === Hands.ROCK && cpuHand === Hands.SCISSORS:
        case playerHand === Hands.PAPER && cpuHand === Hands.ROCK:
        case playerHand === Hands.SCISSORS && cpuHand === Hands.PAPER:
            jankenWinner = PARTICIPANTS.PLAYER;
            setWinnersNumberOfSteps();
            // stepsCount = 1000;
            jankenCount++;
            break;
        case playerHand === Hands.ROCK && cpuHand === Hands.ROCK:
        case playerHand === Hands.PAPER && cpuHand === Hands.PAPER:
        case playerHand === Hands.SCISSORS && cpuHand === Hands.SCISSORS:
            jankenWinner = PARTICIPANTS.NOTHING;
            stepsCount = 0;
            break;
        case playerHand === Hands.ROCK && cpuHand === Hands.PAPER:
        case playerHand === Hands.PAPER && cpuHand === Hands.SCISSORS:
        case playerHand === Hands.SCISSORS && cpuHand === Hands.ROCK:
            jankenWinner = PARTICIPANTS.CPU;
            stepsCount = 0;
            jankenCount++;
            break;
    }
    changeStepsCountText();
    changeJankenCountText();
    changeOdds();
    save();
}

function setWinnersNumberOfSteps() {
    let winnersHand;

    switch (jankenWinner) {
        case PARTICIPANTS.PLAYER:
            winnersHand = playerHand;
            break;
        // case PARTICIPANTS.CPU:
        //     winnersHand = cpuHand;
        //     break;
    }

    switch (winnersHand) {
        case Hands.ROCK:
            stepsCount = rockOdds;
            break;
        case Hands.PAPER:
            stepsCount = paperOdds;
            break;
        case Hands.SCISSORS:
            stepsCount = scissorsOdds;
            break;
        default:
            stepsCount = 0;
            break;
    }
}

$(".game-panel-janken-player-rock").on("click", function () {
    playerHand = Hands.ROCK;
    cpuHand = getRandomNumber(1, 3);
    changeHandsText();
    getJankenResult();
});

$(".game-panel-janken-player-paper").on("click", function () {
    playerHand = Hands.PAPER;
    cpuHand = getRandomNumber(1, 3);
    changeHandsText();
    getJankenResult();

    load();
});

$(".game-panel-janken-player-scissors").on("click", function () {
    playerHand = Hands.SCISSORS;
    cpuHand = getRandomNumber(1, 3);
    changeHandsText();
    getJankenResult();
});