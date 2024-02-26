$("#main-channels-nav-rooms-add-button").on("click", function () {
    let isDisplayed = document.getElementById("main-channels-nav-rooms-add-room") ? true : false;

    if (!isDisplayed) {
        let h = `
            <li id="main-channels-nav-rooms-add-room">
                <input type="text" id="main-channels-nav-rooms-add-room-name">
                <button class="main-channels-nav-rooms-add-button">+</button>
                <button class="main-channels-nav-rooms-del-button">-</button>
            </li>
            `;

        $("#main-channels-nav-rooms").append(h);
    }
});

// $(document).on("click", ".main-channels-nav-rooms-add-button", function () {
//     addRooms();
// });

$(document).on("click", ".main-channels-nav-rooms-del-button", function () {
    $("#main-channels-nav-rooms-add-room").remove();
});
