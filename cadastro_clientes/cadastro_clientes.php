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
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="../assets/css/style.css"/>
</head>
<body>
    <div class="tela">
        <a>
        <div class="square">
            <h1>Cadastro de Clientes</h1>
            <form action="" method="post"  >
                <input type="text" name="nome" placeholder="Nome" required/>
                <input type="text" name="cpf" placeholder="CPF" required/>
                <input type="text" name="cnpjempresa" placeholder="CNPJ da Empresa" required/>
                <div class="DivDoisBotoes">
                    <button type="submit">Cadastrar</button>
                    <button type="button">Voltar</button>    
                </div>
            </form>
            <p>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $nome = $_POST['nome'];
                        $cpf = $_POST['cpf'];
                        $cnpj_empresa = $_POST['cnpjempresa'];

                        if (!empty($nome) && !empty($cpf) && !empty($cnpj_empresa)) {
                            $query = "SELECT * FROM funcionarios WHERE CPF_FUNC = '$cpf'";
                            $result = mysqli_query($conn, $query);

                            $quant_retorno = $result->num_rows;

                            if ($quant_retorno == 1){
                                echo "Funcionário Já Cadastrado!";
                            }else{
                                $query = "INSERT INTO funcionarios (CPF_FUNC, NOME_FUNC, EMPRESAS_CNPJ_EMP) VALUES('$cpf', '$nome', '$cnpj_empresa')";

                                $result = mysqli_query($conn, $query);

                                echo "Funcionário Cadastrado com Sucesso!"; 
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
