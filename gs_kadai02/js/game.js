function initOdds() {
    changeOdds();
}

function changeOdds() {
    rockOdds = getRandomNumber(1, 10);
    paperOdds = getRandomNumber(1, 10);
    scissorsOdds = getRandomNumber(1, 10);
    
    $(".rock-odds").text(rockOdds);
    $(".paper-odds").text(paperOdds);
    $(".scissors-odds").text(scissorsOdds);
}

$(".odds").on("click", function () {
    changeOdds();
})