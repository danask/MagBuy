function removeFromCart(productId, productPrice, productQuantity) {
    $('#button-' + productId).remove();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            var items = document.getElementById("cartItems");
            items.innerHTML = parseInt(items.innerHTML) - productQuantity;
            var price = document.getElementById("cartTotalPrice");
            price.innerHTML = (parseFloat(price.innerHTML) - (productPrice * productQuantity)).toFixed(2);
            var items2 = document.getElementById("cartItems2");
            items2.innerHTML = parseInt(items2.innerHTML) - productQuantity;
            var price2 = document.getElementById("cartTotalPrice2");
            price2.innerHTML = (parseFloat(price2.innerHTML) - (productPrice * productQuantity)).toFixed(2);

            $('#product-' + productId).remove();

        }
    };
    xhttp.open("GET", "../../controller/cart/remove_from_cart_controller.php?pid=" + productId, true);
    xhttp.send();
}