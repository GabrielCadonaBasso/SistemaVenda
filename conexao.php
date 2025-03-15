<?php
    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "SISTEMA";

        // Criar conexão
        $conn = new mysqli($servidor, $usuario, $senha, $banco);

        // Verificar conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
    }
    
?>