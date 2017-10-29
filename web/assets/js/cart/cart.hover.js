function cartHover() {

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {

            var products = JSON.parse(this.responseText);

            var container = document.getElementById('cartDivHover');
            container.innerHTML = "";

            for (var product in products) {

                var div = document.createElement('div');
                container.appendChild(div);

                div.innerHTML = "<a href=\"single.php?pid=" + products[product]['id'] + "\">" +
                "<div class='search-result'>" + "<img class='search-result-img'" +
                " src='" + products[product]['image_url'] + "'><p class='search-result-p'>"
                + products[product]['title'] + "<br/>" + "$" + products[product]['price'] +
                    "<br/>" + "Quantity: " + products[product]['quantity'] + "</p></div></a>"

            }

        }
    };
    xhttp.open("GET", "../../controller/cart/on_hover_cart.php", true);
    xhttp.send();
}