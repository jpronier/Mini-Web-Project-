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


$req = $bdd->prepare('INSERT INTO suggestion (titre, saga, tome, nom, prenom, nomdeplume) VALUES(?, ?, ?, ?, ?, ?)');
$req->execute(array($_POST['titre'], $_POST['saga'], $_POST['tome'], $_POST['nom'], $_POST['prenom'], $_POST['nomdeplume']));

header('Location: form_suggestion.html')

// Redirection du visiteur vers la page du minichat
?> 