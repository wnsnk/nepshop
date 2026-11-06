'use strict';

import ShoppingCart from './modules/shopping_cart.js';
import { createElementWithClass } from './modules/elements.js';
import FormValidator from './modules/validate_form.js';
const cart = new ShoppingCart();
const formValidator = new FormValidator();

const warningsDiv = document.querySelector('.warnings');
// const itemsDiv = document.querySelector('#items');
// const checkoutBtn = document.querySelector('#checkout');

let totalAmount, totalPrice;

showShoppingCart();

async function showShoppingCart() {
    if (warningsDiv) {
        warningsDiv.innerHTML = '';
    }

    const before = cart.items['shoppingCart'];
    await cart.compareCartStock();
    const after = cart.items['shoppingCart'];
    if (before != after) {
        warningsDiv.appendChild(
            formValidator.createWarningElement(
                'Winkelwagen is bijgewerkt omdat niet alles op voorraad is',
            ),
        );
    }
    totalAmount = 0;
    totalPrice = 0;
    const tbodyElement = document.querySelector('tbody');
    tbodyElement.innerHTML = '';
    for (let product of cart.items['shoppingCart']) {
        product = JSON.parse(product);

        const trElement = createElementWithClass('tr', 'text-content-center');

        const idElement = document.createElement('th');
        idElement.scope = 'row';
        idElement.textContent = product['id'];
        trElement.appendChild(idElement);

        const nameElement = document.createElement('td');
        nameElement.scope = 'col';
        nameElement.textContent = product['productName'];
        trElement.appendChild(nameElement);

        const sizeElement = document.createElement('td');
        sizeElement.scope = 'col';
        sizeElement.textContent = product['size'];
        trElement.appendChild(sizeElement);

        const amountElement = document.createElement('td');
        amountElement.scope = 'col';
        amountElement.textContent = product['amount'];
        totalAmount += product['amount'];
        trElement.appendChild(amountElement);

        const priceElement = document.createElement('td');
        priceElement.scope = 'col';
        const totalPriceProduct = product['price'] * product['amount'];
        priceElement.textContent = `€ ${totalPriceProduct}`;
        totalPrice += totalPriceProduct;
        trElement.appendChild(priceElement);

        const deleteTdElement = document.createElement('td');
        deleteTdElement.scope = 'col';
        const rowDiv = createElementWithClass('div', 'row');
        deleteTdElement.appendChild(rowDiv);

        const colDivSelect = createElementWithClass('div', 'col');
        const deleteAmountSelectElement = createElementWithClass(
            'select',
            'form-select',
        );
        for (let i = 1; i <= product['amount']; i++) {
            const optionElement = document.createElement('option');
            optionElement.value = i;
            optionElement.textContent = i;
            deleteAmountSelectElement.appendChild(optionElement);
        }
        colDivSelect.appendChild(deleteAmountSelectElement);
        rowDiv.appendChild(colDivSelect);

        const colDivBtn = createElementWithClass('div', 'col');
        const deleteBtn = createElementWithClass('button', 'btn-close');
        deleteBtn.addEventListener('click', function () {
            // DELETE FROM SHOPPING CART
            const amountToDelete = Number(deleteAmountSelectElement.value);
            cart.remove(product, amountToDelete);
            showShoppingCart();
        });
        colDivBtn.appendChild(deleteBtn);
        rowDiv.appendChild(colDivBtn);
        trElement.appendChild(deleteTdElement);

        tbodyElement.appendChild(trElement);
    }
    showTotals();
}

export function showTotals() {
    const totalDiffIdEl = document.querySelector('#totalDiffId');
    const totalAmountEl = document.querySelector('#totalAmount');
    const totalPriceEl = document.querySelector('#totalPrice');

    totalDiffIdEl.textContent = cart.items['shoppingCart'].length;
    totalAmountEl.textContent = totalAmount;
    totalPriceEl.textContent = `€ ${totalPrice}`;
}
