<?php
$serveur = "localhost";
$base = "projet_S3";
$user = "cloe";
$pass = "inserer votre mots de passe";

try {
    $bdd = new PDO("mysql:host=".$serveur.";dbname=".$base, $user, $pass);
} catch (PDOException $e) {
    // gestion d'erreur de connexion à la base de donnée
    echo "Erreur de connexion à la base de donnée\n";
    //die($e->getMessage());
}

?>
