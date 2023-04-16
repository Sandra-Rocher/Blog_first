<!-- 
<h6 class=text-white> Le <......?php date ("d/m/Y à H:i", strtotime($data->date_articles)) ?......> </h6> -->



<?php

SESSION_start();

    
// connexion avec la database
require_once 'functions/database.php';


if(isset($error)){
    echo "<p style='color:red'>$error</p>";
}

if(isset($success)){
    echo "<p style='color:green'>$success</p>";
}



// récupéré les données dans la base de donnée
    $select = $pdo->prepare("SELECT * FROM users");
    $select->execute();
    $data = $select->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
    <title>Profil</title>
</head>
<body>
    
<?php require 'header.php' ?>

<div class="fs-3 fw-bold text-center mt-5 mb-5">Bienvenue admin, tu verras tout les users et leurs infos. A modifier pour where id = session id connecté... pour que chacun est uniquement son propre profil d'afficher avec ses articles</div>


<?php

foreach($data as $response){

    echo '<form>
        <div class="row">
            <div class="col-3 mx-auto">
                <input type="text" class="form-control id="user" placeholder='. $response["user_name"] .'">
                <label class="form-control" for="user"> <a href="functions/profil_form.php?id='. $response["id"].'&user_name='.$response["user_name"].'">modifier</a>
            </div>

            <div class="col-3 mx-auto">
                <input type="text" class="form-control" id="email" placeholder='. $response["email"] .'">
                <label class="form-control" for="email"> <a href="functions/profil_form.php?id='. $response["id"].'&email='.$response["email"].'">modifier</a>
            </div>

            <div class="col-3 mx-auto mb-5">
                <input type="text" class="form-control" id="password" placeholder="'. $response["password"] .'">
                <label class="form-control" for="password"> <a href="functions/profil_form.php?id='. $response["id"].'&password='.$response["password"].'">modifier</a>
            </div>
        </div>
    </form>';

}


?>

<?php require_once 'footer.php' ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
</body>
</html>

