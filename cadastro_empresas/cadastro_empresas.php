<?php
    include '../funcoes.php';
    
    ConectarBanco();
    CadastraEmpresas();
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
    <div class="square">
        <h1>Cadastro de Empresas</h1>
        <form action="" method="post"  >
            <input type="text" name="nome" placeholder="Nome"/>
            <input type="text" name="cnpj" placeholder="CNPJ"/>
            <input type="text" name="email" placeholder="Email"/>
            <input type="text" name="senha" placeholder="Senha"/>
            <div class="DivDoisBotoes">
                <button type="submit">Cadastrar</button>
                <button type="button">Cancelar</button>    
            </div>

        </form>
    </div>
</body>
</html>
