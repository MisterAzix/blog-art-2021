<?php
///////////////////////////////////////////////////////////////
//
//  CRUD LANGUE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : createLangue.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'Langue';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
$langue = new LANGUE();

// Init variables form
include __DIR__ . '/initLangue.php';
$error = null;


// Controle des saisies du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['lib1Lang']) && !empty($_POST['lib2Lang']) && !empty($_POST['numPays'])) {
        $lib1Lang = ctrlSaisies($_POST['lib1Lang']);
        $lib2Lang = ctrlSaisies($_POST['lib2Lang']);
        $numPays = $_POST['numPays'];

        if (strlen($lib1Lang) >= 3 && strlen($lib2Lang) >= 3) {
            // Ajout effectif de la langue
            $langue->create($lib1Lang, $lib2Lang, $numPays);

            header('Location: ./langue.php');
        } else {
            $error = 'La longueur minimale d\'une langue ou d\'un libellé est de 3 caractères.';
        }
    } else {
        $error = 'Merci de renseigner tous les champs du formulaire.';
    }
}

$countries = $langue->get_AllPays();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Langue</h1>
        <hr>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Ajout d'une langue</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">

                    <fieldset>
                        <legend class="legend1">Formulaire Langue...</legend>

                        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                        <div class="form-group mb-3">
                            <label for="lib1Lang"><b>Nom de la langue :</b></label>
                            <input class="form-control" type="text" name="lib1Lang" id="lib1Lang" size="80" maxlength="80" value="<?= $lib1Lang ?>" autofocus="autofocus" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="lib2Lang"><b>Libellé de la langue :</b></label>
                            <input class="form-control" type="text" name="lib2Lang" id="lib2Lang" size="80" maxlength="80" value="<?= $lib2Lang ?>" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="numPays"><b>Pays :</b></label>
                            <select name="numPays" class="form-control" id="numPays">
                                <option value="">--Choississez un pays--</option>
                                <?php foreach ($countries as $country) : ?>
                                    <option value="<?= $country->numPays ?>"><?= $country->frPays ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="reset" value="Initialiser" class="btn btn-primary" />
                            <input type="submit" value="Créer" name="submit" class="btn btn-success" />
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <?php require_once __DIR__ . '/footerLangue.php' ?>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>