<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="stylesheet.css">
        <title>Bibliotheque-BDSF</title>
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


$req = $bdd->query('SELECT id_livre, titre, auteur, saga, tome, genre, type, langue, dispo, quatrieme  FROM livres WHERE id_livre=25');
while ($donnees = $req->fetch())
{
    $id=$donnees['id_livre'];
    
?>
    

    <h4>
        <?php echo htmlspecialchars($donnees['titre']); ?>
    </h4>

    <h4>
        de <?php echo htmlspecialchars($donnees['auteur']); ?>
    </h4>

    <h3>
    <?php
    if ($donnees['saga']!=null)
    {
        echo htmlspecialchars($donnees['saga']) . ' ' . htmlspecialchars($donnees['tome']);
    }
    ?>
    </h3>

    <h3>
        Genre : <?php echo htmlspecialchars($donnees['genre']); ?>
    </h3>

    <h3>
        Type <?php echo htmlspecialchars($donnees['type']); ?>
    </h3>

    <h3>
        Langue : <?php echo htmlspecialchars($donnees['langue']); ?>
    </h3>

    <h2>
        Quatrième : <?php echo $donnees['quatrieme']; ?>
    </h2>    
    

<?php
} // Fin de la boucle des livres
$req->closeCursor();
$requete = $bdd->query('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, "%d/%m/%Y à %Hh%imin%ss") AS date_commentaire_fr FROM commentaires WHERE id_livre = 25 ORDER BY date_commentaire');
$donnees = $requete->fetch();
?>
<p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
<p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
<?php
// Fin de la boucle des commentaires
$requete->closeCursor();
?>


<form action="ajout_commentaire.php" method="post">
    <p>
    <?php
        echo '<input type="hidden" name="id" id="id" value="'.$id.'"';
    ?>
    <input type="hidden" name="id" id="id" value="25" />

        <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" />
        <label for="commentaire">Commentaire </label> :  <input type="text" name="commentaire" id="commentaire" />
        <input type="submit" value="Envoyer" />
    </p>
</form>


</body>
</html>