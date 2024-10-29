<?php
session_start();
require_once "database.php";

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    die(http_response_code(404));
}

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = mysqli_real_escape_string($mysqli, $_POST['password']);
$repeat_password = mysqli_real_escape_string($mysqli, $_POST['repeat_password']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);

unset($_SESSION['notify']['error']);

if(empty($username) || empty($password) || empty($email) || empty($repeat_password)){
    $_SESSION['notify']['error'] = 'Одно из полей пустое!';
    Header('Location: registration.php');
    exit;
}

if(strlen($username) > 32 || strlen($username) < 2 ){
    $_SESSION['notify']['error'] = 'Имя должно быть не менее 2 и не более 32 символов';
    Header('Location: registration.php');
    exit;
}

if(strlen($password) < 6){
    $_SESSION['notify']['error'] = 'Пароль должен быть не менее 6 символов';
    Header('Location: registration.php');
    exit;
}

if($repeat_password != $password){
    $_SESSION['notify']['error'] = 'Пароли не совпадают';
    Header('Location: registration.php');
    exit;
}

$sql = "SELECT `username` FROM `users` WHERE `username` = '{$username}'";
$result = $mysqli->query($sql);

if($result->num_rows > 0){
    $_SESSION['notify']['error'] = 'Email уже зарегистрирован!';
    Header('Location: registration.php');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['notify']['error'] = 'Невалидный email';
    Header('Location: registration.php');
    exit;
}

if (strlen($email) > 32) {
    $_SESSION['notify']['error'] = 'Почта слишком длинная';
    Header('Location:  registration.php');
    exit;
}

$password = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO `users` (`username`, `password`, `email`) VALUES ('{$username}', '{$password}', '{$email}')";
$mysqli->query($sql);

if($mysqli->affected_rows) {
    unset($_SESSION['notify']['error']);
    $_SESSION['notify']['success'] = 'Регистрация прошла успешно! Войдите в систему';
    Header('Location: login.php');
} else {
    $_SESSION['notify']['error'] = 'Произошла ошибка регистрации';
    Header('Location: registration.php');
}