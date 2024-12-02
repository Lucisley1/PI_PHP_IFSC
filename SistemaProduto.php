<?php
    session_start();
    include_once('config.php');
    // // print_r($_SESSION);
    // // if((!isset($_SESSION['cpf']) == true) and (!isset($_SESSION['senha']) == true))

    if (!isset($_SESSION['tipoUsuario'])){
        header('Location: login.php');
    }if ($_SESSION['tipoUsuario'] != "Administrador GM" && $_SESSION['tipoUsuario'] != "Administrador" ){
        header('Location: login.php');
    }

    if (!isset($_SESSION['cpf']) || !isset($_SESSION['senha']))
    
    {
    unset($_SESSION['cpf']);
    unset($_SESSION['senha']);
        
        header('Location: login.php');
    }
    $logado = $_SESSION['nome'];
    //     // Busca pela caixa de pesquisa
    if(!empty($_GET['search']))
    {
         $data = $_GET['search'];
         

         if ($_SESSION['tipoUsuario'] == "Cliente"){
            $sql = "SELECT * FROM produto WHERE marca LIKE '%$data%' or cpf=".$_SESSION['cpf']." ORDER BY id DESC";
        } else if($_SESSION['tipoUsuario'] == "Administrador" || $_SESSION['tipoUsuario'] == "Administrador GM"){
            $sql = "SELECT * FROM produto WHERE marca LIKE '%$data%' or cpf LIKE '%$data%' ORDER BY id DESC";
        }else {
            $sql = "SELECT * FROM produto WHERE marca LIKE '%$data%' or cpf LIKE '%$data%' ORDER BY id DESC";
        }

    }
    else
    {

        if ($_SESSION['tipoUsuario'] == "Cliente"){
            $sql = "SELECT * FROM produto WHERE cpf=".$_SESSION['cpf']." ORDER BY id DESC";
        } else {
            $sql = "SELECT * FROM produto ORDER BY id DESC";
        }
    }
     $result1 = $conexao->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        function mostrarDiv(codigoDiv){
            document.getElementById("div_" + codigoDiv).style.display='block';
        }
        function esconderDiv(codigoDiv){
            document.getElementById("div_" + codigoDiv).style.display='none';
        }
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Acesso permitido</title>
    <style>
        body{
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            text-align: center;
        }
        .table-bg{
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }

        .box-search{
            display: flex;
            justify-content: center;
            gap: .1%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SISTEMA MERV</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="d-flex">
        <!-- <a href="admin.php" class="btn btn-info me-2">Voltar</a> -->
        <a href="sair.php" class="btn btn-danger me-2">Sair</a>
        </div>
    </nav>
    <br>
    <?php
        echo "<h1>Bem vindo $logado</h1>";
    ?>
        <h3>Acesso ao sistema autorizado</h3>
    <br>
                    <!-- Caixa de pesquisa dos registros -->
    <div class="box-search"> 
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
                    <!-- Icone de pesquisa -->
        <button onclick="searchData()" class="btn btn-primary"> 
                    <!-- Tag do icone -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
                    <!-- tabela do bootstrap -->
    <div class="m-5">
        <table class="table text-white table-bg"> 
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Defeito</th>
                    <th scope="col">Peça Defeito</th>
                    <th scope="col">Valor da Peça</th>
                    <th scope="col">Autorização</th>
                    <th scope="col">Status</th>
                    <th scope="col">...</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dados do banco de dados passando o laço para listar todos os registros -->
                <?php  
                    while($user_data = mysqli_fetch_assoc($result1)) {  
                        echo "<tr>";
                        echo "<td>".$user_data['id']."</td>";
                        echo "<td>".$user_data['cpf']."</td>";
                        echo "<td>".$user_data['marca']."</td>";
                        echo "<td>".$user_data['modelo']."</td>";
                        echo "<td>".$user_data['defeito']."</td>";
                        echo "<td>".$user_data['peca_defeito']."</td>";
                        echo "<td>".$user_data['valor_peca']."</td>";
                        echo "<td>".$user_data['autorizacao']."</td>";
                        echo "<td>".$user_data['statuss']."</td>";
                        echo "<td>
                            <a class='btn btn-sm btn-primary' href='editProduto.php?id=$user_data[id]' title='Editar'>
                            


                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                    <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                                </svg>
                                </a>
                                <button class='btn btn-sm btn-danger' onClick='mostrarDiv($user_data[id])'>
                                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                    </svg>
                                </button>

                                <div id='div_$user_data[id]' style='display: none'>
                                    Confirma a exclusão do produto?
                                    <button class='btn btn-sm btn-danger' onClick='esconderDiv($user_data[id])'>Não</button>
                                    <a class='btn btn-sm btn-danger' href='deleteProduto.php?id=$user_data[id]' title='Deletar'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                    </svg>
                                    </a>
                                </div>


                                

                                </td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
<script>
            // Controle do botao de pesquisa 
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'SistemaProduto.php?search='+search.value;
    }
</script>
</html>