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
    <title>Venda</title>
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
                        <ul>
                            <li><a href="../pagina_venda.php">Voltar</a></li>

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
                    <div class="procurar-tabela">
                        <h1>Busca de Cliente</h1>
                        <form class="form-cliente">
                            <div class="procurar-cliente">
                                <input type="text" name="nome-cliente" placeholder="Procure o Nome do Cliente..." />
                                <button><img src="assets/imagens/lupa.png" /></button>
                            </div>

                        </form>

                        <table>
                            <tr>
                                <td>Carlos</td>
                                <td> 0002222</td>
                                <td><button>+</button></td>
                            </tr>
                            
                           
                        </table>
                    </div>



                </div>



            </div>

        </div>
    </section>
</body>

</html>