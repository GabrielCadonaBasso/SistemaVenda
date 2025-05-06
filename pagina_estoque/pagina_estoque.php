<?php
include "../conexao.php";
include "../verifica_sessao.php";
ob_start();
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
                    <div class="menu-mobile" id="menu-mobile" onclick="menu()">
                        <div class="menu-item"></div>
                        <div class="menu-item"></div>
                        <div class="menu-item"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="sidebar" id="sidebar" >
        <div id="fechar" onclick="fechar()">x</div>
        <ul>
            <li><a href="../pagina_venda/pagina_venda.php">Venda</a></li>
            <li><a href="../pagina_estoque/pagina_estoque.php">Estoque</a></li>
            <li><a href="../pagina_pessoas/pagina_pessoas.php">Clientes</a></li>
            <li><a href="../pagina_pessoas/pagina_funcionarios/pagina_funcionarios.php">Funcionários</a></li>
            <li><a href="../logout/logout.php">Sair</a></li>
        </ul>
    </div>
    <section class="main">
        <div class="container">
            <div class="area">

                <div class="square">
                    <div class="left">
                        <!-- PESQUISAR PRODUTOS -->
                        <h1>Consulta</h1>
                        <form class="form-procurar" method="get">
                            <input type="text" name="pesquisa" placeholder="Pesquise aqui um produto..." />
                            <button> <img src="assets/imagens/lupa.png" /></button>
                        </form>
                        <?php
                        if (isset($_GET['pesquisa'])) {
                            $pesquisa = $_GET['pesquisa'];


                            $pesquisa = mysqli_real_escape_string($conn, $pesquisa);

                            $sql_code = "SELECT * FROM produtos WHERE NOME_PROD LIKE '$pesquisa%' AND EMPRESAS_ID_EMP = '{$_SESSION['ID_EMP']}' LIMIT 10";
                        } else {
                            $sql_code = "SELECT * FROM produtos WHERE EMPRESAS_ID_EMP = '{$_SESSION['ID_EMP']}' LIMIT 10";
                        }
                        ?>
                         <!-- Exibição PRODUTOS -->
                        <table id="tabelaBusca">
                            <?php

                            $result = mysqli_query($conn, $sql_code);
                            if (!$result) {
                                echo "Erro na consulta: " . mysqli_error($conn);
                            }

                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['NOME_PROD']; ?></td>
                                    <td><?php echo $row['QUANTIDADE_PROD'] . " UN"; ?></td>
                                    <td><?php echo "R$ " . $row['PRECO_PROD']; ?></td>
                                    <td><button
                                            onclick="consultaProduto(<?php echo $row['ID_PROD']; ?>, '<?php echo addslashes($row['NOME_PROD']); ?>','<?php echo addslashes($row['FORNECEDOR_PROD']); ?>',<?php echo $row['QUANTIDADE_PROD']; ?>, <?php echo $row['PRECO_PROD']; ?>)">+</button>
                                    </td>

                                </tr>
                                <?php
                            }
                            ?>


                        </table>

                    </div>
                             <!-- EDITAR EXCLUIR E CADASTRAR PRODUTOS -->
                    <div class="right">
                        <h1>Produto</h1>
                        <form class="form-produto" method="POST">

                            <input type="hidden" name="id-produto" id="id-produto" value="-1" />
                            <label>Nome do Produto</label>
                            <input type="text" name="nome-produto" id="nome-produto"
                                placeholder="Digite o nome do produto..." required />
                            <label>Fornecedor</label>
                            <input type="text" name="fornecedor-produto" id="fornecedor-produto"
                                placeholder="Digite o fornecedor do produto..." required />
                            <div class="preco-quantia">
                                <div class="quantia">
                                    <label>Quantidade</label><br>
                                    <input type="number" name="quantidade-produto" id="quantidade-produto"
                                        placeholder="Qtd do produto..." required />
                                </div>
                                <div class="preco">
                                    <label>Preço</label><br>
                                    <input type="number" step="0.01" name="preco-produto" id="preco-produto"
                                        placeholder="Preço do produto..." required />
                                </div>

                            </div>
                            <div class="preco-quantia">
                                <div class="quantia">
                                    <button class="vermelho" name="remover">Remover</button>
                                </div>
                                <div class="quantia">
                                    <button onclick="limparCampos()" class="laranja" name="cancelar">Cancelar</button>
                                </div>
                                <div class="preco">
                                    <button class="verde" name="salvar">Salvar</button>
                                </div>

                            </div>
                        </form>

                        <?php
                        if (isset($_POST['salvar'])) {
                            if (isset($_POST['id-produto']) && $_POST['id-produto'] > -1) {
                                $id = (int) $_POST['id-produto'];
                                $quantidade = (int) $_POST['quantidade-produto'];
                                $preco = (float) $_POST['preco-produto'];
                                $produto = mysqli_real_escape_string($conn, $_POST['nome-produto']);
                                $fornecedor = mysqli_real_escape_string($conn, $_POST['fornecedor-produto']);

                                $sql = "UPDATE produtos SET NOME_PROD = '$produto', FORNECEDOR_PROD ='$fornecedor', QUANTIDADE_PROD = '$quantidade', PRECO_PROD = '$preco' WHERE ID_PROD = '$id' AND EMPRESAS_ID_EMP = '{$_SESSION['ID_EMP']}'";
                                if ($conn->query($sql) === TRUE) {
                                    header("Location: " . $_SERVER['PHP_SELF']);
                                    exit;
                                } else {
                                    echo "Erro de Banco de dado: " . $conn->error;
                                }
                            } else if (isset($_POST["nome-produto"])) {

                                $quantidade = (int) $_POST['quantidade-produto'];
                                $preco = (float) $_POST['preco-produto'];
                                $produto = mysqli_real_escape_string($conn, $_POST['nome-produto']);
                                $fornecedor = mysqli_real_escape_string($conn, $_POST['fornecedor-produto']);

                                $sql = "INSERT INTO produtos (NOME_PROD, FORNECEDOR_PROD, QUANTIDADE_PROD, PRECO_PROD, EMPRESAS_ID_EMP) VALUES ('$produto', '$fornecedor', '$quantidade', '$preco', '{$_SESSION['ID_EMP']}')";

                                if ($conn->query($sql) === TRUE) {

                                    header("Location: " . $_SERVER['PHP_SELF']);
                                    exit;
                                } else {
                                    echo "Erro de Banco de dado: " . $conn->error;
                                }
                            }



                        } else if (isset($_POST["remover"])) {
                            if (isset($_POST['id-produto']) && $_POST['id-produto'] > -1) {
                                $id = $id = (int) $_POST['id-produto'];
                                $sql = "DELETE FROM produtos WHERE ID_PROD = '$id'";
                                if ($conn->query($sql) === TRUE) {
                                    header("Location:" . $_SERVER["PHP_SELF"]);
                                    exit;
                                } else {
                                    echo "Erro de Banco de dado:" . $conn->error;
                                }

                            }

                        }

                        ob_end_flush();
                        ?>

                    </div>
                </div>



            </div>

        </div>
    </section>
    <script src="assets/js/script.js"></script>
</body>

</html>