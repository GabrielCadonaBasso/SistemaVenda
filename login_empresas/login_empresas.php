<?php
try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "10102003";
    $banco = "SISTEMA";

    $conn = new mysqli($servidor, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

session_start();

if (isset($_SESSION['CNPJ_EMP']) && isset($_SESSION['SENHA_EMP'])) {
    header("Location: ../pagina_venda/pagina_venda.php");
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
                <div class="formulario">
                    <form action="" method="post">
                        <input type="text" name="cnpj" placeholder="CNPJ" required />
                        <input type="password" name="senha" placeholder="Senha" required />
                        <button type="submit">Login</button>
                    </form>
                    <p>Não tem uma conta? <a href="../cadastro_empresas/cadastro_empresas.php">Cadastre-se aqui!</a></p>
                </div>
            </div>
        </div>
        <p>
        <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $cnpj = $_POST['cnpj'];
                        $senha = $_POST['senha'];

                        if (!empty($cnpj) && !empty($senha)) {
                            $query = "SELECT * FROM empresas WHERE CNPJ_EMP = '$cnpj' AND SENHA_EMP = '$senha'";
                            $result = mysqli_query($conn, $query);

                            $quant_retorno = $result->num_rows;

                            if ($quant_retorno == 1){

                                $_SESSION['CNPJ_EMP'] = $cnpj;
                                $_SESSION['SENHA_EMP'] = $senha;

                                header("Location: ../pagina_venda/pagina_venda.php");
                            }else{
                                echo "CNPJ ou Senha Incorretos!";
                            }
                            mysqli_close($conn);
                        }
                    }
                ?>
        </p>
    
    </div>

</body>

</html>