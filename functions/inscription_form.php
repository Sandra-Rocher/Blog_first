<?php

    session_start();

    // connexion avec la database
    require_once '../modele/database.php';


// Traitement de l'inscription ci dessous
    if(isset($_POST['user_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_retype']))
{
    $user_name = htmlspecialchars($_POST['user_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);


    $check = $pdo->prepare('SELECT user_name, email, password FROM users WHERE email = ? OR user_name = ?');
    $check->execute(array($email, $user_name));
    $data = $check->fetch();

         $email = strtolower($email);
                
            if($user_name != $data['user_name'])
            {
                if($email != $data['email'])
                {
                    if(strlen($user_name) <= 255)
                    {
                        if(strlen($email) <= 255)
                        {
                            if(filter_var($email, FILTER_VALIDATE_EMAIL))
                            {
                                if($password === $password_retype)
                                {
                                    $password = password_hash($password, PASSWORD_DEFAULT);

                                    // la suite plus bas, pour add en une seule fois

                                     //   echo "Mot de passe différent";
                                }else{ header('Location:../inscription.php?&reg_err=password');  die(); }
                                
                                //   echo "Email invalide";
                            }else{ header('Location:../inscription.php?&reg_err=email');  die(); }

                             //   echo "Email trop long";
                        }else{ header('Location:../inscription.php?&reg_err=email_length');  die(); }    

                         //   echo "Pseudo trop long";
                    }else{ header('Location:../inscription.php?&reg_err=user_name_length');  die(); }

                      //   echo "Email déja existant";
                }else{ header('Location:../inscription.php?&reg_err=email_already_exist');  die(); }

                  //   echo "Login déja existant";
            }else{ header('Location:../inscription.php?&reg_err=user_name_already_exist');  die(); }    

 }


// Traitement de l'upload avatar ci dessous
if(!empty($_FILES['avatar'] ['name']))
    {
        
        $name_file = $_FILES['avatar']['name'];
        $type_file = $_FILES['avatar']['type'];
        $size_file = $_FILES['avatar']['size'];
        $tmp_file = $_FILES['avatar']['tmp_name'];
        $err_file = $_FILES['avatar']['error'];

        $authorised_extensions = ['png', 'jpg', 'jpeg', 'gif'];
        $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];

        $extens = explode('.', $name_file);

        $max_size = 300000;


        if(in_array($type_file, $type))
        {

            if(count($extens) <= 2 && in_array(strtolower(end($extens)), $authorised_extensions))
            {

                if($size_file < $max_size && $err_file == 0)
                {

                    $newname = uniqid() . '.' . strtolower(end($extens));

                    
                    if(move_uploaded_file($tmp_file,'../stock_avatar/' . $newname))
                    {

                        // on add tout en une seule fois ici
                              $insert = $pdo->prepare('INSERT INTO users (user_name, email, password, avatar) VALUES (:user_name, :email, :password, :img) ');
                              $insert->execute(array(
                                  'user_name'=> $user_name,
                                  'email'=> $email,
                                  'password'=> $password,
                                  'img'=> $newname,
                              ));

                            //   echo "Inscription réussie !";
                              header('Location:../connexion.php?&login_err=success_ins'); 

                     //   echo "Upload non effectué";
                    }else{header('Location:../inscription.php?&reg_err=error');  die(); }
                    
                     //   echo "Image trop lourde ou format incorrect";
                }else{header('Location:../inscription.php?&reg_err=type_file');  die(); }
                
                 //   echo "Merci de sélectionner une image";
            }else{header('Location:../inscription.php?&reg_err=image'); die(); }
        
             //   echo "Type non autorisé. Veuillez choisir une image.png ou .jpg ou .jpeg ou .gif";
        }else{header('Location:../inscription.php?&reg_err=type');  die(); }
    
         //   echo "Veuillez selectionner une image";
    }else{header('Location:../inscription.php?&reg_err=check');  die();
        
    }
   
?>