<?php
var_dump($_GET);

if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $delete_id = htmlspecialchars($_GET['id']);

    $delete_id = $pdo->prepare('DELETE FROM articles
                                WHERE id = ?');
                    
    $delete_id->execute(array($delete_id));
    
    header('Location:../other_articles.php?&success=del_art');
}

?>

<!-- Mettre dans la page modif_articles :
    <a href="functions/delete_article.php?id=<?=$_GET['id']?>"> Supprimer l'article </a>


    exemple dans page full pr trouver l'article
    <a href="modif_article.php?id='. $other_article['0'] . '" class="btn btn-info d-flex justify-content-center mb-3" >Modifier l\'article</a>


    
    puis déplacer la fonction en la creant dans functions/get_posts.phppp -->