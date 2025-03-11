<?php
require_once("header.php");
require_once("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = verifyErrors($_POST);
    if (empty($errors)) {
        addNewCar($_POST);
        header('location:index.php');
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