<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=bdsf;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
$a=date('Y-m-d H:i:s');
// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO commentaires (id_livre,auteur, commentaire, date_commentaire) VALUES(?, ?, ?, ?)');
$req->execute(array($_POST['id'], $_POST['pseudo'],$_POST['commentaire'], $a ));

/*$bdd->exec('INSERT INTO commentaires (id_commentaire, id_livre, auteur, commentaire, date_commentaire) VALUES(3,"'.$_POST['id'].'", "'.$_POST['pseudo'].'","'.$_POST['commentaire'].'", "'.$a.'")');*/

header('Location: livre.php');


?>


