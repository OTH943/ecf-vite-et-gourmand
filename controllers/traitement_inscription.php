<?php

// On démarre la session (utile pour les messages d'erreur/succès plus tard)
session_start();

// On inclut la connexion à la BDD
require_once '../config/database.php';

// Vérification : est-ce que le formulaire a bien été soumis ?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Récupération et nettoyage des données (Faille XSS)
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $adresse = htmlspecialchars(trim($_POST['adresse_postale']));
    $ville = htmlspecialchars(trim($_POST['ville']));
    $pays = htmlspecialchars(trim($_POST['pays']));
}

    // 2. Vérification des champs obligatoires
    if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
        header("Location: ../views/inscription.php?error=Veuillez remplir tous les champs obligatoires.");
        exit();
    }

    try {
        // 3. Vérifier si l'email existe déjà
        $checkEmail = $pdo->prepare("SELECT utilisateur_id FROM utilisateur WHERE email = :email");
        $checkEmail->execute(['email' => $email]);

        if ($checkEmail->rowCount() > 0) {
            header("Location: ../views/inscription.php?error=Cet email est déjà utilisé.");
            exit();
        }

        // 4. Hachage du mot de passe (Sécurité)
        // On ne stocke JAMAIS le mot de passe en clair !
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // 5. Insertion dans la base de données
        // On attribue le role_id = 1 (Client) par défaut
        $sql = "INSERT INTO utilisateur (nom, prenom, email, password, telephone, adresse_postale, ville, pays, role_id) 
                VALUES (:nom, :prenom, :email, :password, :tel, :adresse, :ville, :pays, 1)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':password' => $passwordHash,
            ':tel' => $telephone,
            ':adresse' => $adresse,
            ':ville' => $ville,
            ':pays' => $pays
        ]);

        // Succès ! On redirige vers la connexion
        header("Location: ../views/connexion.php?success=Compte créé avec succès ! Connectez-vous.");
        exit();

   } catch (PDOException $e) {
        // Au lieu d'afficher l'erreur technique brute ($e->getMessage()),
        // on regarde le code de l'erreur pour savoir quoi dire.
        
        $message_erreur = "Une erreur technique est survenue.";

        // Code 23000 = Violation de contrainte (ex: Email déjà pris, ou Rôle manquant)
        if ($e->getCode() == '23000') {
            // Si l'erreur contient "Duplicate entry", c'est l'email
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $message_erreur = "Cet email est déjà utilisé.";
            } 
            // Si c'est un problème de clé étrangère (notre problème actuel)
            elseif (strpos($e->getMessage(), 'foreign key') !== false) {
                $message_erreur = "Erreur de configuration (Rôles manquants). Contactez l'admin.";
            }
        }

        // On renvoie vers le formulaire avec le message "propre"
        header("Location: ../views/inscription.php?error=" . urlencode($message_erreur));
        exit();
    }
?>