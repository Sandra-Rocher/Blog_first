<?php

require_once '../modele/database.php';


//check that the id of the person logged in is ADMIN
if (isset($_SESSION["id"]) || $_SESSION["id_role"] = '1') {

    if (isset($_GET['id']) and !empty($_GET['id'])) {
        $articleId = htmlspecialchars($_GET['id']);

        $agree_id = $pdo->prepare('UPDATE articles
                                        SET is_valid = "1"
                                        WHERE id = ?');

        if ($agree_id->execute(array($articleId))) {

            header("Location:../admin.php?&req=agr_art");
        } else {
            header("Location:../admin.php?&req=dont_agr_art");
        }
    }
}
