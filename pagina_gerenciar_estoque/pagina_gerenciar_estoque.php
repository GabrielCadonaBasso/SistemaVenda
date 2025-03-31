<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <title>Gerenciar Estoque</title>
</head>

<body>
    <header>
        <div class="header">

            <div class="container">
                <div class="logo">
                    <h1>Gerenciar Estoque</h1>
                </div>
                <div class="menu">
                    <nav>
                        <ul>
                            <li><a href="">Voltar</a></li>

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


        <div class="main-estoque">






            <div class="main-left">
                <div class='table-box'>
                    <div class="pesquisar">
                        <form>
                            <input type="text" placeholder="Procurar Produtos" />
                            <Button><img src="assets/images/lupa.png"> </Button>
                        </form>
                    </div>



                    <table>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- aqui vai ter um while ou for do php -->
                            <tr>
                                <td>0001</td>
                                <td>Pão de Forma</td>
                                <td>100</td>
                                <td>100</td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="main-right">
                <div class="square">
                    <h1>Produto</h1>
                    <form>
                        <label> Nome do Produto</label>
                        <input type="text" name="produto" placeholder="Nome do Produto" />
                        <label>Código do Produto</label>
                        <input type="number" name="produto" placeholder="Nome do Produto" />
                        <div class='dual-input'>
                            <div class="single-input">
                                <label>Quantidade<br /></label>
                                <input type="number" name="quantidade" placeholder="Quantidade" />
                            </div>
                            <div class="single-input">
                                <label>Fornecedor <br /></label>
                                <input type="text" name="fornecedor" placeholder="Fornecedor" />
                            </div>
                        </div>
                        <div class='dual-input'>
                            <div class="single-input">
                                <label>Preço de Custo<br /></label>
                                <input type="number" name="preco-custo" placeholder="Preço de Custo"step="0.01" />
                            </div>
                            <div class="single-input">
                                <label>Preço de Venda <br /></label>
                                <input type="text" name="preco-venda" placeholder="Preço de Venda" step="0.01"/>
                            </div>
                        </div>
                        <label>Descrição<br /></label>
                        <textarea placeholder="Descrição"></textarea>
                        <div class='dual-input'>
                            <button class="vermelho">Excluir</button>
                            <button class="verde">Salvar</button>
                            
                        </div>







                    </form>
                </div>

            </div>



        </div>



    </section>


</body>

</html>