// handle 'Назад' button
const backBtn = document.querySelector('.product-info__back');
if (backBtn) backBtn.addEventListener('click', () => history.back());

// add to cart 
const toCart = document.querySelectorAll('.add-to-cart');
if (toCart) {
    toCart.forEach(item => item.addEventListener('click', handleAddToCart))
}

async function handleAddToCart(e) {
    const id = e.target.getAttribute('data-id');
    const url = "/cart/addAjax/" + id;
    console.log(id);

    const response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
    })
    const result = await response.json();

    const inCartCount = document.querySelector('#cart-count');   
    inCartCount.textContent = result;

    console.log(result);
}
