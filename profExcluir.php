<!DOCTYPE html>
    <!--
     Desenvolvimento Web
     PUCPR
     Profa. Cristina V. P. B. Souza
     Agosto/2022
    -->
<html>
<head>

    <title>IE - Instituição de Ensino</title>
    <link rel="icon" type="image/png" href="imagens/IE_favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="css/customize.css">
</head>
<body onload="w3_show_nav('menuProf')">
<!-- Inclui MENU.PHP  -->
<?php require 'menu.php';?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <p class="w3-large">
            <div class="w3-code cssHigh notranslate">
                <!-- Acesso em:-->
                <?php

                date_default_timezone_set("America/Sao_Paulo");
                $data = date("d/m/Y H:i:s", time());
                echo "<p class='w3-small' > ";
                echo "Acesso em: ";
                echo $data;
                echo "</p> "
                ?>

                <!-- Acesso ao BD-->
				<?php
	
				// Cria conexão
				$conn = mysqli_connect($servername, $username, $password, $database);

				// Verifica conexão
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}
				// Configura para trabalhar com caracteres acentuados do português
				mysqli_query($conn,"SET NAMES 'utf8'");
				mysqli_query($conn,'SET character_set_connection=utf8');
				mysqli_query($conn,'SET character_set_client=utf8');
				mysqli_query($conn,'SET character_set_results=utf8');

				$id=$_GET['id'];
				
				// Faz Select na Base de Dados
				$sql = "SELECT ID_usuario, Nome, Celular, DataNasc, Login FROM TB_Usuario WHERE ID_usuario = $id";
				echo "<div class='w3-responsive w3-card-4'>"; //Inicio form
				 if ($result = mysqli_query($conn, $sql)) {
						if (mysqli_num_rows($result) > 0) {
						// Apresenta cada linha da tabela
							while ($row = mysqli_fetch_assoc($result)) {
								$dataN = explode('-', $row["DataNasc"]);
								$ano = $dataN[0];
								$mes = $dataN[1];
								$dia = $dataN[2];
								$nova_data = $dia . '/' . $mes . '/' . $ano;
				?>
								<div class="w3-container w3-theme">
									<h2>Exclusão do Professor Cód. = [<?php echo $row['ID_usuario']; ?>]</h2>
								</div>
								<form class="w3-container" action="ProfExcluir_exe.php" method="post" onsubmit="return check(this.form)">
									<input type="hidden" id="Id" name="Id" value="<?php echo $row['ID_usuario']; ?>">
									<p>
									<label class="w3-text-IE"><b>Nome: </b> <?php echo $row['Nome']; ?> </label></p>
									<p>
									<label class="w3-text-IE"><b>Celular: </b><?php echo $row['Celular']; ?></label></p>
									<p>
									<label class="w3-text-IE"><b>Data de Nascimento: </b><?php echo $nova_data; ?></label></p>
									<p>
									<label class="w3-text-IE"><b>Login: </b><?php echo $row['Login']; ?></label></p>
									<p>
									<input type="submit" value="Confirma exclusão?" class="w3-btn w3-red" >
									<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='profListar.php'"></p>
								</form>
			<?php 
							}
						}
				}
				else {
					echo "Erro executando DELETE: " . mysqli_error($conn);
				}
				echo "</div>"; //Fim form
				mysqli_close($conn);  //Encerra conexao com o BD

			?>

			</div>
		</p>
	</div>


	<footer class="w3-panel w3-padding w3-card-4 w3-light-grey w3-center w3-opacity">
    <p>
        <nav>
            <a class="w3-button w3-theme w3-hover-white"
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
