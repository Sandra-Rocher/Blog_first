<?php

require_once '../modele/database.php';

//id_article who want to be liked
if (isset($_GET['id']) && !empty($_GET['id'])) {

    $get_id = htmlspecialchars($_GET['id']);
} else {
    die('Désolé, cet article n\'existe pas ou pas encore !');
}


if (!empty($_SESSION['id'])) {


    $my_session = $_SESSION['id'];

    //Count the likes in the database to see if this session_id has already liked this article_id
    $verif = $pdo->prepare('SELECT * FROM `likes` 
                                WHERE id_articles = ? 
                                AND id_users = ?
                                ');
    $verif->execute(array($get_id, $my_session));

    //If row count = 0, add like on bdd. This article got 1 like in totality and maximum
    if ($verif->rowCount() == 0) {
        $insert = $pdo->prepare('INSERT INTO likes 
                                            (id_users, id_articles)
                                            VALUES (?, ?)
                                ');
        if ($insert->execute(array($my_session, $get_id))) {
            echo "A voté !";
            
        }
        else{echo "Erreur_insertion";
        }

    //If row count = 1, delete like on bdd. So this article got 0 likes and respect the rules.
    } else {
        $delete_id = $pdo->prepare('DELETE FROM likes
                                             WHERE id_users = ? 
                                             AND id_articles = ?
                                            ');
        if($delete_id->execute(array($my_session, $get_id))){
            echo "Oups !";
        }
        else{echo "Erreur_delete";
        }
        
    }
    

    // echo not connected / "Non connecté";
} else {
    header('Location:../full_articles.php?id=' . $_GET["id"] . '&rep_err=empty_id');
}
