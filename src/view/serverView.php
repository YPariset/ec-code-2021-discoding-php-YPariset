<?php ob_start(); ?>

<h1>Bienvenue sur le server <?= $_GET['server'] ?>!</h1>

<?php $content = ob_get_clean(); ?>
<?php require( __DIR__ . '/base.php'); ?>