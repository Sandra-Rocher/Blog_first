
<?php 

require_once 'header.php';

if (!isset($_SESSION["id"])) {

    header("Location: connexion.php");
}

require_once 'functions/get_posts.php';

$data = get_data_profil();

?>


    <div class="text-center mt-5">
        <h1>Bienvenue sur votre profil <?= $_SESSION["user_name"] ?> ! </h1>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-sm-12 col-md-8 col-lg-4 mx-auto">


                <!-- Errors and sucess  -->
                <?php
                if (isset($_GET['req'])) {
                    $succOrErr = htmlspecialchars($_GET['req']);

                    switch ($succOrErr) {

                        case 'user_name_upd':
                ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> Modification de votre login réussi !
                            </div>
                        <?php
                            break;

                        case 'user_name_error':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> login non modifié !
                            </div>
                        <?php
                            break;

                        case 'login_already_exist':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Login déjà existant !
                            </div>
                        <?php
                            break;

                        case 'login_name_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Login trop long !
                            </div>
                        <?php
                            break;


                        case 'user_email_upd':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> Modification de votre email réussi !
                            </div>
                        <?php
                            break;

                        case 'email_user_error':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email non modifié !
                            </div>
                        <?php
                            break;

                        case 'email_already_exist':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Email déjà existant !
                            </div>
                        <?php
                            break;

                        case 'email_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Email trop long !
                            </div>
                        <?php
                            break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Mauvais email !
                            </div>
                        <?php
                            break;

                        case 'pass_user_upd':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> Modification de votre password réussi !
                            </div>
                        <?php
                            break;

                        case 'pass_user_error':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> password non modifié !
                            </div>
                        <?php
                            break;


                        // Errors upload avatar below
                        case 'success_avat':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> Changement de l'avatar réussie !
                            </div>
                        <?php
                            break;

                        case 'error':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Upload non effectué
                            </div>
                        <?php
                            break;

                        case 'type_file':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Image trop lourde ou format incorrect
                            </div>
                        <?php
                            break;

                        case 'image':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Merci de sélectionner une image
                            </div>
                        <?php
                            break;

                        case 'type':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Type non autorisé. Veuillez choisir une image.png ou .jpg ou .jpeg ou .gif
                            </div>
                        <?php
                            break;

                        case 'check':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Veuillez sélectionner une image
                            </div>
                <?php
                            break;
                    }
                }


                ?>


                <?php


                echo     '       
                                <div class="card border border-info shadow-lg bg-info-rounded" style="border-radius: 15px;">
                                    <div class="card-body text-center">
    
                                         <div class="mx-auto mt-4 mb-4 ">
                                            <img src= stock_avatar/' . $data["avatar"] . ' class="rounded-circle w-100">
                                        </div>
    
                                        <h4 class="mb-2"> ' . $data["user_name"] . ' </h4>
                                        <p class="text-muted mb-4"> ' . $data["email"] . ' </p>
                                
                                        <a href="modif_profil.php?&id='.$data["id"].'&user_name='.$data["user_name"].'&email='.$data["email"].'&avatar='.$data["avatar"].'"> <button type="button" class="btn btn-info btn-rounded btn-lg">Modifier</button></a>
                            
                                    </div>
                                </div>
    
                            </div>
                        </div>
                     </div> ';

                ?>

<?php require_once 'footer.php' ?>

