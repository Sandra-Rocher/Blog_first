<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- lien bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
    <title>Page sur les critères</title>
</head>
<body>

<!-- lien header navbar -->
<?php require 'header.php' ?>
      

 <div class="fs-3 fw-bold text-center mt-5 mb-5">Critères pour la bonne validation de l'article :</div>


<div container class="col-sm-12 col-md-10 col-lg-8 mx-auto">

    <div class="fs-6 mt-5">
        <p>Pour respecter le travail de la créatrice ainsi que des utilisateurs :</p>
    </div>  

    <div class="fs-6 mt-4 mb-5">
        <ul>
            <li>Rester courtois, ouvert d'esprit, avenant, positif.</li>
            <li>N'oubliez pas que ce blog est un exercice d'étudiante en Développement Web, mais il pourrait être lu par des recruteurs 
                des inconnus ou des mineurs. Ainsi, veuillez être poli.</li>
            <li>Lorsque vous postez un article vous n'êtes pas obligé de parler de voyage, ou de moto.</li>
            <li>Lorsque vous postez un article vous acceptez que l'admin lise, et décide de sa publication.</li>
        </ul>    
    </div>

    <div class="fs-6 mt-5">
        <p>Voici la liste des raisons pour lesquelles vos articles pourraient ne pas être publiés :</p>
    </div>    

    <div class="fs-6 mt-4 mb-5">
        <ul>
            <li>Image à caractères pornographique, choquante, sanglante.</li>
            <li>Commentaire ou titre d'article raciste, homophobe, anarchiste, politique, misogyne, pédophile, dangereux, complotiste, ou tout simplement hors-sujet.</li>
        </ul>    
    </div>
</div>

<!-- lien footer -->
<?php require_once 'footer.php' ?>

<!-- lien bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 

</body>
</html>