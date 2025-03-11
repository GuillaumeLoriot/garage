<?php
require_once('header.php');
require_once('functions.php');
// je ne vérifie pas si le formulaire est validé avec $_SERVER['REQUEST_METHOD'] === 'POST' a cet endroi du code car je veux afficher 
// une card avec les infos et l'image de la voiture selectionnée avant de valider le formulaire

// verification de l'existance de l'id en parametre GET et de l'existance de l'id en BDD si pas de GET ou d'équivalence BDD = redirection à index
if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    require_once("connectDB.php");
    $pdo = connectDB();
    $selected_car_request = $pdo->prepare("SELECT * FROM car WHERE `id` = :id;");
    $selected_car_request->execute([
        ':id' => $car_id
    ]);
    $car = $selected_car_request->fetch();
    if ($car == false) {
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
// verification si formulaire est validé 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // recuperation d'un tableau d'erreur grace à une fonction qui verifie si les champs sont vide
    $errors = verifyErrors($_POST);
    // si pas d'erreur (tableau vide), appel de la fonction updatecar qui execute la requette d'ajout en bdd puis redirection vers index
    if (empty($errors)) {
        updateCar($_GET, $_POST);
        header('location:index.php');
    }
}
?>

<form method="POST" action="update.php?id=<?php echo ($car_id); ?>">
    <?php
    require_once('form.php');
    ?>
</form>

<?php
require_once('footer.php');
?>