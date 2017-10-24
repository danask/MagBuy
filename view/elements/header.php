<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="en">
<head>

    <!-- Add Favicon -->
    <link rel="shortcut icon" href="../../web/assets/images/favicon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- Bootstrap CSS Library -->
    <link href="../../web/assets/css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <!-- Main site CSS -->
    <link href="../../web/assets/css/style.css" rel='stylesheet' type='text/css'/>
    <!-- Navigation CSS -->
    <link href="../../web/assets/css/megamenu.css" rel="stylesheet" type="text/css" media="all"/>

    <!-- JQuery Library -->
    <script src="../../web/assets/js/jquery-1.11.1.min.js"></script>
    <!-- Navigation JS -->
    <script type="text/javascript" src="../../web/assets/js/megamenu.js"></script>
    <!-- Search JS -->
    <script type="text/javascript" src="../../web/assets/js/search.js"></script>

    <!-- Web fonts -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,300italic,600,700' rel='stylesheet'
          type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Slab:300,400,700' rel='stylesheet' type='text/css'>

    <title>MagBuy Home</title>
</head>
<body>
<div class="top_bar">
    <div class="container">
        <div class="header_top">

            <!-- User Control -->
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

            <!-- Search bar -->
            <div class="top_left">
                <form action="../main/search.php" method="get" autocomplete="off">
                    <input name="search" id="search" class="form-control" type="text"
                           placeholder="Press Enter to Search"
                           onkeyup="searchSuggest()" required>
                    <div id='result'></div>
                <input type="submit" id="search-submit">
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>