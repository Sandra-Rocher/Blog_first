<?php

SESSION_start();

// connexion avec la database
require_once 'functions/database.php';


// $select = $pdo->prepare("SELECT * FROM articles
//                         JOIN users 
//                         ON articles.id_users=users.id
//                         WHERE id=?"); 
// $select->execute(array($_SESSION['id']));
// $other_article = $select->fetch();



// $sql = 'SELECT * FROM articles
//                 JOIN users
//                 ON articles.id_users=users.id
//                 WHERE id=?';

// $requete = $pdo->query($sql);
// $other_article = $requete->fetch();


// On affiche l'article sélectionné MEME SI L'USER N'EST PAS CONNECTE (car page d'accueil pour tous)
$select = $pdo->prepare("SELECT * FROM users
                        JOIN users
                        ON articles.id_users=users.id
                        WHERE id=?");
$select->execute();
$other_article = $select->fetch();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- lien bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
    <title>Un article</title>
</head>
<body>
    
<!-- page header navbar -->
<?php require_once 'header.php' ?>





<div class="fs-3 fw-bold text-center mt-5 mb-5">Article sélectionné : <?php '. $other_article["title"] .' ?> </div>


            <div class="container mt-5">
                <div class="row">




 <!-- Erreur si la personne qui tente de modifier l'article n'est pas l'éditeur de celui ci -->
<?php 
if(isset($_GET['rep_err_wrongId']))
{
    $err = htmlspecialchars($_GET['rep_err']);

    switch($err)
    {
        case 'error':
        ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> Vous devez être l'éditeur de l'article pour le modifier.
                
            </div>
        <?php
        break;
    }
}
?>



<?php


  echo     ' 
                     <div class="col-sm-12 col-md-12 col-lg-5 mx-auto mb-5">

                        <div class="card border border-info shadow-lg mt-3>
                            <p class="card-text"><small class="text-info text-center mt-3">Publié le '. $other_article["date_articles"] . ' par <span class="fw-bold"> '. $other_article["user_name"] . ' </span></small></p>
                            <h5 class="card-title text-center"> ' . $other_article["title"] . ' </h5>
                            <img src= stock_avatar/' . $other_article["image"] . ' class="card-img-top" alt=" '. $other_article["title"] . '">
                            <div class="card-body mx-auto">
                                <p class="card-text"> ' . $other_article["content"] . ' </p>
                                <a href="modif_article.php" class="btn btn-info d-flex justify-content-center mb-3" >Modifier l\'article</a>
                            </div>
                        </div>
                    </div>
             ';

?>
                </div>
            </div> 



<!-- page footer -->
<?php require_once 'footer.php' ?>

<!-- lien bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
</body>
</html>