//Menu right
const bag = document.querySelector('header .bag');
const cart = document.querySelector('.cart');
const closecartBtn = document.querySelector('.closecart');


loadEventListeners()

function loadEventListeners() {
    bag.addEventListener('click', openCart);
    closecartBtn.addEventListener('click', closecart)

}

//Open cart
function openCart(e) {
    e.preventDefault();
    cart.classList.add('activo')
}
//Close Cart
function closecart(e) {
    e.preventDefault();
    cart.classList.remove('activo')
}



document.querySelectorAll('.quantityEdit').forEach(element => {
    element.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            let quantity = this.value;
            let code = this.id;
            var loc = window.location.pathname;
            var dir = loc.substring(0, loc.lastIndexOf('/'));
            window.location.href = dir + '/index.php?action=edit&code=' + code + '&quantity=' + quantity;
        }
    })
});

function changeQuantity(quantity, value) {
    if ((quantity.value == quantity.min && value < 0) || (quantity.value == quantity.max && value > 0)) return;
    quantity.value = Number(quantity.value) + value;

    var loc = window.location.pathname;
    var dir = loc.substring(0, loc.lastIndexOf('/'));
    window.location.href = dir + '/index.php?action=edit&code=' + quantity.id + '&quantity=' + quantity.value;

}