<html lang="pt">
<!-------------------------------------------------------------------------------
Oficina Desenvolvimento Web
PUCPR

INDEX.PHP

Profa. Cristina V. P. B. Souza
Agosto/2022
*** Para o correto funcionamento do CSS, o equipamento precisa de internet ***
---------------------------------------------------------------------------------->
<html>
	<head>	
		<title>IE - Instituição de Ensino</title>
		<link rel="icon" type="image/png" href="imagens/IE_favicon.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="css/customize.css">
	</head>
	<body  onload="w3_show_nav('menuDisc')">

		<!-- Inclui MENU.PHP  -->
		<?php require 'menu.php'; ?>


		<!-- Conteúdo PRINCIPAL: deslocado para direita em 270 pixels quando a sidebar é visível -->
		<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

			<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
				<h1 class="w3-jumbo">Controle Acadêmico: Disciplinas</h1>

				<img src="imagens/disciplina.png" class="w3-image w3-round-xxlarge" width="70%">

				<footer class="w3-panel w3-padding w3-card-4 w3-light-grey w3-center w3-opacity">
					<p>
						<nav>
							<a class="w3-btn w3-theme w3-hover-white"
							   onclick="document.getElementById('id01').style.display='block'">Sobre</a>
						</nav>
					</p>
				</footer>

		<!-- FIM PRINCIPAL -->
			</div>

		<!-- Inclui RODAPE.PHP  -->
		<?php require 'rodape.php';?>
	</body>
</html>