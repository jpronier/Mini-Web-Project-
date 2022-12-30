<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=bdsf;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('INSERT INTO livres (titre, auteur, saga, tome, genre, type, langue,dispo,quatrieme) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
$req->execute(array($_POST['titre'], $_POST['auteur'], $_POST['saga'], $_POST['tome'], $_POST['genre'], $_POST['type'], $_POST['langue'], $_POST['dispo'], $_POST['quatrieme']));
$req->closeCursor();

header('Location: admin.php')



?>
