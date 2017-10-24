<?php
//Check for autoloader
require_once "../../utility/autoloader.php";
//Check for session
require_once "../../utility/no_session_main.php";
//Include main Headers
require_once "../elements/headers.php";
?>

    <!-- CSS for Simple Slider  -->
    <link rel="stylesheet" href="../../web/assets/css/addReview.css">

    <!-- Define Page Name -->
    <title>MagBuy | Add Review></title>
    </head>

<?php
//Include Header
require_once "../elements/header.php";
//Include Navigation
require_once "../elements/navigation.php";
?>

    <!-- Adding new review -->
    <div class="container">
        <form action="../../controller/reviews/add_review_controller.php?pid=<?= $_GET['pid'] ?>" method="post">

            <div id='uppderDiv'></div>
            <label>Rating</label>
            <div id='lowerDiv'></div>
            <label class="radio-inline"><input type="radio" name="rating" value="1" required>
                <img class="starRating" src="../../web/assets/images/star1.png"></label>
            <label class="radio-inline"><input type="radio" name="rating" value="2" required>
                <img class="starRating" src="../../web/assets/images/star2.png"></label>
            <label class="radio-inline"><input type="radio" name="rating" value="3" required checked>
                <img class="starRating" src="../../web/assets/images/star3.png"></label>
            <label class="radio-inline"><input type="radio" name="rating" value="4" required>
                <img class="starRating" src="../../web/assets/images/star4.png"></label>
            <label class="radio-inline"><input type="radio" name="rating" value="5" required>
                <img class="starRating" src="../../web/assets/images/star5.png"></label>
            <div class="clearfix"></div>

            <label id='labelTitle' for="title">Title</label>
            <input class="form-control" type="text" name="title" placeholder="Enter Title" id="title" required>

            <label id='labelTextArea' for="reviewArea">Review</label>
            <textarea class="form-control" rows="5" name="review" id="reviewArea"></textarea><br/>

            <button id='addReviewButton' type="submit" class="btn btn-primary btn-warning">
                <span class="glyphicon glyphicon-tag"></span> Add Review
            </button>

        </form>
    </div>

<?php
//Include Footer
require_once "../elements/footer.php";
?>