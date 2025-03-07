<?php
require_once('header.php');
require_once('connectDB.php');

$pdo = connectDB();

$requete = $pdo->query("SELECT * FROM car;");
$cars = $requete->fetchAll();
?>
<a href="add.php" class="add">Ajouter un véhicule</a>
<section>
<?php
foreach ($cars as $car) {
?>

    <Div class="card">
        <img src="images/<?php echo ($car['image']); ?>" alt="">
        <div class="info">
            <h2><?php echo ($car['model']); ?></h2>
            <p><?php echo ($car['brand'] . ",  " . $car['horsePower'] . " chevaux"); ?></p>
        </div>
        <div class="card_buttons">
            <a href="update.php?=<?php echo($car["id"]); ?>" class="update">Modifier</a>
            <a href="delete.php?=<?php echo($car["id"]); ?>" class="delete">Supprimer</a>
        </div>
    </Div>

<?php
}
?>
</section>
<?php
require_once('footer.php');
?>