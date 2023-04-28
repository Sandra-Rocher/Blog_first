<?php

session_start();

if(isset($_GET['email'])){

    $email = $_GET['email'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page mot de passe oublié3</title>
</head>
<body>

<!-- lien header navbar -->
<?php require 'header.php' ?>


<?php 
        if(isset($_GET['err']))
        {
                    $err = htmlspecialchars($_GET['err']);

                    switch($err)
                    {

 // Erreurs du forgot_code ci dessous

                        case 'ok_let_pwd':
                            ?>
                                <div class="alert alert-success">
                                    <strong>Succès</strong> Code vérifié et juste, vous pouvez saisir votre nouveau mot de passe
                                </div>
                            <?php
                        break;

                        case 'empty_pwd1':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Mot de passe inexistant
                                </div>
                            <?php
                        break;

                        case 'empty_pwd2':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Mot de passe inexistant
                                </div>
                            <?php
                        break;

                        case 'password_err':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Mot de passe différent
                                </div>
                            <?php
                        break;

                        case 'not_udp':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Erreur
                                </div>
                            <?php
                        break;

                     }
        }
?>


<div class="container d-flex align-items-center" style="height: 550px;">
    <div class="container col-sm-12 col-md-8 col-lg-4 border border-info shadow-lg mb-5 mt-5">
            <div class="row shadow-lg bg-info-rounded">
                <div class="text-center mt-4">
                        <h2 class="text-center">Mot de passe oublié</h2>
                        <h3 class="text-center">Dernière étape</h3>
                        <form class="form-group" method="POST" action="functions/forgot_code_last_form.php?email=<?php echo $email ?>">
                            <div class="d-grid gap-2 mx-auto mt-4">

                                <label for="forg_hash" class="fs-5 mx-auto">Veuillez saisir votre nouveau mot de passe</label>
                                <input type="password" id="forg_last" name="password" class="form-control text-center" placeholder="Mot de passe" required="required" autocomplete="off">
                                <input type="password" id="forg_last" name="password_retype" class="form-control text-center" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">
                                
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto mt-4 mb-4">
                                <button tpe="submit" class="btn btn-info">Envoyer</button>
                            </div>
                        </form>                    
                </div>
            </div>
    </div>
</div>

  

<!-- lien footer -->
<?php require_once 'footer.php' ?>

</body>
</html>