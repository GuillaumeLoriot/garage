<?php
require_once('header.php');

// $pass = password_hash("admin", PASSWORD_DEFAULT);
// var_dump($pass);
$errors = [];
$user;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['username']) == false || strlen($_POST['username']) < 4) {
        $errors['username'] = 'le champ username doit faire minimum 4 charactères';
    }
    if (isset($_POST['password']) == false || strlen($_POST['password']) < 4) {
        $errors['password'] = 'le champ password doit faire minimum 4 charactères';
    }
    if (empty($errors)) {

        require_once('connectDB.php');
        $pdo = connectDB();
        $user_request = $pdo->prepare("SELECT * FROM `user` WHERE `username` = :username;");
        $user_request->execute([
            ':username' => $_POST['username']
        ]);
        $user = $user_request->fetch();

        if ($user == false) {
            echo ('identifiant inexistant');
        } else {
            if (password_verify($_POST['password'], $user['password'])) {
                session_start();
                $_SESSION["username"] = $user["username"];
                header("location: admin.php");
            } else {
                echo ('identifiant ou password incorrect');
            }
        }
    }
}
?>
<form action="login.php" method="POST">
    <label for="usernarme">Username</label>
    <input required type="text" name="username">
    <?php if (isset($errors['username'])) {
    ?>
        <p class="errors"><?php echo ($errors['username']); ?></p>
    <?php
    }
    ?>
    <label for="password">Password</label>
    <input required type="password" name="password">
    <?php if (isset($errors['password'])) {
    ?>
        <p class="errors"><?php echo ($errors['password']); ?></p>
    <?php
    }
    ?>
    <input type="submit" value="se connecter">
</form>
<?php
require_once('footer.php');
?>