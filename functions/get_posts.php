<?php

// on récupère le pdo
require_once './modele/database.php';


// fetch du profil sur la page profil
function get_data_profil()
{

    global $pdo;

    $select = $pdo->prepare("SELECT id, user_name, email, avatar 
                             FROM users 
                            WHERE id=? 
                            LIMIT 1");
    $select->execute(array($_SESSION['id']));
    $data = $select->fetch();

    return $data;
}


// fetch de tous les articles non validés pour la page admin-dashboard
function get_all_posts()
{

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


// fetch de tous les commentaires non validés pour la page admin-dashboard
function get_all_comms()
{

    global $pdo;

    $sql = $pdo->prepare("SELECT * FROM comm
                        JOIN users 
                        ON comm.id_users=users.id
                        JOIN articles
                        ON articles.id=comm.id_articles
                        WHERE comm.is_valid = '0'
                        ORDER BY date_comm ASC");
    $sql->execute();
    $comments = $sql->fetchAll();

    return $comments;
}



// fetch de tous les articles de tout le monde pour la page index/accueil AVEC les likes
function get_posts_index()
{

    global $pdo;

    $sql = $pdo->prepare("SELECT *, (SELECT COUNT(*) FROM likes WHERE likes.id_articles = articles.id) AS likesPerArticle FROM articles
                        JOIN users 
                        ON articles.id_users=users.id
                        WHERE is_valid = '1'
                        ORDER BY date_articles DESC");
    $sql->execute();
    $articles = $sql->fetchAll();

    return $articles;
}



// fetch des articles de l'admin sur le theme voyage pour la page article.php./l'admin_voyage
function get_posts_voyage()
{

    global $pdo;

    $sql = $pdo->prepare("SELECT *, (SELECT COUNT(*) FROM likes WHERE likes.id_articles = articles.id) AS likesPerArticle FROM articles
                            JOIN users 
                            ON articles.id_users=users.id
                            WHERE id_role = '1' AND title LIKE '%USA%'
                            AND is_valid ='1'
                            ORDER BY date_articles DESC");
    $sql->execute();
    $articles = $sql->fetchAll();

    return $articles;
}


// fetch des articles de l'admin sur le theme moto pour la page bonus/l'admin_s'amuse
function get_posts_bonus()
{

    global $pdo;

    $sql = $pdo->prepare("SELECT *, (SELECT COUNT(*) FROM likes WHERE likes.id_articles = articles.id) AS likesPerArticle FROM articles
                            JOIN users 
                            ON articles.id_users=users.id
                            WHERE id_role = '1' AND title LIKE '%moto%'
                            AND is_valid ='1'
                            ORDER BY date_articles DESC");
    $sql->execute();

    return $sql->fetchAll();
}



// fetch de tous les articles pour la page other_article/articles perso des users
function get_posts_other()
{

    global $pdo;

    $select = $pdo->prepare("SELECT *, (SELECT COUNT(*) FROM likes WHERE likes.id_articles = articles.id) AS likesPerArticle FROM articles
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
function get_full_articles()
{

    global $pdo;

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $get_id = htmlspecialchars($_GET['id']);

        $articles = $pdo->prepare('SELECT *, (SELECT COUNT(*) FROM likes WHERE likes.id_articles = articles.id) AS likesPerArticle FROM articles 
                                JOIN users
                                 ON articles.id_users=users.id
                                WHERE articles.id = ?
                                AND is_valid ="1"');
        $articles->execute(array($get_id));

        if ($articles->rowCount() == 1) {
            $other_articles = $articles->fetch();

            return $other_articles;
        } else {
            die('Cet article n\'existe pas, ou pas encore !');
        }
    } else {
        die('Erreur');
    }
}



// affiche l'article sélectionné par l'url get en entier dans full_article.php et dans modif_comm.php
function get_full_comments()
{

    global $pdo;

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $get_id = htmlspecialchars($_GET['id']);

        $comms = $pdo->prepare('SELECT * FROM comm
                                    JOIN users 
                                    ON comm.id_users=users.id
                                    JOIN articles
                                    ON articles.id=comm.id_articles
                                    WHERE articles.id = ? AND comm.is_valid ="1"
                                    ORDER BY date_comm ASC
                                ');
        $comms->execute(array($get_id));

        if ($comms->rowCount() > 0) {
            $comments = $comms->fetchAll();

            return $comments;
        } else {
            die('Il n\'y en à pas encore, soyez le ou la premier(e) !');
        }
    } else {
        die('Erreur');
    }
}
