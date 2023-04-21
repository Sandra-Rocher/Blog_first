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


// fetch de tous les articles pour la page admin-dashboard
function get_all_posts(){

    global $pdo;

$sql = $pdo->prepare("SELECT * FROM articles
                        JOIN users 
                        ON articles.id_users=users.id
                        WHERE is_valid = '0'
                        ORDER BY date_articles ASC"); 
$sql->execute();
$articles = $sql->fetchAll();

return $articles;
}


// fetch de tous les articles pour la page index/accueil
function get_posts_index(){

    global $pdo;

$sql = $pdo->prepare("SELECT * FROM articles
                        JOIN users 
                        ON articles.id_users=users.id
                        WHERE is_valid = '1'
                        ORDER BY date_articles DESC"); 
$sql->execute();
$articles = $sql->fetchAll();

return $articles;
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



// fetch de tous les articles pour la page other_article/articles perso des users
function get_posts_other(){

    global $pdo;

    $select = $pdo->prepare("SELECT * FROM articles
                            JOIN users 
                            ON articles.id_users=users.id
                            WHERE id_users=? 
                            AND is_valid ='1'
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
                                WHERE articles.id = ?
                                AND is_valid ="1"');
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