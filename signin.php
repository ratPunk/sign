<?php
session_start();
require_once 'database.php';

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    die(http_response_code(404));
}

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = mysqli_real_escape_string($mysqli, $_POST['password']);

unset($_SESSION['notify']['error']);

if(empty($username) || empty($password)) {
    $_SESSION['notify']['error'] = 'Одно из полей пустое!';
    Header('Location: login.php');
    exit;
}

if (strlen($username) > 32) {
    $_SESSION['notify']['error'] = 'Имя должно быть не более 32 символов';
    Header('Location: registration.php');
    exit;
}

$sql = "SELECT * FROM `users` WHERE `username` = '{$username}'";
$result = $mysqli->query($sql);

if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if(password_verify($password,  $row['password'])) {
        $_SESSION['user'] = [
            "id" => $row['id'],
            "username" => $row['username'],
            "email" => $row['email']
        ];
        Header('Location: lk.php');
        exit();
    }
} else {
    $_SESSION['notify']['error'] = 'Неверный email или пароль';
    Header('Location: login.php');
}