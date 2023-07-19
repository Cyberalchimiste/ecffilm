<?php
// var_dump($_SESSION['user_id']);
//On appelle la fonction getAll()
$offresDao = new OffresDAO();

$offers = $offresDao->getAll();

//On affiche le template Twig correspondant
echo $twig->render('offres.html.twig', [
    'offers' => $offers
]);
