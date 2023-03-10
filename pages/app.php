<?php

include('../protect.php');

if (!isset($_SESSION)) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body class="bg-dark">
//navbarteste 

    <div class="container  bg-dark text-white ">
        <form>
            <div class="row ">
                <div class=" offset-md-1 col-md-4 col-sm-12 mt-3">
                    <div class="mb-3">
                        <input type="text" name="buscaItem" class="form-control">
                    </div>
                </div>

                <div class="col-md-2 col-sm-12 mt-3">
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12 mt-3">
                    <div class="d-grid">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastroItem">Novo Item</button>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12 mt-3">
                    <div class="d-grid">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#relatorio">Relatorio</button>
                    </div>
                </div>


                <div class="col-md-1 col-sm-12 mt-3">
                    <div class="d-flex justify-content-center">

                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="38" fill="currentColor" class="bi bi-person-circle " id="btn-user" type="button" data-bs-toggle="modal" data-bs-target="#infoUsuario" viewBox="0 0 16 16">

                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />

                        </svg>
                    </div>
                </div>

            </div>
        </form>



        <div class="row">
            <div class="col">
                <table class="table table-light  table-responsive col-md-6 col-sm-12 mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Item</th>
                            <th scope="col">Emprestimo</th>
                            <th scope="col">Contato</th>
                            <th scope="col">Devolução</th>
                            <th scope="col">Devolvido Em</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="col-md-6 col-sm-12 mt-3">
                        <?php
                        include('../conexao.php');
                        $dados = array();

                        if (!isset($_GET['buscaItem'])) {
                            $sql_code = "SELECT * FROM itens WHERE idUser ='" . $_SESSION['id'] . "'";
                            $sql_query = $mysqli->query($sql_code) or die("Erro ao Consultar ");


                            while ($linha = $sql_query->fetch_assoc()) {
                                array_push($dados, $linha);
                            }
                        } else {
                            $buscaItem = $_GET['buscaItem'];

                            $sql_code = "SELECT * FROM itens WHERE idUser ='" . $_SESSION['id'] . "' AND item LIKE '%" . $buscaItem . "%'";
                            $sql_query = $mysqli->query($sql_code) or die("Erro ao Consultar ");

                            while ($linha = $sql_query->fetch_assoc()) {
                                array_push($dados, $linha);
                            }
                        }

                        ?>
                        <?php

                        foreach ($dados as $dado) {
                            $hoje = date('Y-m-d');
                            $aux = date('0000-00-00');
                            
                        ?>
                            <div class="modal fade" id="editaItem<?= $dado['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Edição de Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="../gravar.php" method="POST">
                                                <input type="hidden" name="acao" value="editarItem">

                                                <input type="hidden" name="idItemEdit" value="<?= $dado['id'] ?>">

                                                <div class="mb-3">
                                                    <label for="nomeItem" class="form-label text-dark">Item</label>
                                                    <input type="text" class="form-control" name="nomeItemEdit" value="<?= $dado['item'] ?>" required="required">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="dataItem" class="form-label text-dark">Data</label>
                                                    <input type="date" class="form-control" name="dataItemEdit" value="<?= $dado['dataItem'] ?>" required="required">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="contatoItem" class="form-label text-dark ">Contato</label>
                                                    <input class="form-control" name="contatoItemEdit" value="<?= $dado['contato'] ?>" required="required">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="dataItemDev" class="form-label text-dark ">Data de Devolução</label>
                                                    <input type="date" class="form-control" name="dataItemDevEdit" value="<?= $dado['devolucao'] ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="itemDevEm" class="form-label text-dark ">Devolvido Em</label>
                                                    <input type="date" class="form-control" name="itemDevEm" value="<?= $dado['devolvido'] ?>">
                                                </div>

                                                <div class="mb-3 ">
                                                    <label for="observacao" class="form-label text-dark">Descrição</label>
                                                    <textarea type="text" rows="3" class="form-control" name="descricaoEdit"><?= $dado['descricao'] ?></textarea>
                                                </div>


                                                <div class="row">
                                                    <div class="col d-grid">
                                                        <input type="submit" class="btn btn-primary" value="Atualizar">
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="excluirItem<?= $dado['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Exclusão de Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../gravar.php" method="POST">
                                                <input type="hidden" name="acao" value="excluirItem">

                                                <label class="form-label text-dark"> Desaja realmente Excluir Este Item?</label>

                                                <input type="hidden" name="nomeItemExc" value="<?= $dado['item'] ?>">

                                                <div class="mb-3">
                                                    <label for="nomeItem" class="form-label text-dark">Item</label>
                                                    <input type="text" class="form-control" name="nomeItem" value="<?= $dado['item'] ?>" disabled required="required">

                                                </div>


                                                <div class="row">
                                                    <div class="col d-grid">
                                                        <input type="submit" class="btn btn-danger" value="Excluir">
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <tr>

                                <td><?php echo $dado['id'] ?></td>
                                <td><?php echo $dado['item'] ?></td>
                                <td><?php echo $dado['dataItem'] = implode("-",array_reverse(explode("-",$dado['dataItem']))) ?></td>
                                <td><?php echo $dado['contato'] ?></td>


                                <td <?php
                                    if ($dado['devolvido'] != $aux) {
                                        print "class='text-dark'";
                                    }
                                    if ($dado['devolucao'] == $aux) {
                                        print "class='text-dark'";
                                    }
                                    if ($hoje >= $dado['devolucao']) {
                                        print "class='text-danger'";
                                    }




                                    ?>><?php echo $dado['devolucao'] = implode("-",array_reverse(explode("-",$dado['devolucao']))); ?></td>


                                <td><?php echo $dado['devolvido'] = implode("-",array_reverse(explode("-",$dado['devolvido'])));  ?></td>

                                <td><button type="button" type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluirItem<?= $dado['id'] ?>">Excluir</button></td>




                                <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editaItem<?= $dado['id'] ?>">Editar</button></td>






                            </tr>



                        <?php
                        }
                        ?>




                    </tbody>
                </table>
            </div>
        </div>
    </div>


    
    <div class="modal fade" id="cadastroItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastro de Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../gravar.php" method="POST">
                        <input type="hidden" name="acao" value="cadastrarItem">

                        <div class="mb-3">
                            <label for="nomeItem" class="form-label">Item</label>
                            <input type="text" class="form-control" name="nomeItem" required="required">

                        </div>

                        <div class="mb-3">
                            <label for="dataItem" class="form-label">Data</label>
                            <input type="date" class="form-control" name="dataItem" required="required">
                        </div>

                        <div class="mb-3">
                            <label for="contatoItem" class="form-label">Contato</label>
                            <input class="form-control" name="contatoItem" required="required">
                        </div>

                        <div class="mb-3">
                            <label for="dataItemDev" class="form-label">Data de Devolução</label>
                            <input type="date" class="form-control" name="dataItemDev">
                        </div>

                        <div class="mb-3">
                            <label for="dataItemDev" class="form-label">Devolvido Em</label>
                            <input type="date" class="form-control" name="devolvido">
                        </div>

                        <div class="mb-3 ">
                                <label for="observacao" class="form-label">Descrição</label>
                                <textarea rows="3" class="form-control" name="descricao" ></textarea>
                        </div>

                        <div class="row">
                            <div class="col d-grid">
                                <button class="btn btn-primary" id="salvar">Salvar</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php
    $sql_code = "SELECT * FROM users WHERE id ='" . $_SESSION['id'] . "'";
    $sql_query = $mysqli->query($sql_code) or die("Erro ao Consultar ");

    if (isset($_SESSION)) {
        $dadosUser = $sql_query->fetch_assoc();
        
      
    ?>
        <div class="modal fade" id="infoUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Informação de Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../gravar.php" method="POST">
                            <input type="hidden" name="acao" value="editarUser">

                            <div class="mb-3">
                                <label for="nomeItem" class="form-label text-dark">Usuario</label>
                                <input type="text" class="form-control" name="nomeUser" value="<?php echo $dadosUser['nome'] ?>" required="required">

                            </div>

                            <div class="mb-3">
                                <label for="dataItem" class="form-label text-dark">Senha</label>
                                <input type="text" class="form-control" name="senhaUser" placeholder="Digite sua nova senha" >
                            </div>


                            <div class="row">
                                <div class="col d-grid">
                                    <input class="btn btn-primary" type="submit" value="Atualizar">
                                </div>
                            </div>

                            <p class="d-flex justify-content-center mt-3">
                                <a href="../logout.php">Sair</a>
                            </p>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    <?php
    }
    ?>



    
    <div class="modal fade" id="relatorio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Itens Pendentes</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <form >

                            <?php 
                                $pendentes = array();
                                $sql_code = "SELECT * FROM itens WHERE idUser ='" . $_SESSION['id'] . "' AND devolucao <= '$hoje' AND devolvido = '$aux'";
                                $sql_query = $mysqli->query($sql_code) or die("Erro ao Consultar ");
    
                                while ($row = $sql_query->fetch_assoc()) {
                                    array_push($pendentes, $row);
                                }

                                foreach ($pendentes as $pendente) {
                                            
                                    
                            ?>
                            <div class="mb-3">
                                <label for="nomeItem" class="form-label text-dark">Item</label>
                                <input type="text" class="form-control" name="item" value="<?php echo $pendente['item'] ?>" required="required">

                            </div>
                            <?php
                                }
                            ?>
                        </form>
                    </div>

            </div>
        </div>
    </div>

</body>



</html>