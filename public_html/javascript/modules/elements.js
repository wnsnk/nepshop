/**
 * Creates an element with classes
 * @param {string} element - The name of the element (for example div or btn).
 * * @param {string} classes - All the classes you want to ad to the element (for example 'btn btn-primary').
 */
export function createElementWithClass(element, classes) {
    const el = document.createElement(element);
    el.className = classes;
    return el;
}

export function createBootstrapCard(
    productName,
    productPrice,
    imgUrl,
    productId,
) {
    const cardDiv = createElementWithClass('div', 'card');

    const imgElement = createElementWithClass('img', 'card-img-top');
    imgElement.src = imgUrl;
    cardDiv.appendChild(imgElement);

    const bodyDiv = createElementWithClass('div', 'card-body');
    const titleElement = createElementWithClass('h5', 'card-title');
    titleElement.textContent = productName;
    const priceElement = createElementWithClass('p', 'card-text');
    priceElement.textContent = `€${productPrice}`;
    const buttonElement = createElementWithClass('a', 'btn btn-primary');
    buttonElement.textContent = 'Bekijk product';
    buttonElement.href = `product.php?product=${productId}`;

    bodyDiv.appendChild(titleElement);
    bodyDiv.appendChild(priceElement);
    bodyDiv.appendChild(buttonElement);

    cardDiv.append(bodyDiv);

    return cardDiv;
}
