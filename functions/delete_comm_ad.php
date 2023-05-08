<?php

session_start();

require_once '../modele/database.php';


// Verification que l'id user soit connecté OU admin
if (isset($_SESSION["id"]) && isset($_SESSION["user_name"]) && $_SESSION["id.users"] == $_SESSION["id_users"] || $_SESSION["id_role"] = '1') {
                                                                       

        if(isset($_GET['id']) AND !empty($_GET['id'])) {
            $deleteId = htmlspecialchars($_GET['id']);

            $delete_id = $pdo->prepare('DELETE FROM comm
                                        WHERE id = ?');
            

                    if($delete_id->execute([$deleteId])){
                    header("Location:../admin.php?&req=del_com");
                    }
                    else{header('Location:../admin.php?&req=dont_del_com');
                    }
                
        }
 }
?>

    