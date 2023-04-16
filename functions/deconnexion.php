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


    // Pour plus tard : les videos postées :

    // videos youtube partager_integer
    // <iframe width="560" height="315" src="https://www.youtube.com/embed/0zmpuehm3UA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    // <iframe width="560" height="315" src="https://www.youtube.com/embed/wSdT-SArM2Q" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>  
        

    //     msie en page bootstrap
    //     <div class="embed-responsive embed-responsive-16by9">
    //      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
    //     </div>  

    //     donc il faudrait creer un tableau qui récupere peut etre la width et la height
    //     mais qui prends : le src (pour remplacer celui donner dans lexemple bootstrap)
    //                       le_titlee
    //                       frameborder
    //                     allow


    ?>

    