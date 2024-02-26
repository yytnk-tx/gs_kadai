// Chat
function addChatList(msg) {
    chatList.push(msg);
}

function refreshChatArea() {
    clearChatMessage();

    for(let i = 0; i < chatList.length; i++) {
        const msg = chatList[i];

        if(selectedRoom === msg.sendRoom) {
            showChatMessage(chatList[i]);
        }
    }
    scrollChatArea();
}

function clearChatMessage() {
    $("#main-chat-conversation").empty();
}

function showChatMessage(msg) {
    console.log(msg.sentimentScore);
    console.log(msg.sentimentMagnitude);

    let sentiment;
    if(msg.sentimentScore > 0.0 && msg.sentimentMagnitude >= 0.7) {
        sentiment = "chat-message-strong-positive";
    } else if(msg.sentimentScore > 0.0 && msg.sentimentMagnitude >= 0.2) {
        sentiment = "chat-message-weak-positive";
    } else if(msg.sentimentScore < 0.0 && msg.sentimentMagnitude >= 0.7) {
        sentiment = "chat-message-strong-negative";
    } else if(msg.sentimentScore < 0.0 && msg.sentimentMagnitude >= 0.2) {
        sentiment = "chat-message-weak-negative";
    } else {
        sentiment = "chat-message-neutral";
    }

    let h = `
    <div class="chat-message ${sentiment}">
        <div>${msg.senderName}</div>
        <div>${msg.sendMessage}</div>
    </div>
    `;

    $("#main-chat-conversation").append(h);
}

function scrollChatArea() {
    let container = $("#main-chat-conversation");
    container.scrollTop(container.prop("scrollHeight"));
}

// Rooms
function showAdditionalRoomArea() {
    let isDisplayed = document.getElementById("main-channels-nav-rooms-add-room") ? true : false;

    if (!isDisplayed) {
        let h = `
            <li id="main-channels-nav-rooms-add-room">
                <input type="text" id="main-channels-nav-rooms-add-room-name">
                <input type="image" class="main-channels-nav-rooms-add-button" src="./img/add.png">
                <input type="image" class="main-channels-nav-rooms-del-button" src="./img/cancel.png">
            </li>
            `;

        $("#main-channels-nav-rooms").append(h);
    }
}