<?php

session_start();

unset($_SESSION{'loggedUser'});

header("Location: ../view/main/main.php");