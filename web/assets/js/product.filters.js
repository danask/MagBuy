function filterProducts(subcId) {
    var xhttp = new XMLHttpRequest();
    var productsWindow = document.getElementById("productsWindow");
    var mostSold = document.getElementById("mostSoldFilter").checked;
    var mostReviewed = document.getElementById("mostReviewedFilter").checked;
    var newest = document.getElementById("newestFilter").checked;
    var highestRated = document.getElementById("highestRatedFilter").checked;

    var msf = 0;
    if (mostSold === true) {
        msf = 1;
    }

    var mrf = 0;
    if (mostReviewed === true) {
        mrf = 1;
    }

    var newf = 0;
    if (newest === true) {
        newf = 1;
    }

    var hrf = 0;
    if (highestRated === true) {
        hrf = 1;
    }

    xhttp.onreadystatechange = function () {
        productsWindow.innerHTML = "<img src='../../web/assets/images/ajax-loader.gif' align='center'>";
        if (this.status == 200 && this.readyState == 4) {

        }
    };
    xhttp.open("GET", "../../controller/products/products_by_category_filters_controller.php?msf="
        + msf + "&mrf=" + mrf + "&newf=" + newf + "&hrf=" + hrf + "&scid=" + subcId, true);
    xhttp.send();
}