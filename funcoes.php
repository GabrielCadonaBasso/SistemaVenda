<?php
    function ConectarBanco(){
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
    }

    function CadastraEmpresas() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'] ?? 'Nome não informado';
            $cnpj = $_POST['cnpj'] ?? 'Cnpj não informado';
            $email = $_POST['email'] ?? 'Email não informado';
            $senha = $_POST['senha'] ?? 'Senha não informada';
            
            if ((!empty($email)) && (!empty($senha))){
                $query = "SELECT * FROM empresas WHERE CNPJ_EMP = :CNPJ_EMP AND SENHA_EMP = :SENHA_EMP";
            } 
        }
    }
?>