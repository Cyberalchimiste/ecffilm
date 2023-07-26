<?php
// Instanciation de la classe FilmDAO
$filmDAO = new FilmDAO();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $titre = $_POST["titre"];
    $annee = $_POST["annee"];
    $affiche = $_POST["affiche"];
    $realisateur = $_POST["real"];
    
    // Créer un tableau pour stocker les rôles
    $roles = array();
    
    // Récupérer les informations sur les rôles (personnage, nom, prénom)
    if (isset($_POST["personnage"], $_POST["nom"], $_POST["prenom"])) {
        $personnages = $_POST["personnage"];
        $noms = $_POST["nom"];
        $prenoms = $_POST["prenom"];
        
        // Assurez-vous que les tableaux ont la même taille
        if (count($personnages) > 0 && count($personnages) === count($noms) && count($noms) === count($prenoms)) {
            
            
            for ($i = 0; $i < 3; $i++) {
                // Vérifier si les champs ne sont pas vides avant d'ajouter le rôle
                if (!empty($personnages[$i]) && !empty($noms[$i]) && !empty($prenoms[$i])) {
                    $acteur = new Acteur(null, $noms[$i], $prenoms[$i]);
                    $role = new Role(null, $personnages[$i], $acteur);
                    $roles[] = $role;
                }
                
            }
        } else {
            // Gérer l'erreur si les tableaux n'ont pas la même taille ou si aucun rôle n'a été saisi
            echo "Erreur : Vous devez saisir au moins un rôle et au maximum 3 rôles.";
            exit;
        }
    }

    // Créer un nouvel objet Film avec les données du formulaire
    $film = new Film(null, $titre, $realisateur, $affiche, $annee, $roles);

    // Instanciation de la classe FilmDAO
    $filmDAO = new FilmDAO();

    // Ajouter le film à la base de données en utilisant la méthode add($film)
    $newFilm = $filmDAO->add($film);

    // Vérifier si l'ajout a réussi
    if ($newFilm !== null) {
        // Rediriger l'utilisateur vers une page de confirmation ou une autre page appropriée
        header("Location: creationsucces");
        exit;
    } else {
        // Gérer l'erreur si l'ajout n'a pas réussi
        echo "Erreur : Le film n'a pas pu être ajouté.";
    }
}

// Affichage du formulaire
echo $twig->render('creation.html.twig');
?>