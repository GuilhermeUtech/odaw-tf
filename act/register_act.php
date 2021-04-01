<?php

$login = $_POST['login'];
$senha = $_POST['senha'];
$senhaConfirm = $_POST['senhaConfirm'];

$msg_alert = "";

if($senha != $senhaConfirm){
    $msg_alert = "As senhas não coincidem.";
    header("Location: ../pages/index.php");
} else {

    $link = mysqli_connect("localhost", "root", "", "trabalho-final-odaw");
    $resultado = mysqli_query($link, "INSERT INTO user (id_usuario,login_user, senha) VALUES (DEFAULT, '$login', '$senha')");

    if ($resultado == false) {
        $erro = mysqli_error($link);
        echo $erro;
    } else {
        header("Location: ../pages/index.php");
    }

}

?>