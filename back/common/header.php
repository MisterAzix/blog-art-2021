<?php
/////////////////////////////////////////////////////
//
//  Header tous les CRUD (PDO) - Modifié - 25 février 2021
//
//  Script  : header.php
//
/////////////////////////////////////////////////////

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . './../../CLASS_CRUD/auth.class.php';
$auth = new AUTH();

if (!$auth->is_admin()) header('Location: ./accueil');
/* if (!$auth->is_admin()) header('Location: ../../front/includes/pages/home.php'); */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin - Gestion du CRUD <?= !empty($pageTitle) ? $pageTitle : '' ?></title>
    <meta name="description" content="Pannel administrateur permettant la gestion des CRUD">
    <meta name="robots" content="noindex">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/back/css/style.css">
</head>

<body>
    <header>
        <a href="/dashboard.php"><img src="../img/logo_lecopin.svg" alt="Logo permettant de retourner au dashboard"></a>
        <!-- <a href="../../index.php"><img src="../img/logo_lecopin.svg" alt="Logo permettant de retourner au dashboard"></a> -->
    </header>