<?php

//On appelle la fonction getAll()
$usersDao = new UserDAO();
$message = "";
$user = "";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["creerCompte"])) {
        $user = new Users(null, $_POST['email'], $_POST['password']);

        $status = $usersDao->add($user);
        if ($status) {
            $message =  "Compte créer avec succès !";
        } else {
            $message = "Erreur Ajout";
        }
        
    }
} catch (Exeption $e) {
    echo "ERREUR LOOSER !";
    
}

//On affiche le template Twig correspondant
echo $twig->render('creer_compte.html.twig', [
    'message' => $message,
    'user' => $user
]);
