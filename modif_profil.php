<?php

// On ouvre la session
session_start();

// On récupère l'id de la session sinon on redirige
if(!isset($_SESSION["id"])){
   
    header("Location: connexion.php");
}

// On va chercher la fonction, et on la déclenche en dessous pour avoir les infos dans $data
require_once 'functions/get_posts.php';

$data = get_data_profil();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page perso</title>
</head>
<body>

<?php require_once 'header.php' ?>

<div class="text-center mt-5">
    <h2>Modifiez votre profil <?= $_SESSION["user_name"] ?> ! </h2>
</div> 


<!-- Modal de confirmation de suppression du profil, script modal.js -->
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


     <!-- Formulaire dans profil : peut etre repartir du même -->
            <div class="container mt-5 mb-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">
                        <div class="card border border-info shadow-lg bg-info-rounded" style="border-radius: 15px;">
                            <div class="card-body text-center mb-4">
    
                                <div class="mx-auto mt-4 mb-4 "><?php
                                    echo' <img src=stock_avatar/' . $data["avatar"] . ' class="rounded-circle w-50">'?>
                                </div>
    
                                    
                                    <h5 class="mt-4">Login actuel : <?php if(isset($_GET["user_name"])){ echo htmlspecialchars($_GET["user_name"]); } ?></h5>

                                    <form action="functions/profil_form.php?id=<?php echo $data["id"] ?>&user_name=<?php echo $data["user_name"] ?>" method="POST">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="user_name" id="user_name"
                                            value="<?php if(isset($_GET["user_name"])){ echo htmlspecialchars($_GET["user_name"]); } ?>">
                                                                
                                            <button class="bg-info btn btn-outline-black" type="submit" id="user_name">Modifier</button>
                                        </div>
                                    </form>


                                    <h5 class="mt-4">Email actuel : <?php if(isset($_GET["email"])){ echo htmlspecialchars($_GET["email"]); } ?></h5>

                                    <form action="functions/profil_form.php?id=<?php echo $data["id"] ?>&email=<?php echo $data["email"] ?>" method="POST">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="email" id="email"
                                            value="<?php if(isset($_GET["email"])){ echo htmlspecialchars($_GET["email"]); } ?>">
                                                                
                                            <button class="bg-info btn btn-outline-black" type="submit" id="email">Modifier</button>
                                        </div>
                                    </form>

                                    

                                    <div class="mt-4">
                                        <h5>Password actuel : Non révélé</h5>
                                     </div>

                                     <form action="functions/profil_form.php?id=<?php echo $data["id"] ?>" method="POST">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Entrez le nouveau password" name="password" id="password">
                                                                
                                            <button class="bg-info btn btn-outline-black" type="submit" id="password">Modifier</button>
                                        </div>
                                    </form>

                                     <div class="mt-4">
                                        <h5>Modifier votre avatar</h5>
                                    </div>

                                    <form action="functions/profil_form.php?id=<?php echo $data["id"] ?>" method="POST" enctype="multipart/form-data">
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="avatar" id="avatar" aria-describedby="avatar" aria-label="Upload">
                                            <button class="bg-info btn btn-outline-black" type="submit" id="avatar">Modifier</button>
                                        </div>
                                    </form>

                            </div>
                        </div>
                    </div>
                 </div>
            </div>

             <div class="text-center">
                    <h4 class="fs-5 mt-5">Voulez-vous supprimer votre compte <?php echo $_SESSION['user_name']; ?> ?</h4>
                                                                            
                    <br />
                    <a class="confirmModal btn btn-danger btn-md mb-5" href="functions/delete_user.php" >Oui, supprimer mon compte</a>
            </div>
          
                     
<?php require_once 'footer.php' ?>

</body>
</html>

