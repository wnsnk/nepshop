'use strict';
import { createElementWithClass } from '../../javascript/modules/elements.js';
import { deleteProduct } from '../../javascript/modules/fetch.js';
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
        productsEl.innerHTML = '';
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
            const thEl = createElementWithClass('th', 'text-align-left row');
            const editBtn = createElementWithClass(
                'button',
                'btn btn-lg btn-warning col',
            );
            editBtn.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">   <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/> </svg>';
            editBtn.addEventListener('click', function () {
                // TODO
            });
            const removeBtn = createElementWithClass(
                'button',
                'btn btn-lg btn-danger col',
            );
            removeBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/></svg>`;
            removeBtn.addEventListener('click', function () {
                if (
                    confirm(
                        `WARNING: Are you sure you want to delete: ${result['id']} ${result['product_name']}?`,
                    )
                ) {
                    deleteProduct(result['id']);
                    alert(
                        `${result['id']} ${result['product_name']} succesfully removed.`,
                    );
                    getProducts();
                }
            });
            thEl.appendChild(editBtn);
            thEl.appendChild(removeBtn);
            trEl.appendChild(thEl);
            // TODO HIER WAS IK GEBLEVEN
            productsEl.appendChild(trEl);
        }
    } catch (error) {
        console.error(error.message);
    }
}

getProducts();
