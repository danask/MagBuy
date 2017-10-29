function cartHover() {

    var xhttp = new XMLHttpRequest();

    var products = parse(document.getElementById("buyQuantity").value);

    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {



        }
    };
    xhttp.open("GET", "../../controller/cart/on_hover_cart.php", true);
    xhttp.send();
}