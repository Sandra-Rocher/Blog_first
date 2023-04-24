<?php

SESSION_start();

// Verification que l'id user soit connecté ET admin
if(!isset($_SESSION["id"]) || $_SESSION["id_role"] != '1'){
        // sinon : déconnexion du curieux
    header("Location: functions/deconnexion.php");
}

// on va afficher les post et les commentaires grace à leurs fonctions get_all_... situées dans la page get_posts
require_once 'functions/get_posts.php';

$articles = get_all_posts();

$comments = get_all_comms();


// a partir de là c'est nickwall 
require_once 'functions/database.php';


// on mettra apres dans functions/get_posts
function inTable($table){

    global $pdo;
    $query = $pdo->query("SELECT COUNT(id) 
                        FROM $table
                        WHERE is_valid ='0'
                        ");

    return $query->fetch();
}


$tables = [

        "Articles postés" => "articles",
        "Commentaires postés" => "comm",
    ];

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- lien bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- lien bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <title>Page Admin</title>

</head>
<body>

<!-- lien header navbar -->
<?php require_once 'header.php' ?>


<div class="text-center mt-5 mb-5">
     <h2>Bienvenue <?= $_SESSION["user_name"] ?>, l'admin ! </h2>
</div> 


    <?php
        if(isset($_GET['req']))
                {
                    $req = htmlspecialchars($_GET['req']);

                    switch($req)
                    {
                        case 'del_art':
                            ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> Vous avez supprimé l'article.
                            </div>
                            <?php
                        break;

                        case 'dont_del_art':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> La suppréssion de l'article n'a pas marché.
                                </div>
                            <?php
                        break;

                        case 'agr_art':
                        ?>
                            <div class="alert alert-success">
                                <strong>succès</strong> Vous avez validé l'article.
                            </div>
                        <?php
                        break;

                        case 'dont_agr_art':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> La validation de l'article n'a pas marché.
                                </div>
                            <?php
                        break;

                        case 'agr_com':
                            ?>
                                <div class="alert alert-success">
                                    <strong>succès</strong> Vous avez validé votre commentaire.
                                </div>
                            <?php
                        break;
    
                        case 'dont_agr_com':
                            ?>
                                 <div class="alert alert-danger">
                                     <strong>Erreur</strong> La validation du commentaire n'a pas marché.
                                </div>
                            <?php
                         break;

                         case 'del_com':
                            ?>
                                <div class="alert alert-success">
                                    <strong>succès</strong> Vous avez supprimé votre commentaire.
                                </div>
                            <?php
                        break;
    
                        case 'dont_del_com':
                            ?>
                                 <div class="alert alert-danger">
                                     <strong>Erreur</strong> La suppression du commentaire n'a pas marché.
                                </div>
                            <?php
                         break;
                    }
                }
?>

 
    <div class="container mt-5 mb-5">        
        <div class="row d-flex justify-content-around">
                
<?php
foreach($tables as $table_name => $table){
?>
            <div class="card col-sm-12 col-md-6 col-lg-3">
                <div class="card bg-info">
                    <div class="card-title"> <?= $table_name ?></div>
                    <h4>  <?=inTable($table)[0]; ?> </h4>
                   
                </div>  
            </div>
        
<?php
}
?>

        </div>
    </div>
           


<h3 class="text-center"> Articles non lus </h3>


<div class="container">
    <div class="row">
        <table class="mt-5 mb-5">
            <thead>
                <tr class="fs-5">
                    <th>Photo </th>
                    <th>Titre </th>
                    <th>Commentaire </th>
                    <th>Actions </th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach($articles as $article){
                
                echo '
                        <tr id="Article_' . $article[0] . '">
                        
                            <td> <img src="stock_avatar/'. $article['image'].'" width="120" height="80" alt="image de l\'article"></td>
                            <td>'.substr($article["title"],0,40).'...</td>
                            <td>'.substr($article["content"],0,100) .'...</td>
                            <td>
                                
                                <a href="functions/agree_article.php?id='. $article[0].'" class="btn btn-success mb-3"><i class="bi bi-check"></i></a>
                                <a href="functions/delete_article.php?id='. $article[0].'" class="btn btn-danger mb-3"><i class="bi bi-trash3"></i></a>
                                <a href="#idArt'. $article[0] .'" data-bs-toggle="modal" data-bs-target="#idArt'. $article[0] .'" class="btn btn-info modal-trigger mb-3"><i class="bi bi-eye"></i></a>

                                        <div class="modal fade" id="idArt'. $article[0] .'" tabindex="-1" aria-labelledby="idArticle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                
                                                    <div class="modal-header">
                                                        <p class="modal-title fs-5 text-info" id="idArticle"> '.$article["title"].' </p>
                                                        <p>Commentaire posté par <strong> <p class="text-info">'.$article["user_name"].' </p></strong></p>
                                                        <p> Le '.date("d/m/Y à H:i", strtotime($article["date_articles"])).' </p>
                                                    </div>   

                                                    <div class="modal-body">
                                                         <img src="stock_avatar/'. $article['image'].'" width="450" height="400" alt="image de l\'article">
                                                         <p><strong>Commentaire :</strong> '.$article["content"].' </p>
                                                    </div>

                                                    <div class="modal-footer">
                                                         <a href="functions/agree_article.php?id='. $article[0].'" class="btn btn-success mb-3" ><i class="bi bi-check"></i></a>
                                                         <a href="functions/delete_article.php?id='. $article[0].'" class="btn btn-danger mb-3" ><i class="bi bi-trash3"></i></a>
                                                         <button type="button" class="btn btn-dark mb-3" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </td>
                        </tr>

                ';
                }
                ?>
            </tbody>
        </table>
    </div>
 </div>



 <h3 class="text-center"> Commentaires non lus </h3>


<div class="container">
    <div class="row">
        <table class="mt-5 mb-5">
            <thead>
                <tr class="fs-5">
                    <th>Photo de l'article</th>
                    <th>Commentaire posté sur l'article</th>
                    <th>Actions </th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach($comments as $comment){

                echo '
                        <tr id="Article_' . $comment["id_articles"] . '">
                        
                            <td> <img src="stock_avatar/'. $comment['image'].'" width="120" height="80" alt="image de l\'article"></td>
                            
                            <td>'.substr($comment["comm"],0,125) .'...</td>
                            <td>
                                
                                <a href="functions/agree_comm.php?id='. $comment[0].'" class="btn btn-success mb-3"><i class="bi bi-check"></i></a>
                                <a href="functions/delete_comm.php?id='. $comment[0].'" class="btn btn-danger mb-3"><i class="bi bi-trash3"></i></a>
                                <a href="#idArt'. $comment[0] .'" data-bs-toggle="modal" data-bs-target="#idArt'. $comment[0] .'" class="btn btn-info modal-trigger mb-3"><i class="bi bi-eye"></i></a>

                                        <div class="modal fade" id="idArt'. $comment[0] .'" tabindex="-1" aria-labelledby="idArticle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                
                                                    <div class="modal-header">
                                                        <p class="modal-title fs-5 text-info" id="idArticle"> '.$comment["title"].' </p>
                                                        <p>Commentaire posté par <strong> <p class="text-info">'.$comment["user_name"].' </p></strong></p>
                                                        <p> Le '.date("d/m/Y à H:i", strtotime($comment["date_comm"])).' </p>
                                                    </div>   

                                                    <div class="modal-body">
                                                         <img src="stock_avatar/'. $comment['image'].'" width="450" height="400" alt="image de l\'article">
                                                         <p><strong>Commentaire :</strong> '.$comment["comm"].' </p>
                                                    </div>

                                                    <div class="modal-footer">
                                                         <a href="functions/agree_comm.php?id='. $comment[0].'" class="btn btn-success mb-3" ><i class="bi bi-check"></i></a>
                                                         <a href="functions/delete_comm.php?id='. $comment[0].'" class="btn btn-danger mb-3" ><i class="bi bi-trash3"></i></a>
                                                         <button type="button" class="btn btn-dark mb-3" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </td>
                        </tr>

                ';
                }
                ?>
            </tbody>
        </table>
    </div>
 </div>





<!-- lien footer -->
<?php require_once 'footer.php' ?>

<!-- <script>
$(document).ready(function(){
  $('.modal-trigger').click(function(){
    var modal_id = $(this).attr('data-target');
    $(modal_id).modal('show');
  });
});
</script> -->

<!-- lien bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  
</body>
</html>