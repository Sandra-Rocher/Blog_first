<?php

session_start();

if(isset($_GET['email']) && !empty($_GET['email'])){

    $email = $_GET['email'];
}


// connexion avec la database
require_once '../modele/database.php';


    if(isset($_POST['forg_hash']) && !empty($_POST['forg_hash']))
    {
      
        $code_hash_recup = htmlspecialchars($_POST['forg_hash']);

        $check_code = $pdo->prepare('SELECT id,
                                            email  
                                        FROM users
                                        WHERE email = ? AND code_forget = ?
                                    ');

        $check_code->execute(array($email, $code_hash_recup));
        if($check_code->rowCount() == 0 ) 
        {   
            //   echo "erreur, les codes ne correspondent pas";
            header('Location:../forgot_code_hash.php?err=err_code');  die();

        }else{ 
            //   echo "ok maintenant que tout correspond, on redirige vers la derniere étape";
            header('Location:../forgot_code_last.php?email='.$email.'&err=ok_let_pwd');  die(); }
            

      // il manque le code      
    }else{header('Location:../forgot_code_hash.php?&err=empty_code');  die(); }

?>