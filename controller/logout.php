<?php
session_start();


// Supprimez toutes les variables de session
session_unset();

// Détruisez la session
session_destroy();

// Redirigez l'utilisateur vers une page de connexion ou une autre page appropriée
header('Location: deconnecte');
exit();

