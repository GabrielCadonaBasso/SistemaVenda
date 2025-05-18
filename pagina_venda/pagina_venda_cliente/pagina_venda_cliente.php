<?php

include "../../conexao.php";
include "../../verifica_sessao.php";
ob_start();
if (isset($_SESSION['id_cliente']) && isset($_SESSION['nome_cliente'])){
    unset($_SESSION['id_cliente']);
    unset($_SESSION['nome_cliente']);
    
    
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
                                <input type="text" name="pesquisa" placeholder="Procure o Nome do Cliente..." />
                                <button ><img src="assets/imagens/lupa.png" /></button>
                            </div>

                        </form>
                        <?php
                            if (isset($_GET['pesquisa'])) {
                                $pesquisa = $_GET['pesquisa'];


                                $pesquisa = mysqli_real_escape_string($conn, $pesquisa);

                                $sql_code = "SELECT * FROM clientes WHERE NOME_CL LIKE '$pesquisa%' AND EMPRESAS_ID_EMP = '{$_SESSION['ID_EMP']}' LIMIT 10";
                            } else {
                                $sql_code = "SELECT * FROM clientes WHERE EMPRESAS_ID_EMP = '{$_SESSION['ID_EMP']}' LIMIT 10";
                            }
                        ?>

                        <table>
                            <?php

                            $result = mysqli_query($conn, $sql_code);
                            if (!$result) {
                                echo "Erro na consulta: " . mysqli_error($conn);
                            }
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['NOME_CL']; ?></td>
                                <td><?php echo $row['RG_CL']; ?></td>
                                <td><?php echo $row['CPF_CL'] ; ?></td>
                                <td><button name='PegarCliente' onclick="PegarCliente(<?php echo $row['ID_CL'];?>,'<?php echo $row['NOME_CL']; ?>')">+</button></td>
                                
                            </tr>
                            <?php
                            
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