<?php 

$pageTitle = "Connexion";
require_once 'partials/header.php'; 

?>

<div class="auth-container">
    
    <h2 class="auth-title">Se connecter</h2>

    <?php if (isset($_GET['success'])): ?>

        <div class="alert alert-success">

            <?= htmlspecialchars($_GET['success']) ?>

        </div>

    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>

        <div class="alert alert-error">

            <?= htmlspecialchars($_GET['error']) ?>

        </div>

    <?php endif; ?>

    <form action="../controllers/traitement_connexion.php" method="POST">
        
        <div class="form-group">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Ex: votre@email.com">

        </div>

        <div class="form-group">

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required placeholder="Votre mot de passe">

        </div>

        <button type="submit" class="btn-submit">

            SE CONNECTER

        </button>

    </form>

    <div class="auth-footer">

        <p>Pas encore de compte ? <a href="inscription.php" class="auth-link">Créer un compte</a></p>

    </div>
    
</div>

<?php require_once 'partials/footer.php'; ?>