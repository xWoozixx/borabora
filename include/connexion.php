<?php

// Création de la connexion à la base de données
$serveur = "localhost";
$nom_de_la_base = "borabora";
$utilisateur = "root";
$mot_de_passe = "";
$cnx = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_de_la_base);

// Test du succès de la tentative de connexion
if (!$cnx) {
  die('Erreur de connexion (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}

// Passage de la connexion en utf8
mysqli_set_charset($cnx, 'utf8');
