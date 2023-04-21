<?php

require_once 'database.php';


// Verification que l'id user soit connecté ET admin
if(isset($_SESSION["id"]) || $_SESSION["id_role"] = '1'){

        if(isset($_GET['id']) AND !empty($_GET['id'])) {
            $articleId = htmlspecialchars($_GET['id']);

            $agree_id = $pdo->prepare('UPDATE articles
                                        SET is_valid = "1"
                                        WHERE id = ?');
                                         
            if($agree_id->execute(array($articleId))){

                header("Location:../admin.php?&success=agr_art");
            }else{
                header("Location:../admin.php?&success=dont_agr_art");
            }
        }

}        
?>

