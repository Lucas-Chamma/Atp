<?php
   
    include "conexao.php";
    
    switch ($_REQUEST["acao"]){
        case 'cadastrar':
            $confSenha = $_POST['confSenha'];
            $senha = $_POST['senha'];
            if($senha != $confSenha){
                print "<script>alert('Senhas Diferentes');</script>";
                print "<script>location.href='./pages/areaCadastro.php';</script>";
            }else{
                $nome = $_POST["nome"]; 
                $senha = password_hash($_POST["senha"],PASSWORD_DEFAULT);
                
                
                $mysqli->query("INSERT INTO `users` (nome, senha) VALUES ('{$nome}','{$senha}')"); 
                
                
                if($mysqli == true){
                    print "<script>alert('Cadastro realizado');</script>";
                    print "<script>location.href='./pages/areaLogin.php';</script>";
                }   
                else{
                    print "<script>alert('Cadastro Invalido');</script>";
                    print "<script>location.href='./pages/areaCadastro.php';</script>";
                }
            }  
            
        break;

        case 'cadastrarItem':

            if(!isset($_SESSION)){
                session_start();
            }

            $nomeItem = $_POST["nomeItem"]; 
            $dataItem = $_POST["dataItem"];
            $contatoItem = $_POST["contatoItem"];
            $dataItemDev = $_POST["dataItemDev"];
            $idUser = $_SESSION['id'];
            $devolvido = $_POST["devolvido"];

          
            
            $mysqli->query("INSERT INTO `itens` (item, dataItem,contato,devolucao,idUser,devolvido) VALUES ('{$nomeItem}','{$dataItem}','{$contatoItem}','{$dataItemDev}','{$idUser}','{$devolvido}')");
            
            if($mysqli == true){
                print "<script>alert('Cadastro de Item realizado');</script>";
                print "<script>location.href='./pages/app.php';</script>";
                
            }else{
                print "<script>alert('Cadastro Invalido');</script>";
                print "<script>location.href='./pages/app.php';</script>";
                
            }
        break;  

        case 'excluirItem':

            $nomeItemExc = $_POST["nomeItemExc"]; 
            

            

            $mysqli->query("DELETE FROM `itens` WHERE item='{$nomeItemExc}'");
            
            if($mysqli == true){
                print "<script>alert('Item deletado com Sucesso');</script>";
                print "<script>location.href='./pages/app.php';</script>";
            }else{
                print "<script>alert('Error');</script>";
                print "<script>location.href='./pages/app.php';</script>";
                
            }

        break;

        case 'editarItem':

            $nomeItemEdit = $_POST["nomeItemEdit"]; 
            $dataItemEdit = $_POST["dataItemEdit"];
            $contatoItemEdit = $_POST["contatoItemEdit"];
            $dataItemDevEdit = $_POST["dataItemDevEdit"];
            $idItemEdit = $_POST["idItemEdit"];
            $itemDevEm = $_POST["itemDevEm"];

           

            $mysqli->query("UPDATE `itens` SET item='{$nomeItemEdit}',dataItem='{$dataItemEdit}',contato='{$contatoItemEdit}',devolucao='{$dataItemDevEdit}',devolvido='{$itemDevEm}' WHERE id ='{$idItemEdit}'");
            
            if($mysqli == true){
                print "<script>alert('Item atualizado com Sucesso');</script>";
                print "<script>location.href='./pages/app.php';</script>";
            }else{
                print "<script>alert('Error');</script>";
                print "<script>location.href='./pages/app.php';</script>";
                
            }
        break;    

        case 'editarUser':
            
            if(!isset($_SESSION)){
                session_start();
            }

            $nomeUser = $_POST["nomeUser"]; 
            $senhaUser = password_hash($_POST['senhaUser'],PASSWORD_DEFAULT);

          

            $mysqli->query("UPDATE `users` SET nome='{$nomeUser}',senha='{$senhaUser}' WHERE id ='". $_SESSION['id']."'");
            
            if($mysqli == true){
                print "<script>alert('Usuario atualizado com Sucesso');</script>";
                print "<script>location.href='./pages/areaLogin.php';</script>";
            }else{
                print "<script>alert('Error');</script>";
                print "<script>location.href='./pages/app.php';</script>";
                
            }
            


    }


   
   
?>