<?php
// 1. On démarre la session (OBLIGATOIRE pour mémoriser l'utilisateur connecté)
session_start();

require_once '../config/database.php';

// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Nettoyage des données
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: ../views/connexion.php?error=Veuillez remplir tous les champs.");
        exit();
    }

    try {
        // 2. On cherche l'utilisateur par son email
        $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // 3. Vérification du mot de passe
        // On vérifie SI l'utilisateur existe ET SI le mot de passe correspond au hash
        if ($user && password_verify($password, $user['password'])) {

            // On génère un nouvel ID de session pour éviter le vol de session
            session_regenerate_id(true);
            
            // ✅ SUCCÈS : On enregistre les infos dans la SESSION
            $_SESSION['utilisateur'] = [
                'id' => $user['utilisateur_id'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'email' => $user['email'],
                'role' => $user['role_id'] // Très important pour la suite (Admin/Employé)
            ];

            // Redirection vers l'accueil (ou dashboard)
            header("Location: ../index.php?success=Bienvenue " . $user['prenom'] . " !");
            exit();

        } else {
            // ❌ ÉCHEC : Mot de passe ou email incorrect
            // Sécurité : On ne dit pas si c'est l'email ou le mdp qui est faux
            header("Location: ../views/connexion.php?error=Identifiants incorrects.");
            exit();
        }

    } catch (PDOException $e) {
        header("Location: ../views/connexion.php?error=Erreur technique.");
        exit();
    }
} else {
    header("Location: ../views/connexion.php");
    exit();
}
?>