<?php

require_once '../modele/database.php';


//check that the id of the person logged in is ADMIN
if (isset($_SESSION["id"]) && isset($_SESSION["user_name"]) && $_SESSION["user_name"] == $_SESSION["user_name"] || $_SESSION["id_role"] = '1') {
                                                                       

        if(isset($_GET['id']) AND !empty($_GET['id'])) {
            $deleteArt = htmlspecialchars($_GET['id']);

            $delete_id = $pdo->prepare('DELETE FROM articles
                                        WHERE id = ?');
            

                if($delete_id->execute([$deleteArt])){
                header("Location:../admin.php?&req=del_art");
                }
                else{header('Location:../admin.php?&req=dont_del_art');
                }
            }
 }
?>

    