<?php
include "../conexao.php";
include "../verifica_sessao.php";
ob_start();
$nomeCliente = $_SESSION['nome_cliente'] ?? '';
$idCliente = $_SESSION['id_cliente'] ?? '';
$nomeColaborador = $_SESSION['nome_colaborador'] ?? '';
$id_colaborador = $_SESSION['id_colaborador'] ?? '';


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
                            <li><a class="active" href="../pagina_venda/pagina_venda.php">Venda</a></li>
                            <li><a href="../pagina_estoque/pagina_estoque.php">Estoque</a></li>
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
    <div class="sidebar" id="sidebar">
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
                        <h1>Dados</h1>
                        <div class="dados-pessoas">

                            <form class="form-cliente" method="get"
                                action="pagina_venda_cliente/pagina_venda_cliente.php">
                                <label>Cliente</label>
                                <div class="procurar-cliente">
                                    <input type="text" name="cliente"
                                        value="<?= htmlspecialchars($nomeCliente, ENT_QUOTES) ?>" id="clienteInput"
                                        placeholder="Cliente..." readonly />
                                    <button><img src="assets/imagens/lupa.png" /></button>
                                </div>


                            </form>
                            <form method="post" class="form-colaborador"
                                action="pagina_venda_colaborador/pagina_venda_colaborador.php">

                                <label>Colaborador</label>
                                <div class="procurar-colaborador">
                                    <input type="text" name="colaborador"
                                        value="<?= htmlspecialchars($nomeColaborador, ENT_QUOTES) ?>"
                                        id="colaboradorInput" placeholder="Colaborador..." readonly />
                                    <button><img src="assets/imagens/lupa.png" /></button>
                                </div>


                            </form>


                        </div>
                        <div class="selecao-produto">
                            <h1>Seleção de Produto</h1>

                        </div>
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
                    <div class="right">
                        <div class="titulo-extrato">
                            <div class="botao-extrato">

                            </div>
                            <h1>Venda</h1>
                            <div class="botao-extrato">
                                <form action="pagina_venda_extrato/pagina_venda_extrato.php">
                                    <button><img src='assets/imagens/extrato-bancario.png' /></button>
                                </form>

                            </div>
                        </div>

                        <div class="selecionar-quantidade">
                            <form class="selecionar-quantidade-form" method="post">
                                <input type="hidden" id="id-produto" name="id-produto" />
                                <div class="campo-selecao produto">
                                    <label>Produto</label>
                                    <input type="text" id="nome-produto" name="nome-produto" readonly />
                                </div>
                                <div class="campo-selecao quantidade">
                                    <label>Qtd</label>
                                    <input type="number" id="qtd-produto" name="qtd-produto" />
                                </div>
                                <div class="campo-selecao preco-total">
                                    <label>Preço Total</label>
                                    <input type="number" id="preco-total" name="preco-total" readonly
                                        data-preco-unitario="0" />
                                </div>
                                <div class="botao-form">
                                    <button id="botao-add" name="botao-add">ADD</button>
                                </div>
                                <div class="botao-form">
                                    <button id="botao-limpar" name="botao-limpar">Limpar</button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['botao-add']) && $_POST['id-produto'] != "") {
                                $idaux = $_POST['id-produto'];
                                $sql = "SELECT QUANTIDADE_PROD FROM produtos WHERE ID_PROD = $idaux";
                                $result = mysqli_query($conn, $sql);
                                if ($result && $row = mysqli_fetch_assoc($result)) {
                                    $quantidade_disponivel = (int) $row['QUANTIDADE_PROD'];
                                    $quantidade_solicitada = (int) $_POST["qtd-produto"];
                                    if ($quantidade_solicitada <= $quantidade_disponivel) {

                                        if (isset($_SESSION["id_venda"])) {
                                            $id_venda = $_SESSION["id_venda"];
                                            $nome_produto = mysqli_real_escape_string($conn, $_POST["nome-produto"]);
                                            $quant_itens = (int) $_POST["qtd-produto"];
                                            $preco_un = (float) $_POST["preco-total"] / max($quant_itens, 1);
                                            $preco_total = (float) $_POST["preco-total"];
                                            $id_produto = $_POST['id-produto'];
                                            $sql = "INSERT INTO produto_cupom (NOME_PRODUTO, QUANT_ITENS, PRECO_UN, PRECO_TOTAL, vendas_ID_VEND, ID_PROD) VALUES ('$nome_produto', '$quant_itens', '$preco_un', '$preco_total', '$id_venda', '$id_produto' )";
                                            mysqli_query($conn, $sql);

                                            // Atualiza o estoque
                                            $sql_update_estoque = "UPDATE produtos SET QUANTIDADE_PROD = QUANTIDADE_PROD - $quantidade_solicitada WHERE ID_PROD = $idaux";
                                            mysqli_query($conn, $sql_update_estoque);

                                            header("Location: pagina_venda.php");
                                            exit();

                                        } else {
                                            date_default_timezone_set('America/Sao_Paulo');
                                            $data_venda = date('Y-m-d H:i:s');
                                            $empresa = $_SESSION['ID_EMP'];

                                            $sql = "INSERT INTO vendas (DATA_VENDA, EMPRESAS_ID_EMP, CLIENTES_ID_CL, FUNCIONARIOS_ID_FUNC,METODO_PAGAMENTO)
                                                    VALUES ('$data_venda', '$empresa', '$nomeCliente', '$nomeColaborador', 'EM ANDAMENTO')";

                                            if (mysqli_query($conn, $sql)) {
                                                $id_venda = mysqli_insert_id($conn);
                                                $_SESSION['id_venda'] = $id_venda;
                                                $nome_produto = mysqli_real_escape_string($conn, $_POST["nome-produto"]);
                                                $quant_itens = (int) $_POST["qtd-produto"];
                                                $preco_un = (float) $_POST["preco-total"] / max($quant_itens, 1);
                                                $preco_total = (float) $_POST["preco-total"];
                                                $id_produto = $_POST['id-produto'];
                                                $sql = "INSERT INTO produto_cupom (NOME_PRODUTO, QUANT_ITENS, PRECO_UN, PRECO_TOTAL, vendas_ID_VEND, ID_PROD) VALUES ('$nome_produto', '$quant_itens', '$preco_un', '$preco_total', '$id_venda', '$id_produto' )";
                                                mysqli_query($conn, $sql);
                                                $id_produto_cupom = mysqli_insert_id($conn);
                                                $_SESSION['id_cupom'] = $id_produto_cupom;

                                                // Atualiza o estoque
                                                $sql_update_estoque = "UPDATE produtos SET QUANTIDADE_PROD = QUANTIDADE_PROD - $quantidade_solicitada WHERE ID_PROD = $idaux";
                                                mysqli_query($conn, $sql_update_estoque);

                                                header("Location: pagina_venda.php");
                                                exit();
                                            } else {
                                                echo "Erro ao registrar venda: " . mysqli_error($conn);
                                            }
                                        }
                                    } else {
                                        echo "<script>alert('Quantidade solicitada maior que disponível em estoque!');</script>";
                                    }
                                } else {
                                    echo "<div style='color:red;'>Produto não encontrado!</div>";
                                    exit();
                                }
                            }
                            

                            ?>
                            <!-- Tabela de Itens  -->
                        </div>
                        <div class="lista-compras">
                            <table>
                                <tr>
                                    <th>Produto</th>
                                    <th>QTD</th>
                                    <th>Preço UN</th>
                                    <th>Preco Total</th>
                                    <th></th>
                                </tr>
                                <?php
                                if (isset($_SESSION['id_venda'])) {
                                    $id_venda = $_SESSION['id_venda'];
                                    
                                    $venda = mysqli_query($conn, "SELECT * FROM produto_cupom WHERE vendas_ID_VEND = $id_venda ");
                                    if (!$venda) {
                                        echo "Erro na consulta: " . mysqli_error($conn);
                                    }

                                    while ($row = mysqli_fetch_assoc($venda)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['NOME_PRODUTO']; ?></td>
                                            <td><?php echo $row['QUANT_ITENS'] . " UN"; ?></td>
                                            <td><?php echo "R$ " . number_format($row['PRECO_UN'], 2, ',', '.'); ?></td>
                                            <td><?php echo "R$ " . number_format($row['PRECO_TOTAL'], 2, ',', '.'); ?></td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                        <?php
                                    }

                                }

                                ?>
                            </table>
                        </div>
                        <div class="valor-total-venda">
                            <div class="forms-total-venda">
                                <span>R$</span>
                                <input type="number" name="valor-total" id="valor-total" readonly />
                            </div>

                        </div>
                        <form class="form-finalizar" method="post">
                            <input type="hidden" name="valor-total" id="valor-total-hidden" />
                            <button class="vermelho" name="botao-cancelar-compra"
                                id="botao-cancelar-compra">CANCELAR</button>
                            <button class="verde" name="botao-finalizar-compra" id="botao-finalizar-compra">FINALIZAR
                                COMPRA</button>
                        </form>
                        <?php
                        if (isset($_POST['botao-cancelar-compra'])&& isset($_SESSION['id_venda'])) {
                            $id_venda = $_SESSION['id_venda'];
                            $sql = "SELECT ID_PROD, QUANT_ITENS FROM produto_cupom WHERE vendas_ID_VEND = $id_venda";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id_produto = $row['ID_PROD'];
                                $quantidade = $row['QUANT_ITENS'];
                                // Devolve a quantidade ao estoque
                                $sql_update = "UPDATE produtos SET QUANTIDADE_PROD = QUANTIDADE_PROD + $quantidade WHERE ID_PROD = $id_produto";
                                mysqli_query($conn, $sql_update);
                            }
                            mysqli_query($conn, "DELETE FROM produto_cupom WHERE vendas_ID_VEND = $id_venda");
                            mysqli_query($conn, "DELETE FROM vendas WHERE ID_VEND = $id_venda");
                            // Limpa sessões e redireciona
                            unset($_SESSION['id_colaborador']);
                            unset($_SESSION['nome_colaborador']);
                            unset($_SESSION['id_cliente']);
                            unset($_SESSION['nome_cliente']);
                            unset($_SESSION['id_cupom']);
                            unset($_SESSION['id_venda']);
                            header("Location: pagina_venda.php");
                            exit();
                        }
                        if (isset($_POST['botao-finalizar-compra'])) {
                            date_default_timezone_set('America/Sao_Paulo');
                            $data_venda = date('Y-m-d H:i:s');
                            $valorTotal = $_POST['valor-total'];
                            $id_venda = $_SESSION['id_venda'];
                            $idempresa = $_SESSION['ID_EMP'];
                            // Use os nomes, não os IDs!
                            $sql = "UPDATE vendas
                                    SET
                                        DATA_VENDA = '$data_venda',
                                        CLIENTES_ID_CL = '$nomeCliente',
                                        FUNCIONARIOS_ID_FUNC = '$nomeColaborador',
                                        TOTAL_VENDA = '$valorTotal',
                                        METODO_PAGAMENTO='FINALIZADA'
                                    WHERE
                                        ID_VEND = '$id_venda'
                                        AND EMPRESAS_ID_EMP = '$idempresa'";
                            if (!mysqli_query($conn, $sql)) {
                                echo "Erro ao registrar venda: " . mysqli_error($conn);
                            } else {

                                unset($_SESSION['id_colaborador']);
                                unset($_SESSION['nome_colaborador']);
                                unset($_SESSION['id_cliente']);
                                unset($_SESSION['nome_cliente']);
                                unset($_SESSION['id_cupom']);
                                unset($_SESSION['id_venda']);
                                header("Location: pagina_venda.php");
                                exit();
                            }
                        }
                        ?>
                    </div>
                </div>



            </div>

        </div>
        <?php ob_end_flush(); ?>
    </section>
    <script src="assets/js/script.js"></script>
</body>

</html>