<?php
include "../conexao.php";
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
                        <input type="text" name="cnpj"  maxlength="18" oninput="formatarCNPJ(this)" placeholder="00.000.000/0000-00" id="cnpj" required/>
                        <input type="password" name="senha" placeholder="Senha" required  maxlength="16"/>
                        <button type="submit">Login</button>
                    </form>
                    <p>Não tem uma conta? <a href="../cadastro_empresas/cadastro_empresas.php">Cadastre-se aqui!</a></p>
                </div>
            </div>
            <p class="notificacao">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $cnpj = $_POST['cnpj'];
                    $senha = $_POST['senha'];
                    

                    if (!empty($cnpj) && !empty($senha)) {
                        $query = "SELECT * FROM empresas WHERE CNPJ_EMP = '$cnpj' AND SENHA_EMP = '$senha'";
                        $result = mysqli_query($conn, $query);

                        $quant_retorno = $result->num_rows;

                        if ($quant_retorno == 1) {

                            $_SESSION['CNPJ_EMP'] = $cnpj;
                            $_SESSION['SENHA_EMP'] = $senha;
                            while ($row = mysqli_fetch_assoc($result)){
                                $_SESSION['ID_EMP'] = $row['ID_EMP'];
                            }
                            

                            header("Location: ../pagina_venda/pagina_venda.php");
                        } else {
                            echo "CNPJ ou Senha Incorretos!";
                        }
                        mysqli_close($conn);
                    }
                }
                ?>
            </p>
        </div>


    </div>
    
    <script src="assets/js/script.js"></script>
    
</body>

</html>