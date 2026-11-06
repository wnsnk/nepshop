export default class Filters {
    constructor() {}
    /**
     * Returns array of products within selected price range
     * @param {Array} products - Array of products.
     * @param {Number} minPrice - The minimum price of the product.
     * @param {Number} maxPrice - The maximum price of the product.
     * @returns {Array} products
     */
    priceRange(products, minPrice, MaxPrice) {
        const filteredProducts = [];
        for (let product of products) {
            if (
                Number(product['product_price']) < minPrice ||
                Number(product['product_price']) > MaxPrice
            ) {
                continue;
            }
            filteredProducts.push(product);
        }
        return filteredProducts;
    }

    /**
     * Sorts an array of products
     * @param {Array} products - Array of products.
     * @param {string} sortMethod - The method of sorting.
     * @returns {Array} A sorted products array
     */
    sortProducts(products, sortMethod) {
        switch (sortMethod) {
            case 'sortOldNew':
                products.sort(function (a, b) {
                    return a.id - b.id;
                });
                break;
            case 'sortNewOld':
                products.sort(function (a, b) {
                    return a.id - b.id;
                });
                products.reverse();
                break;
            case 'sortPriceLowHigh':
                products.sort(function (a, b) {
                    return a.product_price - b.product_price;
                });
                break;
            case 'sortPriceHighLow':
                products.sort(function (a, b) {
                    return a.product_price - b.product_price;
                });
                products.reverse();
                break;
            case 'sortNameAZ':
                products.sort((a, b) =>
                    a.product_name.localeCompare(b.product_name),
                );
                break;
            case 'sortNameZA':
                products.sort((a, b) =>
                    a.product_name.localeCompare(b.product_name),
                );
                products.reverse();
                break;
        }
        return products;
    }
}
