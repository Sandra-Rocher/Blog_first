<?php

session_start();

require_once '../modele/database.php';


// Verification que l'id user soit connecté et l editeur de l'article à suprimer
if (isset($_SESSION["id"]) && isset($_SESSION["user_name"]) && $_SESSION["user_name"] == $_SESSION["user_name"] || $_SESSION["id_role"] == '1' || $_SESSION["id_role"] == '2') {
                                            
    $sessionId = $_SESSION["id"];

        if(isset($_GET['id']) AND !empty($_GET['id'])) {
            $deleteArt = htmlspecialchars($_GET['id']);


            $verif = $pdo->prepare(' SELECT * from articles
                                                WHERE id = ? 
                                                AND articles.id_users = ?
                                    ');
            if($verif->execute([$deleteArt, $sessionId])) {

                if ($verif->rowCount() == 1) {


                        $delete_id = $pdo->prepare('DELETE FROM articles
                                                    WHERE id = ?');
                        

                        // si c'est un admin qui delete
                        if($_SESSION['id_role'] == '1'){

                            if($delete_id->execute([$deleteArt])){
                            header("Location:../admin.php?&req=del_art");
                            }
                            else{header('Location:../admin.php?&req=dont_del_art');
                            }
                        }

                        // Si c'est l'éditeur de l'article qui delete
                        else if($_SESSION['id_role'] == '2'){

                            if($delete_id->execute([$deleteArt])){
                            header('Location:../other_articles.php?&success=del_art');

                            }else{header('Location:../other_articles.php?&success=dont_del_art');

                            }    
                        }

                                 
                } else { 
                    echo "Vous n'êtes pas l'éditeur de l'article";

                }

            } else { 
                echo "Erreur3";

            }
        }
 }
?>

    