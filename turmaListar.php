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
<body onload="w3_show_nav('menuTurma')">
<!-- Inclui MENU.PHP  -->
<?php require 'menu.php'; ?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <p class="w3-large">
        <p>
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
            <div class="w3-container w3-theme">
            <h2>Listagem de Turmas</h2>
            </div>

            <!-- Acesso ao BD-->
            <?php

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
            $sql = "SELECT t.ID_Turma, p.nome, d.nomeDisc, t.ano, t.semestre FROM TB_Turma as t, TB_Disciplina as d, TB_Usuario as P WHERE t.ID_Disciplina = d.ID_Disciplina AND t.ID_Usuario = p.ID_Usuario ORDER BY ID_Turma";
            echo "<div class='w3-responsive w3-card-4'>";
            if ($result = mysqli_query($conn, $sql)) {
                echo "<table class='w3-table-all'>";
                echo "	<tr>";
                echo "	  <th>Turma</th>";
                echo "	  <th>Usuario</th>";
				echo "	  <th>Disciplina</th>";
				echo "	  <th>Ano</th>";
				echo "	  <th>Semestre</th>";
				echo "	  <th> </th>";
				echo "	  <th> </th>";
                echo "	</tr>";
                if (mysqli_num_rows($result) > 0) {
                    // Apresenta cada linha da tabela
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cod = $row["ID_Turma"];
                        echo "<tr>";
                        echo "<td>";
                        echo $cod;
						echo "</td><td>";
                        echo $row["nome"];
                        echo "</td><td>";
                        echo $row["nomeDisc"];
						echo "</td><td>";	
                        echo $row["ano"];
						echo "</td><td>";
                        echo $row["semestre"];
                        echo "</td><td>";

						//Atualizar e Excluir registro de prof
				?>
                        <a href='turmaAtualizar.php?id=<?php echo $cod; ?>'><img src='imagens/Edit.png' title='Editar Turma' width='32'></a>
                        </td><td>
                        <a href='turmaExcluir.php?id=<?php echo $cod; ?>'><img src='imagens/Delete.png' title='Excluir Turma' width='32'></a>
                        </td>
                        </tr>
				 <?php
                    }
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p>&nbsp;Erro executando SELECT: " . mysqli_error($conn) . "</p>";
            }

            mysqli_close($conn);  //Encerra conexao com o BD

            ?>
        </div>
    </div>


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
