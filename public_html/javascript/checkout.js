'use strict';

import ShoppingCart from './modules/shopping_cart.js';
import { createElementWithClass } from './modules/elements.js';
import { showTotals } from './cart.js';

const cart = new ShoppingCart();
const userId = Number(document.querySelector('#userId').textContent);
// CUSTOMERINFO
getUserInfo(userId);

async function getUserInfo(userId) {
    try {
        const response = await fetch('/api/get_user.php', {
            method: 'POST',
            body: JSON.stringify({
                user_id: userId,
            }),
        });
        if (!response.ok) {
            console.log();
            throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        console.log(result);
        document.querySelector('#email').textContent = result['email_address'];
        document.querySelector('#streetNameWithNum').textContent =
            `${result['street_name']} ${result['house_number']}`;
        document.querySelector('#postcodeAndCity').textContent =
            `${result['postcode']}, ${result['city']} `;
    } catch (error) {
        console.error(error.message);
    }
}
// CART
const warningsDiv = document.querySelector('.warnings');
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

        tbodyElement.appendChild(trElement);
    }
    showTotals();
    const shippingCostTh = document.querySelector('#shippingCost');
    shippingCostTh.textContent = `€ ${calcShippingCost(totalPrice)}`;
    showTotalWithShipping();
}

function calcShippingCost(total) {
    return total < 50 ? 4.99 : 0;
}

function showTotalWithShipping() {
    // TODO
    document.querySelector('#totalWithShipping').textContent =
        totalPrice + calcShippingCost(totalPrice);
}

// CHECKOUT

const checkoutBtn = document.querySelector('#checkoutBtn');

checkoutBtn.addEventListener('click', async function () {
    console.log('checkout');
    const paymentMethod = document.querySelector(
        'input[name="paymentMethod"]:checked',
    ).value;
    const checkoutSuccesful = await cart.checkout(
        userId,
        paymentMethod,
        totalPrice,
        calcShippingCost(totalPrice),
    );
    if (checkoutSuccesful) {
        cart.clear();
        alert('Order succesfully placed');
        window.location.href = '/';
    } else {
        alert('Something went wrong. Please contact us.');
    }
});
