<?php

session_start();


// connexion avec la database
require_once '../modele/database.php';



if(!empty($_SESSION['id'])){
   

    $my_session = $_SESSION['id'];


    if(!empty($_POST['tit']))
    {
        $tit = htmlspecialchars($_POST['tit']);

        if(!empty($_POST['cont']))
        {
            $cont = htmlspecialchars($_POST['cont']);



                if(!empty($_FILES['image'] ['name']))
                {
                    
                    $name_file = $_FILES['image']['name'];
                    $type_file = $_FILES['image']['type'];
                    $size_file = $_FILES['image']['size'];
                    $tmp_file = $_FILES['image']['tmp_name'];
                    $err_file = $_FILES['image']['error'];

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

                                
                                $image = uniqid() . '.' . strtolower(end($extens));
                                if(move_uploaded_file($tmp_file, '../stock_avatar/' . $image))
                                {
                                   
                                    $insert = $pdo->prepare('INSERT INTO articles (title, content, image, id_users) VALUES (:toto, :cont, :img, :idus) ');
                                    $insert->execute(array(
                                    'toto'=> $tit,
                                     'cont'=> $cont,
                                     'img'=> $image,
                                     'idus'=> $my_session,
                                     ));

                                     // echo "Article reçu, l'admin va regarder et valider ou non.. !";
                                    header('Location:../edit_article.php?reg_err=success'); 
                                    die();
                                
                                
                                    // echo "Erreur (upload non effectué)";
                                }else{header('Location:../edit_article.php?reg_err=error'); }
                                
                            
                                // echo "Image trop lourde ou format incorrect";
                            }else{header('Location:../edit_article.php?reg_err=type_file'); }
                            
                        
                            // echo "Merci de mettre une image";
                        }else{header('Location:../edit_article.php?reg_err=image'); }
                        
                    
                        // echo "Type non autorisé. Veuillez choisir une image.png ou .jpg ou .jpeg ou .gif";
                    }else{header('Location:../edit_article.php?reg_err=type'); }


                 // echo "veuillez sélectionner une image";
                }else{header('Location:../edit_article.php?reg_err=check'); }
                    

            // echo "Veuillez mettre un commentaire à votre article";
        }else{header('Location:../edit_article.php?reg_err=cont_empty'); }  


         // echo "Veuillez mettre un titre à votre article";
    }else{header('Location:../edit_article.php?reg_err=tit_empty'); }   
    
    
    // echo "Erreur d'id";
}else{header('Location:../edit_article.php?reg_err=error_id'); }  
                  

?>