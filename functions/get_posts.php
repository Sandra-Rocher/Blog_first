<!-- 
Il faudra rajouté WHERE articles posted (is valid ?) ='1' aux requetes, c est a dire qu'elles ont été vérifié par l'admin.
Je vais créer les functions qui appel le pdo pour que l admin face ça justement -->

<?php



// on récupère le pdo
require_once 'database.php';


// fetch du profil sur la page profil
function get_data_profil(){

    global $pdo;

    $select = $pdo->prepare("SELECT id, user_name, email, avatar 
                        FROM users 
                        WHERE id=? 
                        LIMIT 1"); 
    $select->execute(array($_SESSION['id']));
    $data = $select->fetch();

    return $data;
}



// fetch des articles de l'admin sur le theme voyage pour la page article.php./l'admin_voyage
function get_posts_voyage(){

    global $pdo;

    $sql = $pdo->prepare("SELECT * FROM articles
                            JOIN users 
                            ON articles.id_users=users.id
                            WHERE id_role = '1' AND title LIKE 'USA%'
                            ORDER BY date_articles DESC"); 
    $sql->execute();
    $articles = $sql->fetchAll();

    return $articles;
}


// fetch des articles de l'admin sur le theme moto pour la page bonus/l'admin_s'amuse
function get_posts_bonus(){

    global $pdo;

    $sql = $pdo->prepare("SELECT * FROM articles
                            JOIN users 
                            ON articles.id_users=users.id
                            WHERE id_role = '1' AND title LIKE 'moto%'
                            ORDER BY date_articles DESC"); 
    $sql->execute();

    return $sql->fetchAll();
}


// fetch de tous les articles pour la page index
function get_posts_index(){

    global $pdo;


$sql = $pdo->prepare("SELECT * FROM articles
                        JOIN users 
                        ON articles.id_users=users.id
                        ORDER BY date_articles DESC"); 
$sql->execute();
$articles = $sql->fetchAll();

return $articles;

}


// fetch de tous les articles pour la page other_article/articles perso des users
function get_posts_other(){

    global $pdo;

    $select = $pdo->prepare("SELECT * FROM articles
                            JOIN users 
                            ON articles.id_users=users.id
                            WHERE id_users=? 
                            ORDER BY date_articles DESC"); 
    $select->execute(array($_SESSION['id']));
    $other_articles = $select->fetchAll();

    return $other_articles;

}



// affiche l'article sélectionné par l'url get en entier dans full_article.php et modif_article.php
function get_full_article(){

    global $pdo;

if(isset($_GET['id']) && !empty($_GET['id'])) {

    $get_id = htmlspecialchars($_GET['id']);

    $articles = $pdo->prepare('SELECT * FROM articles 
                            JOIN users
                            ON articles.id_users=users.id
                            WHERE articles.id = ?');
    $articles->execute(array($get_id));
   

    if($articles->rowCount() == 1) {
        $other_article = $articles->fetch();

        return $other_article; 

    }else{ die('Cet article n\'existe pas !');   
    }
    
}else{ die('Erreur');         
}
}









?>