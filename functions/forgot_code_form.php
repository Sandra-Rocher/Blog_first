<?php

// connexion avec la database
require_once '../modele/database.php';


    if(isset($_POST['forg_email']) && !empty($_POST['forg_email']))
    {

        $email = htmlspecialchars($_POST['forg_email']);

        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {

                $check_email = $pdo->prepare('SELECT id,
                                                    user_name,
                                                    email  
                                                FROM users
                                                WHERE email = ?
                                            ');
                $check_email->execute(array($email));
                if($check_email->rowCount() == 0 ) 
                {   
                    //   echo "L'émail n'existe pas";
                    header('Location:../forgot_code.php?err=email_dont_exist');  die();
                
                }else{ 
                        $stock = $check_email->fetch();
                        $email = $stock['email'];
                        $id= $stock['id'];
                        $user_name= $stock['user_name'];

                        // on génère un password
                        $token = bin2hex(openssl_random_pseudo_bytes(32));

                            // On entre le hash dans la bdd user = email, dans la colonne code_forget
                            $forg_pwd = $pdo->prepare("UPDATE users SET code_forget = ? WHERE id = ?");
                            if($forg_pwd->execute(array($token, $id)))
                            {

                                // prépare l'encodage interne du mail en utf8
                                mb_internal_encoding('UTF-8');

                                    // On prépare le mail
                                    $to      = $email;
                                    $subject = 'Mot de passe oublié Blog "En voyage avec..."';
                                    $message = 'Bonjour ' . $user_name . ' , voici votre code : ' . $token . ' ';
                                    $headers = array(
                                                    'From' => 'admin_Blog_voyage@hotmail.fr',
                                                    'Reply-To' => 'No reply',
                                                    'Content-Type' => 'text/html; charset=UTF=8\r\n',
                                                    'X-Mailer' => 'PHP/' . phpversion()
                                                    );
        
                                    //pour que l'accent é fonctionne, on utilise mimeheader qui encode l'entête ici nommé : subject            
                                     $subject = mb_encode_mimeheader($subject);


                                    // envoie du mail
                                    if(mail($to, $subject, $message, $headers)) {
                                        // On redirige vers la page et c'est ok jusque là : passage à l'étape suivante
                                        header("Location: ../forgot_code_hash.php?&email=$email&err=hash_created");
                                        die();

                                    } else {
                                        header("Location: ../forgot_code.php?&err=email_send_not_ok"); die(); 
                                    }    

                            // si échec :
                            }else{header("Location: ../forgot_code.php?&err=udp_forg_not_ok"); die(); } 
                            
                }  

        //   echo "Email invalide";
        }else{ header('Location:../forgot_code.php?err=wrong_email');  die(); }   

    }


?>

            