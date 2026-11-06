'use strict';

const carousel = document.querySelector('#carouselProducts');

import {
    createBootstrapCard,
    createElementWithClass,
} from './modules/elements.js';

async function getProducts() {
    console.log('a');
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
        const randomItems = getRandomItems(results, 12);
        // TODO FIX ROW COL
        let count = 0;
        let carouselItemCount = 0;
        let carouselItemDiv, rowDiv;
        for (const item of randomItems) {
            if (carouselItemCount === 0) {
                carouselItemDiv = createElementWithClass(
                    'div',
                    'carousel-item',
                );
                if (count === 0) {
                    carouselItemDiv.classList.add('active');
                    console.log(carouselItemDiv.classList);
                }
                rowDiv = createElementWithClass('div', 'row');
                carouselItemDiv.appendChild(rowDiv);
                carousel.appendChild(carouselItemDiv);
            }
            carouselItemCount++;
            count++;
            const card = createBootstrapCard(
                item['product_name'],
                item['product_price'],
                item['img_url'],
                item['id'],
            );
            card.classList.add('col');

            console.log(card.classList);
            rowDiv.appendChild(card);

            if (carouselItemCount >= 4) {
                carouselItemCount = 0;
            }
        }
    } catch (error) {
        console.error(error.message);
    }
}

getProducts();

function getRandomItems(results, amount) {
    const items = [];
    for (let i = 0; i < amount; i++) {
        const randomIndex = Math.floor(Math.random() * results.length);
        items.push(results[randomIndex]);
    }
    return items;
}
