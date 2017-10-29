function searchSuggest() {

    var needle = document.getElementById("search").value;

    //Create XMLHTTP request object (the keystone of AJAX)
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var flag = true;

            var products = JSON.parse(this.responseText);

            var container = document.getElementById('result');
            container.style.display = 'block';

            container.innerHTML = "";

            for (var pid in products) {

                flag = false;

                var result = "<a href=\"single.php?pid=" + products[pid]["id"] + "\">" +
                    "<div class='search-result'>" + "<img class='search-result-img'" +
                    " src='" + products[pid]['image_url'] + "'><p class='search-result-p'>"
                    + products[pid]['title'] + "<br/>" + "$" + products[pid]['price'] + "</p></div></a>";

                var productDiv = document.createElement('div');
                productDiv.innerHTML = result;
                container.appendChild(productDiv);
            }

            if(flag) {
                container.style.display = "none";
            }

        }
    };

    //Where to send the request
    xhttp.open("GET", "../../controller/search/search_controller.php?needle=" + needle, true);
    xhttp.send();

}