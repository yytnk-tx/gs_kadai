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