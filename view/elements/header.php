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
                    <li><a href="../admin/admin_panel.php">Admin Panel</a></li>
                </ul>
            </div>
            <?php
            $url = $_SERVER['PHP_SELF'];
            $url = array_slice(explode('/', $url), -1)[0];

            if ($url != "admin_panel.php") {
                ?>
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
                <?php
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>