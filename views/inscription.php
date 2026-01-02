<?php 

$pageTitle = "Inscription"; 

require_once __DIR__ . '/partials/header.php'; 

?>

<div class="registration-container">

    <?php if (isset($_GET['error'])): ?>

        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #f5c6cb;">

            ⚠️ Erreur : <?= htmlspecialchars($_GET['error']) ?>

        </div>
        
    <?php endif; ?>

    <h1>Créer un compte</h1>

    <form action="../controllers/traitement_inscription.php" method="POST">
        
        <div class="form-group">

            <label for="nom">Nom *</label>
            <input type="text" id="nom" name="nom" required>

        </div>

        <div class="form-group">

            <label for="prenom">Prénom *</label>
            <input type="text" id="prenom" name="prenom" required>

        </div>

        <div class="form-group">

            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required>

        </div>

        <div class="form-group">

            <label for="password">Mot de passe *</label>
            <input type="password" id="password" name="password" required>

        </div>

        <div class="form-group">

            <label for="telephone">Téléphone *</label>
            <input type="tel" id="telephone" name="telephone">

        </div>

        <div class="form-group">

            <label for="adresse">Adresse *</label>
            <input type="text" id="adresse" name="adresse">

        </div>

        <div class="two-cols">

            <div class="form-group">

                <label for="ville">Ville *</label>
                <input type="text" id="ville" name="ville">

            </div>

            <div class="form-group">

                <label for="pays">Pays *</label>
                <input type="text" id="pays" name="pays">

            </div>

        </div>

        <button type="submit" class="btn-submit">S'inscrire</button>

    </form>

</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>