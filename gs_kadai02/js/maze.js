function initMaze() {
    maze = new Array(mazeHeight);

    for (let idx = 0; idx < mazeHeight; idx++) {
        maze[idx] = new Array(mazeWidth);
    };

    createMaze();
    setStartPositionOfMaze();
    showMaze();
}

function digMaze(h, w) {
    let up = false, down = false, left = false, right = false;

    while (!up || !down || !left || !right) {
        // 掘り進める方向を乱数で決定
        let d = getRandomNumber(0, 4);

        switch (d) {
            case DIRECTION.UP:
                if (h - 2 >= 0 && h - 2 < mazeHeight) {
                    if (maze[h - 2][w] === WALL) {
                        maze[h - 2][w] = PATH;
                        maze[h - 1][w] = PATH;
                        digMaze(h - 2, w);
                    }
                }
                up = true;
                break;
            case DIRECTION.DOWN:
                if (h + 2 >= 0 && h + 2 < mazeHeight) {
                    if (maze[h + 2][w] === WALL) {
                        maze[h + 2][w] = PATH;
                        maze[h + 1][w] = PATH;
                        digMaze(h + 2, w);
                    }
                }
                down = true;
                break;
            case DIRECTION.LEFT:
                if (w - 2 >= 0 && w - 2 < mazeWidth) {
                    if (maze[h][w - 2] === WALL) {
                        maze[h][w - 2] = PATH;
                        maze[h][w - 1] = PATH;
                        digMaze(h, w - 2);
                    }
                }
                left = true;
                break;
            case DIRECTION.RIGHT:
                if (w + 2 >= 0 && w + 2 < mazeWidth) {
                    if (maze[h][w + 2] === WALL) {
                        maze[h][w + 2] = PATH;
                        maze[h][w + 1] = PATH;
                        digMaze(h, w + 2);
                    }
                }
                right = true;
                break;
        }
    }
}

function createMaze() {
    maze.forEach(function (value) {
        value.fill(WALL);
    });

    let h = (2 * getRandomNumber(0, Math.floor(mazeHeight / 2))) + 1;
    let w = (2 * getRandomNumber(0, Math.floor(mazeWidth / 2))) + 1;

    maze[h][w] = PATH;

    digMaze(h, w);
}

function showMaze() {
    let snipet = "";
    for (let h = 0; h < mazeHeight; h++) {
        for (let w = 0; w < mazeWidth; w++) {
            switch (maze[h][w]) {
                case WALL:
                    snipet += '<div class="wall"></div>';
                    break;
                case PATH:
                    snipet += '<div class="path"></div>';
                    break;
                case PLAYER:
                    snipet += '<div class="player"></div>';
                    break;
                case GOAL:
                    snipet += '<div class="goal"></div>';
                    break;
            }
        }
    }
    $("#maze").html(snipet);
}

function setStartPositionOfMaze() {
    let h, w;

    // プレイヤーの初期位置
    h = 1;
    w = 1;
    // do {
    //     h = getRandomNumber(0, mazeHeight);
    //     w = getRandomNumber(0, mazeWidth);
    // } while (maze[h][w] != PATH);

    mazePlayerPosition.height = h;
    mazePlayerPosition.width = w;
    maze[h][w] = PLAYER;

    // ゴールの位置
    h = mazeHeight - 2;
    w = mazeWidth - 2;
    // do {
    //     h = getRandomNumber(0, mazeHeight);
    //     w = getRandomNumber(0, mazeWidth);
    // } while (maze[h][w] != PATH);

    mazeGOALPosition.height = h;
    mazeGOALPosition.width = w;
    maze[h][w] = GOAL;
}

function moveMaze(moveDirection) {
    if (stepsCount > 0) {
        let mazePosition;
        let mazeCurrentPosition;
        let mazeMoveParticipants;

        switch (jankenWinner) {
            case PARTICIPANTS.PLAYER:
                mazePosition = mazePlayerPosition;
                mazeCurrentPosition = Object.assign({}, mazePlayerPosition);
                mazeMoveParticipants = PLAYER;
                break;
            // case PARTICIPANTS.GOAL:
            //     mazePosition = mazeGOALPosition;
            //     mazeCurrentPosition = Object.assign({}, mazeGOALPosition);
            //     mazeMoveParticipants = GOAL;
            //     break;
        }

        switch (moveDirection) {
            case DIRECTION.UP:
                if (mazePosition.height - 1 >= 0 && mazePosition.height - 1 < mazeHeight) {
                    if (maze[mazePosition.height - 1][mazePosition.width] === PATH ||
                        maze[mazePosition.height - 1][mazePosition.width] === GOAL) {
                        mazePosition.height = mazePosition.height - 1;
                    }
                }
                break;
            case DIRECTION.DOWN:
                if (mazePosition.height + 1 >= 0 && mazePosition.height + 1 < mazeHeight) {
                    if (maze[mazePosition.height + 1][mazePosition.width] === PATH ||
                        maze[mazePosition.height + 1][mazePosition.width] === GOAL) {
                        mazePosition.height = mazePosition.height + 1;
                    }
                }
                break;
            case DIRECTION.LEFT:
                if (mazePosition.width - 1 >= 0 && mazePosition.width - 1 < mazeWidth) {
                    if (maze[mazePosition.height][mazePosition.width - 1] === PATH ||
                        maze[mazePosition.height][mazePosition.width - 1] === GOAL) {
                        mazePosition.width = mazePosition.width - 1;
                    }
                }
                break;
            case DIRECTION.RIGHT:
                if (mazePosition.width + 1 >= 0 && mazePosition.width + 1 < mazeWidth) {
                    if (maze[mazePosition.height][mazePosition.width + 1] === PATH ||
                        maze[mazePosition.height][mazePosition.width + 1] === GOAL) {
                        mazePosition.width = mazePosition.width + 1;
                    }
                }
                break;
        }

        if (mazeCurrentPosition.height != mazePosition.height ||
            mazeCurrentPosition.width != mazePosition.width) {
            stepsCount--;
            changeStepsCountText();

            maze[mazeCurrentPosition.height][mazeCurrentPosition.width] = PATH;
            maze[mazePosition.height][mazePosition.width] = mazeMoveParticipants;
            showMaze();

            if (mazePlayerPosition.height === mazeGOALPosition.height &&
                mazePlayerPosition.width === mazeGOALPosition.width) {
                alert("おめでとう！ゴールしました！\nゴールまでのじゃんけん回数は " + jankenCount + "回 でした！\nまた遊んでね！");
            }
        }
    }
}

$(".maze").on("click", function () {
    initMaze();
    createMaze();
    setStartPositionOfMaze();
    showMaze();
});

$("html").keyup(function (e) {
    switch (e.which) {
        case 38: // Key[↑]
            moveMaze(DIRECTION.UP);
            break;
        case 40: // Key[↓]
            moveMaze(DIRECTION.DOWN);
            break;
        case 37: // Key[←]
            moveMaze(DIRECTION.LEFT);
            break;
        case 39: // Key[→]
            moveMaze(DIRECTION.RIGHT);
            break;
    }
});

$(".moveButton").on("click", function () {
    let buttonId = $(this).attr("id");

    switch (buttonId) {
        case "moveUpButton":
            moveMaze(DIRECTION.UP);
            break;
        case "moveDownButton":
            moveMaze(DIRECTION.DOWN);
            break;
        case "moveLeftButton":
            moveMaze(DIRECTION.LEFT);
            break;
        case "moveRightButton":
            moveMaze(DIRECTION.RIGHT);
            break;
    }
});