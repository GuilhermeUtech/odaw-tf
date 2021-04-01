<?php

session_start();
if (!isset($_SESSION["user"])) {
    header("Location:../pages/login.php");
}

$login = $_POST['login'];
$senha = $_POST['senha'];

$link = mysqli_connect("localhost", "root", "", "trabalho-final-odaw");

$resultado = mysqli_query($link, "SELECT * FROM user WHERE login_user='$login' AND senha='$senha'");

if(mysqli_num_rows($resultado) > 0){

    $user = mysqli_fetch_assoc($resultado);
    session_start();
    $_SESSION["user"] = $user;
    header("location: ../pages/master_page.php");

} else{

    unset ($_SESSION['login']);
    unset ($_SESSION['senha']);
    $_SESSION['alert_error'] = "Falha ao realizar login, usuário não encontrado.";
    header('location: ../pages/index.php');

}





?>