let cart = [];

function loadCart() {
    const savedCart = localStorage.getItem('cart');
    if (savedCart) {
        cart = JSON.parse(savedCart);
    }
    updateCartCount();
    renderCart();
}

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
}
function updateCartCount() {
    const counters = document.querySelectorAll('#cart-count');
    counters.forEach(counter => {
        counter.textContent = cart.length;
    });
}

function addToCart(productName) {
    cart.push(productName);
    saveCart();
    alert(`Товар "${productName}" успешно добавлен в корзину!`);
}

function renderCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    if (!cartItemsContainer) return; 
    cartItemsContainer.innerHTML = '';

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<li class="list-group-item bg-dark text-white border-secondary">Корзина пуста</li>';
        return;
    }

    cart.forEach((item, index) => {
        const li = document.createElement('li');
        li.className = 'list-group-item bg-dark text-white border-secondary d-flex justify-content-between align-items-center';
        li.innerHTML = `
            ${item}
            <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${index})">Удалить</button>
        `;
        cartItemsContainer.appendChild(li);
    });
}
function removeFromCart(index) {
    cart.splice(index, 1);
    saveCart();
    renderCart();
}

function clearCart() {
    cart = [];
    saveCart();
    renderCart();
}

loadCart();