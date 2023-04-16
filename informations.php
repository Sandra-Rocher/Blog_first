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
  
    <title>Page pour les recruteurs</title>
</head>
<body>

<!-- lien header navbar -->
<?php require 'header.php' ?>
      

 <div class="fs-3 fw-bold text-center mt-5 mb-5">Page réservée aux recruteurs</div>


<div container class="col-sm-12 col-md-10 col-lg-8 mx-auto">
    <div class="fs-6 mt-5">
        <p>Ce blog était un exercice pour apprendre : Les langages : PHP, MySql, et Bootstrap.</p>
        <p>Les objectifs : Comprendre les bases de PHP et MySql, et utiliser au maximum Bootstrap.</p>
    </div>    

    <div class="fs-6 mt-4 mb-5">
        <ul>
            <li> Création d'un blog et sa base de données dans lequel on pourra :</li>
            <li>Possibilité d'inscription, de modification, ou de supréssion d'un compte utilisateur</li>
            <li>Créer, modifier, supprimer un article</li>
            <li>Les articles peuvent contenir une photo ou une vidéo, qui peuvent aussi être ajoutée, modifiée, ou supprimée</li>
            <li>Afficher sur la page d'accueil de tous les créateurs d'articles</li>
            <li>Afficher sur la page admin_voyage uniquement les articles créer par l'admin sur le thème voyage</li>
            <li>Afficher sur la page admin_samuse uniquement les articles créer par l'admin sur le thème moto</li>
            <li>Afficher connexion pour les non-connectés</li>
            <li>Afficher déconnexion ainsi que le profil du connecté</li>
            <li>Seul les connectés peuvent créer un article</li>
            <li>Seul l'admin peut modérer les articles, en les publiant ou en les supprimant avant la mise en page public</li>
            <li>Seul les connectés peuvent liker, commenter, ou mettre en favoris les articles, ils pourront les retrouver dans leur profil</li>
            <li>Sécurisé les pages, afin que personne n'accède à la page admin à part celui ci</li>
            <li>Sécurisé la base de données afin qu'elle ne révèle pas les emails et les mots de passe des utilisateurs</li>
            <li>Mise en page responsive avec bootstrap pour le mobile</li>
            <li>Une maquette figma à été réalisée pour la réalisation du projet</li>
        </ul>    
    </div>
</div>

<!-- lien footer -->
<?php require_once 'footer.php' ?>

<!-- lien bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 

</body>
</html>