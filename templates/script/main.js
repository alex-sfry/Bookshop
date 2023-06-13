const backBtn = document.querySelector('.product-info__back');
if (backBtn) backBtn.addEventListener('click', () => history.back());

const addToCart = document.querySelectorAll('.add-to-cart');
if (addToCart) {
    addToCart.forEach(item => {
        item.addEventListener('click', async (e) => {
            console.log('click');
            const id = e.target.getAttribute('data-id');
            console.log(id);
            const response = await toCart("/cart/addAjax/" + id);
            handleResponse(response);
        });
    })
}

async function toCart(url) {
    return await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
    })
}

async function handleResponse(response) {
    const result = await response.text();
    const cartCount = document.querySelector('#cart-count');
    console.log(result);
    cartCount.textContent = result;
}