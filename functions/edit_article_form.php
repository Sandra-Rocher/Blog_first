<?php

require_once '../modele/database.php';


if (!empty($_SESSION['id'])) {

    $my_session = $_SESSION['id'];


    if (!empty($_POST['tit'])) {
        $tit = htmlspecialchars($_POST['tit']);

        if (!empty($_POST['cont'])) {
            $cont = htmlspecialchars($_POST['cont']);


            if (!empty($_FILES['image']['name'])) {

                //Recovering data from the posted image
                $name_file = $_FILES['image']['name'];
                $type_file = $_FILES['image']['type'];
                $size_file = $_FILES['image']['size'];
                $tmp_file = $_FILES['image']['tmp_name'];
                $err_file = $_FILES['image']['error'];

                // define the authorised extensions
                $authorised_extensions = ['png', 'jpg', 'jpeg', 'gif'];
                $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];

                // separate the image name from the .
                $extens = explode('.', $name_file);

                // we define a maximum size in bytes/octets
                $max_size = 100000;

                //Check the image extension: compare in the array if the $type file matches the $type
                if (in_array($type_file, $type)) {

                    //Check the double extension of the image: count the number of extensions after the . and change the extension to lower case.
                    if (count($extens) <= 2 && in_array(strtolower(end($extens)), $authorised_extensions)) {

                        // we compare if the img is smaller than the max_size declared above, and if it is in error 0: correct download
                        if ($size_file < $max_size && $err_file == 0) {

                            // we generate a unique identifier, which we steal from the previously exploded extension and send to the stock_avatar file.
                            $image = uniqid() . '.' . strtolower(end($extens));
                            //Moves an uploaded file to a new location
                            if (move_uploaded_file($tmp_file, '../stock_avatar/' . $image)) {

                                $insert = $pdo->prepare('INSERT INTO articles (title, content, image, id_users) 
                                                                VALUES (:tit, :cont, :img, :idus) ');
                                $insert->execute(array(
                                    'tit' => $tit,
                                    'cont' => $cont,
                                    'img' => $image,
                                    'idus' => $my_session,
                                ));

                                // echo article posted, admin will accept or not / "Article reçu, l'admin va regarder et valider ou non.. !";
                                header('Location:../edit_article.php?&reg_err=success');
                                die();


                                // echo error upload / "Erreur (upload non effectué)";
                            } else {
                                header('Location:../edit_article.php?&reg_err=error');
                            }


                            // echo image too heavy or wrong format / "Image trop lourde ou format incorrect";
                        } else {
                            header('Location:../edit_article.php?&reg_err=type_file');
                        }


                        // echo please select an image / "Merci de mettre une image";
                    } else {
                        header('Location:../edit_article.php?&reg_err=image');
                    }


                // echo type not authorised / "Type non autorisé. Veuillez choisir une image.png ou .jpg ou .jpeg ou .gif";
                } else {
                    header('Location:../edit_article.php?&reg_err=type');
                }


                // echo please select an image /  "veuillez sélectionner une image";
            } else {
                header('Location:../edit_article.php?&reg_err=check');
            }


            // echo please enter a comment to your article / "Veuillez mettre un commentaire à votre article";
        } else {
            header('Location:../edit_article.php?&reg_err=cont_empty');
        }


        // echo please enter a title to your article / "Veuillez mettre un titre à votre article";
    } else {
        header('Location:../edit_article.php?&reg_err=tit_empty');
    }


    // echo error id you should be connected / "Erreur d'id = vous devez être connecté pour publier un article";
} else {
    header('Location:../edit_article.php?&reg_err=error_id');
}
