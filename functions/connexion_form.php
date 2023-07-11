<?php

    require_once '../modele/database.php';


if(isset($_POST['email']) && isset($_POST['password']))
{
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    if(!empty($email) && !empty($password)){

        $email = strtolower($email);

        $check = $pdo->prepare('SELECT user_name, email, id, id_role, password FROM users WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row > 0)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                if(password_verify($password, $data['password']))
                {
                    $_SESSION['user_name'] = $data['user_name'];
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['id_role'] = $data['id_role'];

                        if($data['id_role'] == '1')
                        {
                            header('Location: ../admin.php');

                        }else if($data['id_role'] == '2')
                        {
                            header('Location: ../profil.php');

                        } else { header('Location: ../connexion.php?&login_err=fatalError'); die(); }
                        
                }else{ header('Location:../connexion.php?&login_err=wrong_password'); die(); }

            }  else{ header('Location:../connexion.php?&login_err=wrong_email'); die(); }

        } else{ header('Location:../connexion.php?&login_err=no_exist'); die(); }

    } else{ header('Location:../connexion.php?&login_err=empty'); die(); }

} else{ header('Location:../connexion.php'); die(); }
