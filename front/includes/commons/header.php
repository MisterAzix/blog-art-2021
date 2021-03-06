<?php
require_once __DIR__ . '/../../../CLASS_CRUD/auth.class.php';
$auth = new AUTH();
$isConnected = $auth->is_connected();
$isAdmin = $auth->is_admin();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>L'écopin <?= !empty($page_title) ? "- $page_title" : '' ?></title>
    <meta name="description" content="<?= !empty($page_title) ? $page_description : "Découvert de nombreux articles sur l'écologie !" ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="../../../apple-touch-icon.png"> -->
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="../../../favicon-16x16.png"> -->
    <link rel="manifest" href="/site.webmanifest">
    <!-- <link rel="manifest" href="../../../site.webmanifest"> -->

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://mylene-micoton.herokuapp.com/accueil">
    <meta property="og:title" content="L'écopin - Accueil">
    <meta property="og:description" content="Bienvenue sur L'écopins, Mylène Micoton pour vous servir ! Voici mon un blog traitant tout plein sujet sur l'écologie à Bordeaux.">
    <meta property="og:image" content="/front/assets/images/Capture_d_écran_2021-02-09_à_15.47.20-removebg">
    <!-- <meta property="og:image" content="../../assets/images/Capture_d_écran_2021-02-09_à_15.47.20-removebg"> -->

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://mylene-micoton.herokuapp.com/accueil">
    <meta property="twitter:title" content="L'écopin - Accueil">
    <meta property="twitter:description" content="Bienvenue sur L'écopins, Mylène Micoton pour vous servir ! Voici mon un blog traitant tout plein sujet sur l'écologie à Bordeaux.">
    <meta property="twitter:image" content="/front/assets/images/Capture_d_écran_2021-02-09_à_15.47.20-removebg">
    <!-- <meta property="twitter:image" content="../../assets/images/Capture_d_écran_2021-02-09_à_15.47.20-removebg"> -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="/front/assets/css/main.css">
    <!-- <link rel="stylesheet" href="../../assets/css/main.css"> -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <header>
        <div class="header-container">
            <div class="desktop">
                <a href="/accueil"><img src="/front/assets/images/logo_lecopin.svg" alt="Logo du site avec écrit l'écopins" class="logo"></a>
                <!-- <a href="../pages/home.php"><img src="../../assets/images/logo_lecopin.svg" alt="Logo du site avec écrit l'écopins" class="logo"></a> -->
                <div class="header-right">
                    <div class="header-right-container">
                        <div class="example">
                            <div class="inputSearch" style="display: none;">
                                <input id="fetchval" type="text" placeholder="Search..." name="search">
                                <div class="suggestion" id="suggestion_container" style="display: none;"></div>
                            </div>
                            <button class="searchIcon boutonSearch">
                                <svg class="icon_recherche" width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.0026 18.1601L29.76 28.9175M19.1044 3.65079C23.1789 7.72533 23.1853 14.3251 19.1186 18.3918C15.0519 22.4585 8.45213 22.4521 4.3776 18.3776C0.303063 14.3031 0.296708 7.70329 4.3634 3.6366C8.4301 -0.430098 15.0299 -0.423743 19.1044 3.65079Z" stroke="#1C1F1B" />
                                </svg>
                            </button>
                            <button class="crossIcon boutonSearch" style="display: none;">
                                <svg class="icon_recherche" width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.1299 0.870117L1.00006 19.9999" stroke="#1C1F1B" />
                                    <path d="M20.1299 20L1.00006 0.870173" stroke="#1C1F1B" />
                                </svg>
                            </button>
                        </div>

                        <?php if ($isConnected) : ?>
                            <?php if ($isAdmin) : ?>
                                <div class="button-container">
                                    <a class="button" href="/dashboard">ADMIN</a>
                                    <!-- <a class="button" href="../../../index.php">ADMIN</a> -->
                                </div>
                            <?php endif ?>
                        <?php else : ?>
                            <div class="button-container">
                                <a class="button" href="/inscription">Inscription</a>
                                <!-- <a class="button" href="../pages/register.php">Inscription</a> -->
                                <a class="button button-empty" href="/connexion">Connexion</a>
                                <!-- <a class="button button-empty" href="../pages/login.php">Connexion</a> -->
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="mobile">
                <a href="/connexion"><img src="/front/assets/images/account.svg" alt="Icon de compte" class="icon_account"></a>
                <!-- <a href="../pages/login.php"><img src="../../assets/images/account.svg" alt="Icon de compte" class="icon_account"></a> -->
                <a href="/accueil" class="logoMobile"><img src="/front/assets/images/logo_lecopin.svg" alt="Logo du site avec écrit l'écopins" class="logo"></a>
                <!-- <a href="../pages/home.php" class="logoMobile"><img src="../../assets/images/logo_lecopin.svg" alt="Logo du site avec écrit l'écopins" class="logo"></a> -->
                <div class="example">
                    <div class="inputSearch" class="inputSuggestion" style="display: none;">
                        <input type="text" placeholder="Search..." name="search">
                        <div class="suggestion">
                            <a href="">Ecologique et insolite, c’est possible !</a>
                            <a href="">Bordeaux, écologie et environnement</a>
                            <a href="">Philippe Barre, anticonformiste et créateur d’un écosystème</a>
                        </div>
                    </div>
                    <button class="searchIcon boutonSearch mobileBouton">
                        <svg class="icon_recherche" width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.0026 18.1601L29.76 28.9175M19.1044 3.65079C23.1789 7.72533 23.1853 14.3251 19.1186 18.3918C15.0519 22.4585 8.45213 22.4521 4.3776 18.3776C0.303063 14.3031 0.296708 7.70329 4.3634 3.6366C8.4301 -0.430098 15.0299 -0.423743 19.1044 3.65079Z" stroke="#1C1F1B" />
                        </svg>
                    </button>
                    <button class="crossIcon boutonSearch mobileBouton" style="display: none;">
                        <svg class="icon_recherche" width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.1299 0.870117L1.00006 19.9999" stroke="#1C1F1B" />
                            <path d="M20.1299 20L1.00006 0.870173" stroke="#1C1F1B" />
                        </svg>
                    </button>
                </div>
            </div>
    </header>
    <?php if (!isset($_COOKIE['accepted'])) require_once __DIR__ . '/cookie.php' ?>
    <main>