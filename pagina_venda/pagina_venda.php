<?php
    include "../conexao.php";
    include "../verifica_sessao.php";
    
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
                        <h1>Dados</h1>
                        <div class="dados-pessoas">
                            <div class="select-colaborador">
                                <label>Colaborador</label>
                                <select>
                                    <option>Selcione o Colaborador</option>
                                    <?php
                                        $sql_code= "select * from funcionarios where EMPRESAS_ID_EMP = '{$_SESSION['ID_EMP']}'";
                                        $result = mysqli_query($conn, $sql_code);
                                    if (!$result) {
                                        echo "Erro na consulta: " . mysqli_error($conn);
                                    }
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>

                                    <option><?php echo $row['NOME_FUNC'] ?> </option>
                                    <?php } ?>
                                </select>

                            </div>

                            <form class="form-cliente" method="get"
                                action="pagina_venda_cliente/pagina_venda_cliente.php">
                                <label>Cliente</label>
                                <div class="procurar-cliente">
                                    <input type="text" name="cliente" placeholder="Nome do cliente" />
                                    <button><img src="assets/imagens/lupa.png" /></button>
                                </div>


                            </form>



                        </div>

                        
                    </div>
                    <div class="right">
                        <h1>Venda</h1>
                    </div>
                </div>



            </div>

        </div>
    </section>
</body>

</html>