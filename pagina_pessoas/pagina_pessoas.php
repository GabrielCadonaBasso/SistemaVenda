<?php
try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "SISTEMA";

    $conn = new mysqli($servidor, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

session_start();

if (!isset($_SESSION['CNPJ_EMP']) || !isset($_SESSION['SENHA_EMP'])) {
    header("Location: ../login_empresas/login_empresas.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <title>Pessoas</title>
</head>

<body>
    <header>
        <div class="header">
            <div class="container">
                <div class="logo">
                    <img src="assets/imagens/feitoAmao branco.png" />
                </div>
                <div class="menu">
                    <nav>
                        <div class="grupo-botoes">
                            <p>Pessoas</p>
                            <ul>
                                <li><a href="../pagina_pessoas/pagina_pessoas.php">Clientes</a></li>
                                <li><a href="../pagina_pessoas/pagina_funcionarios/pagina_funcionarios.php">Funcionários</a></li>


                            </ul>
                        </div>

                        <ul>
                            <li><a href="../pagina_venda/pagina_venda.php">Voltar</a></li>
                            <li><a href="../logout/logout.php"><img src='assets/imagens/sair.png' /></a></li>
                        </ul>
                    </nav>
                    <div class="menu-mobile">
                        <div class="menu-item"></div>
                        <div class="menu-item"></div>
                        <div class="menu-item"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="main">
        <div class="container">
            <div class="area">

                <div class="square">
                    <div class="left">

                    </div>
                    <div class="right">
                    </div>
                </div>



            </div>

        </div>
    </section>
</body>

</html>