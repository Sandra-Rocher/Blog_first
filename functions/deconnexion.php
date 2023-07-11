
<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_destroy(); //destroy session
    header('Location:../index.php'); //redirection
    die();

    ?>

    