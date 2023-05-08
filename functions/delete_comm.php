<?php

session_start();

require_once '../modele/database.php';


// Verification que l'id user soit connecté, l editeur du commentaire a suprimer
if (isset($_SESSION["id"]) && isset($_SESSION["user_name"]) && $_SESSION["id.users"] == $_SESSION["id_users"] || $_SESSION["id_role"] = '1 || 2') {
                                                                       
    $sessionId = $_SESSION["id"];

        if(isset($_GET['id']) AND !empty($_GET['id'])) {
            $deleteId = htmlspecialchars($_GET['id']);

            $verif = $pdo->prepare(' SELECT * from comm 
                                                WHERE id = ? 
                                                AND comm.id_users = ?
                                    ');
            if($verif->execute([$deleteId, $sessionId])) {

                if ($verif->rowCount() == 1) {
                                

                    $delete_id = $pdo->prepare('DELETE FROM comm
                                                WHERE id = ?');
                    

                        // si c'est un admin qui delete
                        if($_SESSION["id_role"] == '1'){

                            if($delete_id->execute([$deleteId])){
                            header("Location:../admin.php?&req=del_com");
                            }
                            else{header('Location:../admin.php?&req=dont_del_com');
                            }
                        }

                        // Si c'est l'éditeur de l'article qui delete
                        elseif($_SESSION["id_role"] == '2'){

                            if($delete_id->execute([$deleteId])){
                            header('Location:../other_articles.php?&req=del_com');

                            }else{header('Location:../other_articles.php?&req=dont_del_com');

                            }    
                        }


                        
                } else { 
                    echo "Vous n'êtes pas l'éditeur du commentaire";

                }

            } else { 
                echo "Erreur1";

            }
        }
 }
?>

    