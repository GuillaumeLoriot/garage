<?php
require_once("header.php");
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['model'])) {
        $errors['model'] = 'le champ modèle ne peut pas être vide';
    }
    if (empty($_POST['brand'])) {
        $errors['brand'] = 'le champ marque ne peut pas être vide';
    }
    if (empty($_POST['horsePower'])) {
        $errors['horsePower'] = 'le champ nombre de chevaux ne peut pas être vide';
    }
    if (empty($_POST['image'])) {
        $errors['image'] = 'le champ nom du fichier image de la voiture ne peut pas être vide';
    }
    if (empty($errors)) {
        require_once("connectDB.php");
        $pdo = connectDB();
        $insert_request = $pdo->prepare("INSERT INTO `car` (`id`, `model`, `brand`, `horsePower`, `image`) VALUES (:id, :model, :brand, :horsePower, :image);");
        $insert_request->execute([
            ':id' => 'NULL',
            ':model' => $_POST['model'],
            ':brand' => $_POST['brand'],
            ':horsePower' => $_POST['horsePower'],
            ':image' => $_POST['image']
        ]);
        header('location:index.php');
    }
}

require_once('form.php');
require_once("footer.php");
?>