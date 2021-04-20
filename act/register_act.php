<?php

$login = $_POST['login'];
$senha = $_POST['senha'];
$senhaConfirm = $_POST['senhaConfirm'];

$msg_alert = "";

$senhaMD5 = md5($senha);

if($senha != $senhaConfirm){
    header("Location: ../pages/register_page.php");
} else {
        $link = mysqli_connect("localhost", "root", "", "trabalho-final-odaw");

        if ($result = mysqli_query($link, "SELECT * FROM user WHERE login_user='$login' ")) {
            $row_cnt = mysqli_num_rows($result);
            mysqli_free_result($result);
        }

        if($row_cnt == 0){
            $resultado = mysqli_query($link, "INSERT INTO user (id_usuario, login_user, senha) VALUES (DEFAULT, '$login', '$senhaMD5')");

            if ($resultado == false) {
                $erro = mysqli_error($link);
                #echo $erro;
            } else {
                header("Location: ../pages/index.php");
            }
        } else {
            #usuário já cadastrado, voltando ao cadastro
            header("Location: ../pages/register_page.php");
        }
    }

?>