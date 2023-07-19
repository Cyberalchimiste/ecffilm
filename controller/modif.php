<?php

$offresDao = new OffresDAO();
$message = "";

$offre = $offresDao->getOne($_GET['id']);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier"])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $status = $offresDao->update($id, $titre, $description);

    if ($status) {
        $message =  "Supression effectué !";
    } else {
        $message = "Erreur lors de la supression";
    }

    

    header("Location: offre_updated");
    exit();

}



echo $twig->render('modif.html.twig', [
    'message' => $message,
    'offre' => $offre
]);