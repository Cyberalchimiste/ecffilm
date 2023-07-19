<?php

$offresDao = new OffresDAO();
$message = "";

$idOffre = $_GET['id'];
$offre = $offresDao->getOne($idOffre);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier"])) {
    $offres = new Offres($_POST['id'], $_POST['titre'], $_POST['description']);
    $status = $offresDao->update($offres);

    header("Location: offre_updated");
    exit();

}



echo $twig->render('modif.html.twig', [
    'message' => $message,
    'offre' => $offre
]);