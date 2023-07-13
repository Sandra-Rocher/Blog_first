
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



try
{
    $pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "");
    }catch(Exception $e)
    {
    die("Erreur".$e->getMessage());
}





?>


