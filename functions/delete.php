<?php

session_start();

$id = $_SESSION['id'];

// connexion avec la database
require_once 'database.php';


// on supprime
$delete = $pdo->prepare("DELETE FROM users WHERE id = ?");
$delete->execute([$id]);


// session_start(); // demarrage de la session
    session_destroy(); // on détruit la/les session(s), soit si vous utilisez une autre session, utilisez de préférence le unset()
    header('Location:../index.php?success=suppression du compte réussi'); // On redirige
    die();



// // rediriger vers la page principal
// header("Location: index.php?success=suppression du compte réussi");


