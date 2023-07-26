<?php
$message = "Votre film a bien été ajouté !";
echo $twig->render('creationsucces.html.twig', [
    'message' => $message,
]);