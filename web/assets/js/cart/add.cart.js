function addToCart(productId, productPrice, productTitle, productImg) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            var items = document.getElementById("cartItems");
            items.innerHTML = parseInt(items.innerHTML) + 1;
            var price = document.getElementById("cartTotalPrice");
            price.innerHTML = (parseFloat(price.innerHTML) + productPrice).toFixed(2);


            var container = document.getElementById('cartDivHover');

            var result = "<a href=\"single.php?pid=" + productId + "\">" +
                "<div class='search-result'>" + "<img class='search-result-img'" +
                " src='" + productImg + "'><p class='search-result-p'>"
                + productTitle + "<br/>" + "$" + productPrice + "</p></div></a>";

            var productDiv = document.createElement('div');
            productDiv.innerHTML = result;
            container.appendChild(productDiv);
        }
    };

    xhttp.open("GET", "../../controller/cart/add_to_cart_controller.php?pid=" + productId + "&pqty=" + 1, true);
    xhttp.send();
}

function addToCartSingle(productId, productPrice, productTitle, productImg) {
    var xhttp = new XMLHttpRequest();
    var quantity = parseInt(document.getElementById("buyQuantity").value);
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            var items = document.getElementById("cartItems");
            items.innerHTML = parseInt(items.innerHTML) + quantity;
            var price = document.getElementById("cartTotalPrice");
            price.innerHTML = (parseFloat(price.innerHTML) + (productPrice * quantity)).toFixed(2);



            var container = document.getElementById('cartDivHover');

            var i;
            for (i = 0; i < quantity; i++) {

                var result = "<a href=\"single.php?pid=" + productId + "\">" +
                    "<div class='search-result'>" + "<img class='search-result-img'" +
                    " src='" + productImg + "'><p class='search-result-p'>"
                    + productTitle + "<br/>" + "$" + productPrice + "</p></div></a>";

                var productDiv = document.createElement('div');
                productDiv.innerHTML = result;
                container.appendChild(productDiv);

            }
        }
    };
    xhttp.open("GET", "../../controller/cart/add_to_cart_controller.php?pid=" + productId + "&pqty=" + quantity, true);
    xhttp.send();
}