-- ######################################
-- CREATION base de données de l'association BDSF
-- REMPLISSAGE de la base de donnée
-- ######################################

DROP TABLE IF EXISTS livre;
DROP TABLE IF EXISTS auteur;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS emprunt;
DROP TABLE IF EXISTS lecture;
DROP TABLE IF EXISTS membres_bdsf;
DROP TABLE IF EXISTS suggestion;
DROP TABLE IF EXISTS reservation;
DROP TABLE IF EXISTS type_livre;
DROP TABLE IF EXISTS genre_litt;
DROP TABLE IF EXISTS ecrire;

CREATE TABLE livre(
    id_livre SERIAL CONSTRAINT cle_prim_livre PRIMARY KEY, 
    --SERIAL n'existe pas sur sqlite
    titre VARCHAR(50) NOT NULL,
    auteur INTEGER CONSTRAINT cle_etr_auteur_livre REFERENCES auteur(id_auteur) ON DELETE CASCADE, 
    saga VARCHAR(50),
    tome INTEGER,
    genre TEXT,
    quatrieme TEXT, --resume de la 4eme de couverture ou d'un membre de BDSF
    date_publication DATE,
    langue VARCHAR(30),
    nb_emprunt INTEGER CONSTRAINT nb_emprunt_livre CHECK(nb_emprunt >= 0) NOT NULL,
    dispo BOOLEAN NOT NULL
);

CREATE TABLE auteur(  --~OK
    id_auteur SERIAL CONSTRAINT cle_prim_auteur PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    naissance DATE,
    mort DATE
);

CREATE TABLE utilisateur (
    identifiant VARCHAR(50) CONSTRAINT cle_prim_util PRIMARY KEY,
    mot_de_passe VARCHAR(30) NOT NULL UNIQUE,
    prenom VARCHAR(30) NOT NULL,
    nom VARCHAR(30) NOT NULL,
    surnom VARCHAR(50),
    date_inscription DATE NOT NULL,
    nb_reservation INTEGER CONSTRAINT limite_reservation CHECK (nb_reservation >= 0 && nb_reservation <= 3)
);

CREATE TABLE membres_bdsf (
    identifiant VARCHAR(50) CONSTRAINT cle_etr_membre REFERENCES utilisateur(identifiant) ON DELETE CASCADE,
    role_bureau VARCHAR(50) CONSTRAINT role_bureau IN {'president', 'vice-president', 'secretaire general', 'tresorier'},
    membre_bdsf IN utilisateur,
    PRIMARY KEY(identifiant)
);

CREATE TABLE genre_livre (
    id_livre INTEGER CONSTRAINT cle_etr_genre_livre REFERENCES livre(id_livre) ON DELETE CASCADE,
    genre VARCHAR CONSTRAINT cle_etr_genre REFERENCES genre_litt(genre) ON DELETE CASCADE,
    PRIMARY KEY (id_livre, genre)
);

CREATE TABLE genre_litt (
    genre VARCHAR(50) CONSTRAINT cle_prim_genre PRIMARY KEY
);

CREATE TABLE type_litt (
    type_ VARCHAR(50) CONSTRAINT cle_prim_type PRIMARY KEY
);

CREATE TABLE type_livre (
    id_livre INTEGER CONSTRAINT cle_etr_type_livre REFERENCES livre(id_livre) ON DELETE CASCADE,
    type_ VARCHAR(50) CONSTRAINT cle_etr_type REFERENCES type_litt(type_) ON DELETE CASCADE,
    PRIMARY KEY (id_livre,type_),
    livre IN type_livre
)

CREATE TABLE suggestion (
    id_sugg SERIAL CONSTRAINT cle_prim_sugg PRIMARY KEY,
    proposeur VARCHAR(50) cle_etr_sugg_util REFERENCES utilisateur ON DELETE CASCADE, 
    titre VARCHAR(50) NOT NULL,
    auteur VARCHAR(50) NOT NULL,
    tome INTEGER CONSTRAINT CHECK (tome >= 0),
    suggestion IN utilisateur
)

CREATE TABLE reservation (
    id_utilisateur VARCHAR(50) CONSTRAINT cle_etr_res_util REFERENCES utilisateur(identifiant) ON DELETE CASCADE,
    id_livre INTEGER CONSTRAINT cle_etr_res_livre REFERENCES livre(id_livre) ON DELETE CASCADE,
    date_reservation DATE NOT NULL,
    PRIMARY KEY(id_utilisateur, id_livre)
)

CREATE TABLE emprunt (
    id_emprunt INTEGER CONSTRAINT cle_prim_emprunt PRIMARY KEY,
    emprunteur VARCHAR(50) CONSTRAINT cle_etr_emp_util REFERENCES utilisateur(identifiant) ON DELETE CASCADE,
    emprunté INTEGER CONSTRAINT cle_etr_emp_livre REFERENCES livre(id_livre) ON DELETE CASCADE,
    date_emprunt DATE NOT NULL,
    date_retour DATE
);

CREATE TABLE commentaire (
    id_livre INTEGER CONSTRAINT cle_etr_lect_livre REFERENCES livre(id_livre) ON DELETE CASCADE,
    id_utilisateur VARCHAR(50) CONSTRAINT cle_etr_lect_util REFERENCES utilisateur(identifiant) ON DELETE CASCADE,
    commentaire VARCHAR,
    date_commentaire DATE,
    note float,
    PRIMARY KEY (id_livre, id_utilisateur)
)

CREATE TABLE ecrire (
    auteur INTEGER CONSTRAINT cle_etr_ecrire_auteur REFERENCES auteur(id_auteur) ON DELETE CASCADE,
    livre INTEGER CONSTRAINT cle_etr_ecrire_livre REFERENCES livre(id_livre) ON DELETE CASCADE,
    livre IN ecrire
)