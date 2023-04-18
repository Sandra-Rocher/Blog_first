<?php

SESSION_start();

// Verification que l'id user soit connecté ET admin
if(!isset($_SESSION["id"]) || $_SESSION["id_role"] != '1'){

    header("Location: functions/deconnexion.php");
}

require_once 'functions/database.php';


// on mettra apres dans functions/get_posts
function inTable($table){

    global $pdo;
    $query = $pdo->query("SELECT COUNT(id) 
                        FROM $table");

    return $nombre = $query->fetch();
}


function get_comments(){

        global $pdo;

        $req = $pdo->query("SELECT * FROM comm
                            JOIN articles
                            ON comm.id_users=articles.id_users
                            WHERE seen = '0'
                            ORDER BY date_comm ASC
                            ");

        $results = [];
        while($rows=$req->fetchObject()){
            $results[] = $rows;

        }

        return $results;
}


   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- lien bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <title>Page Admin</title>
</head>
<body>

<!-- lien header navbar -->
<?php require_once 'header.php' ?>

    <div class="text-center mt-5 mb-5">
         <h2>Bienvenue <?= $_SESSION["user_name"] ?>, l'admin ! </h2>
    </div> 


    <?php

    $tables = [

            "Articles postés" => "articles",
            "Commentaires postés" => "comm",
            "Nombre de like" => "likes",
            "Nombre de favoris" => "favourites"
    ];

    ?>

<?php

foreach($tables as $table_name => $table){
?>
        <div class="container col-sm-6 col-md-4 col-lg-2 mt-5 mb-5">
            <div class="row"> 
                <div class="card">
                    <div class="card-title"> <?= $table_name ?></div>
                        <?= $nbrInTable = inTable($table); ?>
                    <div class="card-text"> <?= $nbrInTable[0] ?></div>
                </div>
            </div>
        </div>


<?php
}
?>


<div class="text-center"> Commentaires non lus </div>
    

    <?php
    $comments = get_comments();
    ?>

    <table>
        <thead>
            <tr>
                <th>Article </th>
                <th>Commentaire </th>
                <th>Actions </th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach($comments as $comment){
                ?>
                    <tr id="Commentaire_<?= $comment->id_articles ?>">
                    <!-- il faudra modifier la requete sql pour ecrire le titre de l article -->
                        <td><?=$comment->title?></td>
                        <td><?= substr($comment->comm,0,100); ?>...</td>
                        <td>
                            <a href="" id="<?= $comment->id ?>" class="btn btn-info modal-trigger">Voir</a>
                            <a href="" id="<?= $comment->id ?>" class="btn btn-success">Valider</a>
                            <a href="#comment_<?php $comment->id ?>" class="btn btn-danger">Supprimer</a>
                                    <div class="modal" id="$comment_<?= $comment->id ?>">
                                         <div class="modal-content">
                                                <h4> <?= $comment->title ?> </h4>
                                                <p>Commentaire posté par <strong><?= $comment->name." (".$comment->email.")</strong>" Le ".date("d/m/Y à H:i", strtotime($comment->date)) ?></p>
                                         </div>
                                         <div class="modal-footer">
                                                <a href="" id="<?= $comment->id ?>" >Ok</a>
                                                <a href="" id="<?= $comment->id ?>" >Close</a>
                                         </div>
                        </td>
                    </tr>

                <?php
            }
            ?>
        </tbody>
    </table>





<!-- lien footer -->
<?php require_once 'footer.php' ?>

<!-- lien bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  
</body>
</html>