<?php

require_once '../modele/database.php';


if(isset($_GET['email']) && !empty($_GET['email'])){

    $email = htmlspecialchars($_GET['email']);
}


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
            //   echo error token / "erreur, le token ne correspondent pas";
            header('Location:../forgot_code_hash.php?'.$email.'err=err_code');  die();

        }else{ 
            //   echo sucess, next step / "ok maintenant que tout correspond, on redirige vers la derniere étape"; avec $email
            header('Location:../forgot_code_last.php?email='.$email.'&err=ok_let_pwd');  die(); }
            

      // echo miss token / il manque le token      
    }else{header('Location:../forgot_code_hash.php?&email='.$email.'&err=empty_code');  die(); }

?>