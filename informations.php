<?php

session_start();
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <li>S'inscrire, modifier, ou supprimer un compte utilisateur</li>
            <li>Créer, modifier, supprimer un article (uniquement pour les connectés)</li>
            <li>Les articles peuvent contenir une photo, qui peuvent aussi être ajoutées, modifiées, ou supprimées</li>
            <li>Les articles sont ensuite envoyé à l'admin qui les vérifie, pour ensuite soit supprimer soit autoriser l'article sur les pages public</li>
            <li>Un article ne peut être modifié que par son éditeur, il sera de nouveau vérifié par l'admin</li>
            <li>Afficher sur la page d'accueil tous les articles, même pour les non-connectés</li>
            <li>Afficher sur la page admin_voyage uniquement les articles créer par l'admin sur le thème voyage</li>
            <li>Afficher sur la page admin_samuse uniquement les articles créer par l'admin sur le thème moto</li>
            <li>Afficher connexion pour les non-connectés</li>
            <li>Afficher déconnexion, la page d'user partage ainsi que le profil du connecté</li>
            <li>Seul les connectés peuvent commenter les articles, ils seront visible dans la page de l'article concerné</li>
            <li>Sécurisé les pages, afin que personne n'accède à la page admin à part celui ci</li>
            <li>Sécurisé les pages, afin que personne n'accède par l'url aux pages qui ne le concerne pas</li>
            <li>Sécurisé la base de données afin qu'elle ne révèle pas les emails et les mots de passe des utilisateurs</li>
            <li>Sécurisé le blog des failles XSS et injection SQL</li>
            <li>Mise en page responsive avec bootstrap pour le mobile</li>
            <li>Une maquette figma à été réalisée pour la réalisation du projet</li>
        </ul>    
    </div>
</div>

<div class="fs-3 fw-bold text-center mt-5 mb-5">Voici un aperçu de l'envers du décor</div>

<!-- devra être screené et mise en page -->
    <img src= admin.php         class="card-img w-100" alt="">
    <img src= edit_article.php  class="card-img w-50" alt="">
    <img src= profil.php        class="card-img w-50" alt="">
    <img src= modif_profil.php  class="card-img w-50" alt="">
    <img src= modif_article.php class="card-img w-50" alt="">

<!-- lien footer -->
<?php require_once 'footer.php' ?>

</body>
</html>