<?php

$offresDao = new OffresDAO();

$offre = new Offres($_GET['id'], null, null);

$status = $offresDao->delete($offre);


if ($status) {
    $message =  "Supression effectué !";
} else {
    $message = "Erreur lors de la supression";
}


echo $twig->render('delete_offre.html.twig', [
    'message' => $message,
    'offre' => $offre
]);





