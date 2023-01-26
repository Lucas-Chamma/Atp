<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
    
</head>
<header>
    <div class="container bg-dark text-white">
        
        <ul class="nav d-flex justify-content-center">
            <li class="nav-item">

                <a class="btn nav-link" href="areaCadastro.php">Cadastro</a>
                
            </li>
            <li class="nav-item">
                
                <a class="btn nav-link"  href="areaLogin.php" >Login</a>
                
            </li>
        </ul> 
    </div>

  
</header>
<body class="bg-dark">
    <div id="tela-cadastro" class="container-fluid position-absolute top-50 start-50 translate-middle">
        <div class="row">
            <div class="offset-md-4 col-md-4 col-sm-12 ">
                <form action="../login.php" method="POST" > 
                    <input type="hidden" name="acao" value="logar">
                    <legend class="d-flex justify-content-center text-white">Login</legend>
                    <div class="mb-3">
                        <label for="TextInput" class="form-label text-white">Usuário</label>
                        <input type="text" class="form-control " name="nome" placeholder="Nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="TextInput" class="form-label text-white">Senha</label>
                        <input type="password"  class="form-control" name="senha" placeholder="Aquela que você não esquece" required>
                    </div>
                    
                    <div class="mb-3">
                        <button  id="btn-salvar" class="btn btn-primary form-control">Logar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        
</body>
    
</html>