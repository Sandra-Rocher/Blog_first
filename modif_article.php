<?php

SESSION_start();
   

// connexion avec la database
require_once 'functions/database.php';

// On vérifie que c'est bien la personne qui à écrit l'article qui doit le modifier sinon on lui dit que ce n'est pas possible
// Donc cette personne est connecté
// article selectionné = id dans table articlee
// personne connecté par l'id = ok car 
// article selectionné = id users dans article comme id user dans user

// Verification que l'id de la personne soit bien celle qui a posté l'article
if(!isset($_SESSION["id"]) || $_SESSION["user_name"] != 'user_name'){

  header('Location:full_article.php?rep_err=error_wrongId'); 
}

// On sélectionne ici l'article par l'id qui à été sélectionné
$select = $pdo->prepare("SELECT * FROM articles
                        JOIN users 
                        ON articles.id_users=users.id
                        WHERE id_users=? 
                        "); 
$select->execute(array($_SESSION['id']));
$article = $select->fetch();


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


   

    
    echo     ' <div class="container mt-5 mb-5">
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-lg-4 mx-auto">

                            <div class="card mx-auto border border-info shadow-lg">
                                <p class="card-text mx-auto mt-3"><small class="text-info">Publié le '. $article["date_articles"] . ' par <span class="fw-bold">'. $article ["user_name"] . ' </span></small></p>
                                <h5 class="card-title text-center"> ' . $article["title"] . ' </h5>
                                <img src= stock_avatar/' . $article["image"] . ' class="card-img-top" alt=" '. $article["title"] . '">
                                <div class="card-body mx-auto">
                                    <p class="card-text"> ' . $article["content"] . ' </p>
                                    <a href="#" class="btn btn-info d-flex justify-content-center mb-3" >Voir l\'article en entier</a>
                                </div>
                            </div>
                        </div>






                        <div class="col-sm-12 col-md-8 col-lg-4 mx-auto border border-info shadow-lg">


                                <form class="form-group mt-4" method="POST" action="functions/modif_article_form.php" enctype="multipart/form-data">
                                    <div class="d-grid gap-2 mx-auto ">

                                        <label for="title_art" class="fs-4 mx-auto">Modifier votre titre</label>
                                        <input type="text" class="form-control" name="tit" id="title_art"  placeholder="Titre de votre article..."  required="required">
            
                                        <label for="comm_art" class="fs-4 mx-auto">Modifier votre commentaire</label>
                                        <textarea class="form-control" name="cont" id="comm_art" rows="8" placeholder="Pour mieux voir votre texte vous pouvez agrandir vous pouvez cliquer en bas a droite et déployer vers le bas"  required="required"></textarea>
            
                                        <label for="image_art" class="fs-4 mx-auto">Modifier l\'image</label>
                                        <input type="file" class="form-control" name="image" id="image_art"  placeholder="" required="required">
                                    </div>
                                    <div class="d-grid gap-2 mx-auto mt-4 mb-4">
                                        <button class="btn btn-info" type="submit">Envoyer les modifications</button>
                                    </div>
                                </form>        
                            </div>
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




