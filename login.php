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
    session_start(); // infomra ao PHP que iremos trabalhar com sessão
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
        die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
    }

    $usuario = mysqli_real_escape_string($conn, $_POST['Login']);
    $senha   = mysqli_real_escape_string($conn, $_POST['Senha']);
    
    // Configura para trabalhar com caracteres acentuados do português
    mysqli_query($conn,"SET NAMES 'utf8'");
    mysqli_query($conn,'SET character_set_connection=utf8');
    mysqli_query($conn,'SET character_set_client=utf8');
    mysqli_query($conn,'SET character_set_results=utf8');

    // Faz Select na Base de Dados
    $sql = "SELECT nome, foto, t.nomeTipo FROM TB_Usuario as U, TB_TipoUsuario as T WHERE u.ID_TipoUsu = t.ID_TipoUsu AND login = '$usuario' AND senha = md5('$senha')";

    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION ['login']       = $usuario;
            $_SESSION ['nomeTipoUsu'] = $row['nomeTipo'];
            $_SESSION ['nome']        = $row['nome'];
            $_SESSION ['foto']        = $row['foto'];
            unset($_SESSION['nao_autenticado']);
            header('location: professor.php');
            exit();
        }else{
            $_SESSION ['nao_autenticado'] = true;
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