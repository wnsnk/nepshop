'use strict';
import { createElementWithClass } from './modules/elements.js';
import Filters from './modules/filters.js';
const filters = new Filters();

let columns, rowElement;
const productsDiv = document.querySelector('.products');

async function getProducts() {
    try {
        const response = await fetch('/api/get_products.php', {
            method: 'GET',
        });
        if (!response.ok) {
            console.log();
            throw new Error(`Response status: ${response.status}`);
        }
        const results = await response.json();
        console.log(results);
        columns = calcColumns();
        showProducts(results, columns, 'sortNewOld');

        const sortDropDownBtns = document.querySelectorAll('.sortDropDown');
        for (let sortDropdownElement of sortDropDownBtns) {
            sortDropdownElement.addEventListener('click', function () {
                productsDiv.innerHTML = '';
                columns = calcColumns();
                showProducts(results, columns, sortDropdownElement.id);
            });
        }

        const minPriceInput = document.querySelector('#minPrice');
        const maxPriceInput = document.querySelector('#maxPrice');
        minPriceInput.addEventListener('input', function (event) {
            productsDiv.innerHTML = '';
            columns = calcColumns();
            showProducts(
                filters.priceRange(
                    results,
                    minPriceInput.value,
                    maxPriceInput.value,
                ),
                columns,
                'sortPriceLowHigh',
            );
        });

        maxPriceInput.addEventListener('input', function () {
            productsDiv.innerHTML = '';
            columns = calcColumns();
            showProducts(
                filters.priceRange(
                    results,
                    Number(minPriceInput.value),
                    Number(maxPriceInput.value),
                ),
                columns,
                'sortPriceLowHigh',
            );
        });

        window.addEventListener('resize', function () {
            productsDiv.innerHTML = '';
            columns = calcColumns();
            console.log(columns);
            showProducts(results, columns, 'sortNewOld');
        });
    } catch (error) {
        console.error(error.message);
    }
}
getProducts();

function calcColumns() {
    console.log(window.innerWidth);
    if (window.innerWidth >= 1400) {
        return 4;
    } else if (window.innerWidth > 1000) {
        return 3;
    } else if (window.innerWidth > 800) {
        return 2;
    } else {
        return 1;
    }
}

function showProducts(results, columns, sortBy) {
    let columnsCount = 0;
    results = filters.sortProducts(results, sortBy);

    for (const result of results) {
        if (columnsCount === 0) {
            rowElement = createElementWithClass(
                'div',
                'row justify-content-center',
            );
            productsDiv.appendChild(rowElement);
        }
        const cardEl = createElementWithClass('div', 'card col');
        cardEl.style = 'max-width: 300px; margin: 10px';
        const imgEl = createElementWithClass('img', 'card-img-top');
        imgEl.src = result['img_url'];
        cardEl.appendChild(imgEl);
        const cardBodyEl = createElementWithClass('div', 'card-body');
        cardEl.appendChild(cardBodyEl);
        const h4El = createElementWithClass('h4', 'card-title');
        h4El.textContent = result['product_name'];
        cardBodyEl.appendChild(h4El);
        const paragraphEl = createElementWithClass('p', 'card-text');
        paragraphEl.textContent = `€${result['product_price'].replace('.', ',')}`;
        cardBodyEl.appendChild(paragraphEl);
        const aBtnEl = createElementWithClass('a', 'btn btn-primary');
        aBtnEl.textContent = 'Bekijk product';
        aBtnEl.href = `/product.php?product=${result['id']}`;
        cardBodyEl.appendChild(aBtnEl);
        rowElement.appendChild(cardEl);
        columnsCount++;
        if (columnsCount === columns) {
            columnsCount = 0;
        }
    }
}
