<?php

try {
    
    // 1. On se connecte à MySQL

    $host = '127.0.0.1';
    $port = '3308';
    $db_name = 'vite_et_gourmand';
    $username = 'root'; // Par défaut sur XAMPP/WAMP
    $password = '';     // Par défaut vide sur XAMPP/WAMP

    // On crée l'objet PDO 

    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db_name;charset=utf8", $username, $password);

    // 2. On active les erreurs pour voir les problèmes

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    
    // En cas d'erreur, on arrête tout et on affiche le message

    die("Erreur de connexion : " . $e->getMessage());
}

?>