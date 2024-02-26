import { initializeApp } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-app.js";
import { getDatabase, ref, push, set, onChildAdded, remove, onChildRemoved }
    from "https://www.gstatic.com/firebasejs/9.1.0/firebase-database.js";

const firebaseConfigFilePath = "../settings/firebaseConfig.json";
const firebaseConfig = getConfig(firebaseConfigFilePath);

const app = initializeApp(firebaseConfig);
const db = getDatabase(app);
const dbRefChat = ref(db, "Chat");
const dbRefRooms = ref(db, "Rooms");

$("#main-chat-input-send-button").on("click", async function () {
    let sendDateTime = formatDate(new Date(), "yyyy-MM-dd HH:mm:ss");
    let sendRoom = selectedRoom;
    let senderName = $("#username").val();
    let sendMessage = $("#main-chat-send-message").val();
    let sentiment = await gcpAnalyzeSentiment(sendMessage);

    if (sendRoom !== "" && senderName !== "" && sendMessage !== "") {
        const msg = {
            sendDateTime: sendDateTime,
            sendRoom: sendRoom,
            senderName: senderName,
            sendMessage: sendMessage,
            sentimentScore: sentiment["documentSentiment"]["score"],
            sentimentMagnitude: sentiment["documentSentiment"]["magnitude"]
        }

        console.log(msg);

        const newPostRef = push(dbRefChat);
        set(newPostRef, msg);

        $("#main-chat-send-message").val("");
    } else {
        alert("Roomと名前とメッセージは必須入力です。");
    }
});

$(document).on("click", ".main-channels-nav-rooms-add-button", function () {
    let roomName = $("#main-channels-nav-rooms-add-room-name").val();

    const msg = {
        roomName: roomName
    }

    const newPostRef = push(dbRefRooms);
    set(newPostRef, msg);
    $("#main-channels-nav-rooms-add-room").remove();
});

onChildAdded(dbRefChat, function (data) {
    const msg = data.val();

    if (selectedRoom === msg.sendRoom) {
        showChatMessage(msg);
        scrollChatArea();
    }

    addChatList(msg);
});

onChildAdded(dbRefRooms, function (data) {
    const msg = data.val();
    const uuid = createUuid();

    let h = `
    <li class="main-channels-nav-rooms-content">
        <input type="radio" name="room" id="${uuid}" value="${msg.roomName}">
        <label for="${uuid}">${msg.roomName}</label>
    </li>
    `;

    $("#main-channels-nav-rooms").append(h);
});