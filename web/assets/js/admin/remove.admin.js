function deleteSuperCat(superCatId) {
    if (confirm("Are you sure you want to delete SuperCategory with ID " + superCatId + " ? WARNING: " +
            "This will also delete or set null anything that goes under this SuperCategory(lower categories, products, etc)!")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {
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
            if (this.status == 200 && this.readyState == 4) {
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
            if (this.status == 200 && this.readyState == 4) {
                $('#delId-' + subcatId).remove();
            }
        };
        xhttp.open("GET", "../../../controller/admin/categories/delete_category_controller.php?cid=" + subcatId, true);
        xhttp.send();
    }
}