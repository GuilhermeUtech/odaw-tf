<?php

session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotReddit</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            background: #60a3bc !important;
        }
    </style>   
</head>
<body>
    <a href="../act/logout_act.php">Sair</a>
    <br>
    <a href="publicar.php">Escrever publicação</a>
</body>
</html>
