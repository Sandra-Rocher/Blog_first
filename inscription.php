<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog en voyage avec...</title>
</head>
<body>


<?php require_once 'header.php' ?>


     <div class="container col-sm-12 col-md-8 col-lg-3 border border-info shadow-lg mb-5 mt-5">
        <div class="row shadow-lg bg-info-rounded">
             <div class="text-center mt-4">
                 <h2 class="text-center">Inscription</h2>
                    <form class="form-group" method="POST" action="functions/inscription_form.php" enctype="multipart/form-data">
                        <div class="d-grid gap-2 mx-auto mt-4">



                    
<?php 
        if(isset($_GET['reg_err']))
        {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {

 // Erreurs inscription ci dessous

                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Mot de passe différent
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Email non valide
                            </div>
                        <?php
                        break;

                        case 'email_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Email trop long
                            </div>
                        <?php 
                        break;

                        case 'user_name_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Pseudo trop long
                            </div>
                        <?php 
                        break;

                        case 'email_already_exist':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Email deja existant
                            </div>
                        <?php 
                        break;

                        case 'user_name_already_exist':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Login deja existant
                                </div>
                            <?php 
                        break;




 // Erreurs upload avatar ci dessous
                            case 'error':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Upload non effectué
                                </div>
                            <?php
                            break;
    
                            case 'type_file':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Image trop lourde ou format incorrect 
                                </div>
                            <?php
                            break;
    
                            case 'image':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Merci de sélectionner une image
                                </div>
                            <?php 
                            break;
    
                            case 'type':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Type non autorisé. Veuillez choisir une image.png ou .jpg ou .jpeg ou .gif
                                </div>
                            <?php 
                            break;

                            case 'check':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Veuillez sélectionner une image
                                </div>
                            <?php 
                            break;


                     }
         }
?>


                        <input type="text" name="user_name" class="form-control text-center" placeholder="Login" required="required" autocomplete="off">
                        <input type="email" name="email" class="form-control text-center" placeholder="Email" required="required" autocomplete="off">
                        <input type="password" name="password" class="form-control text-center" placeholder="Mot de passe" required="required" autocomplete="off">
                        <input type="password" name="password_retype" class="form-control text-center" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">

                        <label for="image_avat">Choississez votre avatar</label>
                            <input type="file" class="form-control" name="avatar" id="image_avat" placeholder="">
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto mt-4">
                            <button type="submit" class="btn btn-info">S'inscrire</button>
                        </div>
                    </form>
                        <p class="text-center mt-4 mb-4"><a href="index.php">Revenir à l'accueil</a></p>
                    
            </div>
        </div>
    </div>


<?php require_once 'footer.php' ?>

</body>
</html>