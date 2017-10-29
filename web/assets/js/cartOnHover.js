function cartOnHover() {

    document.getElementById('cartDivHover').innerHTML = "";


    for (var pid in products) {

        var result = "<a href=\"single.php?pid=" + products[pid]["id"] + "\">" +
            "<div class='search-result'>" + "<img class='search-result-img'" +
            " src='" + products[pid]['image_url'] + "'><p class='search-result-p'>"
            + products[pid]['title'] + "<br/>" + "$" + products[pid]['price'] + "</p></div></a>";

        var productDiv = document.createElement('div');
        productDiv.innerHTML = result;
        container.appendChild(productDiv);
    }
}