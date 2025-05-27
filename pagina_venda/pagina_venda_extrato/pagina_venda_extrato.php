<?php

include "../../conexao.php";
include "../../verifica_sessao.php";
ob_start();
date_default_timezone_set('America/Sao_Paulo');
$data = $_GET['data-venda'] ?? date('Y-m-d');


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <title>Extrato de vendas</title>
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
                        <h1>Extrato de Vendas</h1>

                        <form class="form-cliente">
                            <input type="date" id="data-venda" name="data-venda" value="<?= htmlspecialchars($data); ?>"/>
                            <div class="procurar-cliente">
                                <input type="text" name="pesquisa" placeholder="Procure o Nome do Cliente..." />
                                <button ><img src="assets/imagens/lupa.png" /></button>
                            </div>

                        </form>
                        <?php
                            if (isset($_GET['pesquisa'])) {
                                $pesquisa = $_GET['pesquisa'];


                                $pesquisa = mysqli_real_escape_string($conn, $pesquisa);

                                 $sql_code = "SELECT *, DATE_FORMAT(DATA_VENDA, '%H:%i:%s') AS HORARIO_VENDA FROM vendas  WHERE EMPRESAS_ID_EMP = '{$_SESSION['ID_EMP']}' AND DATE(DATA_VENDA) = '$data' AND  CLIENTES_ID_CL LIKE '$pesquisa%' ";
                            } else {
                                 $sql_code = "SELECT *, DATE_FORMAT(DATA_VENDA, '%H:%i:%s') AS HORARIO_VENDA FROM vendas  WHERE EMPRESAS_ID_EMP = '{$_SESSION['ID_EMP']}' AND DATE(DATA_VENDA) = '$data' ";
                            }
                        ?>

                        <table>
                            <?php

                            $result = mysqli_query($conn, $sql_code);
                            if (!$result) {
                                echo "Erro na consulta: " . mysqli_error($conn);
                            } else {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['HORARIO_VENDA']; ?></td>
                                <td><?php echo $row['CLIENTES_ID_CL']; ?></td>
                                <td><?php echo "R$ ". $row['TOTAL_VENDA']; ?></td>
                                <td><?php echo $row['METODO_PAGAMENTO']; ?></td>
                                <td>
                                    <form action="../pagina_venda_detalhes/pagina_venda_detalhes.php" method="get" style="margin:0;">
                                        <input type="hidden" name="id_venda" value="<?php echo $row['ID_VEND']; ?>">
                                        <button type="submit">i</button>
                                    </form>
                                </td>
                               
                            </tr>
                            <?php
                                }
                            }
                            ob_end_flush();
                            ?>


                        </table>
                        <form method="post" id="form-cliente-sessao">
                            <input type="hidden" id="id_cliente_sessao" name="id_cliente_sessao"/>
                            <input type="hidden" id="nome_cliente_sessao" name="nome_cliente_sessao"/>
                        </form>
                        
                        <?php 
                            if(isset($_POST['id_cliente_sessao'])){
                                $_SESSION['id_cliente'] = $_POST['id_cliente_sessao'];
                                $_SESSION['nome_cliente'] = $_POST['nome_cliente_sessao'];

                                
                                header('location: ../pagina_venda.php');
                            }
                        ?>
                    </div>



                </div>



            </div>

        </div>
    </section>
    <script src="assets/js/script.js"></script>
</body>

</html>