// Function to add an item to the cart
function addToCart(title, imgSrc, id) {
    let cart = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    const existingItemIndex = cart.findIndex(item => item.id === id);

    if (existingItemIndex > -1) {
        cart[existingItemIndex].rentalDays += 1; // Increment rental days
    } else {
        cart.push({ id: id, title: title, imgSrc: imgSrc, rentalDays: 1 });
    }

    sessionStorage.setItem('cartItems', JSON.stringify(cart));
    showModal('The book "' + title + '" has been added to your cart.');
}

// Function to display a modal with a message
function showModal(message) {
    const modal = document.getElementById('modal');
    const modalMessage = document.getElementById('modal-message');
    modalMessage.textContent = message;
    modal.style.display = 'block';
    
    // Hide the modal after 2 seconds
    setTimeout(() => {
        modal.style.display = 'none';
    }, 2000);
}

// Function to close the modal
function closeModal() {
    const modal = document.getElementById('modal');
    modal.style.display = 'none';
}

// Function to handle "Rent Now" button
function rent(title, imgSrc, id) {
    addToCart(title, imgSrc, id);
    window.location.href = 'checkout.php';
}

// Function to calculate total rental cost
function displayCartItems() {
    const cartContainer = document.getElementById('cartContainer');
    const cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    
    cartContainer.innerHTML = ''; // Clear previous items

    cartItems.forEach((item, index) => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';

        cartItem.innerHTML = `
            <input type="checkbox" class="cart-item-checkbox" id="item${index}" value="${item.id}">
            <img src="${item.imgSrc}" alt="${item.title}" class="cart-item-image">
            <div class="cart-item-details">
                <p class="book-title">${item.title}</p>
                <label for="rentalDays${index}">Rental Days:</label>
                <select id="rentalDays${index}" class="rentalDays" onchange="updateRentalDays(${index}, this.value)">
                    ${generateRentalDaysOptions(item.rentalDays)}
                </select>
                <button class="delete-button" onclick="removeCartItem(${index})">Remove</button>
            </div>
        `;

        cartContainer.appendChild(cartItem);
    });

    calculateTotal(); // Calculate total after displaying items
}

function generateRentalDaysOptions(selectedDays) {
    let options = '';
    for (let i = 1; i <= 30; i++) {
        options += `<option value="${i}" ${i === selectedDays ? 'selected' : ''}>${i} day(s)</option>`;
    }
    return options;
}

function updateRentalDays(index, days) {
    let cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    cartItems[index].rentalDays = parseInt(days);
    sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
    calculateTotal(); // Recalculate total after updating rental days
}

function calculateTotal() {
    let total = 0;
    const cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];

    cartItems.forEach(item => {
        total += item.rentalDays * 10; // Assuming $10 per day
    });

    const totalAmountContainer = document.getElementById('totalAmountContainer');
    totalAmountContainer.style.display = 'block';
    document.getElementById('totalAmount').innerText = total.toFixed(2);
    document.getElementById('totalAmountHidden').value = total.toFixed(2);

    sessionStorage.setItem('totalAmount', total.toFixed(2)); // Store total amount in sessionStorage
}

function removeCartItem(index) {
    let cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    cartItems.splice(index, 1);
    sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
    displayCartItems(); // Refresh cart display after removal
}

function toggleCheckboxes() {
    const checkboxes = document.querySelectorAll('.cart-item-checkbox');
    const markItemsButton = document.getElementById('markItemsButton');

    if (checkboxes[0].style.display === 'none' || checkboxes[0].style.display === '') {
        checkboxes.forEach(checkbox => {
            checkbox.style.display = 'block';
            checkbox.checked = false; // Unmark all items initially
        });
        markItemsButton.textContent = 'Unmark Items';
    } else {
        checkboxes.forEach(checkbox => {
            checkbox.style.display = 'none';
        });
        markItemsButton.textContent = 'Mark Items';
    }
}

function goToPayment() {
    window.location.href = "payment.php";
}

// Initialize cart display when the page loads
document.addEventListener("DOMContentLoaded", function() {
    displayCartItems();
});
