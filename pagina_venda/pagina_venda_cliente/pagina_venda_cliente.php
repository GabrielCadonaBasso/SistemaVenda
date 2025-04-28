<?php
include "../../conexao.php";
include "../../verifica_sessao.php";


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
                                <td><button>+</button></td>
                                
                            </tr>
                            <?php
                            }
                            ?>


                        </table>
                    </div>



                </div>



            </div>

        </div>
    </section>
</body>

</html>