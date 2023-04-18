<?php 
    session_start(); // demarrage de la session
    session_destroy(); // on détruit la/les session(s), soit si vous utilisez une autre session, utilisez de préférence le unset()
    header('Location:../index.php'); // On redirige
    die();



    // <a class="btn btn-outline-primary btn-md" href="">J'aime</a>
    // <a class="btn btn-outline-primary btn-md" href="">Favoris</a>

// Pour faire duex buttons like et favorite :
// bootstrap : button type button couleur taille md j'aime en text avec un pouce de taille moyenne
// <button type="button" class="btn btn-outline-primary btn-md">J'aime<i class="bi bi-hand-thumbs-up ml-2" aria-hidden="true"></i></button>
// <button type="button" class="btn btn-outline-primary btn-md">Favoris<i class="bi bi-star ml-2" aria-hidden="true"></i></button>


    ?>

    