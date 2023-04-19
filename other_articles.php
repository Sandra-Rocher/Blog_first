<?php

SESSION_start();

require_once 'functions/get_posts.php';

$other_articles = get_posts_other();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Vos articles</title>
</head>
<body>
    
<?php require_once 'header.php' ?>


<?php
    if(!empty($_SESSION['id'])){
?>


<div class="fs-3 fw-bold text-center mt-5 mb-3">Ici, vous retrouverez tous vos articles personnellement publiés.</div>
<div class="fs-5 fw-bold text-center mb-5">Après validation de l'admin, ils seront ensuite publiés dans la page accueil.</div>

        
            <div class="container mt-5">
                <div class="row">

<?php

    foreach($other_articles as $other_article){

  echo     ' 
                     <div class="col-sm-12 col-md-12 col-lg-5 mx-auto mb-5">

                        <div class="card border border-info shadow-lg">
                            <p class="card-text mx-auto mt-3"><small class="text-info">Publié le ' . date("d/m/Y à H:i", strtotime($other_article["date_articles"])) . ' par <span class="fw-bold"> '. $other_article["user_name"] . ' </span></small></p>
                            <h5 class="card-title text-center"> ' . $other_article["title"] . ' </h5>
                            <a href="full_article.php?id='. $other_article[0] . '"> <img src= stock_avatar/' . $other_article["image"] . ' class="card-img-top" alt=" '. $other_article["title"] . '"></a>
                            <div class="card-body mx-auto">
                               <p class="card-text overflow-auto"> ' . substr(nl2br($other_article["content"]),0,1000) . ' ... </p>
                                <a href="full_article.php?id='. $other_article[0] . '" class="btn btn-info d-flex justify-content-center" >Voir l\'article complet</a>
                            </div>
                        </div>
                    </div>
             ';
 }
?>
                </div>
            </div> 

<?php
}else{
?>
        <div class="container mt-5 mb-5 text-center">
             <div class ="fs-4 mb-3"> Vous devez être connecté pour voir vos articles </div>
            <a href="connexion.php">Connexion</a>
        </div>

<?php
}
?>

<?php require_once 'footer.php' ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
</body>
</html>