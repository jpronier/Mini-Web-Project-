<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=bdsf;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req=$bdd->prepare('DELETE FROM livres WHERE id_livre = ?');
$req->execute([$_POST['id_livre_a_supprimer']]);
$req->closeCursor();
header('Location: admin.php')
?>