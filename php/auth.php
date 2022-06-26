<?php
session_start();
require 'dbcon.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/css.css">
    <title>Авторизация</title>
</head>
<body>
    <form action="code.php" method="POST">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите Ваш логин" required>
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите Ваш пароль" required>
        <button type="submit" name="enter" style="border: none;border-radius: 5px; background: #1d5cf6;color: white">Войти</button>
    </form>
</body>
</html>