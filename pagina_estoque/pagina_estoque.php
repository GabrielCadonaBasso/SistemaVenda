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
    <title>Estoque</title>
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
                            <li><a href="../pagina_venda/pagina_venda.php">Venda</a></li>
                            <li><a class="active" href="../pagina_estoque/pagina_estoque.php">Estoque</a></li>
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
                    <div class="left">
                        <h1>Consulta</h1>
                        <form class="form-procurar">
                            <input type="text" name="pesquisa" placeholder="Pesquise aqui um produto..." />
                            <button> <img src="assets/imagens/lupa.png" /></button>
                        </form>
                        <?php
                        if (isset($_GET['pesquisa'])) {
                            $pesquisa = $_GET['pesquisa'];

                            
                            $pesquisa = mysqli_real_escape_string($conn, $pesquisa);

                            $sql_code = "SELECT * FROM produtos WHERE NOME_PROD LIKE '$pesquisa%' LIMIT 10";
                        } else {
                            $sql_code = "SELECT * FROM produtos LIMIT 10";
;
                        }
                        ?>

                        <table id="tabelaBusca">
                            <?php

                            $sql_query = mysqli_query($conn, $sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
                            $aux = 0;
                            
                            while ($row = mysqli_fetch_assoc($sql_query)) {
                                ?>
                                <tr>
                                
                                    <td><?php echo $row['NOME_PROD']; ?></td>
                                    <td><?php echo $row['QUANTIDADE_PROD'] . " ". $row['UNIDADEMEDIDA_PROD']; ?></td>

                                    <td><button onclick="consultaProduto(<?php echo $row['ID_PROD']; ?>, <?php echo $aux ?>)">+</button></td>
                                
                                </tr>
                                <?php $aux++; } ?>


                        </table>

                    </div>

                    <div class="right">
                        <h1>Produto</h1>
                        <form class="form-produto">
                            <label>Código</label>
                            <input type="text" name="codigo-produto" />
                            <label>Nome do Produto</label>
                            <input type="text" name="nome-produto" />
                            <label>Fornecedor</label>
                            <input type="text" name="fornecedor-produto" />
                            <div class="preco-quantia">
                                <div class="quantia">
                                    <label>Quantidade</label><br>
                                    <input type="number" name="quantidade-produto" />
                                </div>
                                <div class="preco">
                                    <label>Preço</label><br>
                                    <input type="number" step="0.01" name="preco-produto" />
                                </div>

                            </div>
                            <div class="preco-quantia">
                                <div class="quantia">
                                    <button class="laranja">Remover</button>
                                </div>
                                <div class="preco">
                                    <button class="verde">Salvar</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>



            </div>

        </div>
    </section>
    <script src="assets/js/script.js"></script>
</body>

</html>