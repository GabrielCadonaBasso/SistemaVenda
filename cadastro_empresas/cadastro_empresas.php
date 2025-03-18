<?php
    include '../funcoes.php';
    
    ConectarBanco();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastrar</title>
    <link rel="stylesheet" href="../assets/css/style.css"/>
</head>
<body>
    <div class="tela">
        <div class="square">
            <h1>Cadastro de Empresas</h1>
            <form action="" method="post"  >
                <input type="text" name="nome" placeholder="Nome" required/>
                <input type="text" name="cnpj" placeholder="CNPJ" required/>
                <input type="email" name="email" placeholder="Email" required/>
                <input type="password" name="senha" placeholder="Senha" required/>
                <div class="DivDoisBotoes">
                    <button type="submit">Cadastrar</button>
                    <button type="button">Cancelar</button>    
                </div>
            </form>
        </div>
        <div class="MostraResultado">
            <?php
                CadastraEmpresas();
            ?>    
        </div>
    </div>
</body>
</html>
