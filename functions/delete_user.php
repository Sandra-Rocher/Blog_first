<?php

require_once '../modele/database.php';

$id = $_SESSION['id'];

// delete table
$delete = $pdo->prepare("DELETE FROM users WHERE id = ?");
$delete->execute([$id]);

// delete session
session_destroy();
// redirection
header('Location:../index.php?&success=supp_id_user');
die();
