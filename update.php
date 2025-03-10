<?php
require_once('header.php');

$errors = [];

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    require_once("connectDB.php");
    $pdo = connectDB();
    $selected_car_request = $pdo->prepare("SELECT * FROM car WHERE `id` = :id;");
    $selected_car_request->execute([
        ':id' => $car_id
    ]);
    $car = $selected_car_request->fetch();
    if($car == false){
        header('location:index.php');
    }

?>
    <Div class="card">
        <h2>vous pouvez maintenant modifier cette voiture</h2>
        <img src="images/<?php echo ($car['image']); ?>" alt="">
        <div class="info">
            <h2><?php echo ($car['model']); ?></h2>
            <p><?php echo ($car['brand']); ?></p>
        </div>

    </Div>
<?php
} else {
    header('location:index.php');
}

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
        $pdo = connectDB();
        $update_request = $pdo->prepare("UPDATE car SET `id` = :id,  `model` = :model, `brand` = :brand, `horsePower` = :horsePower, `image` = :image WHERE `id` = :id;");
        $update_request->execute([
            ':id' => $_GET['id'],
            ':model' => $_POST['model'],
            ':brand' => $_POST['brand'],
            ':horsePower' => $_POST['horsePower'],
            ':image' => $_POST['image']
        ]);
        header('location:index.php');
    }
}
require_once('form.php');
require_once('footer.php');

?>