<?php

require_once '../modele/database.php';


//check that the id of the person logged in is that of the user or admin who wants to delete the comment
if (isset($_SESSION["id"]) && isset($_SESSION["user_name"]) && $_SESSION["user_name"] == $_SESSION["user_name"] || $_SESSION["id_role"] = '1') {
                                                                       

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

    