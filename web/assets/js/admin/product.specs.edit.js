function loadFilledSpecs() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            var window = document.getElementById("specsWindow");
            window.innerHTML = "";
            var specs = JSON.parse(this.responseText);
            var i = 0;
            for (var key in specs) {
                if (specs.hasOwnProperty(key)) {
                    var specInput = document.createElement("input");
                    specInput.type = "text";
                    specInput.setAttribute("name", "specValue-" + i);
                    specInput.setAttribute("placeholder", specs[key]['name']);
                    specInput.setAttribute("value", specs[key]['value']);

                    var specId = document.createElement("input");
                    specId.type = "hidden";
                    specId.setAttribute("name", "specValueId-" + i);
                    specId.setAttribute("value", specs[key]["id"]);


                    window.append(specs[key]['name'] + ": ");
                    window.appendChild(specInput);
                    window.appendChild(specId);
                    window.innerHTML += "<br>";

                    i++;
                }
            }

            var specCount = document.createElement("input");
            specCount.type = "hidden";
            specCount.setAttribute("name", "specsCount");
            specCount.setAttribute("value", i);

            window.appendChild(specCount);
        }
    };
    var productId = location.search;
    xhttp.open("GET", "../../../controller/admin/products_promotions_reviews/edit_product_fill_specs_controller.php" + productId, true);
    xhttp.send();
}
