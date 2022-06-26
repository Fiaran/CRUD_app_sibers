<?php
session_start();
require 'dbcon.php';
if (isset($_SESSION['login'])){


?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../css/css.css" rel="stylesheet">

    <title>Страничка добавления пользователя</title>
</head>
<body>

<div class="container mt-5">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Добавление пользователя
                        <a href="index.php" class="btn btn-danger float-end">НАЗАД</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST">

                        <div class="mb-3">
                            <label>Логин</label>
                            <input type="text" name="login" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Пароль</label>
                            <input type="text" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Имя</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Фамилия</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Пол</label> <br>
                            <input type="radio" name="gender" value="Мужской" required/> Мужской
                            <input type="radio" name="gender" value="Женский" required/> Женский
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Дата рождения</label>
                            <input type="date" name="birthday" class="form-control" required/>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="save_user" class="btn_up" >Добавить пользователя</button>
                        </div>

                    </form>
                    <?php }
                    else{
                        $login=$_POST['login'];
                        $pass=$_POST['password'];
                        if ($_POST['login']==$login && $_POST['password'] == $pass){
                            $_SESSION['login']=$login;
                            header("Location:index.php");
                        }else{
                            header('Location:auth.php');
                        }
                    }
                       ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>