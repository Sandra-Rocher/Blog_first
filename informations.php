

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
            <li>Se connecter sur son compte utilisateur</li>
            <li>Voir, modifier son profil utilisateur</li>
            <li>Créer, modifier, supprimer un article (uniquement pour les connectés)</li>
            <li>Les articles doivent contenir une photo</li>
            <li>Créer, modifier, supprimer un commentaire (uniquement pour les connectés)</li>
            <li>Les articles et les commentaires sont ensuite envoyés à l'admin qui les vérifie, pour ensuite soit les supprimer soit les autoriser sur les pages publiques</li>
            <li>Si un article ou un commentaire est modifié par son éditeur, il sera de nouveau vérifié par l'admin</li>
            <li>Pour les non-connectés la page d'accueil affichera tous les articles publiés dans l'ordre du plus récent</li>
            <li>Pour les non-connectés la page admin_voyage uniquement les articles publiés dans l'ordre du plus récent crées par l'admin sur le thème voyage</li>
            <li>Pour les non-connectés la page admin_s'amuse uniquement les articles publiés dans l'ordre du plus récent crées par l'admin sur le thème moto</li>
            <li>Pour les non-connectés : affichage de la page connexion, mentions-legales, et vous êtes recruteurs </li>
            <li>Pour les connectés : affichage de la page déconnexion, l'user partage, créer un article, ainsi que le profil</li>
            <li>Seuls les connectés peuvent liker les articles, un click ajoute le like ('A voté!'), un click supplémentaire le retire ('Oups !'), il n'y aura donc qu'un seul like possible par personne sur un article.</li>
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
