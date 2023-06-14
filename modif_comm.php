<?php

session_start();

// page d'appel des functions
require_once 'functions/get_posts.php';

// même fonction que full article, car on veut afficher pour rappel les infos de l'article concerné par le commentaire
$article = get_full_articles();

// on récupère le commentaire en vue de l'afficher afin de le modifier
$comment = get_comment();

// Verification que l'id de la personne soit bien connectée et celle qui à éditée l'article
if(!isset($_SESSION["id"]) || $_SESSION["id"] != $comment['3']){
    
    // redirection sur l'article en full qui été sélectionné par l'id
header('Location:full_article.php?id='.$article[0].'&rep_err=wrong_id_us');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog en voyage avec...</title>
</head>
<body>


<?php require 'header.php' ?>


<!-- Erreurs reportées -->
<?php
    if (isset($_GET['rep_err'])) {
        $rep_err = htmlspecialchars($_GET['rep_err']);

        if ($rep_err === 'cont_empty') {
        ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> Remplir le champ.
            </div>
        <?php
        }

        if ($rep_err === 'error') {
        ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> Erreur d'upd
            </div>
        <?php
        }
 
    }
?>


<?php
    if(!empty($_SESSION['id'])){
?>

<!-- Modal de confirmation de suppression du commentaire, script modal.js -->
<div id="dialog-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dialog-confirm-title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dialog-confirm-title">Confirmation de la suppression</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Etes-vous sûr de vouloir supprimer cet élément ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirm-yes">Confirmer</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>


<?php
   
    
    echo     ' <div class="container mt-5 mb-5 col-sm12 col-md-8 col-lg-10 border border-info shadow-lg bg-info-rounded">
                    <div class="row text-center border border-info shadow-lg bg-info-rounded">
                        <h1 class="mt-5">Modifier mon commentaire</h1>

                                <form class="form-group mt-3" method="POST" action="functions/modif_comm_form.php?&idc='.$comment[0].'&ida='.$article[0].'">
                                    <div class="d-grid gap-2 col-sm-12 col-md-8 col-lg-10 mx-auto mt-3">
            
                                        <label for="comm_art" class="fs-4 mx-auto">Votre commentaire ci dessous</label>
                                        <textarea class="form-control" name="cont" id="comm_art" rows="8" required="required" placeholder="" >'.$comment["comment"].'</textarea>
            
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <img src= stock_avatar/'.$article [3].' class="card-img-top w-75" alt=" '.$article [1].'">
                                            </div> 
                                            <div class="col-6 mt-auto mb-auto">
                                                <label for="title_art" class="fs-4 mx-auto">Rappel du titre et de la photo de l\'article concerné :</label>
                                                <input type="text" class="form-control" name="tit" id="title_art"  placeholder="Titre de votre article..." value="'.$article[1].'" readonly>
                                            </div> 
                                        </div>

                                        <div class="row">
                                            <div class="d-flex justify-content-around mx-auto mt-5 mb-4">
                                                <a href="functions/delete_comm.php?&id='.$comment[0].'"<button class="confirmModal btn btn-info" type="submit">Supprimer entièrement le commentaire</button></a>
                                                <button class="btn btn-info" type="submit">Envoyer les modifications</button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="d-grid gap-2 mx-auto mt-4 mb-5">
                                        <div class="fs-bold"><a href="crit_valid.php">Avant de valider votre commentaire, allez voir les critères de validation de celui-ci</a></div>
                                    </div>
                                </form>    
                                     
                    </div>
                </div> ';
                  

?>

<?php
}else{
?>
        <div class="container mt-5 mb-5 text-center">
             <div class ="fs-4 mb-3"> Vous devez être connecté pour modifier votre commentaire </div>
            <a href="connexion.php">Connexion</a>
        </div>

<?php
}
?>


<?php require_once 'footer.php' ?>

 </body>
</html>




