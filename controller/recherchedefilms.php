<?php
// Instanciation de la classe FilmDAO
$filmDAO = new FilmDAO();

$titre = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $titre = $_POST['recherche'];
}

// Récupération de tous les films depuis la base de données
$films = $filmDAO->getAll($titre);

echo $twig->render('recherchedefilms.html.twig', ['films' => $films]);
