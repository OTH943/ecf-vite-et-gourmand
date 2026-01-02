<!DOCTYPE html>

<html lang="fr">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Vite & Gourmand - Traiteur en ligne</title>

        <link rel="stylesheet" href="../assets/css/style.css">

    </head>

    <body>

   <header class="site-header">

        <div class="header-container">
        
            <div class="header-left">

                <div class="burger-menu" onclick="toggleMenu()">

                    <span></span>
                    <span></span>
                    <span></span>

                </div>

            </div> 

            <div class="header-center">

                <a href="index.php">

                    <img src="../assets/images/logo_vite_et_gourmand.png" alt="Logo" class="logo-img">

                </a>

                <nav class="center-nav" id="mobileNav">

                    <ul>

                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="menus.php">Nos Menus</a></li>
                        <li><a href="contact.php">Contact</a></li>

                    </ul>

                </nav>

            </div>

            <div class="header-right">

                <a href="connexion.php" class="connexion-link">Connexion</a>

                <div class="cart-icon">

                    <img src="../assets/images/icon-panier.png" alt="Panier">

                </div>

            </div>

        </div>

    </header>

    <script>

    function toggleMenu() {

        const nav = document.getElementById('mobileNav');
        nav.classList.toggle('active');

    }

    </script>

<main>