<?php

require_once './modele/database.php';


// fetch all profile data's from the user connected / fetch du profil sur la page profil
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


// fetch all articles where is_valid = 0 for the admin dashboard / fetch de tous les articles non validés pour la page admin-dashboard
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


// fetch all comments where is_valid = 0 for the admin dashboard / fetch de tous les commentaires non validés pour la page admin-dashboard
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



// fetch all articles of everybody on index page with likes / fetch de tous les articles de tout le monde pour la page index/accueil AVEC les likes
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



// fetch all articles on l'admin_voyage page with likes / fetch des articles de l'admin sur le theme voyage pour la page article.php./l'admin_voyage AVEC les likes
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


// fetch all articles on l'admin_s'amuse page with likes / fetch des articles de l'admin sur le theme moto pour la page bonus/l'admin_s'amuse AVEC les likes
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



// fetch all articles from the user connected on l'user_partage page with likes / fetch de tous les articles pour la page other_article/articles perso des users AVEC les likes
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



// show full article by id with likes on full article page and modif_article page / affiche l'article sélectionné par l'url get en entier dans full_article.php et modif_article.php AVEC les likes
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
            $articles = $articles->fetch();

            return $articles;
        } else {
            die('Cet article n\'existe pas, ou pas encore !');
        }
    } else {
        die('Erreur');
    }
}



// show comment by id_article on full_article page and modif_article page / affiche l'article sélectionné par l'url get en entier dans full_article.php et dans modif_comm.php
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
            die('Il n\'y en a pas encore, soyez le ou la premier(e) ! (Connexion obligatoire)');
        }
    } else {
        die('Erreur');
    }
}



// show comment by id_article on modif_article page / affiche le commentaire sélectionné par l'url get en entier dans modif_comm.php
function get_comment()
{

    global $pdo;

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $get_id = htmlspecialchars($_GET['id']);

        if (isset($_GET['idc']) && !empty($_GET['idc'])) {

            $get_idc = htmlspecialchars($_GET['idc']);

            $comms = $pdo->prepare('SELECT * FROM comm
                                        JOIN users 
                                        ON comm.id_users=users.id
                                        JOIN articles
                                        ON articles.id=comm.id_articles
                                        WHERE articles.id = ? AND comm.id = ?
                                        AND comm.is_valid ="1"
                                    ');
            $comms->execute(array($get_id, $get_idc));
            

            if ($comms->rowCount() == 1 ) {
            $comment = $comms->fetch();

            return $comment;
            } else {
            die('Erreur2');
            }
            

        } else {
            die('Erreur_idc');

        }

    } else {
        die('Erreur');
    }
}

