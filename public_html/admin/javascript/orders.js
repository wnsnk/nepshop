'use strict';
import { createElementWithClass } from '../../javascript/modules/elements.js';
import { deleteProduct } from '../../javascript/modules/fetch.js';
const productsEl = document.querySelector('#products');

async function getOrders() {
    const url = '/api/get_orders.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const results = await response.json();
        // console.log(results);
        productsEl.innerHTML = '';
        results.reverse();
        for (const result of results) {
            const trEl = document.createElement('tr');
            for (const key of Object.keys(result)) {
                const thEl = createElementWithClass('th', 'text-align-left');
                if (key === 'items') {
                    const items = JSON.parse(result['items']);

                    for (const item of items) {
                        const OlEl = document.createElement('ol');
                        const OlliEl = document.createElement('li');
                        OlEl.appendChild(OlliEl);
                        const Ulel = document.createElement('ul');
                        OlliEl.appendChild(Ulel);
                        for (const key of Object.keys(item)) {
                            console.log(key);
                            if (key === 'description') {
                                continue;
                            }
                            const liEl = document.createElement('li');
                            liEl.textContent = `${key}: ${item[key]}`;
                            Ulel.appendChild(liEl);
                        }
                        thEl.appendChild(OlEl);
                    }
                } else {
                    thEl.textContent = result[key];
                }
                trEl.appendChild(thEl);
            }
            const thEl = createElementWithClass('th', 'text-align-left row');
            const editBtn = createElementWithClass(
                'button',
                'btn btn btn-warning col',
            );
            editBtn.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">   <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/> </svg> Verander status';
            editBtn.href = `/admin/edit-product.php?product=${result['id']}`;
            editBtn.addEventListener('click', function () {
                // TODO
            });
            thEl.appendChild(editBtn);

            trEl.appendChild(thEl);
            productsEl.appendChild(trEl);
        }
    } catch (error) {
        console.error(error.message);
    }
}

getOrders();
