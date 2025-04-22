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
                                <li><a class="active" href="../pagina_pessoas/pagina_pessoas.php">Clientes</a></li>
                                <li><a
                                        href="../pagina_pessoas/pagina_funcionarios/pagina_funcionarios.php">Funcionários</a>
                                </li>


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
                        <h1>Consulta</h1>
                        <form class="form-procurar" method="get">
                            <input type="text" name="pesquisa" placeholder="Pesquise aqui um cliente..."
                                value="todos clientes" />
                            <button> <img src="assets/imagens/lupa.png" /></button>
                        </form>
                        <?php
                        if (isset($_GET['pesquisa']) && $_GET['pesquisa'] != "todos clientes") {
                            $pesquisa = $_GET['pesquisa'];


                            $pesquisa = mysqli_real_escape_string($conn, $pesquisa);

                            $sql_code = "SELECT * FROM clientes WHERE NOME_CL LIKE '$pesquisa%' LIMIT 10";
                        } elseif (isset($_GET['pesquisa']) && $_GET['pesquisa'] == "todos clientes") {
                            $sql_code = "SELECT * FROM clientes";

                        } else {
                            $sql_code = "SELECT * FROM clientes LIMIT 10";
                        }
                        ?>

                        <table id="tabelaBusca">
                            <?php
                            
                            $sql_query = mysqli_query($conn, $sql_code) or die("Falha na execução do código SQL: " . mysqli_error($conn));
                            $aux = 0;

                            while ($row = mysqli_fetch_assoc($sql_query)) {
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['NOME_CL']); ?></td>
                                    <td><?php echo htmlspecialchars($row['RG_CL']); ?></td>
                                    <td><?php echo htmlspecialchars($row['CPF_CL']); ?></td>
                                    <td>
                                        <button onclick="consultaProduto(
                                            <?php echo $row['ID_CL']; ?>,
                                            '<?php echo addslashes($row['NOME_CL']); ?>',
                                            '<?php echo addslashes($row['RG_CL']); ?>',
                                            '<?php echo addslashes($row['CPF_CL']); ?>'
                                        )">+</button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>


                        </table>

                    </div>

                    <div class="right">
                        <h1>Clientes</h1>
                        <form class="form-produto" method="POST">

                            <input type="hidden" name="id-cliente" id="id-cliente" value="-1" />
                            <label></label>

                            <label>Nome do Cliente</label>
                            <input type="text" name="nome-cliente" id="nome-cliente"
                                placeholder="Digite o nome do cliente..." required />
                            <label>RG</label>
                            <input type="text" name="rg-cliente" id="rg-cliente" placeholder="Digite o RG do cliente..."
                                required />
                            <input type="text" name="cpf-cliente" id="cpf-cliente"
                                placeholder="Digite o CPF do cliente..." required />

                            <div class="preco-quantia">
                                <div class="quantia">
                                    <button class="laranja" name="remover">Remover</button>
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


                                $nome = mysqli_real_escape_string($conn, $_POST['nome-cliente']);
                                $rg = mysqli_real_escape_string($conn, $_POST['rg-cliente']);
                                $cpf = mysqli_real_escape_string($conn, $_POST['cpf-cliente']);

                                $sql = "UPDATE clientes SET NOME_CL='$nome', RG_CL = '$rg', CPF_CL ='$cpf' WHERE ID_CL = '$id'";
                                if ($conn->query($sql) === TRUE) {
                                    header("Location: " . $_SERVER['PHP_SELF']);
                                    exit;
                                } else {
                                    echo "Erro de Banco de dado: " . $conn->error;
                                }
                            } else if (isset($_POST["nome-cliente"])) {


                                $nome = mysqli_real_escape_string($conn, $_POST['nome-cliente']);
                                $rg = mysqli_real_escape_string($conn, $_POST['rg-cliente']);
                                $cpf = mysqli_real_escape_string($conn, $_POST['cpf-cliente']);

                                $sql = "INSERT INTO clientes (NOME_CL, RG_CL, CPF_CL) VALUES ('$nome', '$rg', '$cpf')";

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
                                $sql = "DELETE FROM clientes WHERE ID_CL = '$id'";
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

        </div>
    </section>
    <script src="assets/js/script.js"></script>
</body>

</html>