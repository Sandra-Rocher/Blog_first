<?php

session_start();

   // connexion avec la database
require_once '../modele/database.php';


// update de l'user_name : on vérifie si il y a un user_name et un id
    if(isset($_GET["user_name"]) && isset($_GET["id"])){

        // on les passe en htmlspecialchars pour empecher les failles xss et on les place dans des variables qu'on à nommées
        $id = htmlspecialchars($_GET["id"]);
        $user_name = htmlspecialchars($_GET["user_name"]);
    }

    // si un user_name à été posté et existe
    if(isset($_POST["user_name"])){

        // on le passe en htmlspecialchar
        $user_name = htmlspecialchars($_POST["user_name"]);

        // si le user_name n'est pas vide dans l'input
        if($user_name !== ''){

            
            $check = $pdo->prepare('SELECT 
                                            user_name, 
                                            email  
                                        FROM users
                                        WHERE user_name = ?
                                        ');
            $check->execute(array($user_name));
            if($check->rowCount() == 0) 
            {       

                if(strlen($user_name) <= 255)
                {
            
                    // on prepare et execute dans la table users le nouveau user_name choisis et post
                    $edit = $pdo->prepare("UPDATE users SET user_name = ? WHERE id = ?");
                    if($edit->execute([$user_name, $id]))
                    {
                    // en réussite :
                        header("Location: ../profil.php?&req=user_name_upd");
                        die();

                    // si échec :
                    }else{header("Location: ../profil.php?&req=user_name_error"); }
                    

                 //   echo "Pseudo trop long";
                }else{ header('Location:../profil.php?&req=login_name_length');  die(); }   

            //   echo "Login déja existant";
            }else{ header('Location:../profil.php?&req=login_already_exist');  die(); }  

        }
        else{
         // si erreur :
        $error = "veuillez remplir les champs";
        }
    }


    // update de l'email
    if(isset($_GET["email"]) && isset($_GET["id"])){

        // on les passe en htmlspecialchars pour empecher les failles xss et on les place dans des variables qu'on à nommées
        $id = htmlspecialchars($_GET["id"]);
        $email = htmlspecialchars($_GET["email"]);
    }
    

    // si un email à été posté et existe
    if(isset($_POST["email"])){

        // on le passe en htmlspecialchars
        $email = htmlspecialchars($_POST["email"]);

        // si l'email n'est pas vide dans l'input
        if($email !== ''){

            $email = strtolower($email);

                $check = $pdo->prepare('SELECT 
                                                user_name, 
                                                email  
                                            FROM users
                                            WHERE email = ?
                                            ');
                $check->execute(array($email));
                if($check->rowCount() == 0) 
                {       

                    if(strlen($email) <= 255)
                    {

                        if(filter_var($email, FILTER_VALIDATE_EMAIL))
                        {

                            // on prepare et execute dans la table users le nouvel email choisis et post
                            $edit = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
                            if($edit->execute([$email, $id]))
                            {
                            // si réussite :
                            header("Location: ../profil.php?&req=user_email_upd");
                            die();
                            // si échec :
                            }else{header("Location: ../profil.php?&req=email_user_error");
                            }

                        //   echo "Email invalide";
                        }else{ header('Location:../profil.php?&req=email');  die(); }

                      
                    //   echo "Email trop long";
                    }else{ header('Location:../profil.php?&req=email_length');  die(); } 
           
                 //   echo "Email déja existant";
                }else{ header('Location:../profil.php?&req=email_already_exist');  die(); }       
            
        }else{
         // si erreur :
        $error = "veuillez remplir les champs";
        }
    }


    
// update du password
    if(isset($_POST["password"]) && isset($_GET["id"])){

        // on les passe en htmlspecialchars pour empecher les failles xss et on les place dans des variables qu'on à nommées
        $id = htmlspecialchars($_GET["id"]);
        $password = htmlspecialchars($_POST["password"]);
    }
    

    // si un password à été posté et existe
    if(isset($_POST["password"])){

        // on le passe en htmlspecialchars
        $password = htmlspecialchars($_POST["password"]);

        // on hash le password par sécurité
        $password = password_hash($password, PASSWORD_DEFAULT);

        // si le password n'est pas vide dans l'input
        if($password !== ''){

            // on prepare et execute dans la table users le nouveau password choisis et post
            $edit = $pdo->prepare("UPDATE users SET users.password = ? WHERE id = ?");
            
            if($edit->execute([$password,$id]))
            {// si réussite :
                
                header("Location: ../profil.php?&req=pass_user_upd");
                die();
                
                // si échec :
            }else{header("Location: ../profil.php?&req=pass_user_error");}
            

        }
        else{
            // si erreur :
            $error = "veuillez remplir les champs";
        }
    }


    // update de l'avatar :
    if(isset($_FILES["avatar"]) && isset($_GET["id"])){

        // on les passe en htmlspecialchars pour empecher les failles xss et on les place dans des variables qu'on à nommées
        $id = htmlspecialchars($_GET["id"]);
        $avatar = htmlspecialchars($_POST["avatar"]);
    }

    if(isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['name']))
    {
        
        $name_file = $_FILES['avatar']['name'];
        $type_file = $_FILES['avatar']['type'];
        $size_file = $_FILES['avatar']['size'];
        $tmp_file = $_FILES['avatar']['tmp_name'];
        $err_file = $_FILES['avatar']['error'];

        $authorised_extensions = ['png', 'jpg', 'jpeg', 'gif'];
        $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];

        $extens = explode('.', $name_file);

        $max_size = 8000000;


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
                              $insert = $pdo->prepare('UPDATE users SET avatar = ? WHERE id = ? ');
                              $insert->execute([$newname, $id]);

                            //   echo "Changement de l'avatar réussie !";
                              header('Location:../profil.php?&req=success_avat'); 

                     //   echo "Upload non effectué";
                    }else{header('Location:../profil.php?&req=error');  die(); }
                    
                     //   echo "Image trop lourde ou format incorrect";
                }else{header('Location:../profil.php?&req=type_file');  die(); }
                
                 //   echo "Merci de sélectionner une image";
            }else{header('Location:../profil.php?&req=image'); die(); }
        
             //   echo "Type non autorisé. Veuillez choisir une image.png ou .jpg ou .jpeg ou .gif";
        }else{header('Location:../profil.php?&req=type');  die(); }
    
         //   echo "Veuillez selectionner une image";
    }else{header('Location:../profil.php?&req=check');  die();
        
    }

    
?>


                     