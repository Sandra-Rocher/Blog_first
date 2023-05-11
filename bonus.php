<?php

session_start();

require_once 'functions/get_posts.php';

$articles = get_posts_bonus();


?>



<!doctype html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>L'admin_s'amuse</title>

</head>
<body>


<?php require_once 'header.php' ?>

        
<div class= "fs-3 fw-bold text-center mt-5 mb-5"> Ici, l'admin vous partage tous ses articles sur le thème de la Moto.</div>

            <div class="container mt-5 mb-5">
                <div class="row">

<?php

    foreach($articles as $article){
    
    echo     '
                        <div class="col-sm-12 col-md-12 col-lg-5 mx-auto mb-5">

                            <div class="card mx-auto border border-info shadow-lg">
                                <div class="d-flex justify-content-between">
                                    <p class="card-text mx-auto mt-3"><small class="text-info">Publié le ' .date("d/m/Y à H:i", strtotime($article["date_articles"])).' par <span class="fw-bold"> '. $article["user_name"].' </span></small></p>
                    
                                    <p class="mt-3 mx-auto btn btn-info" ';
                                    if (!empty($_SESSION["id"])) echo 'onclick="likeArticle('.$article[0].')" ';
        echo'
                                     role="button"> <i class="bi bi-hand-thumbs-up"></i> 
                                    <span id="likes-for-article-'.$article[0].'">'.$article["likesPerArticle"].'</span></p>
                                    
                                </div>
                                    <h5 class="card-title text-center"> '.$article["title"].' </h5>
                                    <a href="full_article.php?id='.$article[0].'"> <img src= stock_avatar/'.$article["image"].' class="card-img-top" alt="'.$article["title"].'"></a>
                                        <div class="card-body mx-auto">
                                            <p class="card-text overflow-auto"> '.substr(nl2br($article["content"]),0,1000) . ' ... </p>
                                            <a href="full_article.php?id='.$article[0] .'" class="btn btn-info d-flex justify-content-center mb-3" >Voir l\'article complet</a>
                                        </div>
                            </div>
                        </div>
                     ';
 }
?>

                </div>
            </div>


<?php require_once 'footer.php' ?>
<script src="public/like_script.js"></script>

</body> 
</html>