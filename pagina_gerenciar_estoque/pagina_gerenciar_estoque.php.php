<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <title>Login</title>
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
                        <label>Produto<br />
                            <input class="form-produto" placeholder="Produto" name="produto" />

                        </label>
                        <label>Código<br />
                            <input class="form-codigo" placeholder="Código do Produto" name="codigo" />

                        </label>

                        <div class="quantiaPreco">
                            <div class="square-quantia-preco">
                                <label>Preço<br />
                                    <input class="form-preco" placeholder="Preço do Produto" name="preco" />

                                </label>

                            </div>
                            <div class="square-quantia-preco">
                                <label>Quantidade<br />
                                    <input class="form-quantidade" placeholder="Quantidade do Produto"
                                        name="quantidade" />

                                </label>

                            </div>



                        </div>
                        <label>Fornecedor<br />
                            <input class="form-fornecedor" placeholder="Fornecedor" name="fornecedor" />

                        </label>

                        <label>Descrição<br />
                            <textarea class="form-descricao" name="descricao">

                        </textarea>
                        </label>
                        <div class="botoes">
                            <button>Salvar</button>
                            <button>Excluir</button>

                        </div>





                    </form>
                </div>

            </div>



        </div>



    </section>


</body>

</html>