<?php

require_once '../modele/database.php';


if (isset($_GET['idc']) && !empty($_GET['idc'])) {

    $get_idc = htmlspecialchars($_GET['idc']);
} else {
    //TODO
    header('Location:../modif_comm.php?reg_err=error_no_comm_id');
}


if (isset($_GET['ida']) && !empty($_GET['ida'])) {

    $get_ida = htmlspecialchars($_GET['ida']);
} else {
    //TODO
    header('Location:../modif_comm.php?reg_err=error_no_art_id');
}


if (!empty($_SESSION['id'])) {

    $my_session = $_SESSION['id'];

    //To check the modification of a posted article, is_valid must return to 0 in the database, so that the administrator can check again.
    $is_valid = 0;

        
        if (!empty($_POST['cont'])) {
            
            $cont = htmlspecialchars($_POST['cont']);


                    $insert = $pdo->prepare('UPDATE comm
                                                SET comment = ?, is_valid = ?
                                                WHERE id = ?');

                    if($insert->execute([$cont, $is_valid, $get_idc])){

                    //echo comment received, it will be checked by the admin and published or deleted 
                     //"Commentaire reçu, il sera vérifié par l'admin et publié ou supprimé !";
                    header('Location:../full_article.php?id='.$_GET['ida'].'&rep_err=success_upd');
                    die();

                    // echo error update / "Erreur d'upd";
                    } else {
                        header('Location:../modif_comm.php?id='.$_GET['idc'].'&rep_err=error');
                    }
            

        // echo empty input / "veuillez remplir le champ";
        } else {
            header('Location:../modif_comm.php?id='.$_GET['idc'].'&rep_err=cont_empty');
        }


    // echo error id / "Erreur d'id";
} else {
    header('Location:../full_article.php?id='.$_GET['ida'].'&rep_err=error_id');
}
