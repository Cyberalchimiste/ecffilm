<?php

// Instanciation de la classe FilmDAO
$filmDAO = new FilmDAO();

// Récupération de tous les films depuis la base de données
$films = $filmDAO->getAll();

// Plus besoin de regrouper les films par leur identifiant (idFilm) pour éliminer les doublons car c'est déjà fait dans la requête SQL
echo $twig->render('accueil.html.twig', ['films' => $films]);




