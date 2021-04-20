<?php

session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
$link = mysqli_connect("localhost", "root", "", "trabalho-final-odaw");

$busca = isset($_GET["busca"]) ? $_GET["busca"] : "";

$orderBy = isset($_GET["orderby"]) ? strtoupper($_GET["orderby"]) : "ASC";
$orderColumn = isset($_GET["ordercolumn"]) ? $_GET["ordercolumn"] : "data_postagem";

$user = $_SESSION["user"];
$idUsuario = $user["id_usuario"];
$result = null;
$select = "
SELECT postagem.id_postagem, postagem.titulo, postagem.texto_postagem, user.login_user as usuario, postagem.data_postagem, tabelaPositivo.positivos, tabelaNegativo.negativos, IFNULL(tabelaPositivo.positivos, 0) - IFNULL(tabelaNegativo.negativos, 0) AS diferenca
FROM postagem 
LEFT JOIN (SELECT id_postagem, count(id) as positivos FROM `user_postagem` WHERE avaliacao = 1 GROUP BY id_postagem) AS tabelaPositivo ON postagem.id_postagem = tabelaPositivo.id_postagem
LEFT JOIN (SELECT id_postagem, count(id) as negativos FROM `user_postagem` WHERE avaliacao = 0 GROUP BY id_postagem) AS tabelaNegativo ON postagem.id_postagem = tabelaNegativo.id_postagem
INNER JOIN user ON postagem.id_usuario = user.id_usuario
";

if ($busca != "") {
	$select .= "WHERE UPPER(postagem.titulo) LIKE UPPER('%$busca%')
	OR UPPER(postagem.texto_postagem) LIKE UPPER('%$busca%')
	OR UPPER(user.login_user) LIKE UPPER('%$busca%')";
} 
$select .= "ORDER BY ".$orderColumn." ".$orderBy;
$select .= ";";
$result = mysqli_query($link, $select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotReddit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="shortcut icon" href="../repos/REDDIT-LOGO.svg" type="image/x-icon">
   <link rel="shortcut icon" href="../repos/REDDIT-LOGO.svg" type="image/x-icon"> <link rel="stylesheet" href="../pages/repos/index.css">
    <link href="../repos/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet"> <!--load all styles -->
    <style>
    </style>   
</head>
<body style="background-color: #60a3bc;">
    <nav class="navbar navbar-light bg-light" style="background-color: #f39c12 !important;">
        <div class="container" style="background-color: #f39c12 !important;">
            <a class="navbar-brand" href="master_page.php" style="position: relative;">
                <img src="../repos/REDDIT-LOGO.svg" style="position: absolute; top: -21px; left: 0;" alt="" height="50">
            </a>
            <form class="d-flex col-8" action="./master_page.php" method="GET">
                <input class="form-control me-4" type="search" name="busca" placeholder="Search" aria-label="Search" value="<?php echo $busca; ?>">
                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <a href="../act/logout_act.php">
                <button class="btn btn-sm btn-outline-secondary" type="button" style="background-color: white !important;">
                    Sair
                    <span class="fa fa-sign-out-alt"></span>
                </button>
            </a>
        </div>
    </nav>

    <div class="container p-5">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between col-12" >
                    <div>
											<form class="d-flex" action="./master_page.php" method="GET">
												<input type="hidden" value="<?php echo $busca; ?>" name="busca" />
												<input type="hidden" value="<?php echo $orderBy === "ASC" ? "DESC" : "ASC"; ?>" name="orderby" />
												<select class="form-control form-select mr-3" aria-label="Default select example" name="ordercolumn">
													<option value="data_postagem" <?php echo $orderColumn == "data_postagem" ? 'selected="selected"' : "";?>>
														Data de publicação
													</option>
													<option value="diferenca" <?php echo $orderColumn === "diferenca" ? 'selected="selected"' : "";?>>
													
														Melhores postagens
													</option>
												</select>
												<button class="btn btn-sm btn-outline-secondary" type="submit">
														Ordernar
														<?php 
																if ($orderBy == "ASC") {
														?>
																		<i class="fas fa-sort-amount-down-alt"></i>
														<?php
																} else {
														?>
																		<i class="fas fa-sort-amount-up-alt"></i>
														<?php
																}
														?>
														
														<?php
														?>
												</button>
											</form>
											
                    </div>
                    <div>
                        <a href="publicar.php">
                            <button class="btn btn-sm btn-outline-secondary" type="button">
                                Escrever publicação
                                <span class="fas fa-edit"></span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
				<?php 
						if(!is_null($result)) {
							if ($result->num_rows > 0) {
								while ($row = $result->fetch_row()) {
									$dt = new DateTime( $row[4] );
									
				?>
						<div class="card mt-3">
							<div class="card-body">
										<h5 class="card-title"><?php echo $row[1]; ?></h5>
										<h6 class="card-subtitle mb-2 text-muted"><?php echo $row[3]; echo " "; echo $dt->format( 'd/m/Y H:i' );?></h6>
										<p class="card-text"><?php echo $row[2]; ?></p>
							</div>
							<div class="card-body" style="padding: 0 10px; margin: 0;">
									<div class="col-12 d-flex justify-content-between" >
										<div>
											<p style="color: green; font-size: 24px;">
												<?php echo is_null($row[5]) ? "0" : $row[5]; ?>
												<i class="far fa-smile"></i>
											</p>
										</div>
										<div>
											<p style="color: red; font-size: 24px;">
												<?php echo is_null($row[6]) ? "0" : $row[6]; ?>
												<i class="far fa-frown"></i>
											</p>
										</div>
									</div>
									<div class="col-12 d-flex justify-content-between" style="margin-bottom: 10px; margin-top: -15px;">
										<div>
											<a href="../act/votar_act.php?idpostagem=<?php echo $row[0]; ?>&voto=positivo">
												<button class="btn btn-success" type="button">
														Gostei
														<i class="far fa-thumbs-up"></i>
												</button>
											</a>
										</div>
										<div>
										<a href="../act/votar_act.php?idpostagem=<?php echo $row[0]; ?>&voto=negativo">
												<button class="btn btn-danger" type="button">
														Não Gostei
														<i class="far fa-thumbs-down"></i>
												</button>
											</a>
										</div>
									</div>
							</div>
						</div>
				<?php		
								}	
							} else {
				?>
							<div class="card mt-3">
								<div class="card-body">
									<p>Nenhuma noticia encontrada</p>
								</div>
							</div>
				<?php
							}
						}	
				?>
			
       
    </div>
    
    <br>
</body>
</html>
