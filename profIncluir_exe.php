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
	  <link rel="icon" type="image/png" href="imagens/IE_favicon.png" />
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
	$data = date("d/m/Y H:i:s",time());
	echo "<p class='w3-small' > ";
	echo "Acesso em: ";
	echo $data;
	echo "</p> "
	?>

	<!-- Acesso ao BD-->
	<?php
		$nome    = $_POST['Nome'];
		$celular = $_POST['Celular'];
		$login   = $_POST['Login'];
		$dtNasc  = $_POST['DataNasc'];
		$genero  = $_POST['Genero'];
		
		if ($dtNasc != ""){
			if (strpos($dtNasc,"-") != false){
				$strData = explode('-',$dtNasc);
			}else {
				$strData = explode('/',$dtNasc);
			}
		
			$ano = $strData[2];
			$mes = $strData[1];
			$dia = $strData[0];

			$nova_data = $ano.'-'.$mes.'-'.$dia;
		}
		else
			$nova_data = "";

		//Criptografa Senha
		$md5Senha = md5($_POST['Senha']);

		// Cria conexão
		$conn = mysqli_connect($servername, $username, $password, $database);

		// Verifica conexão
		if (!$conn) {
			die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
		}
		// Configura para trabalhar com caracteres acentuados do português
		mysqli_query($conn,"SET NAMES 'utf8'");
		mysqli_query($conn,'SET character_set_connection=utf8');
		mysqli_query($conn,'SET character_set_client=utf8');
		mysqli_query($conn,'SET character_set_results=utf8');

		// Faz Select na Base de Dados

		if ($_FILES['Imagem']['size'] == 0) { // Não recebeu uma imagem binária
			$sql = "INSERT INTO TB_Usuario (Nome, Celular, DataNasc, ID_Genero, Login, Senha, ID_TipoUsu, Foto) VALUES ('$nome','$celular','$dtNasc', '$genero','$login','$md5Senha', 2, NULL)";
		} else {                              // Recebeu uma imagem binária
			$imagem = addslashes(file_get_contents($_FILES['Imagem']['tmp_name'])); // Prepara para salvar em BD
			$sql = "INSERT INTO TB_Usuario (Nome, Celular, DataNasc, ID_Genero, Login, Senha, ID_TipoUsu, Foto) VALUES ('$nome','$celular','$dtNasc', '$genero','$login','$md5Senha', 2, '$imagem')";
		}
		?>
		<div class='w3-responsive w3-card-4'>
		<div class="w3-container w3-theme">
		<h2>Inclusão de Novo Professor</h2>
		</div>
		<?php
		if ($result = mysqli_query($conn, $sql)) {
			echo "<p>&nbsp;Registro cadastrado com sucesso! </p>";
		} else {
			echo "<p>&nbsp;Erro executando INSERT: " . mysqli_error($conn . "</p>");
		}
        echo "</div>";
		mysqli_close($conn);  //Encerra conexao com o BD

	?>
  </div>
</div>


<footer class="w3-panel w3-padding w3-card-4 w3-light-grey w3-center w3-opacity">
  <p><nav>
      <a class="w3-btn w3-theme w3-hover-white" onclick="document.getElementById('id01').style.display='block'" >Sobre</a>
  </nav></p>
</footer>

<!-- FIM PRINCIPAL -->
</div>
<!-- Inclui RODAPE.PHP  -->
<?php require 'rodape.php';?>
</body>
</html>
