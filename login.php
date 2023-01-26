<?php
    

    include "conexao.php";

    switch ($_REQUEST["acao"]){
        case 'logar':
            $nome = $_POST["nome"]; 
            $senha = $_POST["senha"];

            
            $sql_code = "SELECT * FROM users WHERE nome = '$nome' LIMIT 1";
            $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);

        
            $usuario = $sql_exec->fetch_assoc();
            
            if(password_verify($senha,$usuario['senha'])){
                if(!isset($_SESSION)){
                    session_start();
                }
                
                $_SESSION['id'] =  $usuario['id'];
                $_SESSION['nome'] =  $usuario['nome'];

                print "<script>alert('Usuario Logado');</script>";
                print "<script>location.href='./pages/app.php';</script>";
            }else{
                print "<script>alert('Usuario ou Senha inválido');</script>";
                print "<script>location.href='./pages/areaLogin.php';</script>";
                
            }
        
            
            
    }

?>