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
    <link rel="stylesheet" href="../css/css.css">
    <title>Редактирование пользователя</title>
</head>
<body>

<div class="container">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Редактирование пользователя
                        <a href="index.php" class="btn btn-danger float-end">НАЗАД</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    if(isset($_GET['id']))
                    {
                        $user_id = mysqli_real_escape_string($con, $_GET['id']);
                        $query = "SELECT * FROM users WHERE id='$user_id' ";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            $user = mysqli_fetch_array($query_run);
                            ?>
                            <form action="code.php" method="POST">
                                <input type="hidden" name="id" value="<?= $user['id']; ?>">

                                <div class="mb-3">
                                    <label>Логин</label>
                                    <input type="text" name="login" value="<?=$user['login'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Пароль</label>
                                    <input type="text" name="password" value="<?=$user['password'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Имя</label>
                                    <input type="text" name="first_name" value="<?=$user['first_name'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Фамилия</label>
                                    <input type="text" name="last_name" value="<?=$user['last_name'];?>" class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="">Пол</label> <br>
                                    <input type="radio" name="gender" value="Мужской" <?php if($user['gender']=="Мужской"){ echo "checked";}?> /> Мужской
                                    <input type="radio" name="gender" value="Женский" <?php if($user['gender']=="Женский"){ echo "checked";}?>/> Женский
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Дата рождения</label>
                                    <input type="date" name="birthday" class="form-control" value="<?=$user['birthday'];?>" />
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_user" class="btn_up">
                                        Редактировать
                                    </button>
                                </div>

                            </form>
                            <?php
                        }
                        else
                        {
                            echo "<h4>No Such Id Found</h4>";
                        }
                    }}
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>