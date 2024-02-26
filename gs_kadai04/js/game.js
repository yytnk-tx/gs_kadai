function initOdds() {
    changeOdds();
}

function changeOddsText() {
    $(".rock-odds").text(rockOdds);
    $(".paper-odds").text(paperOdds);
    $(".scissors-odds").text(scissorsOdds);
}

function changeOdds() {
    rockOdds = getRandomNumber(1, 10);
    paperOdds = getRandomNumber(1, 10);
    scissorsOdds = getRandomNumber(1, 10);

    changeOddsText();
}