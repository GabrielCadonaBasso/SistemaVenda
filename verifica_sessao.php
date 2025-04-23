<?php
    session_start();
    if ((!isset($_SESSION["SENHA_EMP"])) && (!isset($_SESSION["CNPJ_EMP"]))) {
        header("Location: ../login_empresas/login_empresas.php");
    }
?>