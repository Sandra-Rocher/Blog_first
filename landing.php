<?php 

    require_once 'modele/database.php';
    
    if(!isset($_SESSION['user_name'])){
        header('Location:index.php');
        die();
    }

?>


<?php require 'header.php' ?>

<div class="container d-flex justify-content-center align-items-center" style="height: 550px;">
    <div class="row">
       <div class="text-center">
              <h4 class="p-3 mt-5 mb-5">Voulez-vous nous quitter <?php echo $_SESSION['user_name']; ?> ? Si oui, cliquez sur le bouton ci dessous.</h4>
             <a href="functions/deconnexion.php" class="btn btn-danger btn-lg mb-5">Déconnexion</a>
       </div>
    </div>
</div>


<?php require_once 'footer.php' ?>
