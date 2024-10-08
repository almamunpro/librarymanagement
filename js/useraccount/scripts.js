// Function to add an item to the cart
function addToCart(title, imgSrc) {
    let cart = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    cart.push({ title: title, imgSrc: imgSrc, rentalDays: 1 }); // Default rentalDays to 1
    sessionStorage.setItem('cartItems', JSON.stringify(cart));
    showModal('The book "' + title + '" has been added to your cart.');
}


// Function to display cart items on checkout page
function displayCartItems() {
    const cartContainer = document.getElementById('cartContainer');
    const cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];

    cartContainer.innerHTML = ''; // Clear previous items

    cartItems.forEach((item, index) => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';

        cartItem.innerHTML = `
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

// Function to generate rental days options for select dropdown
function generateRentalDaysOptions(selectedDays) {
    let options = '';
    for (let i = 1; i <= 30; i++) {
        if (i === selectedDays) {
            options += `<option value="${i}" selected>${i} day(s)</option>`;
        } else {
            options += `<option value="${i}">${i} day(s)</option>`;
        }
    }
    return options;
}

// Function to update rental days for a specific cart item
function updateRentalDays(index, days) {
    let cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    cartItems[index].rentalDays = parseInt(days);
    sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
    calculateTotal(); // Recalculate total after updating rental days
}

// Function to calculate total amount
function calculateTotal() {
    let total = 0;
    const cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];

    cartItems.forEach(item => {
        total += item.rentalDays * 10; // Assuming $10 per day
    });

    let totalAmountContainer = document.getElementById('totalAmountContainer');
    totalAmountContainer.style.display = 'block';
    document.getElementById('totalAmount').innerText = total;
    document.getElementById('totalAmountHidden').value = total;

    sessionStorage.setItem('totalAmount', total); // Store total amount in sessionStorage
}


// Function to remove a cart item
function removeCartItem(index) {
    let cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    cartItems.splice(index, 1);
    sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
    displayCartItems(); // Refresh cart display after removal
}

// Function to toggle checkboxes for marking items
function toggleCheckboxes() {
    let checkboxes = document.querySelectorAll('.cart-item-checkbox');
    let markItemsButton = document.getElementById('markItemsButton');

    if (checkboxes[0].style.display === 'none' || checkboxes[0].style.display === '') {
        checkboxes.forEach(function(checkbox) {
            checkbox.style.display = 'block';
            checkbox.checked = false; // Unmark all items initially
        });
        markItemsButton.textContent = 'Unmark Items';
    } else {
        checkboxes.forEach(function(checkbox) {
            checkbox.style.display = 'none';
        });
        markItemsButton.textContent = 'Mark Items';
    }
}

// Function to show a modal with a message
function showModal(message) {
    let modal = document.getElementById('modal');
    let modalMessage = document.getElementById('modal-message');
    modalMessage.textContent = message;
    modal.style.display = 'block';
}

// Function to close the modal
function closeModal() {
    let modal = document.getElementById('modal');
    modal.style.display = 'none';
}

// Initialize cart display when the page loads
document.addEventListener("DOMContentLoaded", function() {
    displayCartItems();
});

//slideshow

let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}

