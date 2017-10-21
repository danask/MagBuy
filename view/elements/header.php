<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="top_bg" id="home">
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
                <form action="" method="get">
                <input id="search" class="form-control" type="text" placeholder="Search" onkeyup="searchSuggest()">
                <input type="submit" style="position: absolute; left: -9999px">
                </form>

                <script>
                    function searchSuggest() {

                        var needle = document.getElementById("search").value;

                        //Create XMLHTTP request object (the keystone of AJAX)
                        var xhttp = new XMLHttpRequest();

                        xhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {

                                alert (this.responseText);

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