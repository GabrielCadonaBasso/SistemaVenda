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
    <title>Cadastro de Empresas</title>
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
            <p>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $nome = $_POST['nome'];
                        $cnpj = $_POST['cnpj'];
                        $email = $_POST['email'];
                        $senha = $_POST['senha'];

                        if (!empty($cnpj) && !empty($senha)) {
                            $query = "SELECT * FROM empresas WHERE CNPJ_EMP = '$cnpj'";
                            $result = mysqli_query($conn, $query);

                            $quant_retorno = $result->num_rows;

                            if ($quant_retorno == 1){
                                echo "Usuário Já Cadastrado!";
                            }else{
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
</body>
</html>
