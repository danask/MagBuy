//Call function with Id of the ad that will be deleted
function addFavourite(product_id) {

    //Create XMLHTTP request object (the keystone of AJAX)
    var xhttp = new XMLHttpRequest();

    //What happens when response is received
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {


        }
    };

    //Where to send the request
    xhttp.open("GET", "../../../MagBuy/controller/favourites/add_favourites_controller.php?product_id=" + product_id, true);
    xhttp.send();
}