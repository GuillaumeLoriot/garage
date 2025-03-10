
<form method="POST" action="add.php">
<div class="champForm">
    <label for="model">Modèle</label>
    <input type="text" name="model" placeholder="EX: Eldorado">
    <?php if (isset($errors['model'])) {
    ?>
        <p class="errors"><?php echo ($errors['model']); ?></p>
    <?php
    }
    ?>
</div>
<div class="champForm">
    <label for="brand">Marque</label>
    <input type="text" name="brand" placeholder="EX: Cadillac">
    <?php if (isset($errors['brand'])) {
    ?>
        <p class="errors"><?php echo ($errors['brand']); ?></p>
    <?php
    }
    ?>
</div>
<div class="champForm">
<label for="horsePower">nombre de chevaux</label>
<input type="number" name="horsePower" placeholder="EX: 210">
<?php if (isset($errors['horsePower'])) {
?>
    <p class="errors"><?php echo ($errors['horsePower']); ?></p>
<?php
}
?>
</div>
<div class="champForm">
<label for="image">nom du fichier image de la voiture</label>
<input type="text" name="image" placeholder="EX: Eldorado.jpg">
<?php if (isset($errors['image'])) {
?>
    <p class="errors"><?php echo ($errors['image']); ?></p>
<?php
}
?>
</div>
<input type="submit" value="valider" class="confirm">
</form>

