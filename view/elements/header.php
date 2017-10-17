<?php
session_start();
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
                <h6><span></span> Call us GODS</h6>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>