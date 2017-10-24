function addToCart(productId, productPrice) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            var items = document.getElementById("cartItems");
            items.innerHTML = parseInt(items.innerHTML) + 1;
            var price = document.getElementById("cartTotalPrice");
            price.innerHTML = (parseFloat(price.innerHTML) + productPrice).toFixed(2);
        }
    };
    xhttp.open("GET", "../../controller/cart/add_to_cart_controller.php?pid=" + productId, true);
    xhttp.send();
}