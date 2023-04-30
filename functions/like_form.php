<?php

session_start();

// connexion avec la database
require_once '../modele/database.php';


// Vérifier qu'on prends bien l'id de l'article qu'on veut modifier
if(isset($_GET['id']) && !empty($_GET['id'])) {

    $get_id = htmlspecialchars($_GET['id']);

}else { die('Cet article n\'existe pas ou pas encore !');  
}
        

if(!empty($_SESSION['id'])){


    $my_session = $_SESSION['id'];

        //On compte les likes dans la bdd pour voir si cette session_id à déja liké cet id_article
        $verif = $pdo->prepare('SELECT COUNT(*) 
                                FROM `likes` 
                                WHERE id_articles = ? 
                                AND id_users = ?
                                ');
        ($verif->execute(array($get_id, $my_session)));

         //Si row count = 0, on ajoute le like dans la bdd. Il mettra donc 1 like.
        if($verif->rowCount() == 0)
        {               
            $insert = $pdo->prepare('INSERT INTO likes (id_users, id_articles)
                                                         VALUES (?, ?)
                                                         ');
            if($insert->execute(array($my_session, $get_id )))                  
            {

            //Si row count = 1, on enleve le like dans la bdd. En retirant le like, il ne pourra alors en mettre qu'un seul max ou 0 (donc null).
            }
        }else{ 
            $delete_id = $pdo->prepare('DELETE FROM likes
                                             WHERE id_users = ? 
                                             AND id_articles = ?
                                            ');
            $delete_id->execute(array($my_session, $get_id )); 
        }
                    

    // echo "Non connecté";
}else{header('Location:../full_articles.php?id='.$_GET["id"].'&rep_err=empty_id'); }  

?>