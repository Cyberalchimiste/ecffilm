<?php
$message = "Vous avez bien été déconnecté !";
echo $twig->render('deconnecte.html.twig', [
    'message' => $message,
]);