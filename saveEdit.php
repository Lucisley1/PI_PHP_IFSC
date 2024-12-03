<?php
    session_start();
    include_once('config.php');

    if(isset($_POST['update'])){
        if ($_SESSION['tipoUsuario'] == "Cliente"){
            $id = $_POST['id'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $sqlUpdate = "UPDATE usuarios SET senha='$senha' WHERE id='$id'";

            $result = $conexao->query($sqlUpdate);
    
        } else if ($_SESSION['tipoUsuario'] == "Tecnico"){
            $id = $_POST['id'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $sqlUpdate = "UPDATE usuarios SET senha='$senha' WHERE id='$id'";

            $result = $conexao->query($sqlUpdate);

        } else if($_SESSION['tipoUsuario'] == "Administrador" || $_SESSION['tipoUsuario'] == "Administrador GM"){
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $cpf = $_POST['cpf'];
            //$senha = $_POST['senha'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $telefone = $_POST['telefone'];
            $sexo = $_POST['sexo'];
            $data_nasc = $_POST['data_nasc'];
            $cidade = $_POST['cidade'];
            $estado = $_POST['estado'];
            $endereco = $_POST['endereco'];
            $permissao = $_POST['permissao'];

            $sqlUpdate = "UPDATE usuarios SET nome='$nome',email='$email',cpf='$cpf',senha='$senha',
            telefone='$telefone',sexo='$sexo',data_nasc='$data_nasc',cidade='$cidade',estado='$estado',
            endereco='$endereco',permissao='$permissao' WHERE id='$id'";

            $result = $conexao->query($sqlUpdate);
        }
            header('Location: sistema.php');
    }
?>