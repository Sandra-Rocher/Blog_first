
<?php

session_start();

if(!isset($_SESSION["id"])){
    

    header("Location: connexion.php");
}


// connexion avec la database
require_once 'functions/database.php';


$select = $pdo->prepare("SELECT id, user_name, email, avatar 
                        FROM users 
                        WHERE id=? 
                        LIMIT 1"); 
$select->execute(array($_SESSION['id']));
$data = $select->fetch();


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
    <h2>Bienvenue sur votre profil <?= $_SESSION["user_name"] ?> ! </h2>
</div> 



<?php



    echo     '       <div class="container mt-5 mb-5">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-8 col-lg-4 mx-auto">
    
                                <div class="card border border-info shadow-lg bg-info-rounded" style="border-radius: 15px;">
                                    <div class="card-body text-center">
    
                                         <div class="mx-auto mt-4 mb-4">
                                            <img src= stock_avatar/' . $data ["avatar"] . ' class="rounded-circle">
                                        </div>
    
                                        <h4 class="mb-2"> '. $data ["user_name"] . ' </h4>
                                        <p class="text-muted mb-4"> '. $data ["email"] . ' </p>
                                
                                        <button type="button" class="btn btn-info btn-rounded btn-lg"> Modifier </button>
                            
                                    </div>
                                </div>
    
                            </div>
                        </div>
                     </div> ';
 
   
 ?>

        <div class="text-center">
              <h4 class="fs-5 mt-5">Voulez-vous supprimer votre compte <?php echo $_SESSION['user_name']; ?> ?</h4>
              <!-- ou echo $data['user_name']; -->
                 <br />
             <a href="functions/delete.php" class="btn btn-danger btn-md mb-5">Oui, supprimer mon compte</a>
            

       </div>



<?php require_once 'footer.php' ?>

</body>
</html>




