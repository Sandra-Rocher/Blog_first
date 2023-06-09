<?php

require_once 'functions/get_posts.php';

$articles = get_full_articles();

?>


    <?php require_once 'header.php' ?>



    <!-- Errors and sucess-->
    <?php
    if (isset($_GET['rep_err'])) {
        $rep_err = htmlspecialchars($_GET['rep_err']);

        if ($rep_err === 'wrong_id_us') {
        ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> Vous devez être l'éditeur de l'article pour le modifier.
            </div>
        <?php
        }

        if ($rep_err === 'content_empty') {
        ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> Il n'y à pas de commentaire saisis.
            </div>
        <?php
        }

        if ($rep_err === 'empty_id') {
        ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> Vous n'êtes pas connecté.
            </div>
        <?php
        }

        if ($rep_err === 'comm_post') {
        ?>
            <div class="alert alert-success">
                <strong>Succès</strong> Votre commentaire à été envoyé, il sera vérifié par l'admin, et s'il corresponds aux <a href="crit_valid.php">critères de publication</a>, il sera publié.
            </div>
        <?php
        }

        if ($rep_err === 'comm_not_post') {
        ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> Le commentaire n'a pas été posté.
            </div>
        <?php
        }

        if ($rep_err === 'error_id') {
            ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> Erreur d'id commentaire
                </div>
            <?php
            }

        if ($rep_err === 'success_upd') {
            ?>
                 <div class="alert alert-success">
                    <strong>succès</strong> Votre commentaire à été modifié, il sera vérifié par l'admin, et s'il corresponds aux <a href="crit_valid.php">critères de publication</a>, il sera publié.
                </div>
            <?php
        }
    }
    ?>



    <?php

    echo     '         
                    <img src= stock_avatar/'.$articles['image'].' class="card-img" alt=" '.$articles['title'].'">
                        <div class="container">
                            <h3 class="mt-3 mb-3"> '.$articles['title'].' </h3>
                                <div class="d-flex justify-content-between">
                                    <p class=""><small>Publié le '.date("d/m/Y à H:i", strtotime($articles['date_articles'])).' par <span class="fw-bold me-2"> '.$articles['user_name'].' </span></small> <img src= stock_avatar/' . $articles["avatar"] . ' class="rounded" style="height: 45px; width: 45px;"></p>

                                    <p class="mt-3 btn btn-info" ';
                                if (!empty($_SESSION["id"])) echo 'onclick="likeArticle('.$articles[0].')" ';
    echo'
                                 role="button"> <i class="bi bi-hand-thumbs-up"></i> 
                                <span id="likes-for-article-'.$articles[0].'">'.$articles["likesPerArticle"].'</span></p>
                                
                                    </div>    
                                    <div class="">
                                        <p class=""> '.(nl2br($articles['content'])).' </p>
                                    </div>
                        </div> 
                                ';
    ?>

    <?php
    if (isset($_SESSION["id"]) && $_SESSION["id"] == $articles["id"]) {
    ?>
    <?php
        echo '   <a href="modif_article.php?&id='.$articles["0"].'" class="btn btn-info d-flex justify-content-center col-sm-3 col-md-4 col-lg-3 mx-auto  mb-3" >Modifier mon article</a>
                                            
             ';
    }
    ?>

    <?php
    if (!empty($_SESSION['id'])) {

        echo  ' <div class="container">
                    <div class="row">
                        <form class="form-group" method="POST" action="functions/comm_form.php?&id= '.$articles['0'].'">
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
                ';
    } 
    ?>


        <div class="container mt-3 mb-5">
            <label for="" class="fs-5 fw-bold">Commentaires :</label>

        <?php
        $comments = get_full_comments();
        if (!empty($comments)) {
            foreach ($comments as $comment) {
                echo '
                        <div class="mt-4">
                            <p class=""><small>Publié le '.date("d/m/Y à H:i", strtotime($comment['date_comm'])).' par <span class="fw-bold me-2"> '.$comment['user_name'].' </span></small> <img src= stock_avatar/' . $comment["avatar"] . ' class="rounded" style="height: 45px; width: 45px;"></p>
                            <p>'.$comment['comment'].' </p>
                        </div>
                    ';

                    
                    if (isset($_SESSION["id"]) && $_SESSION["id"] == $comment["3"]) {
                        echo '   <a href="modif_comm.php?&id='.$articles["0"].'&idc='.$comment["0"].'" class="btn btn-info d-flex justify-content-center col-sm-3 col-md-4 col-lg-3 mx-auto  mb-3" >Modifier mon commentaire</a>
                                            
                        ';
                    
                    }
                    
            }
        }
    
        ?>

        </div>

        
<?php require_once 'footer.php' ?>
