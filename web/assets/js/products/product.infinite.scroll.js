var loadedProducts = 0;

$(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 50) {
            loadedProducts += 6;
            var xhttp = new XMLHttpRequest();
            var productsWindow = document.getElementById("productsWindow");
            var loading = document.createElement("img");
            var loaderDiv = document.getElementById("loader");
            loading.setAttribute("src", "../../web/assets/images/ajax-loader.gif");
            if (loaderDiv.children.length < 1) {
                loaderDiv.appendChild(loading);
            }
            xhttp.onreadystatechange = function () {
                if (this.status == 200 && this.readyState == 4) {
                    loaderDiv.removeChild(loading);
                    var products = JSON.parse(this.responseText);

                    var i = 0;
                    var content = '';
                    for (var key in products) {
                        if (products.hasOwnProperty(key)) {

                            if (products[key]['percent'] != null) {
                                // && $product['start_date'] < date("Y-m-d H:i:s")
                                //&& $product['end_date'] > date("Y-m-d H:i:s")
                                var promotedPrice = math.round((products[key]['price'] -
                                            ((products[key]['price'] * products[key]['percent']) / 100)
                                        ) * 100) / 100;
                            } else {
                                promotedPrice = null;
                            }

                            if (key == 0) {
                                content += '<div class="products-grid-lft">';
                            }

                            if (i == 3) {
                                content +=
                                    '<div class="clearfix"></div></div>' +
                                    '<div class="products-grid-lft">';

                                i = 0;
                            }

                            content +=
                                '<div class="products-grd">' +
                                '<div class="p-one simpleCart_shelfItem prd">' +
                                '<a href="single.php?pid=' + products[key]['id'] + '">' +
                                '<img src="' + products[key]['image_url'] + '"' +
                                'alt="Product Image" class="img-responsive"/>' +
                                '</a>' +
                                '<h4>' + products[key]['title'] + '</h4>' +
                                '<p><a class="btn btn-default btn-sm"' +
                                'onclick="addToCart(' + products[key]['id'] +
                                ',' + (promotedPrice != null ? promotedPrice : products[key]['price']) + ')">' +
                                '<i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd' +
                                '</a>&nbsp&nbsp';
                            if (promotedPrice != null) {
                                content +=
                                    '<span class="item_price valsa"' +
                                    'style="color: red;">$' + promotedPrice + '</span>' +
                                    '<span class="item_price promoValsa">$' + products[key]['price'] + '</span>';
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
                                    '<div class="clearfix"></div></div>';
                                $('#productsWindow').append(content);
                            }

                            i++;
                        }
                    }
                }
            };
            var subcid = location.search;
            xhttp.open("GET", "../../controller/products/infinite_scroll_controller.php?lp="
                + loadedProducts + "&subcid=" + subcid, true);
            xhttp.send();
        }
    }
);