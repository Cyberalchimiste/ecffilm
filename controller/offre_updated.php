<?php
$message = "Votre offre a bien été modifié !";
echo $twig->render('offre_updated.html.twig', [
    'message' => $message,
]);