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
                        <li><a  class="active" href="../pagina_venda/pagina_venda.php">Venda</a></li>
                            <li><a  href="../pagina_estoque/pagina_estoque.php">Estoque</a></li>
                            <li><a href="../pagina_pessoas/pagina_pessoas.php">Pessoas</a></li>
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
                        <form>
                            <label> Nome do Produto</label>
                            <input type="text" name="produto" placeholder="Nome do Produto" />
                            <label>Código do Produto</label>
                            <input type="number" name="produto" placeholder="Código do Produto" />
                            <div class='dual-input'>
                                <div class="single-input">
                                    <label>Quantidade<br /></label>
                                    <input type="number" name="quantidade" placeholder="Quantidade" />
                                </div>
                                <div class="single-input">
                                    <label>Preço de Venda <br /></label>
                                    <input type="text" name="preco-venda" placeholder="Preço de Venda" step="0.01" />
                                </div>
                            </div>

                            <label>Descrição<br /></label>
                            <textarea placeholder="Descrição"></textarea>
                            <div class='dual-input'>
                                <button class="vermelho">Excluir</button>
                                <button class="verde">Adicionar</button>

                            </div>
                        </form>
                    </div>


              
            </div>

        </div>
    </section>
</body>

</html>