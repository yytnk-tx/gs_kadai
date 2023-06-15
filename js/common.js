// グローバル変数
var chatList = [];
var selectedRoom;

// 共通関数
function formatDate(date, format) {
  format = format.replace(/yyyy/g, date.getFullYear());
  format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2));
  format = format.replace(/dd/g, ('0' + date.getDate()).slice(-2));
  format = format.replace(/HH/g, ('0' + date.getHours()).slice(-2));
  format = format.replace(/mm/g, ('0' + date.getMinutes()).slice(-2));
  format = format.replace(/ss/g, ('0' + date.getSeconds()).slice(-2));
  format = format.replace(/SSS/g, ('00' + date.getMilliseconds()).slice(-3));
  return format;
};

function createUuid() {
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (a) {
    let r = (new Date().getTime() + Math.random() * 16) % 16 | 0, v = a == 'x' ? r : (r & 0x3 | 0x8);
    return v.toString(16);
  });
}

function getConfig(path) {
  let xhr = new XMLHttpRequest();
  xhr.overrideMimeType("application/json");
  xhr.open('GET', path, false); // 最後の引数をfalseに設定して同期リクエストにします
  xhr.send();

  let json = "";

  if (xhr.readyState === 4 && xhr.status === 200) {
    json = JSON.parse(xhr.responseText);
  } else {
    console.error('Failed to load JSON file.');
  }

  return json;
}

function setSelectedRoom() {
  let elements = document.getElementsByName("room");
  let checkedValue = "";

  for (let i = 0; i < elements.length; i++) {
    if (elements[i].checked) {
      checkedValue = elements[i].value;
      break;
    }
  }

  selectedRoom = checkedValue;
}