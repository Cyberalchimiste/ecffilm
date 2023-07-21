<?php

// Instanciation de la classe FilmDAO
$filmDAO = new FilmDAO();

// Récupération de tous les films depuis la base de données
$films = $filmDAO->getAll();
$resultats = $filmDAO->join();


// Regrouper les films par leur identifiant (idFilm) pour éliminer les doublons
$filmsGroupes = array();
foreach ($films as $film) {
    $idFilm = $film->getId();
    if (!array_key_exists($idFilm, $filmsGroupes)) {
        $filmsGroupes[$idFilm] = $film;
    }
}

echo $twig->render('accueil.html.twig', ['films' => $filmsGroupes, 'resultats' => $resultats]);

