<?php
require_once('header.php');

// $pass = password_hash("admin", PASSWORD_DEFAULT);
// var_dump($pass);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once('connectDB.php');
    $pdo = connectDB();
    $user_request = $pdo->prepare("SELECT * FROM `user` WHERE `username` = :username;");
    $user_request -> execute([
        ':username' => $_POST['username']
    ]);
    $user = $user_request->fetch();
    if ($_POST['username'] == $user['username']) {
        if (password_verify($_POST['password'], $user['password'])) {
            echo ('ca marche ');
        } else {
            echo ('identifiant ou password incorrect');
        }
    }

   
}
?>
<form action="login.php" method="POST">
    <label for="usernarme">Username</label>
    <input required type="text" name="username">
    <label for="password">Password</label>
    <input required type="password" name="password">
    <input type="submit" value="se connecter">
</form>
<?php
require_once('footer.php');
?>

