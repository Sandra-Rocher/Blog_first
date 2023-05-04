<?php

session_start();

?>


<!doctype html>
<html lang="en">
  <head>
    <title>Creer un article</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- lien bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
</head>
<body>


<?php require_once 'header.php' ?>

<?php
    if(!empty($_SESSION['id'])){
?>
        
  <div class="container mt-5 mb-5 col-sm12 col-md-8 col-lg-10 border border-info shadow-lg bg-info-rounded">
        <div class="row text-center border border-info shadow-lg bg-info-rounded">
            <h1 class="mt-5">Créer un article</h1>
                <form class="form-group" method="POST" action="functions/edit_article_form.php" enctype="multipart/form-data">
                    <div class="d-grid gap-2 col-sm-12 col-md-8 col-lg-10 mx-auto mt-4">
                        
 <?php 

                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {
                        case 'success':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> Article bien reçu, l'admin vérifiera et s'il corresponds aux <a href="crit_valid.php">critères de publication</a>, si c'est le cas il sera posté sur la page Accueil et dans votre page nommée l'User_partage !
                            </div>
                        <?php
                        break;

                        case 'error':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Erreur
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

                        case 'tit_empty':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Veuillez remplir le titre de l'article
                                </div>
                            <?php 
                        break;
    
                        case 'cont_empty':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Veuillez mettre une description, ou un commentaire à votre article
                                </div>
                            <?php 
                        break;

                        case 'error_id':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Erreur d'id
                                </div>
                            <?php 
                        break;

                    }
                }
                ?>


                            <label for="title_art">Ajouter un titre à votre article</label>
                            <input type="text" class="form-control" name="tit" id="title_art"  placeholder="Titre de votre article..."  required="required">

                            <label for="comm_art">Ajouter un commentaire</label>
                            <textarea class="form-control" name="cont" id="comm_art" rows="8" placeholder="Pour mieux voir votre texte vous pouvez agrandir vous pouvez cliquer en bas a droite et déployer vers le bas"  required="required"></textarea>

                            <label for="image_art">Ajouter une image</label>
                            <input type="file" class="form-control" name="image" id="image_art"  placeholder="" required="required">
                    </div>
                        <div class="d-grid gap-2 col-2 mx-auto mt-4">
                            <button class="btn btn-info" type="submit">Envoyer</button>
                        </div>

                        <div class="d-grid gap-2 mx-auto mt-4">
                            <div class="fs-bold"><a href="crit_valid.php">Avant de valider votre article, allez voir les critères de validation de celui-ci</a></div>
                        </div>
                </form>
                <p class="text-center mt-4 mb-5"><a href="other_articles.php">Voir mes articles</a></p>
        </div>
 </div>

<?php
}else{
?>
        <div class="container mt-5 mb-5 text-center">
             <div class ="fs-4 mb-3"> Vous devez être connecté pour publier un article </div>
            <a href="connexion.php">Connexion</a>
        </div>

<?php
}
?>


<?php require_once 'footer.php' ?>

<!-- lien bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

  
</body> 
</html>