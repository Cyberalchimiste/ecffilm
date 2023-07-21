<?php

// Instanciation de la classe FilmDAO
$filmDAO = new FilmDAO();

// Récupération de tous les films depuis la base de données
$films = $filmDAO->getAll();
$resultats = $filmDAO->join();
echo $twig->render('accueil.html.twig', ['films' => $films, 'resultats' => $resultats]);




