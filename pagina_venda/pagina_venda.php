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
                                    <option>Lucas</option>
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

                        <h1>Produto</h1>
                        <div class="produto">
                            <form class="form-produto">
                                <div class="nome-quantidade">
                                    <div class="nome">
                                        <label>Produto</label>
                                        <span>
                                            <input type="text" placeholder="Procurar Produto..." />
                                            <button><img src="assets/imagens/lupa.png" /></button>
                                        </span>


                                    </div>
                                    <div class="quantidade">
                                        <label>Quantidade</label>
                                        <input type="number" step="0.01" placeholder="Quantidade" />
                                    </div>
                                    
                                </div>
                                <div class="nome-quantidade">
                                    <div class="nome">
                                        <label>Preço Unitário</label>
                                        <span>
                                            <input type="numeber" name="preco-unitario" disabled/>
                                            
                                        </span>


                                    </div>
                                    <div class="quantidade">
                                        <label>Preço Total</label>
                                        <input type="number" step="0.01" name="preco-total" disabled />
                                    </div>
                                    
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