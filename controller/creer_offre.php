<?php

$offresDao = new OffresDAO();
$message = "";
$offre = "";


try {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["creerOffre"])) {
        $offre = new Offres(null, $_POST['titre'], $_POST['desc']);

        $status = $offresDao->add($offre);
        if ($status) {
            $message =  "Ajout OK !";
        } else {
            $message = "Erreur Ajout.";
        }
        
    }
} catch (Exeption $e) {
    echo "ERREUR LOOSER !";
    
}





echo $twig->render('creer_offre.html.twig', [
    'message' => $message,
    'offre' => $offre
]);
