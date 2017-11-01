var offset = 0;

$(document).ready(function () {
    loadProducts(offset);
});

$(window).scroll(function () {
        onScrollToBottom();
    }
);

function filteredProducts() {
    $(window).bind('scroll', function () {
        onScrollToBottom();
    });
    offset = 0;
    loadProducts(offset);
}

function onScrollToBottom() {
    if ($(window).scrollTop() + $(window).height() > $(document).height() - 50) {
        offset += 8;
        loadProducts(offset);
    }
}

function loadProducts(offset) {
    var xhttp = new XMLHttpRequest();
    var productsWindow = document.getElementById("productsWindow");
    var loading = document.createElement("img");
    loading.setAttribute("src", "../../web/assets/images/ajax-loader.gif");
    loading.setAttribute("class", "center-block");
    var loaderDiv = document.getElementById("loader");
    if (loaderDiv.children.length < 1) {
        loaderDiv.appendChild(loading);
    }
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            loaderDiv.innerHTML = "";
            if (offset == 0) {
                productsWindow.innerHTML = "";
            }
            var products = JSON.parse(this.responseText);
            if (products.length == 0) {
                $(window).unbind('scroll');
            }
            var i = 0;
            var content = '';
            for (var key in products) {
                if (products.hasOwnProperty(key)) {

                    if (products[key]['percent'] !== null) {
                        var promotedPrice = Math.round((products[key]['price'] -
                                    ((products[key]['price'] * products[key]['percent']) / 100)
                                ) * 100) / 100;
                    } else {
                        promotedPrice = null;
                    }
                    if (products[key]['average'] === null) {
                        var productAverage = 0;
                    } else {
                        productAverage = Math.round(products[key]['average']);
                    }

                    if (key == 0) {
                        content += '<div class="products-grid-lft">';
                    }

                    if (i == 4) {
                        content +=
                            '<div class="products-grid-lft">';

                        i = 0;
                    }

                    content +=
                        '<div class="products-grd">' +
                        '<div id="categoryMarginUnderButton" class="p-one">' +
                        '<a href="single.php?pid=' + products[key]['id'] + '">' +
                        '<img src="' + products[key]['image_url'] + '"' +
                        'alt="Product Image" class="img-responsive"/>' +
                        '</a>' +
                        '<h4>' + products[key]['title'] + '</h4>' +
                        '<img class="ratingCatDiv media-object img"' +
                        ' src="../../web/assets/images/rating' + productAverage + '.png">' +
                        '<span>(' + products[key]['reviewsCount'] + ')</span>' + '<br/><br/>' +
                        '<p><a id="addButtonBlock" class="btn btn-default btn-sm"' +
                        'onclick="addToCart(' + products[key]['id'] +
                        ',' + (promotedPrice != null ? promotedPrice : products[key]['price']) + ')">' +
                        '<i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd' +
                        '</a>&nbsp&nbsp';
                    if (promotedPrice != null) {
                        content +=
                            '<span class="item_price valsa"' +
                            'style="color: red;">$' + promotedPrice + '</span>' +
                            ' <span class="item_price promoValsa">$' + products[key]['price'] + '</span>';
                    }
                    else {
                        content +=
                            '<span class="item_price valsa">$' + products[key]['price'] + '</span>';
                    }

                    content +=
                        '</p>' +
                        '<div class="pro-grd">' +
                        '<a href="single.php?pid=' + products[key]['id'] + '">View</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    if (key == products.length - 1) {
                        content +=
                            '</div>';
                        $('#productsWindow').append(content);
                    }

                    i++;
                }
            }
        }
    };
    var priceFilter = document.getElementById("amount").value;
    var filter = document.getElementById('filter').value;
    var subcid = location.search;
    xhttp.open("GET", "../../controller/products/products_by_category_controller.php" + subcid + "&offset="
        + offset + "&filter=" + filter + "&pf=" + priceFilter, true);
    xhttp.send();
}