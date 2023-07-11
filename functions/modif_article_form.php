<?php

require_once '../modele/database.php';


if (isset($_GET['id']) && !empty($_GET['id'])) {

    $get_id = htmlspecialchars($_GET['id']);
} else {
    //TODO
    header('Location:../modif_article.php?reg_err=error_no_art_id');
}



if (!empty($_SESSION['id'])) {

    
    $my_session = $_SESSION['id'];

    //To check the modification of a posted article, is_valid must return to 0 in the database, so that the administrator can check again.
    $is_valid = 0;

    
    if (!empty($_POST['tit'])) {
        
        $tit = htmlspecialchars($_POST['tit']);

        
        if (!empty($_POST['cont'])) {
           
            $cont = htmlspecialchars($_POST['cont']);


            if (isset($_FILES['image'])) {

                if (!empty($_FILES['image']['name'])) {

                    //Retrieve the image informations
                    $name_file = $_FILES['image']['name'];
                    $type_file = $_FILES['image']['type'];
                    $size_file = $_FILES['image']['size'];
                    $tmp_file = $_FILES['image']['tmp_name'];
                    $err_file = $_FILES['image']['error'];

                    $authorised_extensions = ['png', 'jpg', 'jpeg', 'gif'];
                    $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];

                    $extens = explode('.', $name_file);

                    $max_size = 100000;

                    if (in_array($type_file, $type)) {
                        
                        if (count($extens) <= 2 && in_array(strtolower(end($extens)), $authorised_extensions)) {

                            if ($size_file < $max_size && $err_file == 0) {

                                $image = uniqid() . '.' . strtolower(end($extens));
                                if (move_uploaded_file($tmp_file, '../stock_avatar/' . $image)) {

                                    $insert = $pdo->prepare('UPDATE articles 
                                                             SET title = ?, content = ?, image = ?, is_valid = ?
                                                             WHERE id = ?');

                                    $insert->execute([$tit, $cont, $image, $is_valid, $get_id]);

                                    // echo Article received, it will be checked by the admin and published or deleted
                                    // "Article reçu, il sera vérifié par l'admin et publié ou supprimé !";
                                    header('Location:../other_articles.php?&reg_err=success_upd');
                                    die();

                                    // echo error upload / "Erreur, upload non effectué";
                                } else {
                                    header('Location:../other_articles.php?&reg_err=error_upd');
                                }

                                // echo image too heavy or wrong format / "Image trop lourde ou format incorrect";
                            } else {
                                header('Location:../other_articles.php?&reg_err=type_file');
                            }

                            // echo please enter an image /"Merci de mettre une image";
                        } else {
                            header('Location:../other_articles.php?&reg_err=image');
                        }

                        // echo type not authorised / "Type non autorisé. Veuillez choisir une image.png ou .jpg ou .jpeg ou .gif";
                    } else {
                        header('Location:../other_articles.php?&reg_err=type');
                    }
                } 

                $insert = $pdo->prepare('UPDATE articles 
                                         SET title = ?, content = ?, is_valid = ?
                                         WHERE id = ?');

                $insert->execute([$tit, $cont, $is_valid, $get_id]);

                //echo Article received, it will be checked by the admin and published or deleted 
                //"Article reçu, il sera vérifié par l'admin et publié ou supprimé !";
                header('Location:../other_articles.php?&reg_err=success_upd');
                die();
            }

            // echo please enter a comment to your article / "Veuillez mettre une description, ou un commentaire à votre article";
        } else {
            header('Location:../other_articles.php?&reg_err=cont_empty');
        }

        // echo please enter a title / "Veuillez remplir le titre de l'article" ;
    } else {
        header('Location:../other_articles.php?&reg_err=tit_empty');
    }

    // echo wrong id / "Erreur d'id";
} else {
    header('Location:../other_articles.php?&reg_err=error_id');
}
