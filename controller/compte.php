<?php

$usersDao = new UserDAO();
$user = "";
$newUser = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {

    $user = $usersDao->getOneByEmailAndPass($_POST['login_email'], $_POST['login_password']);
    if ($user == null) {
        $message = "Utilisateur incorrect, Veuillez réessayer.";
    } else {
        $_SESSION['user_id'] = $user->getId();
        header('Location: accueil');
        exit();  
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {

    if ($_POST["password"] === $_POST["confirm_password"]) {
        try {
            $newUser = new User(null, $_POST['username'], $_POST['email'], $_POST['password']);
            $status = $usersDao->add($newUser);
            if ($status) {
                $message =  "Compte créer avec succès !";
            } else {
                $message = "Erreur Ajout";
            }
                
            
        } catch (Exeption $e) {
            echo "ERREUR LOOSER !";
            
        }
    
    }else{
        $message = "Les deux mots de passe ne sont pas similaires, veuillez réessayer.";
    }


}



echo $twig->render('compte.html.twig', [
    'message' => $message,
    'user' => $user
]);
