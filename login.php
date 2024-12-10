<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        div{
            background-color: rgba(0, 0, 0, 0.9);
            position:absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 60px;
            border-radius: 15px;
            color: white;
        }
        input{
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
        }
        .InputSubmit{
            background-color: dodgerblue;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }
        .InputSubmit{
            background: darkslateblue;
            cursor: pointer;
            
        }
    </style>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>

</head>
<body>
<!-- <a href="home.php" class="btn btn-danger me-5">Inicio</a> -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div_ class="container-fluid">
            <a class="navbar-brand" href="#">SISTEMA MERV</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            
            <a href="sair.php" class="btn btn-danger me-2">Sair</a>
        </div_>
    </nav>
    <div>
        <h1>MERV Service</h1>
        <h1>Login</h1>
        <form action="testeLogin.php" method="POST">
            <input type="text" name="cpf" placeholder="CPF">
            <br><br>
            <input type="password" name="senha" placeholder="Senha">
            <!-- <input type="password" name="verified" placeholder="Senha"> -->
            <br><br>
            <input class="InputSubmit" type="submit" name="submit" value="Acessar">

            <?php
                session_start(); // Iniciar a sessão se ainda não foi feita
                if (isset($_SESSION["erroLogin"]) AND $_SESSION["erroLogin"] == true) {echo "<p>CPF ou senha incorreta.</p>"; }
                $_SESSION["erroLogin"] = false;
            ?>
            <!-- <button>Entrar</button> -->
        </form>
    </div> 
</body>
</html>