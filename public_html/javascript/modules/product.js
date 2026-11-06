'use strict';

export default class Product {
    constructor(id, productName, description, size, amount, price) {
        this.id = Number(id);
        this.productName = productName;
        this.description = description;
        this.size = size;
        this.amount = Number(amount);
        this.price = Number(price);
    }
    toJSON() {
        return {
            id: this.id,
            productName: this.productName,
            description: this.description,
            size: this.size,
            amount: this.amount,
            price: this.price,
        };
    }
}
