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
<body onload="w3_show_nav('menuProf')" >
	<!-- Inclui MENU.PHP  -->
	<?php require 'menu.php'; ?>
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
				$id = $_GET['id'];

				// Cria conexão
				$conn = mysqli_connect($servername, $username, $password, $database);

				// Verifica conexão
				if (!$conn) {
					die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
				}
				// Configura para trabalhar com caracteres acentuados do português	 
				mysqli_query($conn, "SET NAMES 'utf8'");
				mysqli_query($conn, 'SET character_set_connection=utf8');
				mysqli_query($conn, 'SET character_set_client=utf8');
				mysqli_query($conn, 'SET character_set_results=utf8');
				
				// Faz Select na Base de Dados
				$sql = "SELECT ID_Usuario, Nome, Celular, DataNasc, ID_Genero, Foto, Login FROM TB_Usuario WHERE ID_Usuario = $id";

				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = mysqli_query($conn, $sql)) {
					if(mysqli_num_rows($result) == 1){
						$row = mysqli_fetch_assoc($result);
						$genero     = $row['ID_Genero'];
						$id_usuario = $row['ID_Usuario'];
						$nome       = $row['Nome'];
						$celular    = $row['Celular'];
						$dataNasc   = $row['DataNasc'];
						$login      = $row['Login'];
						$foto       = $row['Foto'];
									
						// Faz Select na Base de Dados
						$sqlG = "SELECT ID_Genero, Nome FROM TB_Genero";
							
						$optionsGenero = array();
						
						if ($result = mysqli_query($conn, $sqlG)) {
							while ($row = mysqli_fetch_assoc($result)) {
								$selected = "";
								if ($row['ID_Genero'] == $genero)
									$selected = "selected";
								array_push($optionsGenero, "\t\t\t<option " . $selected . " value='". $row["ID_Genero"]."'>".$row["Nome"]."</option>\n");
							}
						}

						?>
						<div class="w3-container w3-theme">
							<h2>Altere os dados do Professor Cód. = [<?php echo $id_usuario; ?>]</h2>
						</div>
						<form class="w3-container" action="ProfAtualizar_exe.php" method="post" enctype="multipart/form-data">
						<table class='w3-table-all'>
						<tr>
							<td style="width:50%;">
							<p>
							<input type="hidden" id="Id" name="Id" value="<?php echo $id_usuario; ?>">
							<p>
							<label class="w3-text-IE"><b>Nome</b></label>
							<input class="w3-input w3-border w3-sand" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$"
									title="Nome entre 10 e 100 letras." value="<?php echo $nome; ?>" required></p>
							<p>
							<label class="w3-text-IE"><b>Celular</b></label>
							<input class="w3-input w3-border w3-sand " name="Celular" type="text" id="Celular"  type="text" maxlength="15"
									pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$" title="(XX)XXXXX-XXXX" value="<?php echo $celular; ?>" required></p>
							<p>
							<label class="w3-text-IE"><b>Data de Nascimento</b></label>
							<input class="w3-input w3-border w3-sand" name="DataNasc" type="date"
									pattern="((0[1-9])|([1-2][0-9])|(3[0-1]))\/((0[1-9])|(1[0-2]))\/((19|20)[0-9][0-9])"
									placeholder="dd/mm/aaaa" title="dd/mm/aaaa"
									title="Formato: dd/mm/aaaa" value="<?php echo $dataNasc; ?>"></p>
							
							<p><label class="w3-text-IE"><b>Gênero</b>*</label>
							<select name="Genero" id="Genero" class="w3-input w3-border w3-sand" required>

							<?php
								foreach($optionsGenero as $key => $value){
									echo $value;
								}
							?>
							</select>
							</p>
							
							<p>
							<label class="w3-text-IE"><b>Login</b></label>
							<input class="w3-input w3-border w3-sand" name="Login" type="text"
									pattern="[a-zA-Z]{2,20}.[a-zA-Z]{2,20}" title="Formato: nome.sobrenome" value="<?php echo $login; ?>" required></p>
							
							</td>
							<td>
							
							<p>
							<label class="w3-text-IE"><b>NOVA Senha</b>*</label>
							<input class="w3-input w3-border w3-sand" name="Senha" id="Senha" type="password" onchange="validarSenha()"
									pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}"
									title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
									required></p>
							<p>
							<label class="w3-text-IE"><b>Confirma NOVA Senha</b>*</label>
							<input class="w3-input w3-border w3-sand" name="Senha2" id="Senha2" type="password" onkeyup="validarSenha()"
									pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}"
									title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
									required> </p> 
							<p>
							<input type="checkbox" class="w3-btn w3-theme"  onclick="mostrarOcultarSenha()"> Mostrar senha
							</p>						
							<p style="text-align:center"><label class="w3-text-IE" ><b>Minha Imagem para Identificação: </b></label></p>
							<?php
							if ($foto) {?>
								<p style="text-align:center">
									<img id="imagemSelecionada" class="w3-circle w3-margin-top" src="data:image/png;base64,<?= base64_encode($foto); ?>" />
								</p> 
								<?php
							} else {
								?>
								<p style="text-align:center">
									<img id="imagemSelecionada" class="w3-circle w3-margin-top" src="imagens/pessoa.jpg" />
								</p>
								<?php
							}
							?>
							<p style="text-align:center"><label class="w3-btn w3-theme">Selecione uma Imagem
							<input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
							<input type="file" id="Imagem" name="Imagem" accept="imagem/*" onchange="validaImagem(this);" /></label>
							</p>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
							<p>
							<input type="submit" value="Alterar" class="w3-btn w3-red" >
							<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='profListar.php'"></p>
						</tr>
						</table>
						<br>
						</form>
								<?php
					}else{?>
								<div class="w3-container w3-theme">
								<h2>Professor inexistente</h2>
								</div>
								<br>
							<?php
							}
				} else {
					echo "<p style='text-align:center'>Erro executando UPDATE: " . mysqli_error($conn) . "</p>";
				}
				echo "</div>"; //Fim form
				mysqli_close($conn);  //Encerra conexao com o BD
				?>
			</div>
			</p>
		</div>

		<footer class="w3-panel w3-padding w3-card-4 w3-light-grey w3-center w3-opacity">
			<nav>
				<a class="w3-btn w3-theme w3-hover-white"
				onclick="document.getElementById('id01').style.display='block'">Sobre</a>
			</nav>
		</footer>

	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'rodape.php';?>

</body>
</html>
