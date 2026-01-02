<?php

session_start(); // 1. On récupère la session en cours
session_unset(); // 2. On vide toutes les variables de session
session_destroy(); // 3. On détruit la session complètement

// 4. On redirige vers la page d'accueil (ou de connexion)

header("Location: ../index.php?success=Vous êtes bien déconnecté.");

exit();

?>