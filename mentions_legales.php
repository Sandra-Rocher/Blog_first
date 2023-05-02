<?php

session_start();
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Mentions légales</title>
</head>
<body>

<!-- lien header navbar -->
<?php require 'header.php' ?>
      

 <div class="fs-3 fw-bold text-center mt-5 mb-5">Page Mentions légales</div>


<div container class="col-sm-12 col-md-10 col-lg-8 mx-auto">
    <div class="fs-6 mt-5">
        <p class="text-center">Ce blog est un exercice d'étudiante en développement web.</p>
        <p class="text-center">Je vous propose d'apporter votre aide !</p>
    </div>   
    
<div class="fs-4 fw-bold text-center mt-5 mb-5">Pourquoi créer un compte sur ce blog ?</div>

    <div class="fs-6 mt-4 mb-5">
        <ul>
            <li>Pour participer aux fonctions qu'il réserve en vous inscrivant</li>
            <li>Pour l'égayer d'articles, de commentaires et le faire vivre</li>
            <li>Pour challenger la créatrice et l'admin, si vous trouvez des erreurs, bugs, 404 etc : dites "false" sur mon email</li>
            <li>Vos informations seront stockées dans une base de données qui ne sera jamais divulgée sur internet, pas 
                d'utilisation à des fins commercial, pas de pub monnayés, pas d'offre de pop-up qui vous saute dessus, rien.</li>
            <li>Gratuité d'utilisation du blog éternelle </li>
            <li>Pour toute questions : sandra.rocher@hotmail.fr</li>
        </ul>    
    </div>
</div>

<!-- lien footer -->
<?php require_once 'footer.php' ?>

</body>
</html>