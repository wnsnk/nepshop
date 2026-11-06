'use strict';

import FormValidator from './modules/validate_form.js';
import ShoppingCart from './modules/shopping_cart.js';
import Product from './modules/product.js';

const cart = new ShoppingCart();
let sizeSelected;

const validateForm = new FormValidator();
const warningsDiv = document.querySelector('#warnings');
const sizeRadioBtns = document.getElementsByName('sizes');
const addToCartBtn = document.querySelector('#addToCart');
const amountSelect = document.querySelector('#amountSelect');

const productId = Number(document.querySelector('#productId').textContent);

for (const sizeRadioBtn of sizeRadioBtns) {
    sizeRadioBtn.addEventListener('click', function () {
        showAmountForSize(productId);
    });
}

addToCartBtn.addEventListener('click', function () {
    warningsDiv.innerHTML = '';

    addToCart(productId);
});

/**
 * Gets the size selected from the radiobuttons
 */
function getSize() {
    for (const sizeRadioBtn of sizeRadioBtns) {
        if (sizeRadioBtn.checked) {
            sizeSelected = sizeRadioBtn.id;
            break;
        }
    }
    if (!sizeSelected) {
        warningsDiv.appendChild(
            validateForm.createWarningElement('Please select a size.'),
        );
    }
    return sizeSelected;
}

async function showAmountForSize(productId) {
    const url = `/api/get_product_info.php?product=${productId}`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const result = await response.json();
        console.log(result);
        // UPDATE AMOUNTSELECTELEMENT
        const size = getSize();
        const sizeAmountJson = JSON.parse(result['sizeAmount']);
        const available = sizeAmountJson[size];
        amountSelect.innerHTML = '';
        for (let i = 1; i <= available; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            amountSelect.appendChild(option);
        }
        console.log(available);
    } catch (error) {
        console.error(error.message);
    }
}

async function addToCart(productId) {
    if (sizeSelected) {
        const url = `/api/get_product_info.php?product=${productId}`;
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }

            const result = await response.json();
            console.log(result);
            // CREATE PRODUCT CLASS
            const product = new Product(
                result['productId'],
                result['productName'],
                result['description'],
                getSize(),
                Number(amountSelect.value),
                result['price'],
            );
            cart.add(product);
        } catch (error) {
            console.error(error.message);
        }
    }
}
