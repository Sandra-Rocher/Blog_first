<?php

require_once '../modele/database.php';


// Verification que l'id user soit connecté ET admin
if (isset($_SESSION["id"]) || $_SESSION["id_role"] = '1') {

    if (isset($_GET['id']) and !empty($_GET['id'])) {
        $commentId = htmlspecialchars($_GET['id']);

        $agree_id = $pdo->prepare('UPDATE comm
                                        SET is_valid = "1"
                                        WHERE id = ?');

        if ($agree_id->execute(array($commentId))) {

            header("Location:../admin.php?&req=agr_com");
        } else {
            header("Location:../admin.php?&req=dont_agr_com");
        }
    }
}
