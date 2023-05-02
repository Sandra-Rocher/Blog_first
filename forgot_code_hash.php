<?php

if(isset($_GET['email'])){

    $email = htmlspecialchars($_GET['email']);
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page mot de passe oublié2</title>
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
                        case 'hash_created':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> Un code vous à été envoyé sur votre email. Récupérez-le.
                            </div>
                        <?php
                        break;

                        case 'err_code':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Le mail et le code ne correspondent pas.
                                </div>
                            <?php
                        break;

                        case 'empty_code':
                            ?>
                                 <div class="alert alert-danger">
                                     <strong>Erreur</strong> Pas de code saisis.
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
                        <h3 class="text-center">Etape intermédiaire</h3>
                        <form class="form-group" method="POST" action="functions/forgot_code_hash_form.php?&email=<?php echo $email ?>">
                            <div class="d-grid gap-2 mx-auto mt-4">

                                <label for="forg_hash" class="fs-5 mx-auto">Veuillez saisir le code reçu par email</label>
                                <input type="text" id="forg_hash" name="forg_hash" class="form-control text-center" placeholder="Code" required="required" autocomplete="off">
                                
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