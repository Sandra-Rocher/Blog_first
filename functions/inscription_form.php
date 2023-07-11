<?php

require_once '../modele/database.php';


if (isset($_POST['user_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_retype'])) {
    $user_name = trim(htmlspecialchars($_POST['user_name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));
    $password_retype = trim(htmlspecialchars($_POST['password_retype']));


    $check = $pdo->prepare('SELECT user_name, email, password FROM users WHERE email = ? OR user_name = ?');
    $check->execute(array($email, $user_name));
    $data = $check->fetch();

    $email = strtolower($email);

    if ($user_name != $data['user_name']) {
        if ($email != $data['email']) {
            if (strlen($user_name) <= 255) {
                if (strlen($email) <= 255) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if (strlen($password) > 7){
                            if ($password === $password_retype) {
                                $password = password_hash($password, PASSWORD_DEFAULT);

                                    // the rest below, to add in one go/time

                            //echo different password / "Mot de passe différent";
                            } else {
                                header('Location:../inscription.php?&reg_err=password');
                                die();
                            }

                        //   echo password too short / "Mot de passe trop court, veuillez entrer 8 caractères ou plus";
                        } else {
                            header('Location:../inscription.php?&reg_err=passwordSize');
                            die();
                        }

                        //   echo invalid email / "Email invalide";
                    } else {
                        header('Location:../inscription.php?&reg_err=email');
                        die();
                    }

                    //   echo email too long / "Email trop long";
                } else {
                    header('Location:../inscription.php?&reg_err=email_length');
                    die();
                }

                //   echo name too long / "Pseudo trop long";
            } else {
                header('Location:../inscription.php?&reg_err=user_name_length');
                die();
            }

            //   echo email already exist / "Email déja existant";
        } else {
            header('Location:../inscription.php?&reg_err=email_already_exist');
            die();
        }

        //   echo login already exist / "Login déja existant";
    } else {
        header('Location:../inscription.php?&reg_err=user_name_already_exist');
        die();
    }
}


// Processing the avatar upload below: similar to uploading the image to edit_article_form
if (!empty($_FILES['avatar']['name'])) {

    $name_file = $_FILES['avatar']['name'];
    $type_file = $_FILES['avatar']['type'];
    $size_file = $_FILES['avatar']['size'];
    $tmp_file = $_FILES['avatar']['tmp_name'];
    $err_file = $_FILES['avatar']['error'];

    $authorised_extensions = ['png', 'jpg', 'jpeg', 'gif'];
    $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];

    $extens = explode('.', $name_file);

    $max_size = 100000;


    if (in_array($type_file, $type)) {

        if (count($extens) <= 2 && in_array(strtolower(end($extens)), $authorised_extensions)) {

            if ($size_file < $max_size && $err_file == 0) {

                $newname = uniqid() . '.' . strtolower(end($extens));


                if (move_uploaded_file($tmp_file, '../stock_avatar/' . $newname)) {

                    // everything is inserted into the bdd
                    $insert = $pdo->prepare('INSERT INTO users (user_name, email, password, avatar) VALUES (:user_name, :email, :password, :img) ');
                    $insert->execute(array(
                        'user_name' => $user_name,
                        'email' => $email,
                        'password' => $password,
                        'img' => $newname,
                    ));

                    //   echo inscription success / "Inscription réussie !";
                    header('Location:../connexion.php?&login_err=success_ins');

                    //   echo error upload / "Upload non effectué";
                } else {
                    header('Location:../inscription.php?&reg_err=error');
                    die();
                }

                //   echo image too heavy or incorrect format / "Image trop lourde ou format incorrect";
            } else {
                header('Location:../inscription.php?&reg_err=type_file');
                die();
            }

            //   echo please select an image / "Merci de sélectionner une image";
        } else {
            header('Location:../inscription.php?&reg_err=image');
            die();
        }

        //   echo type not authorised / "Type non autorisé. Veuillez choisir une image.png ou .jpg ou .jpeg ou .gif";
    } else {
        header('Location:../inscription.php?&reg_err=type');
        die();
    }

    //   echo please select an image / "Veuillez selectionner une image";
} else {
    header('Location:../inscription.php?&reg_err=check');
    die();
}
