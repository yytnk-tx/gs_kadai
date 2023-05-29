const commandText = `<input type="text">`;
const addButton = `<button class="add-button">+</button>`;

$(document).on("click", ".add-button", function() {
    $(".add-button").remove();
    $(".manual-command").append(commandText);
    $(".manual-command").append(addButton);
});