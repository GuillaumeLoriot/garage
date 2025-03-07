<?php
require_once ('header.php');
require_once ('connectDB.php');

$pdo = connectDB();

$requete = $pdo->query("SELECT * FROM car;");
$cars = $requete->fetchAll();
foreach($cars as $car){
    ?>
<p><?php echo($car['id'] . $car['model'] . $car['brand'] . $car['horsePower']);?></p>
<img src="images/<?php echo($car['image']);?>" alt="">
<?php
}



require_once ('footer.php');
?>