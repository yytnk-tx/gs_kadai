// じゃんけんの手
const Hands = {
    ROCK: 1,
    PAPER: 2,
    SCISSORS: 3
};

// ゲームの参加者
const PARTICIPANTS = {
    PLAYER: "PLAYER",
    CPU: "CPU",
    NOTHING: "NOTHING"
};

// 迷路の大きさ（5以上の奇数）
const mazeHeight = 15;
const mazeWidth = 29;

// 宝箱の数
const mazeTreasureCount = 10;

// 迷路定義
const PATH = 0;
const WALL = 1;
const PLAYER = 2;
const GOAL = 3;
const TREASURE = 4;

// 方向定義
const DIRECTION = {
    UP: 0,
    DOWN: 1,
    LEFT: 2,
    RIGHT: 3
};

// プレイヤー&CPUの手
var playerHand;
var cpuHand;

// じゃんけん勝者
var jankenWinner;

// 迷路本体
var maze;

// 迷路内のプレイヤーの位置
var mazePlayerPosition = {
    height: 0,
    width: 0
};

// 迷路内のゴールの位置
var mazeGOALPosition = {
    height: 0,
    width: 0
};

// 各じゃんけんの手のオッズ
var rockOdds;
var paperOdds;
var scissorsOdds;

// 残り歩数
var stepsCount = 0;

// じゃんけん数
var jankenCount = 0;

// 宝箱取得集
var treasureCount = 0;

// 乱数を取得する（min～max）
function getRandomNumber(min, max) {
    return Math.floor(Math.random() * max + min);
}

// ゲームを初期状態にする
function init() {
    initMaze();
    initOdds();
    save();
}

// セーブデータからゲームをロードする
function load() {
    playerHand = Number(localStorage.getItem("playerHand"));
    cpuHand = Number(localStorage.getItem("cpuHand"));
    jankenWinner = localStorage.getItem("jankenWinner");
    maze = JSON.parse(localStorage.getItem("maze"));
    mazePlayerPosition = JSON.parse(localStorage.getItem("mazePlayerPosition"));
    mazeGOALPosition = JSON.parse(localStorage.getItem("mazeGOALPosition"));
    rockOdds = Number(localStorage.getItem("rockOdds"));
    paperOdds = Number(localStorage.getItem("paperOdds"));
    scissorsOdds = Number(localStorage.getItem("scissorsOdds"));
    stepsCount = Number(localStorage.getItem("stepsCount"));
    jankenCount = Number(localStorage.getItem("jankenCount"));
    treasureCount = Number(localStorage.getItem("treasureCount"));

    changeHandsText();
    changeStepsCountText();
    changeJankenCountText();
    changeTreasureCountText();
    changeOddsText();
    showMaze();
}

// 進行状況を保存する
function save() {
    localStorage.setItem("playerHand", playerHand);
    localStorage.setItem("cpuHand", cpuHand);
    localStorage.setItem("jankenWinner", jankenWinner);
    localStorage.setItem("maze", JSON.stringify(maze));
    localStorage.setItem("mazePlayerPosition", JSON.stringify(mazePlayerPosition));
    localStorage.setItem("mazeGOALPosition", JSON.stringify(mazeGOALPosition));
    localStorage.setItem("rockOdds", rockOdds);
    localStorage.setItem("paperOdds", paperOdds);
    localStorage.setItem("scissorsOdds", scissorsOdds);
    localStorage.setItem("stepsCount", stepsCount);
    localStorage.setItem("jankenCount", jankenCount);
    localStorage.setItem("treasureCount", treasureCount);
}

$("header").on("click", function() {
    location.href = "../index.html";
});