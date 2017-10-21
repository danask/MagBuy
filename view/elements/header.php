<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="top_bg" id="home" style="position: fixed; z-index: 999; width: 100%; margin-bottom: 100px;">
    <div class="container">
        <div class="header_top">
            <div class="top_right">
                <ul>
                    <?php
                    if (isset($_SESSION['loggedUser'])) {
                        echo '<li><a href="../user/edit.php">Edit profile</a></li>';
                        echo '<li><a href="../../utility/log_out.php">LogOut</a></li>';
                    } else {
                        echo '<li><a href="../user/register.php">Register</a></li>';
                        echo '<li><a href="../user/login.php">Login</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="top_left">
                <form action="" method="get" autocomplete="off" >
                <input id="search" class="form-control" type="text" placeholder="Search" onkeyup="searchSuggest()">

                    <div id='result' style=" display:none; z-index: 100; height: 200px; width: 184px; background-color: inherit; position: absolute;"></div>

                <input type="submit" style="position: absolute; left: -9999px">
                </form>

                <script>
                    function searchSuggest() {

                        var needle = document.getElementById("search").value;

                        //Create XMLHTTP request object (the keystone of AJAX)
                        var xhttp = new XMLHttpRequest();

                        xhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {

                                var products = JSON.parse(this.responseText);

                                var container = document.getElementById('result');
                                container.style.display = 'block';

                                container.innerHTML = "";

                                for (var pid in products) {

                                    var result = "<a href=\"single.php?pid=" + products[pid]["id"] + "\"><div style=\"background-color: #F5F5F5 ; margin: 0; padding: 10px; \"><img style=\"border-radius: 10%; display:inline-block; width: 70px;\" src='" + products[pid]['image_url'] + "'><p style=\" margin-left: 20px; display:inline-block;\">" + products[pid]['title'] + "<br/>$" + products[pid]['price'] + "</p></div></a>";
                                    var productDiv = document.createElement('div');
                                    productDiv.innerHTML = result;
                                    container.appendChild(productDiv);
                                }
                            }
                        };

                        //Where to send the request
                        xhttp.open("GET", "../../controller/search/search_controller.php?needle=" + needle, true);
                        xhttp.send();

                    }
                </script>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>