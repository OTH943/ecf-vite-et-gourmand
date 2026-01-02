<?php

// 1. SÉCURITÉ : On démarre la session

session_start();

// 2. LE VIDEUR : Si l'utilisateur n'est pas connecté, on l'éjecte vers la connexion

if (!isset($_SESSION['utilisateur'])) {

    header("Location: connexion.php?error=Veuillez vous connecter pour accéder à votre profil.");
    exit();

}

$pageTitle = "Mon Profil";

require_once 'partials/header.php';

?>

<div class="profile-card">
    
    <h1>Mon Espace Personnel</h1>
    
    <div class="profile-info">

        <p>Bonjour, <strong><?= htmlspecialchars($_SESSION['utilisateur']['prenom']) ?></strong> ! 👋</p>
        
        <p>Voici vos informations personnelles :</p>
        
        <ul style="list-style: none; padding: 0;">

            <li><strong>Nom :</strong> <?= htmlspecialchars($_SESSION['utilisateur']['nom']) ?></li>
            <li><strong>Prénom :</strong> <?= htmlspecialchars($_SESSION['utilisateur']['prenom']) ?></li>
            <li><strong>Email :</strong> <?= htmlspecialchars($_SESSION['utilisateur']['email']) ?></li>
            
            <li><strong>Statut :</strong> 

                <?php 

                    if($_SESSION['utilisateur']['role'] == 1) echo "Client";
                    elseif($_SESSION['utilisateur']['role'] == 2) echo "Employé";
                    elseif($_SESSION['utilisateur']['role'] == 3) echo "Administrateur";

                ?>

            </li>

        </ul>

    </div>

    <a href="../controllers/deconnexion.php" class="btn-logout">

        Se déconnecter
        
    </a>

</div>

<?php require_once 'partials/footer.php'; ?>