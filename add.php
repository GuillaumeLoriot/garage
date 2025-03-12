<?php
require_once("header.php");
require_once("functions.php");

session_start();
if (!isset($_SESSION["username"])) {
    header('location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = verifyErrors($_POST);
    if (empty($errors)) {
        addNewCar($_POST);
        header('location:admin.php');
    }
}
?>
<form method="POST" action="add.php">
    <?php
    require_once('form.php');
    ?>
</form>
<?php
require_once("footer.php");
?>