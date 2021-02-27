<?php
//========================================//
//
//               plan.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Plan du site';
$page_description = '';

// Insertion classe ARTICLE
require_once __DIR__ . '/../../../CLASS_CRUD/article.class.php';
$article = new ARTICLE();

// Appel méthode : tous les angles en BDD
$allArticles = $article->get_AllArticles();

require_once __DIR__ . '/../commons/header.php';
?>

<!-- WRITE HTML CODE BELOW -->
<div class="plan_container layout">
    <div class="title">
        <p><span></span>Plan du Site</p>
    </div>
    <div class="sections">
        <div class="section_container">
            <div class="section">
                <h2>Acces rapide</h2>
                <a href="/accueil">Page d'accueil</a>
                <a href="/inscription">Inscription</a>
                <a href="/connexion">Connexion</a>
                <a href="/contact">Me contacter</a>
                <a href="/cgu">Mentions légale</a>
            </div>
        </div>
        <div class="path">
            <svg width="4" height="102" viewBox="0 0 4 102" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 0L2 102" stroke="#BFF088" stroke-width="4" />
            </svg>
        </div>

        <div class="section_container">
            <div class="section">
                <h2>tous mes articles</h2>
                <?php foreach ($allArticles as $article) : ?>
                    <a href="./article/<?= $article->numArt ?>"><?= $article->libTitrArt ?></a>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>


<?php require_once __DIR__ . '/../commons/footer.php' ?>