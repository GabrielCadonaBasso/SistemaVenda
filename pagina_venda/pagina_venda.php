<?php
include "../conexao.php";
include "../verifica_sessao.php";
$nomeCliente = $_SESSION['nome_cliente'] ?? '';
$idCliente= $_SESSION['id_cliente'] ?? '';
$nomeColaborador = $_SESSION['nome_colaborador'] ?? '';
$id_colaborador = $_POST['id_colaborador'] ?? '';


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
                        <h1>Dados</h1>
                        <div class="dados-pessoas">
                           
                            <form class="form-cliente" method="get" action="pagina_venda_cliente/pagina_venda_cliente.php">
                                <label>Cliente</label>
                                <div class="procurar-cliente">
                                    <input type="text" name="cliente" value="<?= htmlspecialchars($nomeCliente, ENT_QUOTES) ?>" id="clienteInput" placeholder="Cliente..." readonly />
                                    <button ><img src="assets/imagens/lupa.png" /></button>
                                </div>


                            </form>
                            <form method="post" class="form-colaborador" action="pagina_venda_colaborador/pagina_venda_colaborador.php">
                             
                                <label>Colaborador</label>
                                <div class="procurar-colaborador">
                                    <input type="text" name="colaborador" value="<?= htmlspecialchars($nomeColaborador, ENT_QUOTES) ?>" id="colaboradorInput" placeholder="Colaborador..." readonly />
                                    <button ><img src="assets/imagens/lupa.png" /></button>
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
                        <h1>Venda</h1>
                        <div class="selecionar-quantidade">
                            <form class="selecionar-quantidade-form">
                                <input type="hidden" id="id-produto" name="id-produto"/>
                                <div class="campo-selecao produto">
                                    <label>Produto</label>
                                    <input type="text" id="nome-produto" name="nome-produto"  readonly/>
                                </div>
                                <div class="campo-selecao quantidade">
                                     <label>Qtd</label>
                                    <input type="number" id="qtd-produto" name="qtd-produto"/>
                                </div>
                                <div class="campo-selecao preco-total">
                                    <label>Preço Total</label>
                                    <input type="number" id="preco-total" name="preco-total" readonly data-preco-unitario="0"/>
                                </div>
                                <div class="botao-form">
                                    <button>ADD</button>
                                </div>
                                <div class="botao-form">
                                    <button>Limpar</button>
                                </div>
                            </form>
                            <?php
                                // if (isset($_POST['id-produto'])){
                                //     if(isset($_SESSION['idvenda'])){
                                        
                                //     }else{
                                //         $dataAtual = date('Y-m-d');
                                        
                                //         $_SESSION['idvenda']
                                //     }
                                // }
                            
                            ?>
                            <!-- Tabela de Itens  -->
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </section>
    <script src="assets/js/script.js"></script>
</body>

</html>