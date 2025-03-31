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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Empresas</title>
    <link rel="stylesheet" href="../assets/css/style.css"/>
</head>
<body>
    <div class="tela">
        <div class="square">
            <h1>login de Empresas</h1>
            <form action="" method="post" >
                <input type="text" name="cnpj" placeholder="CNPJ" required/>
                <input type="password" name="senha" placeholder="Senha" required/>
                <div class="DivDoisBotoes">
                    <button type="submit">Login</button>
                    <a class="botao_link" href="../cadastro_empresas/cadastro_empresas.php">Cadastrar</a>   
                </div>
            </form>
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

                                session_start();

                                $_SESSION['CNPJ_EMP'] = $cnpj;
                                $_SESSION['SENHA_EMP'] = $senha;

                                header("Location: ../cadastro_funcionarios/cadastro_funcionarios.php");
                            }else{
                                echo "CNPJ ou Senha Incorretos!";
                            }
                            mysqli_close($conn);
                        }
                    }
                ?>
            </p>
        </div>
    </div>
</body>
</html>
