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


<?php require 'header.php' ?>
      

 <div class="fs-3 fw-bold text-center mt-5 mb-5">Page réservée aux recruteurs</div>


<div container class="col-sm-12 col-md-10 col-lg-8 mx-auto">
    <div class="fs-6 mt-5">
        <p>Ce blog était un exercice pour apprendre : Les langages : PHP, MySql, et Bootstrap.</p>
        <p>Les objectifs : Comprendre les bases de PHP et MySql, et utiliser au maximum Bootstrap.</p>
    </div>    

    <div class="fs-6 mt-4 mb-5">
        <ul>
            <li>Création d'un blog et sa base de données dans lequel on pourra :</li>
            <li>S'inscrire, modifier, ou supprimer un compte utilisateur</li>
            <li>Créer, modifier, supprimer un article (uniquement pour les connectés)</li>
            <li>Les articles peuvent contenir une photo, qui peut aussi être ajoutée, modifiée, ou supprimée</li>
            <li>Les articles sont ensuite envoyés à l'admin qui les vérifie, pour ensuite soit supprimer soit autoriser l'article sur les pages publiques</li>
            <li>Un article ne peut être modifié que par son éditeur, il sera de nouveau vérifié par l'admin</li>
            <li>Afficher sur la page d'accueil tous les articles, même pour les non-connectés</li>
            <li>Afficher sur la page admin_voyage uniquement les articles crées par l'admin sur le thème voyage</li>
            <li>Afficher sur la page admin_s'amuse uniquement les articles crées par l'admin sur le thème moto</li>
            <li>Afficher connexion pour les non-connectés, la page mentions-legales, et la page vous êtes recruteurs </li>
            <li>Afficher déconnexion, la page d'user partage, créer un article, ainsi que le profil du connecté</li>
            <li>Seuls les connectés peuvent commenter les articles, ils ne seront visible que dans la page de l'article concerné</li>
            <li>Seuls les connectés peuvent liker les articles, ils ne seront visible que dans la page de l'article concerné</li>
            <li>Sécuriser les pages, afin que personne n'accède à la page admin à part celui ci</li>
            <li>Sécuriser les pages, afin que personne n'accède par l'url aux pages qui ne le concernent pas</li>
            <li>Sécuriser la base de données afin qu'elle ne révèle aucun email et mot de passe des utilisateurs</li>
            <li>Sécuriser le blog des failles XSS et injection SQL</li>
            <li>Mise en page responsive avec bootstrap pour le mobile</li>
            <li>Une maquette figma à été réalisée pour la réalisation du projet</li>
            <li>Bien sûr il y a encore beaucoup de fonctionnalités à venir comme : l'upload de plusieurs photos ou de vidéos, l'autosearch d'un article par mots clés 
              dans le titre, avoir des favoris, mettre des dislikes, faire des regex plus strict sur le mot de passe, etc.</li>
        </ul>    
    </div>
</div>


<div class="fs-3 fw-bold text-center mt-5 mb-5">Voici un aperçu de l'envers du décor</div>

<div class="container">
    <div id="carouselDuBlog" class="carousel slide mb-5" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselDuBlog" data-bs-slide-to="0" class="active bg-info" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselDuBlog" data-bs-slide-to="1" class="bg-info" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselDuBlog" data-bs-slide-to="2" class="bg-info" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselDuBlog" data-bs-slide-to="3" class="bg-info" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carouselDuBlog" data-bs-slide-to="4" class="bg-info" aria-label="Slide 5"></button>
        <button type="button" data-bs-target="#carouselDuBlog" data-bs-slide-to="5" class="bg-info" aria-label="Slide 6"></button>
        <button type="button" data-bs-target="#carouselDuBlog" data-bs-slide-to="6" class="bg-info" aria-label="Slide 7"></button>
      </div>

      <div class="carousel-inner">

        <div class="carousel-item active" data-bs-interval="5000">
          <img src="public/carousel/maquette_figma.jpg" class="d-block w-100" alt="maquette_figma">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h5 class="text-danger">Maquette figma</h5> -->
            <!-- <p class="text-danger">Présentation de la maquette complête du Blog.</p> -->
          </div>
        </div>

        <div class="carousel-item" data-bs-interval="5000">
          <img src="public/carousel/dashboard_admin.jpg" class="d-block w-100" alt="dashboard_admin">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h5 class="text-danger">Dashboard admin</h5> -->
            <!-- <p class="text-danger">Contrôle des articles et des commentaires avant publications.</p> -->
          </div>
        </div>

        <div class="carousel-item" data-bs-interval="5000">
          <img src="public/carousel/dashboard_admin2.jpg" class="d-block w-100" alt="dashboard_admin_2">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h5 class="text-danger">Dashboard admin-suite</h5> -->
            <!-- <p class="text-danger">Aperçu en détail des articles et des commentaires.</p> -->
          </div>
        </div>

        <div class="carousel-item" data-bs-interval="5000">
          <img src="public/carousel/creer_article.jpg" class="d-block w-100" alt="page création d'article">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h5 class="text-danger">Création d'article</h5> -->
            <!-- <p class="text-danger">Uniquement pour les connectés. Quelques vérifications seront effectués (extension, taille de l'image, etc)</p> -->
          </div>
        </div>

        <div class="carousel-item" data-bs-interval="5000">
          <img src="public/carousel/modif_article.jpg" class="d-block w-100" alt="page modification d'article">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h5 class="text-danger">Modification d'article</h5> -->
            <!-- <p class="text-danger">Uniquement pour l'éditeur de l'article connecté. L'article sera de nouveau analysé par l'admin</p> -->
          </div>
        </div>

        <div class="carousel-item" data-bs-interval="5000">
          <img src="public/carousel/page_profil.jpg" class="d-block w-100" alt="page profil">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h5 class="text-danger">Page profil</h5> -->
            <!-- <p class="text-danger">Uniquement pour les connectés.</p> -->
          </div>
        </div>

        <div class="carousel-item" data-bs-interval="5000">
          <img src="public/carousel/modif_profil.jpg" class="d-block w-100" alt="page modification de profil">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h5 class="text-danger">Modification du profil</h5> -->
            <!-- <p class="text-danger">Les vérifications dans la base de données (login, email en double) seront les même qu'a l'inscription</p> -->
          </div>
        </div>

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselDuBlog" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-info" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselDuBlog" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-info" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
  </div>
</div>


<?php require_once 'footer.php' ?>

</body>
</html>