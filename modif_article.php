<?php

SESSION_start();

// page d'appel des functions
require_once 'functions/get_posts.php';

// même fonction que full article, car on veut aussi afficher l'article en grand avant de le modifier
$article = get_full_article();

// Verification que l'id de la personne soit bien connectée et celle qui à éditée l'article
if(!isset($_SESSION["id"]) || $_SESSION["id"] != $article['id_users']){

    
        // redirection sur l'article en full qui été sélectionné par l'id
  header('Location:full_article.php?id='. $article[0] . 'rep_err=wrong_id_us');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

          <!-- lien bootstrap  -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
        <title>Modifier un article</title>
</head>
<body>

<!-- lien header navbar -->
<?php require 'header.php' ?>


<?php
    if(!empty($_SESSION['id'])){
?>
      

 <div class="fs-3 fw-bold text-center mt-5 mb-5">Voir et Modifier un article</div>


 <?php 

        if(isset($_GET['reg_err']))
        {
            $err = htmlspecialchars($_GET['reg_err']);

            switch($err)
            {
                case 'success':
                ?>
                    <div class="alert alert-success">
                        <strong>Succès</strong> Article posté !
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

<?php

// var_dump($article);
   

    
    echo     ' <div class="container mt-5 mb-5 col-sm12 col-md-8 col-lg-10 border border-info shadow-lg bg-info-rounded">
                    <div class="row text-center border border-info shadow-lg bg-info-rounded">
                        <h1 class="mt-5">Modifier un article</h1>

                                <form class="form-group mt-3" method="POST" action="functions/modif_article_form.php" enctype="multipart/form-data">
                                    <div class="d-grid gap-2 col-sm-12 col-md-8 col-lg-10 mx-auto mt-3">

                                        <label for="title_art" class="fs-4 mx-auto">Modifier votre titre</label>
                                        <input type="text" class="form-control" name="tit" id="title_art"  placeholder="Titre de votre article..." value="' . $article[1] . '" required="required">
            
                                        <label for="comm_art" class="fs-4 mx-auto">Modifier votre commentaire</label>
                                        <textarea class="form-control" name="cont" id="comm_art" rows="8" required="required" placeholder="' . $article[2] . '" ></textarea>
            
                                        <label for="image_art" class="fs-4 mx-auto">Modifier l\'image</label>
                                        <input type="file" class="form-control" name="image" id="image_art"  placeholder="" value="<?= ' . $article[3] . ' ?>" required="required">
                                    </div>
                                    <div class="d-grid col-2 gap-2 mx-auto mt-5 mb-4">
                                        <button class="btn btn-info" type="submit">Envoyer les modifications</button>
                                    </div>
                                    <div class="d-grid gap-2 mx-auto mt-4 mb-5">
                                        <div class="fs-bold"><a href="crit_valid.php">Avant de valider votre article, allez voir les critères de validation de celui-ci</a></div>
                                    </div>
                                </form>    
                                    
                        </div> 
                    </div>
                </div> ';
                  

?>

<?php
}else{
?>
        <div class="container mt-5 mb-5 text-center">
             <div class ="fs-4 mb-3"> Vous devez être connecté pour modifier vos articles </div>
            <a href="connexion.php">Connexion</a>
        </div>

<?php
}
?>

 <!-- lien footer -->
<?php require_once 'footer.php' ?>

<!-- lien bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
 </body>
</html>




