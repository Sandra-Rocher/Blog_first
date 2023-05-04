<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page mot de passe oublié</title>
</head>
<body>


<?php require 'header.php' ?>

<?php 
        if(isset($_GET['err']))
        {
                    $err = htmlspecialchars($_GET['err']);

                    switch($err)
                    {

 // Erreurs du forgot_code ci dessous

                        case 'udp_forg_not_ok':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Erreur
                            </div>
                        <?php
                        break;

                        case 'wrong_email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Veuillez saisir un email. Exemple : "email@email.fr"
                            </div>
                        <?php 
                        break;

                        case 'email_dont_exist':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Cet email n'existe pas dans la base de données.
                            </div>
                        <?php 
                        break;

                        case 'email_send_not_ok':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Mail non envoyé.
                                </div>
                            <?php 
                            break;

                     }
         }
?>

<div class="container d-flex align-items-center" style="height: 550px;">
    <div class="container col-sm-12 col-md-8 col-lg-3 border border-info shadow-lg mb-5 mt-5">
            <div class="row shadow-lg bg-info-rounded">
                <div class="text-center mt-4">
                        <h2 class="text-center">Mot de passe oublié</h2>
                        <form class="form-group" method="POST" action="functions/forgot_code_form.php">
                            <div class="d-grid gap-2 mx-auto mt-4">

                                <label for="forg_email" class="fs-5 mx-auto">Veuillez saisir votre email</label>
                                <input type="email" id="forg_email" name="forg_email" class="form-control text-center" placeholder="Email" required="required">
                                
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto mt-4 mb-4">
                                <button tpe="submit" class="btn btn-info">M'envoyer un code</button>
                            </div>
                        </form>                    
                </div>
            </div>
    </div>
</div>

  
<?php require_once 'footer.php' ?>

</body>
</html>