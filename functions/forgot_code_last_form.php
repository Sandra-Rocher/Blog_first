<?php

require_once '../modele/database.php';


if(isset($_GET['email']) && !empty($_GET['email'])){

    $email = htmlspecialchars($_GET['email']);
    
}

        if(isset($_POST['password']) && isset($_POST['password_retype']))
        {

            if(!empty($_POST['password']) && !empty($_POST['password_retype']))
            {

                 $new_password = htmlspecialchars($_POST['password']);
                 $new_password_retype = htmlspecialchars($_POST['password_retype']);

                if($new_password === $new_password_retype)
                {
                    //hash password
                    $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                    //for update unique token to empty case
                    $empty = '';

                    //update new password on bdd
                    $edit = $pdo->prepare("UPDATE users SET users.password = ?, code_forget = ? WHERE email = ?");
                    if($edit->execute([$new_password, $empty, $email]))
                    {
                    // if success :
                        header("Location: ../connexion.php?&login_err=finaly");
                        die();

                    // if error :
                    }else{header("Location: ../forgot_code_last.php?&err=not_udp"); die(); }


                //   echo different password / "Mot de passe différent"
                }else{ header('Location:../forgot_code_last.php?&email='.$email.'&err=password_err');  die(); }

                // echo empty password2 / "mot de passe2 vide"
            }else{header('Location:../forgot_code_last.php?'.$email.'&err=empty_pwd2');  die(); }

            // echo empty password1 / "mot de passe1 vide"
        }else{header('Location:../forgot_code_last.php?'.$email.'&err=empty_pwd1');  die(); }

?>