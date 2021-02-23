<?php
//========================================//
//
//            login/index.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Login';
$page_description = '';
$error = null;

// Insertion classe
require_once __DIR__ . '/../../../../CLASS_CRUD/membre.class.php';
require_once __DIR__ . '/../../../../CLASS_CRUD/auth.class.php';
$membre = new MEMBRE();
$auth = new AUTH();

if ($auth->is_connected()) {
    header('Location: ../index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $login = $auth->login($_POST['email'], $_POST['password']);
        if ($login) {
            header('Location: ../');
        } else {
            $error = 'Error : Invalid password or email!';
        }
        unset($_POST['email'], $_POST['password']);
    }
}

require_once '../../commons/header.php';
?>

<div class='sign_container layout'>
    <div class='illustration'>
        <img src="../../../assets/images/Capture_d_écran_2021-02-09_à_15.47.20-removebg.png" alt="loginImage">
    </div>
    <div class='login'>
        <?php if ($error) : ?>
            <span id="error" ><?= $error ?></span>
        <?php endif ?>
        
        <h2>Connexion</h2>
        <div class="input_container">
            <form action="" method="POST">
                <div class="group">
                    <input class="input" name="email" type="mail" placeholder="Renseigne ton email" required />
                    <label>Email</label>
                </div>
                <div class="group">
                    <input class="input" name="password" type="password" placeholder="Renseigne ton mot de passe" required />
                    <label>Mot de passe</label>
                </div>
            </form>
        </div>
        <a href="">Mot de passe oublié ?</a>

        <?php
        $buttonTitle = 'Se connecter';
        $buttonClass = 'login_button';
        require '../../components/button.php';
        ?>
        <p>Pas de compte ? <a href="../../pages/register/index.php">Inscris-toi ! </a> </p>
    </div>
</div>

<?php require_once '../../commons/footer.php' ?>