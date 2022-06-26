<?php
session_start();
require 'dbcon.php';

if(isset($_POST['enter'])) {
    $login=$_POST['login'];
    $pass=$_POST['password'];
    $check_user="SELECT * FROM admin WHERE login='$login'AND password='$pass'";
    $run=mysqli_query($con,$check_user);
    if(mysqli_num_rows($run)) {

        header("Location:index.php");
        $_SESSION['login']=$login;
    }
    else
    {

        header("Location:auth.php");
        session_destroy();
    }
}

if(isset($_POST['delete_user']))
{
    $id = mysqli_real_escape_string($con, $_POST['delete_user']);

    $query = "DELETE FROM users WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Пользователь успешно удален!";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Пользователь не найден";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update_user']))
{
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $login = mysqli_real_escape_string($con, $_POST['login']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);
    $fname = mysqli_real_escape_string($con, $_POST['first_name']);
    $lname = mysqli_real_escape_string($con, $_POST['last_name']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $birthday = date('Y-m-d', strtotime($_POST['birthday']));

    $query = "UPDATE users SET login='$login',password='$pass', first_name='$fname', last_name='$lname', gender='$gender', birthday='$birthday' WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Данные о пользователе успешно обновлены";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Данные о пользователе не обновлены";
        header("Location: index.php");
        exit(0);
    }

}


if(isset($_POST['save_user']))
{
    $login = mysqli_real_escape_string($con, $_POST['login']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);
    $fname = mysqli_real_escape_string($con, $_POST['first_name']);
    $lname = mysqli_real_escape_string($con, $_POST['last_name']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $birthday = date('Y-m-d', strtotime($_POST['birthday']));
    $select = mysqli_query($con, "SELECT * FROM users WHERE login = '$login'");
    if(mysqli_num_rows($select)) {
        header("Location: login_exist.php");
    }else{
        $query = "INSERT INTO users (login,password,first_name,last_name,gender,birthday) VALUES ('$login','$pass','$fname','$lname','$gender','$birthday')";

        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            $_SESSION['message'] = "Новый пользователь успешно добавлен!";
            header("Location: create.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Пользователь не добавлен";
            header("Location: create.php");
            exit(0);
        }
    }

}

?>