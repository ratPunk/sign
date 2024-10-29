<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_SESSION['notify']['error'])){
    echo $_SESSION['notify']['error'];
}

if (isset($_SESSION['notify']['success'])){
    echo $_SESSION['notify']['success'];
}
?>
<form action="signin.php" method="post">
    <input type="text" name="username" id="" placeholder="Имя" required>
    <input type="password" name="password" id="" placeholder="Пароль" required>
    <input type="submit" value="Войти">
</form>
<a href="registration.php">Нет аккаунта</a>
</body>
</html>