<?php

include "../../conexao.php";
include "../../verifica_sessao.php";
ob_start();
if (isset($_SESSION['id_colaborador']) && isset($_SESSION['nome_colaborador'])){
    unset($_SESSION['id_colaborador']);
    unset($_SESSION['nome_colaborador']);
    
    
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
                        <h1>Busca de Colaborador</h1>
                        <form class="form-cliente">
                            <div class="procurar-cliente">
                                <input type="text" name="pesquisa" placeholder="Procure o Nome do Colaborador..." />
                                <button ><img src="assets/imagens/lupa.png" /></button>
                            </div>

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

                        <table>
                            <?php

                            $result = mysqli_query($conn, $sql_code);
                            if (!$result) {
                                echo "Erro na consulta: " . mysqli_error($conn);
                            }
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['NOME_FUNC']; ?></td>
                                
                                <td><?php echo $row['CPF_FUNC'] ; ?></td>
                                <td><button name='PegarCliente' onclick="PegarCliente(<?php echo $row['ID_FUNC'];?>,'<?php echo $row['NOME_FUNC']; ?>')">+</button></td>
                                
                            </tr>
                            <?php
                            
                            }
                            ob_end_flush();
                            ?>


                        </table>
                        <form method="post" id="form-colaborador-sessao">
                            <input type="hidden" id="id_colaborador_sessao" name="id_colaborador_sessao"/>
                            <input type="hidden" id="nome_colaborador_sessao" name="nome_colaborador_sessao"/>
                        </form>
                        
                        <?php 
                            if(isset($_POST['id_colaborador_sessao'])){
                                $_SESSION['id_colaborador'] = $_POST['id_colaborador_sessao'];
                                $_SESSION['nome_colaborador'] = $_POST['nome_colaborador_sessao'];

                                
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