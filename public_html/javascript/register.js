'use strict';

import FormValidator from './modules/validate_form.js';
import { createUser } from './modules/fetch.js';
const formValidator = new FormValidator();

const eMailInput = document.querySelector('#floatingInput');
const pass0Input = document.querySelector('#floatingPassword0');
const pass1Input = document.querySelector('#floatingPassword1');
const registerBtn = document.querySelector('#registerBtn');
const warningsDiv = document.querySelector('#warnings');

const postCodeInput = document.querySelector('#postcode');
const houseNumberInput = document.querySelector('#houseNumber');
const fillAddressBtn = document.querySelector('#fillAddress');
const streetNameInput = document.querySelector('#streetName');
const cityInput = document.querySelector('#city');
let warnings = [];
let warning;

registerBtn.addEventListener('click', function () {
    // clear warnings
    warnings = [];
    warningsDiv.innerHTML = '';
    // check if inputs are filled
    if (
        !eMailInput.value ||
        !pass0Input.value ||
        !pass1Input.value ||
        !postCodeInput.value ||
        !houseNumberInput.value ||
        !streetNameInput.value ||
        !cityInput.value
    ) {
        warning = 'Vul alle velden in!';
        warnings.push(warning);
        warningsDiv.appendChild(formValidator.createWarningElement(warning));
    }

    if (pass0Input.value) {
        const passwordValidation = formValidator.validatePassword(
            pass0Input.value,
        );
        if (!passwordValidation[0]) {
            warning = passwordValidation[1];
            warnings.push(warning);
            warningsDiv.appendChild(
                formValidator.createWarningElement(warning),
            );
        }
    }

    // CHECK IF PASSWORDS MATCH
    const passwordsMatch = pass0Input.value === pass1Input.value ? true : false;

    if (!passwordsMatch) {
        warning = 'Wachtwoorden zijn niet hetzelfde.';
        warnings.push(warning);
        warningsDiv.appendChild(formValidator.createWarningElement(warning));
    }

    // CHECK IF NO WARNINGS.
    if (warnings.length === 0) {
        // SEND POST REQUEST
        createUser(
            eMailInput.value,
            pass0Input.value,
            postCodeInput.value,
            houseNumberInput.value,
            streetNameInput.value,
            cityInput.value,
        );
    }
});

// postCodeInput.addEventListener('onblur', function () {
//     console.log('onblur');
//     formValidator.postCodeValid(postCodeInput.value);
//     // TODO IMPLEMENT THIS CORRECTLY
// });

fillAddressBtn.addEventListener('click', function () {
    streetNameRequest(postCodeInput.value, houseNumberInput.value);
});

async function streetNameRequest(postCode, houseNum) {
    if (
        formValidator.postCodeValid(postCodeInput.value) &&
        houseNumberInput.value
    ) {
        try {
            const response = await fetch('/api/get_address.php', {
                method: 'GET',
                headers: {
                    postcode: postCode,
                    houseNumber: houseNum,
                },
            });
            if (!response.ok) {
                console.log();
                throw new Error(`Response status: ${response.status}`);
            }
            const result = await response.json();
            console.log(result);
            if (result['street'] && result['city']) {
                streetNameInput.value = result['street'];
                cityInput.value = result['city'];
            }
        } catch (error) {
            console.error(error.message);
        }
    } else {
        warning = 'Controleer postcode en huisnummer.';
        warnings.push(warning);
        warningsDiv.appendChild(formValidator.createWarningElement(warning));
    }
}
