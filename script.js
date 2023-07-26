let editButtons = document.querySelectorAll('.edit-data');
let contactTableRow = document.querySelectorAll('.contact-row');
let updatePopup = document.querySelector('.update-popup');

for (let i = 0; i < editButtons.length; i++) {
    editButtons[i].addEventListener("click", function () {
        let currentPhone = editButtons[i].getAttribute("data-phonenum");
        let currentRowColumns = contactTableRow[i].querySelectorAll("td");
        let currentName = currentRowColumns[0].innerText;
        let currentEmail = currentRowColumns[1].innerText;
        let currentCity = currentRowColumns[3].innerText;

        updatePopup.classList.add('open');

        window.location.href = 'contact.php?currentName=' + currentName + '&currentEmail=' + currentEmail + "&oldphone=" + currentPhone + "&currentCity=" + currentCity;
    })
}

let sendEmailButton = document.querySelectorAll(".send-email");

for (let i = 0; i < sendEmailButton.length; i++) {
    sendEmailButton[i].addEventListener("click", function () {
        let currentEmail = sendEmailButton[i].getAttribute("data-email");
        window.location.href = 'mail.php?currentEmail=' + currentEmail;
    })
}


let cancel_update = document.getElementById("cancel_update")

if (cancel_update) {
    cancel_update.addEventListener("click", function () {
        updatePopup.classList.remove('open');
        window.location.href = 'contact.php';
    })
}

let cancel_email = document.getElementById("cancel_email");

if (cancel_email) {
    cancel_email.addEventListener("click", function () {
        window.location.href = 'contact.php';
    })
}