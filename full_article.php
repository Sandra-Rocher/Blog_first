<?php

session_start();

// appel de la page des fonctions
require_once 'functions/get_posts.php';

// appel de la fonction pour afficher l'article en grand et ses commentaires (tous, étant validés par l'admin précédemment)
$other_articles = get_full_articles();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Un article entier</title>
</head>
<body>
    
<!-- page header navbar -->
<?php require_once 'header.php' ?>

                                                            

 <!-- Erreur si la personne qui tente de modifier l'article n'est pas l'éditeur de celui ci -->
<?php 
if(isset($_GET['rep_err']))
{
    $rep_err = htmlspecialchars($_GET['rep_err']);

    if($rep_err === 'wrong_id_us')
    {
        ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> Vous devez être l'éditeur de l'article pour le modifier.
            </div>
        <?php
    }

    if($rep_err === 'content_empty')
    {
        ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> Il n'y à pas de commentaire saisis.
            </div>
        <?php
    }

    if($rep_err === 'empty_id')
    {
        ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> Vous n'êtes pas connecté.
            </div>
        <?php
    }

    if($rep_err === 'comm_post')
    {
        ?>
            <div class="alert alert-success">
                <strong>Succès</strong> Votre commentaire à été envoyé, il sera vérifié par l'admin, et s'il corresponds aux <a href="crit_valid.php">critères de publication</a>, il sera publié.
            </div>
        <?php
    }

    if($rep_err === 'comm_not_post')
    {
        ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> Le commentaire n'a pas été posté.
            </div>
        <?php
    }
}
?>



<?php

  echo     '         
                    <img src= stock_avatar/'.$other_articles['image'].' class="card-img" alt=" '.$other_articles['title'] .'">
                        <div class="container">
                            <h2 class="mt-3 mb-3"> '.$other_articles['title'] .'</h2>
                            <p class="text-info"><small>Publié le ' .date("d/m/Y à H:i", strtotime($other_articles['date_articles'])) .' par <span class="fw-bold"> '. $other_articles['user_name'].'</span></small></p>
                                <div class="">
                                <p class="mb-5">'.nl2br($other_articles['content']).'</p>
                                </div>
                        </div> 
                                ';
                                ?>

                    <?php
                    if(isset($_SESSION["id"]) && $_SESSION["id"] == $other_articles["id"]) {
                    ?>
                    <?php
                           echo '   <a href="modif_article.php?&id='.$other_articles["0"].'" class="btn btn-info d-flex justify-content-center col-sm-3 col-md-4 col-lg-3 mx-auto  mb-3" >Modifier mon article</a>
                                            
             ';
            }
?>

<?php
     echo  ' <div class="container">
            <div class="row">
                <form class="form-group" method="POST" action="functions/comm_form.php?&id= '.$other_articles['0'].'">
                    <div class="d-grid gap-2 col-sm-12 col-md-8 col-lg-10 mx-auto mt-4">

                            <label for="comm_art" class="fs-5 fw-bold">Ecrivez votre commentaire :</label>
                            <textarea class="form-control" name="content" id="comm_art" rows="3" placeholder="Pour mieux voir votre texte vous pouvez agrandir vous pouvez cliquer en bas à droite et déployer vers le bas"></textarea>

                                    <div class="d-grid gap-2 col-2 mx-auto mt-4">
                                        <button class="btn btn-info" type="submit">Envoyer</button>
                                    </div>
                    </div>
                </form>
            </div>
         </div>
        '
?>


    <div class="container mt-3 mb-5">
        <label for="" class="fs-5 fw-bold">Commentaires :</label>
        
<?php
$comments = get_full_comments();
if(!empty($comments)){
    foreach($comments as $comment){
        echo '
                        <div class="mt-4">
                            <p class="text-info"><small>Publié le ' . date("d/m/Y à H:i", strtotime($comment['date_comm'])) .' par <span class="fw-bold"> '. $comment['user_name'].' </span></small></p>
                            <p>'.nl2br($comment['comment']).'</p>
                        </div>
                                

            ';
    }
}
?>

    </div>

<!-- page footer -->
<?php require_once 'footer.php' ?>

</body>
</html>

    