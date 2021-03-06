<?php
///////////////////////////////////////////////////////////////
//
//  CRUD LIKEART (PDO) - Code Modifié - 12 Février 2021
//
//  Script  : createLikeArt.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'LikeArt';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/likeart.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
$likeart = new LIKEART();
$membre = new MEMBRE();
$article = new ARTICLE();

// Init variables form
include __DIR__ . '/initLikeArt.php';
$error = null;


// Controle des saisies du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['numMemb']) && !empty($_POST['numArt'])) {
        $numMemb = $_POST['numMemb'];
        $numArt = $_POST['numArt'];

        $likeart->createOrUpdate($numMemb, $numArt);
        header('Location: ./likeArt.php');
    } else {
        $error = 'Merci de renseigner tous les champs du formulaire.';
    }
}

$allMembers = $membre->get_AllMembres();
$allArticles = $article->get_AllArticles();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD LikeArt</h1>
        <hr>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Ajout d'un like sur un article</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="numMemb" value="<?= isset($_GET['numMemb']) ?: '' ?>" />
                    <input type="hidden" name="numArt" value="<?= isset($_GET['numArt']) ?: '' ?>" />

                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="numMemb"><b>Membre :</b></label>
                            <select name="numMemb" class="form-control" id="numMemb">
                                <option value="">--Choississez un membre--</option>
                                <?php foreach ($allMembers as $member) : ?>
                                    <option value="<?= $member->numMemb ?>"><?= $member->pseudoMemb ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group mb-3 col-6">
                            <label for="numArt"><b>Article :</b></label>
                            <select name="numArt" class="form-control" id="numArt">
                                <option value="">--Choississez un article--</option>
                                <?php foreach ($allArticles as $article) : ?>
                                    <option value="<?= $article->numArt ?>"><?= $article->libTitrArt ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <input type="reset" value="Initialiser" class="btn btn-primary" />
                        <input type="submit" value="Créer" name="submit" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>

        <?php require_once __DIR__ . '/footerLikeArt.php' ?>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>