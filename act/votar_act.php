<?php 
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: ../pages/index.php");
    }

    
    $user = $_SESSION["user"];
    $idUsuario = $user["id_usuario"];

    $voto = $_GET["voto"];
    $idPostagem = $_GET["idpostagem"];
    if ($voto == "negativo") {
        $voto = false;
    } else {
        $voto = true;
    }

    $link = mysqli_connect("localhost", "root", "", "trabalho-final-odaw");

    $resultado = mysqli_query($link, "SELECT * FROM user_postagem WHERE id_usuario = '$idUsuario' AND id_postagem = '$idPostagem'");

    if(mysqli_num_rows($resultado) > 0){
        $user = mysqli_fetch_assoc($resultado);
        $insert = mysqli_query($link, "UPDATE user_postagem SET avaliacao = '$voto' WHERE id_usuario = '$idUsuario' AND id_postagem = '$idPostagem'");
        if ($insert == false) {
            $erro = mysqli_error($link);
            echo $erro;
        } else {
            header("Location: ../pages/master_page.php");
        }
    } else {
        $insert = mysqli_query($link, "INSERT INTO user_postagem (id_usuario, id_postagem, avaliacao) VALUES ('$idUsuario', '$idPostagem', '$voto')");
        if ($insert == false) {
            $erro = mysqli_error($link);
            echo $erro;
        } else {
            header("Location: ../pages/master_page.php");
        }
    }
    

?>