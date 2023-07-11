<?php

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
                    //   echo email does not exist / "L'émail n'existe pas";
                    header('Location:../forgot_code.php?err=email_dont_exist');  die();
                
                }else{ 
                        $stock = $check_email->fetch();
                        $email = $stock['email'];
                        $id= $stock['id'];
                        $user_name= $stock['user_name'];

                        // create a unique token with 64 characteres
                        $token = bin2hex(openssl_random_pseudo_bytes(32));

                            // update into the bdd
                            $forg_pwd = $pdo->prepare("UPDATE users SET code_forget = ? WHERE id = ?");
                            if($forg_pwd->execute(array($token, $id)))
                            {

                                // prepares the internal encoding of the email in utf8
                                mb_internal_encoding('UTF-8');

                                    // We prepare the email, $headers is an additional header in the form of an array
                                    $to      = $email;
                                    $subject = 'Mot de passe oublié Blog "En voyage avec..."';
                                    $message = 'Bonjour ' . $user_name . ' , voici votre code : ' . $token . ' ';
                                    $headers = array(
                                                    'From' => 'admin_Blog_voyage@hotmail.fr',
                                                    'Reply-To' => 'No reply',
                                                    'Content-Type' => 'text/html; charset=UTF=8\r\n',
                                                    'X-Mailer' => 'PHP/' . phpversion()
                                                    );
        
                                    //For the 'é' accent to work, we use mimeheader, which encodes the header here named: subject            
                                     $subject = mb_encode_mimeheader($subject);


                                    // send email
                                    if(mail($to, $subject, $message, $headers)) {
                        
                                        //if success : redirection to the next step with $email
                                        header("Location: ../forgot_code_hash.php?&email='.$email.'&err=hash_created");
                                        die();

                                    } else {
                                        // echo print_r(error_get_last());
                                        header("Location: ../forgot_code.php?&email='.$email.'&err=email_send_not_ok"); die(); 
                                    }    

                            // if error :
                            }else{header("Location: ../forgot_code.php?&email='.$email.'&err=udp_forg_not_ok"); die(); } 
                            
                }  

        //   echo wrong email / "Email invalide";
        }else{ header('Location:../forgot_code.php?&email='.$email.'&err=wrong_email');  die(); }   

    }
