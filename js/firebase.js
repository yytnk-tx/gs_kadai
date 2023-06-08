import { initializeApp } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-app.js";
import { getDatabase, ref, push, set, onChildAdded, remove, onChildRemoved }
    from "https://www.gstatic.com/firebasejs/9.1.0/firebase-database.js";

const firebaseConfig = {

};

const app = initializeApp(firebaseConfig);
const db = getDatabase(app);
const dbRefChat = ref(db, "Chat");
const dbRefRooms = ref(db, "Rooms");

$("#main-chat-input-send-button").on("click", function () {
    let sendDateTime = formatDate(new Date(), "yyyy-MM-dd HH:mm:ss");
    let sendRoom = getSelectedRoom();
    let senderName = $("#username").val();
    let sendMessage = $("#main-chat-send-message").val();

    if (sendRoom !== "" && senderName !== "" && sendMessage !== "") {
        const msg = {
            sendDateTime: sendDateTime,
            sendRoom: sendRoom,
            senderName: senderName,
            sendMessage: sendMessage,
        }

        console.log(msg);

        const newPostRef = push(dbRefChat);
        set(newPostRef, msg);

        $("#main-chat-send-message").val("");
    } else {
        alert("Roomと名前とメッセージは必須入力です。");
    }
});

// function addRooms() {
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
    let selectedRoom = getSelectedRoom();
    const msg = data.val();

    if (selectedRoom === msg.sendRoom) {
        let h = `
        <div class="chat-message chat-message-send">
            <div>${msg.senderName}</div>
            <div>${msg.sendMessage}</div>
        </div>
        `;

        $("#main-chat-conversation").append(h);

        let chatElement = document.getElementById("#main-chat-conversation");
        chatElement.scrollTop = chatElement.scrollHeight;
    }
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