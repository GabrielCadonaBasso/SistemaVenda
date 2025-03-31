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

    if (!isset($_SESSION['CNPJ_EMP']) || !isset($_SESSION['SENHA_EMP'])){
        header("Location: ../login_empresas/login_empresas.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <title>Login</title>
</head>

<body>
    <header>
        <div class="header">
            <div class="container">
                <div class="logo">
                    <h1>Sistema de Vendas</h1>
                </div>
                <div class="menu">
                    <nav>
                        <ul>
                            <li><a class="active" href="">Venda</a></li>
                            <li><a href="">Estoque</a></li>
                            <li><a href="">Pessoas</a></li>
                            <li><a href="../logout/logout.php">Sair</a></li>
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
           <div class="botoes">
                <a href=""> 
                   Realizar Vendas 
                </a>
                <a href=""> 
                    Histórico de Venda
                 </a>
                 <a href=""> 
                     Saídas
                 </a>
           </div>
        </div>
    </section>
</body>
</html>