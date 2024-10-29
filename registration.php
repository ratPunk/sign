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
<?php  if (isset($_SESSION['notify']['error'])){
    echo $_SESSION['notify']['error'];
    }
?>
        <form action="signup.php" method="post">
            <input type="text" name="username" id="" placeholder="Имя" required>
            <input type="password" name="password" id="" placeholder="Пароль" required>
            <input type="password" name="repeat_password" id="" placeholder="Повторить пароль" required>
            <input type="email" name="email" id="" placeholder="E-mail" required>
            <input type="submit" value="Зарегистрироваться">
        </form>
        <a href="login.php">Уже есть аккаунт</a>
</body>
</html>