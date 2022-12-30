<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>bdsf</title>
    </head>
 
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
?>


<div>
    Ajouter un livre : 
    <form method="post" action="ajout_livre.php">
    Titre : <input type="text" name="titre" id="titre" /><br />
    Auteur : <input type="text" name="auteur" id="auteur" /><br />
    Saga : <input type="text" name="saga" id="saga" /><br />
    Tome : <input type="number" name="tome" id="tome" /><br />
    Genre : <input type="text" name="genre" id="genre" /><br />
    Type : <input type="text" name="type" id="type" /><br />
    Langue : <input type="text" name="langue" id="langue" /><br />
    Dispo : <input type="text" name="dispo" id="dispo" /><br />
    Quatrieme : <input type="text" name="quatrieme" id="quatrieme" /><br />
    <input type="submit" value="Ajouter">
    </form>
</div>


<div>
    Chercher un livre : 
    <form method='post' action='admin.php'>
        <input type="text" placeholder="Cherchez en utilisant des mots clé" id="recherche_livre" name="recherche_livre">
        <input type="submit" value="ici">
    </form>

    <?php
        $mot_cles = preg_split("/[\s,]+/", $_POST['recherche_livre']);
        $taille = count($mot_cles);
        $requete= 'SELECT id_livre,titre FROM livres WHERE lower(CONCAT(titre,auteur,genre,saga)) like lower(?)';
        if ($_POST['recherche_livre']!=NULL)
        {
            $mot_cles[0]='%' . $mot_cles[0] . '%' ;
            for ($i = 1 ; $i < $taille ; $i++ )
        {
            $mot_cles[$i]='%' . $mot_cles[$i] . '%' ;
            $requete=$requete . 'AND lower(CONCAT(titre,auteur,genre,saga)) like lower(?)' ;
        }
        }
        
        $req = $bdd->prepare($requete);
        $req->execute($mot_cles);
        while ($donnees=$req->fetch())
        {
        ?>

            <h4>
                <?php echo htmlspecialchars($donnees['titre']) ?> : <?php echo htmlspecialchars($donnees['id_livre']) ?> 
            </h4>

        <?php
        }

$req->closeCursor();


?>



<div>
    Supprimer un livre : 
    <form action="suppression_livre.php" method="post">
        Rentrez l'ID du livre que vous voulez supprimer :
        <input type="number" id="id_livre_a_supprimer" name="id_livre_a_supprimer">
        <input type="submit" value="Supprimer">
    </form>
</div>


</div>

</html>

