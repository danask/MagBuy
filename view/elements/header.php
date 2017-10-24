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