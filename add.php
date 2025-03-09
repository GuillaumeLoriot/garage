<?php
require_once("header.php");
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['model'])) {
        $errors['model'] = 'ce champ ne peut pas être vide';
    }
    if (empty($_POST['brand'])) {
        $errors['brand'] = 'ce champ ne peut pas être vide';
    }
    if (empty($_POST['horsePower'])) {
        $errors['horsePower'] = 'ce champ ne peut pas être vide';
    }
    if (empty($_POST['image'])) {
        $errors['image'] = 'ce champ ne peut pas être vide';
    }
    if (empty($errors)) {
        require_once("connectDB.php");
        $pdo = connectDB();
        $insert_request = $pdo->prepare("INSERT INTO `car` (`id`, `model`, `brand`, `horsePower`, `image`) VALUES (:id, :model, :brand, :horsePower, :image)");
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
?>
<form method="POST" action="add.php">
    <label for="model">Modèle</label>
    <input type="text" name="model" placeholder="EX: Eldorado">
    <?php if (isset($errors['model'])) {
    ?>
        <p class="errors"><?php echo ($errors['model']); ?></p>
    <?php
    }
    ?>
    <label for="brand">Marque</label>
    <input type="text" name="brand" placeholder="EX: Cadillac">
    <?php if (isset($errors['brand'])) {
    ?>
        <p class="errors"><?php echo ($errors['brand']); ?></p>
    <?php
    }
    ?>
    <label for="horsePower">nombre de chevaux</label>
    <input type="number" name="horsePower" placeholder="EX: 210">
    <?php if (isset($errors['horsePower'])) {
    ?>
        <p class="errors"><?php echo ($errors['horsePower']); ?></p>
    <?php
    }
    ?>
    <label for="image">nom du fichier image de la voiture</label>
    <input type="text" name="image" placeholder="EX: Eldorado.jpg">
    <?php if (isset($errors['image'])) {
    ?>
        <p class="errors"><?php echo ($errors['image']); ?></p>
    <?php
    }
    ?>
    <input type="submit" value="valider">
</form>

<?php
require_once("footer.php");
?>