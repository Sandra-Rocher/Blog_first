<?php

require_once '../modele/database.php';

//check that the id of the person logged in is that of the user or admin who wants to delete the article
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
                        

                        // if admin delete :
                        if($_SESSION['id_role'] == '1'){

                            if($delete_id->execute([$deleteArt])){
                            header("Location:../admin.php?&req=del_art");
                            }
                            else{header('Location:../admin.php?&req=dont_del_art');
                            }
                        }

                        // if user delete :
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

    