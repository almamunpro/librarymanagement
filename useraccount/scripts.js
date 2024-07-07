function addToCart(title, imgSrc) {
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    cart.push({ title: title, imgSrc: imgSrc });
    sessionStorage.setItem('cart', JSON.stringify(cart));
    showModal('The book "' + title + '" has been added to your cart.');
}

function buyNow(title, imgSrc) {
    addToCart(title, imgSrc);
    window.location.href = 'checkout.php';
}

function calculateTotal() {
    let total = 0;
    let checkboxes = document.querySelectorAll('.cart-item-checkbox');

    if (checkboxes.length === 0 || checkboxes[0].style.display === 'none') {
        // If no checkboxes are visible, calculate total for all items
        document.querySelectorAll('.cart-item').forEach(function(cartItem) {
            let rentalDays = parseInt(cartItem.querySelector('.rentalDays').value);
            total += rentalDays * 10; // Assuming $10 per day
        });
    } else {
        // Calculate total only for checked items
        checkboxes.forEach(function(checkbox, index) {
            if (checkbox.checked) {
                let rentalDays = parseInt(checkbox.nextElementSibling.nextElementSibling.nextElementSibling.value);
                total += rentalDays * 10; // Assuming $10 per day
            }
        });
    }

    let totalAmountContainer = document.getElementById('totalAmountContainer');
    totalAmountContainer.textContent = 'Total Amount: $' + total;
    totalAmountContainer.style.display = 'block';
}

function showModal(message) {
    let modal = document.getElementById('modal');
    let modalMessage = document.getElementById('modal-message');
    modalMessage.textContent = message;
    modal.style.display = 'block';
}

function closeModal() {
    let modal = document.getElementById('modal');
    modal.style.display = 'none';
}

window.onload = function() {
    if (document.getElementById('cartContainer')) {
        displayCart();
    }
};

function deleteCartItem(index) {
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    cart.splice(index, 1);
    sessionStorage.setItem('cart', JSON.stringify(cart));
    displayCart();
}

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

function displayCart() {
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    let cartContainer = document.getElementById('cartContainer');
    cartContainer.innerHTML = '';

    cart.forEach(function(item, index) {
        let cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');

        let checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.classList.add('cart-item-checkbox');
        checkbox.style.display = 'none'; // Hide initially
        cartItem.appendChild(checkbox);

        let img = document.createElement('img');
        img.src = item.imgSrc;
        img.alt = item.title;
        img.classList.add('book-img');
        cartItem.appendChild(img);

        let title = document.createElement('p');
        title.textContent = (index + 1) + '. ' + item.title;
        title.classList.add('book-title');
        cartItem.appendChild(title);

        let rentalDaysSelect = document.createElement('select');
        rentalDaysSelect.classList.add('rentalDays');
        for (let i = 1; i <= 30; i++) {
            let option = document.createElement('option');
            option.value = i;
            option.textContent = i + ' day(s)';
            rentalDaysSelect.appendChild(option);
        }
        cartItem.appendChild(rentalDaysSelect);

        let deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.onclick = function() {
            deleteCartItem(index);
        };
        deleteButton.style.float = 'right'; // Align the delete button to the right
        cartItem.appendChild(deleteButton);

        cartContainer.appendChild(cartItem);
    });
}
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

// Assuming we have an array to keep track of stock
let bookStock = {
    1: 10 // Example book ID and its stock
};

function updateStock(bookId) {
    if (bookStock[bookId] > 0) {
        bookStock[bookId]--;
        document.getElementById(`stock-${bookId}`).innerText = bookStock[bookId];
    } else {
        alert("Out of stock!");
    }
}

function addToCart(title, imgSrc, bookId) {
    let cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    cartItems.push({ title, imgSrc, bookId });
    sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
    updateStock(bookId); // Decrease the stock
    showModal("Item added to cart");
}

function buyNow(title, imgSrc, bookId) {
    let cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    cartItems.push({ title, imgSrc, bookId });
    sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
    updateStock(bookId); // Decrease the stock
    window.location.href = 'checkout.php';
}
