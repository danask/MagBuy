function deleteSuperCat(superCatId) {
    if (confirm("Are you sure you want to delete SuperCategory with ID " + superCatId + " ? WARNING: " +
            "This will also delete or set null anything that goes under this SuperCategory(lower categories, products, etc)!")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.status == 500 && this.readyState == 4) {
                window.location.replace("../error/error_500.php");
            } else if (this.status == 400 && this.readyState == 4) {
                window.location.replace("../error/error_400.php");
            } else if (this.status == 200 && this.readyState == 4) {
                $('#delId-' + superCatId).remove();
            }
        };
        xhttp.open("GET", "../../../controller/admin/supercategories/delete_supercategory_controller.php?scid=" + superCatId, true);
        xhttp.send();
    }
}

function deleteCat(catId) {
    if (confirm("Are you sure you want to delete Category with ID " + catId + " ? WARNING: " +
            "This will also delete or set null anything that goes under this Category(lower categories, products, etc)!")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.status == 500 && this.readyState == 4) {
                window.location.replace("../error/error_500.php");
            } else if (this.status == 400 && this.readyState == 4) {
                window.location.replace("../error/error_400.php");
            } else if (this.status == 200 && this.readyState == 4) {
                $('#delId-' + catId).remove();
            }
        };
        xhttp.open("GET", "../../../controller/admin/categories/delete_category_controller.php?cid=" + catId, true);
        xhttp.send();
    }
}

function deleteSubCat(subcatId) {
    if (confirm("Are you sure you want to delete SubCategory with ID " + subcatId + " ? WARNING: " +
            "This will also unset the category of any products that go under this SubCategory!")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.status == 500 && this.readyState == 4) {
                window.location.replace("../error/error_500.php");
            } else if (this.status == 400 && this.readyState == 4) {
                window.location.replace("../error/error_400.php");
            } else if (this.status == 200 && this.readyState == 4) {
                $('#delId-' + subcatId).remove();
            }
        };
        xhttp.open("GET", "../../../controller/admin/subcategories/delete_subcategory_controller.php?scid=" + subcatId, true);
        xhttp.send();
    }
}

function deleteSpec(specId) {
    if (confirm("Are you sure you want to delete SubCategory Specification with ID " + specId + " ? WARNING: " +
            "This will also delete the product specification of any products that have this Subcat Spec!")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.status == 500 && this.readyState == 4) {
                window.location.replace("../error/error_500.php");
            } else if (this.status == 400 && this.readyState == 4) {
                window.location.replace("../error/error_400.php");
            } else if (this.status == 200 && this.readyState == 4) {
                $('#delId-' + specId).remove();
            }
        };
        xhttp.open("GET", "../../../controller/admin/subcategory_specs/delete_subcat_spec_controller.php?ssid=" + specId, true);
        xhttp.send();
    }
}

function deletePromo(promoId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.status == 500 && this.readyState == 4) {
            window.location.replace("../error/error_500.php");
        } else if (this.status == 400 && this.readyState == 4) {
            window.location.replace("../error/error_400.php");
        } else if (this.status == 200 && this.readyState == 4) {
            $('#delId-' + promoId).remove();
        }
    };
    xhttp.open("GET", "../../../controller/admin/products_promotions_reviews/delete_product_promotion_controller.php?prid="
        + promoId, true);
    xhttp.send();
}

function toggleVisibility(productId, currentVis) {
    if (confirm("Are you sure you want to toggle visibility of Product with ID " + productId + " ?")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.status == 500 && this.readyState == 4) {
                window.location.replace("../error/error_500.php");
            } else if (this.status == 400 && this.readyState == 4) {
                window.location.replace("../error/error_400.php");
            } else if (this.status == 200 && this.readyState == 4) {
                var visibility = document.getElementById("togId-" + productId);
                if (visibility.innerHTML == "Yes") {
                    visibility.innerHTML = "No";
                } else {
                    visibility.innerHTML = "Yes";
                }
            }
        };
        xhttp.open("GET", "../../../controller/admin/products_promotions_reviews/visibility_product_controller.php?pid="
            + productId + "&vis=" + currentVis, true);
        xhttp.send();
    }
}