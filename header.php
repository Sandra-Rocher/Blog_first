<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO -->
    <meta name="author" content="Rocher Sandra">
    <meta name="keywords" content="HTML, CSS, JavaScript, Bootstrap, Ajax, PHP, MySQL, blog, articles, profil, commentaires, like">
    <meta name="description" content="Blog de publication personnelle, publications public périodique et régulière">
    <!-- litle logo on browser page -->
    <link rel="icon" type="image/x-icon" href="public/Logo_Sandra.ico" />
    <!-- link css -->
    <link href="public/stylesheet.css" rel="stylesheet">
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <!-- link bootstrap icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- 3 Links jquery js for the modal confirmation of deletion -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>Blog en voyage avec...</title>
</head>
<body>

<nav class="navbar navbar-expand-xxl bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand ms-5 text-white" href="index.php"><span class="text-info fs-2 fw-bold">BLOG</span> En voyage avec... <span class="text-info fs-3 fw-bold"><?php if(!empty($_SESSION['user_name'])){ echo $_SESSION['user_name']; }else{ }?></span> </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <div class="ms-auto">
                      <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item ms-3">
                                <a class="nav-link <?php if ($_SERVER['SCRIPT_NAME'] === '/Blog_first/index.php'): ?> active aria-current='page' <?php endif; ?>"   href="index.php">Accueil</a>
                              </li>
                            <li class="nav-item ms-3">
                                <a class="nav-link <?php if ($_SERVER['SCRIPT_NAME'] === '/Blog_first/articles.php'): ?> active aria-current='page' <?php endif; ?>"  href="articles.php">L'admin_voyage</a>
                            </li>
                            <li class="nav-item ms-3">
                              <a class="nav-link <?php if ($_SERVER['SCRIPT_NAME'] === '/Blog_first/bonus.php'): ?> active aria-current='page' <?php endif; ?> " href="bonus.php">L'admin_s'amuse</a>
                            </li>
     

<?php
  if(!empty($_SESSION['id'])){
?>
                          <li class="nav-item ms-3">
                            <a class="nav-link <?php if ($_SERVER['SCRIPT_NAME'] === '/Blog_first/other_articles.php'): ?> active aria-current='page'<?php endif; ?>" href="other_articles.php">L'user_partage</a>
                          </li>

                          <li class="nav-item ms-3">
                            <a class="nav-link <?php if ($_SERVER['SCRIPT_NAME'] === '/Blog_first/edit_article.php'): ?> active aria-current='page'<?php endif; ?>" href="edit_article.php">Créer un article</a>
                          </li>

                          <li class="nav-item ms-3">
                            <a class="nav-link <?php if ($_SERVER['SCRIPT_NAME'] === '/Blog_first/profil.php'): ?> active aria-current='page'<?php endif; ?>" href="profil.php">Mon profil</a>
                          </li>

                          <li class="nav-item ms-3 mx-3">
                            <a class="nav-link <?php if ($_SERVER['SCRIPT_NAME'] === '/Blog_first/landing.php'): ?> active aria-current='page'<?php endif; ?>" href="landing.php">Déconnexion</a>
                          </li>

<?php
}else{
?>
                        <li class="nav-item ms-3">
                          <a class="nav-link <?php if ($_SERVER['SCRIPT_NAME'] === '/Blog_first/connexion.php'): ?> active aria-current='page' <?php endif; ?>" href="connexion.php">Connexion</a>
                        </li>

                      </ul>
                  </div>

<?php
}
?>
      
            </div>
    </div>
</nav>


<!-- link javascript -->
<script src="public/like_script.js"></script>
<script src="public/modal.js"></script>

<!-- link bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
</body>
</html>