<?php

include "../../conexao.php";
include "../../verifica_sessao.php";
ob_start();
date_default_timezone_set('America/Sao_Paulo');

// Pega o id da venda pela URL
$id_venda = $_GET['id_venda'] ?? null;

if (!$id_venda) {
    echo "<div style='color:red;'>Venda não encontrada!</div>";
    header("location: ../pagina_venda_extrato/pagina_venda_extrato.php");
    exit();
}

// Busca dados da venda
$sql_venda = "SELECT * FROM vendas WHERE ID_VEND = '$id_venda' AND EMPRESAS_ID_EMP = '{$_SESSION['ID_EMP']}'";
$result_venda = mysqli_query($conn, $sql_venda);
$venda = mysqli_fetch_assoc($result_venda);

if (!$venda) {
    echo "<div style='color:red;'>Venda não encontrada!</div>";
    exit();
}

// Busca itens da venda
$sql_itens = "SELECT * FROM produto_cupom WHERE vendas_ID_VEND = '$id_venda'";
$result_itens = mysqli_query($conn, $sql_itens);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Detalhes da Venda</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
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
                        <div class="detalhes-venda">
                            <h1>Detalhes da Venda</h1>
                            <p>Data/Hora:
                                <?php echo date('d/m/Y H:i:s', strtotime($venda['DATA_VENDA'])); ?>
                            </p>
                            <p>Cliente: <?php echo htmlspecialchars($venda['CLIENTES_ID_CL']); ?></p>
                            <p>Vendedor:
                                <?php echo htmlspecialchars($venda['FUNCIONARIOS_ID_FUNC']); ?>
                            </p>
                            <p>Status: <?php echo htmlspecialchars($venda['METODO_PAGAMENTO']); ?></p>
                            <p>Total: R$
                                <?php echo number_format($venda['TOTAL_VENDA'], 2, ',', '.'); ?>
                            </p>
                        </div>

                        <div class="tabela">
                            <h2>Itens Comprados</h2>
                            <table>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Preço Unitário</th>
                                    <th>Preço Total</th>
                                </tr>
                                <?php while ($item = mysqli_fetch_assoc($result_itens)) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($item['NOME_PRODUTO']); ?></td>
                                        <td><?php echo $item['QUANT_ITENS']; ?></td>
                                        <td>R$ <?php echo number_format($item['PRECO_UN'], 2, ',', '.'); ?></td>
                                        <td>R$ <?php echo number_format($item['PRECO_TOTAL'], 2, ',', '.'); ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>

                        <br>
                        <a href="../pagina_venda_extrato/pagina_venda_extrato.php">Voltar ao Extrato</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>