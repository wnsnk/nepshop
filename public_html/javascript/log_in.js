'use strict';

import { logInUser } from './modules/fetch.js';

import FormValidator from './modules/validate_form.js';
const formValidator = new FormValidator();

const eMailInput = document.querySelector('#floatingInput');
const passwordInput = document.querySelector('#floatingPassword');
const logInBtn = document.querySelector('#logInBtn');
const warningsDiv = document.querySelector('#warnings');
eMailInput.addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {
        logIn();
    }
});
passwordInput.addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {
        logIn();
    }
});
logInBtn.addEventListener('click', function () {
    logIn();
});

async function logIn() {
    warningsDiv.innerHTML = '';
    if (!eMailInput.value || !passwordInput.value) {
        warningsDiv.appendChild(
            formValidator.createWarningElement('Vul alle velden in!'),
        );
    } else {
        const loginSuccesful = await logInUser(
            eMailInput.value,
            passwordInput.value,
        );
        console.log(loginSuccesful);
        if (!loginSuccesful) {
            warningsDiv.appendChild(
                formValidator.createWarningElement(
                    'E-mail of wachtwoord incorrect.',
                ),
            );
        }
    }
}
