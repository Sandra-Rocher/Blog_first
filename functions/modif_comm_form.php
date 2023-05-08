<?php

session_start();


// connexion avec la database
require_once '../modele/database.php';



// Vérifier qu'on prends bien l'id du commentaire qu'on veut modifier
if (isset($_GET['idc']) && !empty($_GET['idc'])) {

    $get_idc = htmlspecialchars($_GET['idc']);
} else {
    // CREER sur la page l erreur... et indenter tout ça !!
    header('Location:../modif_comm.php?reg_err=error_no_comm_id');
}



// Vérifier qu'on prends bien l'id de l'article qu'on veut modifier
if (isset($_GET['ida']) && !empty($_GET['ida'])) {

    $get_ida = htmlspecialchars($_GET['ida']);
} else {
    // CREER sur la page l erreur... et indenter tout ça !!
    header('Location:../modif_comm.php?reg_err=error_no_art_id');
}



// si la session n'est pas vide
if (!empty($_SESSION['id'])) {

    // on recupere la session
    $my_session = $_SESSION['id'];

    // ici nous modifions un commentaire déjà validé par l'admin et visible du public. (donc is_valid = 1). Pour ne pas que la
    //  personne en profite pour écrire n'importe quoi, il faudra que l'admin le re-vérifie : donc on passe is_valid à 0 comme 
    //  lorsqu'on créer un article du départ. Si il réponds de nouveau aux critères, l'admin repassera is_valid à 1 et l'article
    //   sera de nouveau publié.
    $is_valid = 0;

        // si le content n'est pas vide
        if (!empty($_POST['cont'])) {
            // on passe le content en htmlspecialchars
            $cont = htmlspecialchars($_POST['cont']);

                    // on prepare et execute la requete, dans la table articles, on rentre le titre, le content, et l'image de l'article crée
                    $insert = $pdo->prepare('UPDATE comm
                                                SET comment = ?, is_valid = ?
                                                WHERE id = ?');

                    if($insert->execute([$cont, $is_valid, $get_idc])){

                    //  Si on a rencontré une erreur, on la nomme ci dessous celon a quel endroit elle à eu lieu
                    // echo "Commentaire modifié, il sera vérifié par l'admin et publié ou supprimé !";
                    header('Location:../full_article.php?id='.$_GET['ida'].'&rep_err=success_upd');
                    die();

                    // echo "Erreur d'upd";
                    } else {
                        header('Location:../modif_comm.php?id='.$_GET['idc'].'&rep_err=error');
                    }
            

        // echo "veuillez remplir le champ";
        } else {
            header('Location:../modif_comm.php?id='.$_GET['idc'].'&rep_err=cont_empty');
        }


    // echo "Erreur d'id";
} else {
    header('Location:../full_article.php?id='.$_GET['ida'].'&rep_err=error_id');
}
