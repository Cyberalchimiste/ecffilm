<?php

$usersDao = new UserDAO();
$user = "";
$newUser = "";
$message = "";


// Controller du formulaire : "Se Connecter"

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $login_email = trim($_POST['login_email']);
    $login_password = trim($_POST['login_password']);

    // Récupérer l'utilisateur correspondant à l'email fourni depuis la base de données
    $user = $usersDao->getOneByEmail($login_email);
    // Récupérer ensuite son mdp
    $bddPass = $user->getPassword();


    if ($user == null) {
        // Si aucun utilisateur correspondant, affiche erreur.
        $message = "Utilisateur incorrect, Veuillez réessayer.";
    } else {
        // Vérifier si le mot de passe entré correspond au mot de passe haché stocké dans la base de données
        if (password_verify($login_password, $bddPass)) {
            // Le mot de passe est correct
            // On peut connecter l'utilisateur ici en créant une session
            $_SESSION['user_id'] = $user->getId();
            header('Location: accueil');
            exit();
        } else {
            // Le mot de passe est incorrect
            $message = "Mot de passe incorrect, veuillez réessayer.";
        }
    }
}




// Controller du formulaire : "Créer un compte"

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {

    // On vérifie que le confirm password est exact
    if ($_POST["password"] === $_POST["confirm_password"]) {
        
        try {
            // on créer un new User à partir des infos du formulaire.
            $newUser = new User(null, $_POST['username'], $_POST['email'], $_POST['password']);
            $status = $usersDao->add($newUser);
            if ($status) {
                $message =  "Compte créer avec succès !";
            } else {
                $message = "Erreur Ajout";
            }
                
            
        } catch (Exeption $e) {
            echo 'Erreur lors de la création du compte : ',  $e->getMessage();
            
        }
    
    }else{
        $message = "Les deux mots de passe ne sont pas similaires, veuillez réessayer.";
    }


}



echo $twig->render('compte.html.twig', [
    'message' => $message,
    'user' => $user
]);
