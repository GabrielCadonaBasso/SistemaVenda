<?php
try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "SISTEMA";

    $conn = new mysqli($servidor, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <div class="main">
        <div class="main-square">
            <div class="logo">
                <img src="assets/images/feitoAmão.png" />
            </div>
                <div class="formulario">
                    <form action="" method="post">
                        <input type="text" name="nome" placeholder="Nome" required />
                        <input type="text" name="cnpj" placeholder="CNPJ" required />
                        <input type="email" name="email" placeholder="Email" required />
                        <input type="password" name="senha" placeholder="Senha" required />
                        <div class="DoisBotoes">
                            <a class="botao_link" href="../login_empresas/login_empresas.php">Voltar</a>
                            <button type="submit" name="cadastrar">Cadastrar</button>
                            
                        </div>
                    </form>

                </div>

                <p class="notificacao">
                <?php
                if (isset($_POST['cadastrar'])) {
                    $nome = $_POST['nome'];
                    $cnpj = $_POST['cnpj'];
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];

                    if (!empty($cnpj) && !empty($senha)) {
                        $query = "SELECT * FROM empresas WHERE CNPJ_EMP = '$cnpj'";
                        $result = mysqli_query($conn, $query);

                        $quant_retorno = $result->num_rows;

                        if ($quant_retorno == 1) {
                            echo "Usuário Já Cadastrado!";
                        } else {
                            $query = "INSERT INTO empresas (NOME_EMP, CNPJ_EMP, EMAIL_EMP, SENHA_EMP) VALUES('$nome', '$cnpj', '$email', '$senha')";

                            $result = mysqli_query($conn, $query);

                            echo "Usuário Cadastrado com Sucesso!";
                            
                            
                        }
                        mysqli_close($conn);
                    }
                }
                ?>
            </p>
            </div>
            
        </div>
            

    </div>

</body>

</html>
