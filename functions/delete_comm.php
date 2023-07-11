<?php

require_once '../modele/database.php';


//check that the id of the person logged in is that of the user or admin who wants to delete the comment
if (isset($_SESSION["id"]) && isset($_SESSION["user_name"]) && $_SESSION["user_name"] == $_SESSION["user_name"] || $_SESSION["id_role"] == '1' || $_SESSION["id_role"] == '2') {
                                                                       
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
                    

                        // if admin delete
                        if($_SESSION["id_role"] == '1'){

                            if($delete_id->execute([$deleteId])){
                            header("Location:../admin.php?&req=del_com");
                            }
                            else{header('Location:../admin.php?&req=dont_del_com');
                            }
                        }

                        // if user delete
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

    