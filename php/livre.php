<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Bibliotheque-BDSF</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    
    <body>
        
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
        
        <div class ="page_livre">
            <p class="couv_livre">
                <img scr="image.jpeg" alt="Couverture"/>
            </p>
            <div class="info_livre">
                
                <h1 class="titre_livre"><br><?php echo htmlspecialchars($donnees['titre']); ?></h1>
                <h2 class="auteur_livre"><?php echo htmlspecialchars($donnees['auteur']); ?></h2>
                <h3 class="saga_tome">
                <?php
                if ($donnees['saga']!=null)
                {
                    echo htmlspecialchars($donnees['saga']) . ' ' . htmlspecialchars($donnees['tome']);
                }
                ?>
                </h3>

                <table class="tab_livre">
                    <tbody>
                        <tr>
                            <th scope="row">Genre</th>
                            <td><?php echo htmlspecialchars($donnees['genre']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Type de livre</th>
                            <td><?php echo htmlspecialchars($donnees['type']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Langue</th>
                            <td><?php echo htmlspecialchars($donnees['langue']); ?></td>
                        </tr>
                    </tbody>
                </table>
        
                <div class="quatrieme">
                    <?php echo htmlspecialchars($donnees['quatrieme']); ?>  
                </div>
            </div>

            <?php
        } // Fin de la boucle des livres
                $req->closeCursor();
                $requete = $bdd->query('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, "%d/%m/%Y à %Hh%imin%ss") AS date_commentaire_fr FROM commentaires WHERE id_livre = 25 ORDER BY date_commentaire');
                $donnees = $requete->fetch();
            ?>
            <div>
                <div class="commentaire">
                    <p class="commentor"><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong></p>
                    <p class="comment_date"><?php echo $donnees['date_commentaire_fr']; ?></p>
                    <p class="comment_content"><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
                </div>

                <form action="ajout_commentaire.php" method="post">
                    <p class="nouveau_comment">
                    <?php
                        echo '<input type="hidden" name="id" id="id" value="'.$id.'"';
                    ?>
                    <input type="hidden" name="id" id="id" value="25" />

                        <label class="label_comment" for="commentaire">Commentaire </label>
                        <textarea class="input_comment" type="text" name="commentaire" id="commentaire" col="200"></textarea>  

                        <input class="button_comment" type="submit" value="Envoyer" />
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>
