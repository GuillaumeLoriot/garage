<?php
require_once("header.php");
require_once("connectDB.php");

$pdo = connectDB();
$requete = $pdo->query("SELECT * FROM car;");
$cars = $requete->fetchAll();
?>
<h1>LE GARAGE DU CRUD</h1>

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
        </Div>

    <?php
    }
    ?>
</section>
<?php
require_once("footer.php");
?>