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
     <title>Vos articles</title>
</head>
<body>
    
<?php require_once 'header.php' ?>

<?php
    if(!empty($_SESSION['id'])){
?>


<?php 
if(isset($_GET['success']))
{
    $success = htmlspecialchars($_GET['success']);

    if($success === 'del_art')
    {
        ?>
            <div class="alert alert-success">
                <strong>Succès</strong> Vous avez supprimé l'article.
            </div>
        <?php
    }else{($success === 'dont_del_art')
        ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> Vous n'avez pas supprimé l'article.
            </div>

        <?php
    }
}

if(isset($_GET['req']))
{
    $req = htmlspecialchars($_GET['req']);

    if($req === 'del_com')
    {
        ?>
            <div class="alert alert-success">
                <strong>Succès</strong> Vous avez supprimé le commentaire.
            </div>
        <?php
    }else{($req === 'dont_del_com')
        ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> Vous n'avez pas supprimé le commentaire.
            </div>

        <?php
    }
}
?>

<?php 

        if(isset($_GET['reg_err']))
        {
            $err = htmlspecialchars($_GET['reg_err']);

            switch($err)
            {
                case 'success_upd':
                ?>
                    <div class="alert alert-success">
                        <strong>Succès</strong> Article modifié, l'admin vérifiera et s'il corresponds aux <a href="crit_valid.php">critères de publication</a>, si c'est le cas il sera posté sur la page Accueil et dans votre page nommée l'User_partage !
                    </div>
                <?php
                break;

                case 'error_upd':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> Erreur, l'article n'a pas pu être modifié
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


<div class="fs-3 fw-bold text-center mt-5 mb-3">Ici, vous retrouverez tous vos articles personnellement publiés.</div>
<div class="fs-5 fw-bold text-center mb-5">Après validation de l'admin, ils seront ensuite publiés dans la page accueil.</div>

        
            <div class="container mt-5">
                <div class="row">

<?php

    foreach($other_articles as $other_article){

  echo     ' 
                     <div class="col-sm-12 col-md-12 col-lg-5 mx-auto mb-5">

                        <div class="card border border-info shadow-lg">
                            <div class="d-flex justify-content-between">
                                <p class="card-text mx-auto mt-3"><small class="text-info">Publié le ' . date("d/m/Y à H:i", strtotime($other_article["date_articles"])).' par <span class="fw-bold"> '. $other_article["user_name"].' </span></small></p>
                                <a class="mt-3 mx-auto btn btn-info" href="like_form.php?&id='.$other_article['0'].'" role="button"><i class="bi bi-hand-thumbs-up"> '.$other_article["likesPerArticle"].'</i></a>
                            </div>
                                <h5 class="card-title text-center"> '.$other_article["title"].' </h5>
                                <a href="full_article.php?id='. $other_article[0].'"> <img src= stock_avatar/'.$other_article["image"] .' class="card-img-top" alt=" '.$other_article["title"].'"></a>
                                    <div class="card-body mx-auto">
                                        <p class="card-text overflow-auto"> '.substr(nl2br($other_article["content"]),0,1000) . ' ... </p>
                                        <a href="full_article.php?&id='.$other_article[0].'" class="btn btn-info d-flex justify-content-center" >Voir l\'article complet</a>
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

</body>
</html>