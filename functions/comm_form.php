<?php

session_start();


// connexion avec la database
require_once '../modele/database.php';


// Vérifier qu'on prends bien l'id de l'article qu'on veut modifier
if (isset($_GET['id']) && !empty($_GET['id'])) {

    $get_id = htmlspecialchars($_GET['id']);
} else {
    die('Cet article n\'existe pas ou pas encore !');
}


if (!empty($_SESSION['id'])) {


    $my_session = $_SESSION['id'];


    if (!empty($_POST['content'])) {
        $content = htmlspecialchars($_POST['content']);

        // Le commentaire rentre dans la bdd
        $insert = $pdo->prepare('INSERT INTO comm (comment, id_users, id_articles) VALUES (:comment, :id_users, :id_articles) ');
        if ($insert->execute(array(
            ':comment' => $content,
            ':id_users' => $my_session,
            ':id_articles' => $get_id,
        )))
        // en réussite :
        {
            header('Location: ../full_article.php?id='.$_GET["id"].'&rep_err=comm_post');
            die();

            // si échec :
        } else {
            header('Location: ../full_article.php?id='.$_GET["id"].'&rep_err=comm_not_post');
        }


        // echo "Pas de commentaire";
    } else {
        header('Location:../full_articles.php?id='.$_GET["id"].'&rep_err=content_empty');
    }

    // echo "Non connecté";
} else {
    header('Location:../full_articles.php?id='.$_GET["id"].'&rep_err=empty_id');
}
