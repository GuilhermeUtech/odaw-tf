<?php

session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../pages/index.php");
}

$titulo = $_POST['titulo'];
$descricao = $_POST['publicacao'];
$user = $_SESSION["user"];
$idUsuario = $user["id_usuario"];


date_default_timezone_set('UTC');

$data_postagem = date("Y-m-d H:i:s"); 

if($titulo == "" || $descricao == ""){
    header("Location: ../pages/master_page.php");
} else {
    
    $link = mysqli_connect("localhost", "root", "", "trabalho-final-odaw");

    $resultado = mysqli_query($link, "INSERT INTO postagem (id_postagem, titulo, texto_postagem, data_postagem, id_usuario) VALUES (DEFAULT, '$titulo', '$descricao', '$data_postagem', '$idUsuario')");
    
    if ($resultado == false) {
        $erro = mysqli_error($link);
        echo $erro;
    } else {
        header("Location: ../pages/master_page.php");
    }
}

?>