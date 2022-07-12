<html>
	<head>

	  <title>IE - Instituição de Ensino</title>
	  <link rel="icon" type="image/png" href="imagens/IE_favicon.png" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" href="css/customize.css">
	</head>
<body>

<?php

    require 'bd/conectaBD.php'; 

    date_default_timezone_set("America/Sao_Paulo");
    $data = date("d/m/Y H:i:s",time());
    echo "<p class='w3-small' > ";
    echo "Acesso em: ";
    echo $data;
    echo "</p> ";

    // Cria conexão
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Verifica conexão
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        exit();
    }

    $usuario = mysqli_real_escape_string($conn, $_POST['Login']);
    $senha   = mysqli_real_escape_string($conn, $_POST['Senha']);
    
    // Configura para trabalhar com caracteres acentuados do português
    mysqli_query($conn,"SET NAMES 'utf8'");
    mysqli_query($conn,'SET character_set_connection=utf8');
    mysqli_query($conn,'SET character_set_client=utf8');
    mysqli_query($conn,'SET character_set_results=utf8');

    // Faz Select na Base de Dados
    $sql = "SELECT nome, ID_TipoUsu FROM TB_Usuario WHERE login = '$usuario' AND senha = md5('$senha')";

    echo $sql;
    echo"<br>";

    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION ['login'] = $usuario;
            $tipoUsu = $row['ID_TipoUsu'];
            $nome    = $row['nome'];
            $_SESSION ['tipo']  = $tipoUsu;
            $_SESSION ['nome']  = $nome;

            echo $tipoUsu;
            echo $nome;
            echo "";

            header('location: professor.php');
            exit();
        }else{
            header('location: index.php');
            exit();
        }
    }
    else {
        echo "Erro ao acessar o BD: " . mysqli_error($conn);
    }
    mysqli_close($conn);  //Encerra conexao com o BD
?>
	</body>
</html>