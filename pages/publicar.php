<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../repos/REDDIT-LOGO.svg" type="image/x-icon">
    <title>Publicar</title>
</head>
<body style="background-color: #60a3bc;">

<div class="container p-5">
        <div class="card" style="background-color: #f39c12;">
            <div class="card-header">
                <div class="d-flex justify-content-between col-12">
                    <div>
                        <form action="../act/publicar_act.php" method="POST">
                            <div id="form-group">
                                <label for="titulo">Título</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo">
                                <label for="publicacao">Publicação</label>
                                <textarea class="form-control" name="publicacao" rows="4" cols="150"></textarea>
                                <div class="d-flex justify-content-center mt-3 login_container">
                                    <button type="submit" name="button" class="btn login_btn">Publicar</button>
                                </div>
                            </div>
                        </form>				
                    </div>
                <div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3 login_container">
                <a href="master_page.php">
                    <button class="btn btn-sm btn-outline-secondary" type="button">Voltar</button>
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>