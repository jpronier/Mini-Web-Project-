<!DOCTYPE hmtl>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Bibliotheque-BDSF</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>

    <body>
        <h1 class="navbar">
            <li class="BDSF">BDSF</li>
            <li><a href="authentification.php">Connexion</a></li>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="ajout_suggestion.php">Suggérer un nouveau livre</a></li>
            <input class="searchBar" type="text" placeholder="Rechercher..">
        </h1>
        
        <h1 class="header_result">Résultats de votre recherche :</h1>
        
        <div class="list_result">
            <div class="livre_result">
                <div>
                    <img class= "couv_result" src="shipofmagic.jpeg" alt="couverture"/>
                </div>
                <div class="info_result">
                    <div class="titre_result">Ship of Magic</div>
                    <div class="auteur_result">Robin Hobb</div>
                    <div class="saga_result">The Liveship Traders, Tome 1</div>
                </div>
            </div>
            <div class="button_box">
                <input class="button_consult" type="button" value="Consulter"/>
            </div> 
        </div>
    </body>
</html>
