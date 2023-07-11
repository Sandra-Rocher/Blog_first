<?php

require_once '../modele/database.php';


    if(isset($_GET["user_name"]) && isset($_GET["id"])){

        $id = htmlspecialchars($_GET["id"]);
        $user_name = htmlspecialchars($_GET["user_name"]);
    }
    
    if(isset($_POST["user_name"])){
       
        $user_name = htmlspecialchars($_POST["user_name"]);
        
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
            
                    //update user
                    $edit = $pdo->prepare("UPDATE users SET user_name = ? WHERE id = ?");
                    if($edit->execute([$user_name, $id]))
                    {
                    // if success :
                        header("Location: ../profil.php?&req=user_name_upd");
                        die();

                    // if error :
                    }else{header("Location: ../profil.php?&req=user_name_error"); }
                    

                 //   echo name too long / "Pseudo trop long";
                }else{ header('Location:../profil.php?&req=login_name_length');  die(); }   

            //   echo login already exist / "Login déja existant";
            }else{ header('Location:../profil.php?&req=login_already_exist');  die(); }  

        }
        else{
         // if error :
        $error = "veuillez remplir les champs";
        }
    }



    // update email
    if(isset($_GET["email"]) && isset($_GET["id"])){

        $id = htmlspecialchars($_GET["id"]);
        $email = htmlspecialchars($_GET["email"]);
    }
    

    if(isset($_POST["email"])){

        $email = htmlspecialchars($_POST["email"]);

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

                            //update email
                            $edit = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
                            if($edit->execute([$email, $id]))
                            {
                            // if success :
                            header("Location: ../profil.php?&req=user_email_upd");
                            die();
                            // if error :
                            }else{header("Location: ../profil.php?&req=email_user_error");
                            }

                        //   echo wrong email / "Email invalide";
                        }else{ header('Location:../profil.php?&req=email');  die(); }

                      
                    //   echo email too long / "Email trop long";
                    }else{ header('Location:../profil.php?&req=email_length');  die(); } 
           
                 //   echo email already exist / "Email déja existant";
                }else{ header('Location:../profil.php?&req=email_already_exist');  die(); }       
            
        }else{
         // if error :
        $error = "veuillez remplir les champs";
        }
    }



    
// update password
    if(isset($_POST["password"]) && isset($_GET["id"])){

        $id = htmlspecialchars($_GET["id"]);
        $password = htmlspecialchars($_POST["password"]);
    }
    
    if(isset($_POST["password"])){

        $password = htmlspecialchars($_POST["password"]);

        $password = password_hash($password, PASSWORD_DEFAULT);

        if($password !== ''){

            //update password
            $edit = $pdo->prepare("UPDATE users SET users.password = ? WHERE id = ?");
            
            if($edit->execute([$password,$id]))
            {// if success :
                
                header("Location: ../profil.php?&req=pass_user_upd");
                die();
                
                // if error :
            }else{header("Location: ../profil.php?&req=pass_user_error");}
            
        }
        else{
            // if error :
            $error = "veuillez remplir les champs";
        }
    }



    // update image :
    if(isset($_FILES["avatar"]) && isset($_GET["id"])){

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

        $max_size = 100000;


        if(in_array($type_file, $type))
        {

            if(count($extens) <= 2 && in_array(strtolower(end($extens)), $authorised_extensions))
            {

                if($size_file < $max_size && $err_file == 0)
                {

                    $newname = uniqid() . '.' . strtolower(end($extens));

                    
                    if(move_uploaded_file($tmp_file,'../stock_avatar/' . $newname))
                    {        

                        //update image
                              $insert = $pdo->prepare('UPDATE users SET avatar = ? WHERE id = ? ');
                              $insert->execute([$newname, $id]);

                            //   echo image changed / "Changement de l'avatar réussie !";
                              header('Location:../profil.php?&req=success_avat'); 

                     //   echo error upload / "Upload non effectué";
                    }else{header('Location:../profil.php?&req=error');  die(); }
                    
                     //   echo image too heavy or wrong format / "Image trop lourde ou format incorrect";
                }else{header('Location:../profil.php?&req=type_file');  die(); }
                
                 //   echo please select an image / "Merci de sélectionner une image";
            }else{header('Location:../profil.php?&req=image'); die(); }
        
             //   echo type not authorised / "Type non autorisé. Veuillez choisir une image.png ou .jpg ou .jpeg ou .gif";
        }else{header('Location:../profil.php?&req=type');  die(); }
    
         //   echo please select an image / "Veuillez selectionner une image";
    }else{header('Location:../profil.php?&req=check');  die();
        
    }

    
?>


                     