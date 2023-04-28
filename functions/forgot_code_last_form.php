<?php

session_start();

if(isset($_GET['email']) && !empty($_POST['email'])){

    $email = $_GET['email'];
}

    // connexion avec la database
    require_once '../modele/database.php';


        if(isset($_POST['password']) && isset($_POST['password_retype']))
        {

            if(!empty($_POST['password']) && !empty($_POST['password_retype']))
            {

                 $new_password = htmlspecialchars($_POST['password']);
                 $new_password_retype = htmlspecialchars($_POST['password_retype']);

                if($new_password === $new_password_retype)
                {

                    $new_password = password_hash($new_password, PASSWORD_DEFAULT);


                    $edit = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
                    if($edit->execute([$new_password, $email]))
                    {
                    // en réussite :
                        header("Location: ../connexion.php?&login_err=finaly");
                        die();

                    // si échec :
                    }else{header("Location: ../forgot_code_last.php?&err=not_udp"); die(); }


                //   echo "Mot de passe différent";
                }else{ header('Location:../forgot_code_last.php?err=password_err');  die(); }


            }else{header('Location:../forgot_code_last.php?err=empty_pwd2');  die(); }


        }else{header('Location:../forgot_code_last.php?err=empty_pwd1');  die(); }

?>