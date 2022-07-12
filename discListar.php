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

<body onload="w3_show_nav('menuDisc')">
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
                <h2>Listagem de Disciplinas</h2>
                </div>

                <!-- Acesso ao BD-->
                <?php

                // Verifica conexão
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
                $sql = "SELECT ID_Disciplina, NomeDisc, Ementa, FotoBin FROM TB_Disciplina";

                echo "<div class='w3-responsive w3-card-4'>";
                if ($result = mysqli_query($conn, $sql)) {
                    echo "<table class='w3-table-all'>";
                    echo "	<tr>";
                    echo "	  <th width='7%'>Código</th>";
                    echo "	  <th width='20%'>Nome</th>";
                    echo "	  <th width='30%'>Ementa</th>";
                    echo "	  <th width='29%' style='text-align:center;'>Imagem</th>";
                    echo "	  <th width='7%'> </th>";
                    echo "	  <th width='7%'> </th>";
                    echo "	</tr>";
                    if (mysqli_num_rows($result) > 0) {
                        // Apresenta cada linha da tabela
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cod = $row["ID_Disciplina"];
                            echo "<tr>";
                            echo "<td>";
                            echo $cod;
                            echo "</td><td>";
                            echo $row["NomeDisc"];
                            echo "</td><td>";
                            echo $row["Ementa"];
                            echo "</td>";
                            if ($row['FotoBin']) { ?>
                                <td style="text-align:center">
                                    <img id="imagemSelecionada" src="data:image/png;base64,<?= base64_encode($row['FotoBin']) ?>" />
                                </td>
                                <?php
                            } else {
                                ?>
                                <td style="text-align:center">
                                    <img id="imagemSelecionada" src="imagens/imagem.png" />
                                </td>
                                <?php
                            }
                            //Atualizar e Excluir registro de disciplina
                                ?>
                                <td>
                                <a href='discAtualizar.php?id=<?php echo $cod; ?>'><img src='imagens/Edit.png' title='Editar Disciplina' width='32'></a>
                                </td>
                                <td>
                                    <a href='discExcluir.php?id=<?php echo $cod; ?>'><img src='imagens/Delete.png' title='Excluir Disciplina' width='32'></a>
                                </td>
                                </tr>
                    <?php

                        }
                    }
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "Erro executando SELECT: " . mysqli_error($conn);
                }

                mysqli_close($conn);  //Encerra conexao com o BD

                    ?>
            </div>
        </div>


        <footer class="w3-panel w3-padding w3-card-4 w3-light-grey w3-center w3-opacity">
            <p>
            <nav>
                <a class="w3-btn w3-theme w3-hover-white" onclick="document.getElementById('id01').style.display='block'">Sobre</a>
            </nav>
            </p>
        </footer>

        <!-- FIM PRINCIPAL -->
    </div>
    <!-- Inclui RODAPE.PHP  -->
    <?php require 'rodape.php'; ?>
</body>

</html>