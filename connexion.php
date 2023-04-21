<?php

SESSION_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- lien bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
    <title>Connexion</title>
</head>
<body>

<!-- lien header navbar -->
 <?php require_once 'header.php' ?>

 <!-- Si la personne est déja connecté on ne lui affiche pas la connexion. Il faudra qu'elle se déconnecte (ce qu'on lui propose plus bas) -->
 <?php
    if(empty($_SESSION['id'])){
?>

        
    <div class="container col-sm-12 col-md-8 col-lg-3 border border-info shadow-lg mb-5 mt-5">
        <div class="row shadow-lg bg-info-rounded">
            <div class="text-center mt-4">
                    <h2 class="text-center">Connexion</h2>
                    <form class="form-group" method="POST" action="functions/connexion_form.php">
                         <div class="d-grid gap-2 mx-auto mt-4">


<?php 
        if(isset($_GET['login_err']))
        {
                    $err = htmlspecialchars($_GET['login_err']);

                    switch($err)
                    {
                        case 'wrong_password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Mot de passe incorrect
                            </div>
                        <?php
                        break;

                        case 'wrong_email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Email incorrect
                            </div>
                        <?php
                        break;

                        case 'no_exist':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Compte non existant
                            </div>
                        <?php
                        break;

                        case 'empty':
                        ?>
                             <div class="alert alert-danger">
                                 <strong>Erreur</strong> Veuillez remplir les champs
                             </div>
                        <?php
                        break;

                        case 'fatalError':
                            ?>
                                 <div class="alert alert-danger">
                                     <strong>Erreur</strong> Fatal ERROR
                                 </div>
                            <?php
                        break;
                    }
        }
?> 
            
 
                            <input type="email" name="email" class="form-control text-center" placeholder="Email" required="required" autocomplete="off">
                            <input type="password" name="password" class="form-control text-center" placeholder="Mot de passe" required="required" autocomplete="off">
                        
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto mt-4">
                            <button tpe="submit" class="btn btn-info">Connexion</button>
                        </div>
                    </form>
                            <p class="text-center mt-4 mb-4">Pas encore de compte ? <a href="inscription.php">S'inscrire</a></p>
                    
            </div>
        </div>
    </div>


<?php
}else{
?>
        <div class="container mt-5 mb-5 text-center">
             <div class ="fs-4 mb-3"> Vous êtes déja connecté en tant que <?= $_SESSION["user_name"] ?></div>
            <a href="functions/deconnexion.php">Déconnexion</a>
        </div>

<?php
}
?>


<!-- lien footer -->
<?php require_once 'footer.php' ?>

<!-- lien bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 

</body>
</html>