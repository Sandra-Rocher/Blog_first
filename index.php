
<?php

session_start();

require_once 'functions/get_posts.php';

$articles = get_posts_index();

?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Accueil</title>
</head>
<body>


<?php require 'header.php' ?>
      
 <div class="fs-3 fw-bold text-center mt-5 mb-5">Bienvenue sur la page de tous les articles partagés par ordre d'actualité.</div>

             <div class="container mt-5 mb-5">
                <div class="row">


<!-- Lorsqu'un user supprime son compte, il revient ici à l'accueil -->
<?php 
if(isset($_GET['success']))
{
    $success = htmlspecialchars($_GET['success']);

    if($success === 'supp_id_user')
    {
        ?>
            <div class="alert alert-danger">
                <strong>Succès</strong> Votre compte à bien été supprimé.
            </div>
        <?php
    }
}
?>


<?php
    foreach($articles as $article){

  echo     ' 
                     <div class="col-sm-12 col-md-12 col-lg-5 mx-auto mb-5">

                        <div class="card mx-auto border border-info shadow-lg">
                            <div class="d-flex justify-content-between">
                                <p class="card-text mx-auto mt-3"><small class="text-info">Publié le ' . date("d/m/Y à H:i", strtotime($article["date_articles"])).' par <span class="fw-bold">'.$article["user_name"].' </span></small></p>
                                <a class="mt-3 mx-auto btn btn-info" href="like_form.php?&id='.$article[0].'" role="button"><i class="bi bi-hand-thumbs-up"> '.$article["likesPerArticle"].'</i></a>
                            </div> 
                                <h5 class="card-title text-center"> '.$article["title"].'</h5>
                                <a href="full_article.php?id='.$article[0].'"> <img src= stock_avatar/'.$article["image"].' class="card-img-top" alt="'.$article["title"].'"></a>
                                    <div class="card-body mx-auto">
                                        <p class="card-text overflow-auto"> '.substr(nl2br($article["content"]),0,1000).'...</p>
                                        <a href="full_article.php?id='.$article[0].'" class="btn btn-info d-flex justify-content-center mb-3" >Voir l\'article en entier</a>
                                    </div>
                        </div>
                    </div>
                ';
 }
?>

                </div>
             </div>

            
<?php require_once 'footer.php' ?>

</body>
</html>