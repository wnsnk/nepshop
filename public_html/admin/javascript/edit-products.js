'use strict';
import { createElementWithClass } from '../../javascript/modules/elements.js';
const productsEl = document.querySelector('#products');

async function getProducts() {
    const url = '/api/get_products.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const results = await response.json();
        console.log(results);
        for (const result of results) {
            const trEl = document.createElement('tr');
            for (const key of Object.keys(result)) {
                if (key === 'product_description' || key === 'img_url') {
                    continue;
                }
                const thEl = createElementWithClass('th', 'text-align-left');
                thEl.textContent = result[key];
                trEl.appendChild(thEl);
            }
            const editBtn = createElementWithClass('button', 'btn-close');
            // TODO HIER WAS IK GEBLEVEN
            productsEl.appendChild(trEl);
        }
    } catch (error) {
        console.error(error.message);
    }
}

getProducts();
