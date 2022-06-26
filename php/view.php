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
    <link href="../css/css.css" rel="stylesheet">

    <title>User View</title>
</head>
<body>

<div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4>Просмотр пользователя
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

                            <div class="mb-3">
                                <label>Логин</label>
                                <p class="form-control">
                                    <?=$user['login'];?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Пароль</label>
                                <p class="form-control">
                                    <?=$user['password'];?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Имя</label>
                                <p class="form-control">
                                    <?=$user['first_name'];?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Фамилия</label>
                                <p class="form-control">
                                    <?=$user['last_name'];?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Пол</label>
                                <p class="form-control">
                                    <?=$user['gender'];?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Дата рождения</label>
                                <p class="form-control">
                                    <?=$user['birthday'];?>
                                </p>
                            </div>

                            <?php
                        }
                        else
                        {
                            echo "<h4>Нет результатов</h4>";
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