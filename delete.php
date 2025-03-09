<?php
require_once("header.php");


if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    require_once("connectDB.php");
    $pdo = connectDB();
    $selected_car_request = $pdo->prepare("SELECT * FROM car WHERE `id` = :id;");
    $selected_car_request->execute([
        ':id' => $car_id
    ]);
    $car = $selected_car_request->fetch();

?>
    <Div class="card">
        <h2>confirmez-vous la supression de cette voiture?</h2>
        <img src="images/<?php echo ($car['image']); ?>" alt="">
        <div class="info">
            <h2><?php echo ($car['model']); ?></h2>
            <p><?php echo ($car['brand']); ?></p>
        </div>
        <form method="POST" action="delete.php?id=<?php echo ($car_id); ?>">
            <input type="submit" value="Confirmer" class="delete">
            <button formaction="index.php" class="cancel">retour à l'accueil</button>
        </form>
    </Div>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $delete_request = $pdo->prepare("DELETE FROM car WHERE `id` = :id");
        $delete_request->execute([
            ':id' => $car_id
        ]);
        header('location:index.php');
    }
}
require_once("footer.php");
?>