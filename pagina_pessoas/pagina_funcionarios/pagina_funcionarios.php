<?php
    include "../../verifica_sessao.php";
    include "../../conexao.php";
    ob_start();
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
                            <li><a href="../pagina_pessoas.php">Clientes</a></li>
                            <li><a class="active" href="../pagina_funcionarios/pagina_funcionarios.php">Funcionários</a></li>


                            </ul>
                        </div>

                        <ul>
                            <li><a href="../../pagina_venda/pagina_venda.php">Voltar</a></li>
                            <li><a href="../../logout/logout.php"><img src='assets/imagens/sair.png' /></a></li>
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
        <li><a href="../../pagina_venda/pagina_venda.php">Venda</a></li>
            <li><a href="../../pagina_estoque/pagina_estoque.php">Estoque</a></li>
            <li><a href="../../pagina_pessoas/pagina_pessoas.php">Clientes</a></li>
            <li><a href="../../pagina_pessoas/pagina_funcionarios/pagina_funcionarios.php">Funcionários</a></li>
            <li><a href="../../logout/logout.php">Sair</a></li>
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

                            $sql_code = "SELECT * FROM funcionarios WHERE NOME_FUNC LIKE '$pesquisa%' AND EMPRESAS_ID_EMP = '{$_SESSION['ID_EMP']}' LIMIT 10";
                        } else {
                            $sql_code = "SELECT * FROM funcionarios WHERE EMPRESAS_ID_EMP = '{$_SESSION['ID_EMP']}' LIMIT 10";
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
                                    <td><?php echo $row['NOME_FUNC']; ?></td>
                                    <td><?php echo $row['CPF_FUNC']; ?></td>
                                    

                                    <td><button
                                            onclick="consultaPessoa(<?php echo $row['ID_FUNC']; ?>,  '<?php echo addslashes( $row['NOME_FUNC']); ?>', '<?php echo addslashes($row['CPF_FUNC']); ?>')">+</button>
                                    </td>

                                </tr>
                                <?php
                            }
                            ?>


                        </table>

                    </div>
                             <!-- EDITAR EXCLUIR E CADASTRAR PRODUTOS -->
                    <div class="right">
                        <h1>Funcionário</h1>
                        <form class="form-produto" method="POST">

                            <input type="hidden" name="id-cliente" id="id-cliente" value="-1" />
                            
                            <label>Nome do Funcionário</label>
                            <input type="text" name="nome-cliente" id="nome-cliente"
                                placeholder="Digite o nome do cliente..." maxlength="45"required />                            
                            <label>CPF</label>
                            <input type="text" name="cpf-cliente" id="cpf-cliente"
                            maxlength="14" oninput="formatarCPF(this)" placeholder="000.000.000-00" required />
                            
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
                            if (isset($_POST['id-cliente']) && $_POST['id-cliente'] > -1) {
                                $id = (int) $_POST['id-cliente'];
                                $nome =  mysqli_real_escape_string($conn, $_POST['nome-cliente']);
                                
                                $cpf =  mysqli_real_escape_string($conn, $_POST['cpf-cliente']);
                                
                                

                                $sql = "UPDATE funcionarios SET NOME_FUNC='$nome', CPF_FUNC ='$cpf' WHERE ID_FUNC = '$id' AND EMPRESAS_ID_EMP = '{$_SESSION['ID_EMP']}'";
                                if ($conn->query($sql) === TRUE) {
                                    header("Location: " . $_SERVER['PHP_SELF']);
                                    exit;
                                } else {
                                    echo "Erro de Banco de dado: " . $conn->error;
                                }
                            } else if (isset($_POST["nome-cliente"])) {

                                $nome =  mysqli_real_escape_string($conn, $_POST['nome-cliente']);
                                
                                $cpf =  mysqli_real_escape_string($conn, $_POST['cpf-cliente']);

                                $sql = "INSERT INTO funcionarios (NOME_FUNC, CPF_FUNC, EMPRESAS_ID_EMP) VALUES ('$nome','$cpf', '{$_SESSION['ID_EMP']}')";

                                if ($conn->query($sql) === TRUE) {

                                    header("Location: " . $_SERVER['PHP_SELF']);
                                    exit;
                                } else {
                                    echo "Erro de Banco de dado: " . $conn->error;
                                }
                            }



                        } else if (isset($_POST["remover"])) {
                            if (isset($_POST['id-cliente']) && $_POST['id-cliente'] > -1) {
                                $id = $id = (int) $_POST['id-cliente'];
                                $sql = "DELETE FROM funcionarios WHERE ID_FUNC = '$id'AND EMPRESAS_ID_EMP = '{$_SESSION['ID_EMP']}' ";
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