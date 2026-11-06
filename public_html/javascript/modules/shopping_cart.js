'use strict';

import Product from './product.js';

export default class ShoppingCart {
    constructor() {
        if (!window.localStorage.getItem('cart')) {
            this.clear();
        }
        this.items = JSON.parse(window.localStorage.getItem('cart'));
    }
    /**
     * adds product to shopping cart
     * @param {Product} product - The product that needs to be added.
     */
    add(product) {
        let itemInCart = false;
        let index = 0;
        for (let item of this.items['shoppingCart']) {
            item = JSON.parse(item);
            if (
                item['id'] === product['id'] &&
                item['size'] === product['size']
            ) {
                itemInCart = true;
                item['amount'] = item['amount'] += product['amount'];
                this.items['shoppingCart'][index] = JSON.stringify(item);
                this.updateLocalStorage();
            }
        }
        if (!itemInCart) {
            this.items['shoppingCart'].push(JSON.stringify(product));
            this.updateLocalStorage();
        }
    }
    /**
     *  Removes product from shopping cart
     * @param {Product} product - The product that needs to be Removed.
     * * @param Amount - The Amount of the product that needs to be Removed.
     */
    remove(product, amount) {
        let index = 0;
        for (let item of this.items['shoppingCart']) {
            item = JSON.parse(item);
            if (
                item['id'] === product['id'] &&
                item['size'] === product['size']
            ) {
                if (amount < item['amount']) {
                    item['amount'] = item['amount'] - amount;
                    this.items['shoppingCart'][index] = JSON.stringify(item);
                    this.updateLocalStorage();
                } else {
                    this.items['shoppingCart'].splice(index, 1);
                }

                this.updateLocalStorage();
            }
            index++;
        }
    }
    /**
     *  Empty the shopping cart
     */
    clear() {
        const emptyCart = { shoppingCart: [] };
        window.localStorage.setItem('cart', JSON.stringify(emptyCart));
    }
    /**
     * Compares the items in the cart against the items in the Database and updates the cart if something is not in stock.
     */
    async compareCartStock() {
        try {
            const response = await fetch('/api/check_stock.php', {
                method: 'POST',
                body: JSON.stringify({
                    cart: this.items['shoppingCart'],
                }),
            });

            if (!response.ok) {
                console.log();
                throw new Error(`Response status: ${response.status}`);
            }
            const result = await response.json();
            // console.log(this.items['shoppingCart']);
            // console.log(result);
            if (!result['succes']) {
                ((this.items['shoppingCart'] = result['updated_cart']),
                    this.updateLocalStorage());
            }
        } catch (error) {
            console.error(error.message);
        }
    }

    async checkout(customerId, payment_method, totalAmount, shippingCosts) {
        try {
            const response = await fetch('/api/checkout.php', {
                method: 'POST',
                body: JSON.stringify({
                    customerId: customerId,
                    cart: this.items['shoppingCart'],
                    paymentMethod: payment_method,
                    totalAmount: totalAmount,
                    shippingCosts: shippingCosts,
                }),
            });
            if (!response.ok) {
                console.log();
                throw new Error(`Response status: ${response.status}`);
            }
            const result = await response.json();
            console.log(result);
            if (result['succes']) {
                return true;
            } else {
                return false;
            }
        } catch (error) {
            console.error(error.message);
            return false;
        }
    }

    updateLocalStorage() {
        window.localStorage.setItem('cart', JSON.stringify(this.items));
    }
}
