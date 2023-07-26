

 <?php 
 require_once 'header.php';
 ?>

 <?php
    if(empty($_SESSION['id'])){
?>

<div class="container d-flex align-items-center" style="height: 550px;">
    <div class="container col-sm-12 col-md-8 col-lg-3 border border-info shadow-lg mb-5 mt-5">
        <div class="row shadow-lg bg-info-rounded">
            <div class="text-center mt-4">
                    <h1 class="text-center">Connexion</h1>
                    <form class="form-group" method="POST" action="functions/connexion_form.php">
                         <div class="d-grid gap-2 mx-auto mt-4">


<?php 
        if(isset($_GET['login_err']))
        {
                    $err = htmlspecialchars($_GET['login_err']);

                    switch($err)
                    {

                        case 'success_ins':
                            ?>
                                <div class="alert alert-success">
                                    <strong>Succès</strong> Inscription réussie !
                                </div>
                            <?php
                        break;

                        case 'wrong_password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Mot de passe incorrect
                            </div>
                        <?php
                        break;

                        case 'wrong_email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Email incorrect
                            </div>
                        <?php
                        break;

                        case 'no_exist':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Compte non existant
                            </div>
                        <?php
                        break;

                        case 'empty':
                        ?>
                             <div class="alert alert-danger">
                                 <strong>Erreur</strong> Veuillez remplir les champs
                             </div>
                        <?php
                        break;

                        case 'fatalError':
                            ?>
                                 <div class="alert alert-danger">
                                     <strong>Erreur</strong> Fatal ERROR
                                 </div>
                            <?php
                        break;

// success change de forgot password
                        case 'finaly':
                            ?>
                                <div class="alert alert-success">
                                    <strong>Succès</strong> Mot de passe modifié !
                                </div>
                            <?php
                        break;
                    }
        }
?> 
            
 
                            <input type="email" name="email" class="form-control text-center" placeholder="Email" required="required" autocomplete="off">
                            <input type="password" name="password" class="form-control text-center" placeholder="Mot de passe" required="required" autocomplete="off">
                        
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto mt-4">
                            <button tpe="submit" class="btn btn-info">Connexion</button>
                        </div>
                    </form>
                            <p class="text-center mt-4"><a href="forgot_code.php">Mot de passe oublié</a></p>
                            <p class="text-center mb-4">Pas encore de compte ? <a href="inscription.php">S'inscrire</a></p>
                    
            </div>
        </div>
    </div>
</div>

<?php
}else{
?>
        <div class="container mt-5 mb-5 text-center" style="height: 460px;">
             <div class ="fs-4 mb-3"> Vous êtes déja connecté en tant que <?= $_SESSION["user_name"] ?></div>
            <a href="functions/deconnexion.php">Déconnexion</a>
        </div>

<?php
}
?>


<?php require_once 'footer.php' ?>
