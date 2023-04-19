
<?php

// On ouvre la session
session_start();

// On récupère l'id de la session sinon on redirige
if(!isset($_SESSION["id"])){
    
    header("Location: connexion.php");
}

// On va chercher la fonction, et on la déclenche en dessous pour avoir les infos dans $data
require_once 'functions/get_posts.php';

$data = get_data_profil();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page perso</title>
</head>
<body>

<?php require_once 'header.php' ?>

<div class="text-center mt-5">
    <h2>Bienvenue sur votre profil <?= $_SESSION["user_name"] ?> ! </h2>
</div> 

                    <div class="container mt-5 mb-5">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-8 col-lg-4 mx-auto">


<!-- Retour des success ci dessous  -->
<?php 
        if(isset($_GET['req']))
        {
                    $succOrErr = htmlspecialchars($_GET['req']);

                    switch($succOrErr)
                    {

                        case 'user_name_upd':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> Modification de votre login réussi !
                            </div>
                        <?php
                        break;

                        case 'user_email_upd':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong>  Modification de votre email réussi !
                            </div>
                        <?php
                        break;

                        case 'pass_user_upd':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong>  Modification de votre password réussi !
                            </div>
                        <?php
                        break;

                        case 'pass_user_error':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Succès</strong>  Error password non modifié !
                                </div>
                            <?php
                        break;

                        case 'avat_user_upd':
                            ?>
                                <div class="alert alert-success">
                                    <strong>Succès</strong>  Modification de votre avatar réussi !
                                </div>
                            <?php
                        break;

                    }
}
?>


<?php


    echo     '       
    
                                <div class="card border border-info shadow-lg bg-info-rounded" style="border-radius: 15px;">
                                    <div class="card-body text-center">
    
                                         <div class="mx-auto mt-4 mb-4 ">
                                            <img src= stock_avatar/' . $data ["avatar"] . ' class="rounded-circle w-100">
                                        </div>
    
                                        <h4 class="mb-2"> '. $data ["user_name"] . ' </h4>
                                        <p class="text-muted mb-4"> '. $data ["email"] . ' </p>
                                
                                        <a href="modif_profil.php?id='. $data ["id"] .'&user_name='. $data ["user_name"] .'&email='. $data ["email"] .'&avatar=' . $data["avatar"] . '"> <button type="button" class="btn btn-info btn-rounded btn-lg"> Modifier </button></a>
                            
                                    </div>
                                </div>
    
                            </div>
                        </div>
                     </div> ';
   
 ?>

<?php require_once 'footer.php' ?>

</body>
</html>




