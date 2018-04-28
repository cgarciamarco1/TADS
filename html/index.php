<!-- Comentarios -->
<?php
	$cadOnLoad="CargarID('00_menuV.php', '00_menuC.php', 'nav')";
	?>
<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" href="css/styles.css">
		<link href="https://fonts.googleapis.com/css?family=Mukta+Mahee" rel="stylesheet">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="lib/interfazVC.js"></script>
		<title> TADS COMPANY </title>
	</head>

	<body onload ="<?php echo $cadOnLoad;?>">
		<div id="header">
			<div id="headerlogo">
			</div>
			<div id="headercentro">
				<a href="index.php">
					<h1 class="headernombre"> TADS COMPANY</h1>
				</a>
			</div>
		</div>
		<nav id="nav">
		</nav>
		<div id="main">

			<img src="img/918263-Pizzeria-La-Imperial-banner-1.w1900.jpg" alt="imagen pizza" onclick="CargarID('10_pedidosV.php', '10_pedidosC.php', 'main')" style="cursor:pointer"></img>
		</div>
		<div id="myAlert"></div>
	</body>
</html>

