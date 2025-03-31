<?php
    if (!isset($_SESSION)){
        session_start();
    }
    unset($_SESSION['CNPJ_EMP']);
    unset($_SESSION['SENHA_EMP']);
    session_destroy();
    header("Location: ../login_empresas/login_empresas.php");
?>