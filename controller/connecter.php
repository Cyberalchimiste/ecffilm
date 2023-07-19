<?php

$usersDao = new UserDAO();
$message = "";
$user = "";



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["connecter"])) {

    $user = $usersDao->getOneByEmailAndPass($_POST['email'], $_POST['password']);
    if ($user == null) {
        $message = "Utilisateur incorrect, Veuillez réessayer.";
    } else {
        $_SESSION['user_id'] = $user->getId();
        $message = "Utilisateur correct !";
        header('Location: offres');
        exit();
        
    }

    
}


echo $twig->render('connecter.html.twig', [
    'message' => $message,
    'user' => $user
]);
