<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>bdsf</title>
    </head>
 
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


?>



<form method='post' action='recherche.php'>
    <input type="text" placeholder="Cherchez en utilisant des mots clé" id="recherche" name="recherche">
    <input type="submit" value="ici">
</form>


<?php
$mot_cles = preg_split("/[\s,]+/", $_POST['recherche']);
$taille = count($mot_cles);
$requete= 'SELECT id_livre,titre FROM livres WHERE lower(CONCAT(titre,auteur,genre,saga)) like lower(?)';
$mot_cles[0]='%' . $mot_cles[0] . '%' ;
for ($i = 1 ; $i < $taille ; $i++ )
{
    $requete=$requete . 'AND lower(CONCAT(titre,auteur,genre,saga)) like lower(?)' ;
    $mot_cles[$i]='%' . $mot_cles[$i] . '%' ;
}

$req = $bdd->prepare($requete);
$req->execute($mot_cles);



while ($donnees=$req->fetch())
{
?>

    <h4>
        <?php echo htmlspecialchars($donnees['titre']); ?>
    </h4>

<?php
}

$req->closeCursor();







?>
</html>