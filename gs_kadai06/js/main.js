$(document).on("change", "input[name=room]:radio", function() {
    setSelectedRoom();
    refreshChatArea();
});

$("#main-channels-nav-rooms-add-button").on("click", function () {
    showAdditionalRoomArea();
});

$(document).on("click", ".main-channels-nav-rooms-del-button", function () {
    $("#main-channels-nav-rooms-add-room").remove();
});
