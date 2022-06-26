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
    <title>Dashboard</title>
</head>
<body>

<div>
    <a href="logout.php" class="logout">Выход</a>
    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Логин</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th><a href="create.php" class="btn_add">Добавить нового пользователя</a></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $record_page = 4;
                        if(isset($_GET["page"])){
                            $page = $_GET["page"];
                        }else{
                            $page = 1;
                        }

                        $start_from = ($page-1)*$record_page;

                        $query = "SELECT * FROM users order by id asc limit $start_from, $record_page";;
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            foreach($query_run as $user)
                            {
                                ?>
                                <tr>
                                    <td><?= $user['id']; ?></td>
                                    <td><?= $user['login']; ?></td>
                                    <td><?= $user['first_name']; ?></td>
                                    <td><?= $user['last_name']; ?></td>
                                    <td>
                                        <form action="view.php?id=<?= $user['id']; ?>" method="POST" class="d-inline">
                                            <button type="submit"  value="<?=$user['id'];?>" class="btn btn-danger btn-sm">Просмотреть</button>
                                        </form>
                                        <br>
                                        <form action="edit.php?id=<?= $user['id']; ?>" method="POST" class="d-inline">
                                            <button type="submit"  value="<?=$user['id'];?>" class="btn btn-danger btn-sm">Редактировать</button>
                                        </form>
                                        <br>
                                        <form action="code.php" method="POST">
                                            <button type="submit" name="delete_user" value="<?=$user['id'];?>" class="delete">Удалить</button>
                                        </form>

                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            echo "<h5> No Record Found </h5>";
                        }
                        ?>

                        </tbody>

                    </table>
                    <div class="pagination" align="center">
                        <?php
                        $page_query = "SELECT * FROM users ORDER BY id desc ";
                        $page_res = mysqli_query($con, $page_query);
                        $total_rec = mysqli_num_rows($page_res);
                        $total_pages = ceil($total_rec/$record_page);
                        for($i=1; $i<=$total_pages; $i++){
                            echo '<a href="index.php?page='.$i.'">              '.$i.'</a>';
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
</div>
</body>
</html>