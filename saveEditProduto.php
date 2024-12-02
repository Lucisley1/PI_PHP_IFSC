<?php
    session_start();
    include_once('config.php');

    if(isset($_POST['update'])){

        if ($_SESSION['tipoUsuario'] == "Cliente"){
            $id = $_POST['id'];
            $autorizacao = $_POST['autorizacao'];

            $sqlUpdate = "UPDATE produto SET autorizacao='$autorizacao' WHERE id='$id'";

            $result = $conexao->query($sqlUpdate);
    
        } else if ($_SESSION['tipoUsuario'] == "Tecnico"){
            $id = $_POST['id'];
            $defeito = $_POST['defeito'];
            $peca_defeito = $_POST['peca_defeito'];
            $valor_peca = $_POST['valor_peca'];
            $statuss = $_POST['statuss'];

            $sqlUpdate = "UPDATE produto SET defeito='$defeito', peca_defeito='$peca_defeito',valor_peca='$valor_peca',
            statuss='$statuss' WHERE id='$id'";

            $result = $conexao->query($sqlUpdate);

        } else if($_SESSION['tipoUsuario'] == "Administrador" || $_SESSION['tipoUsuario'] == "Administrador GM"){

            $id = $_POST['id'];
            $cpf = $_POST['cpf'];
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $defeito = $_POST['defeito'];
            $peca_defeito = $_POST['peca_defeito'];
            $valor_peca = $_POST['valor_peca'];
            $autorizacao = $_POST['autorizacao'];
            $statuss = $_POST['statuss'];

            $sqlUpdate = "UPDATE produto SET cpf='$cpf',marca='$marca',modelo='$modelo',defeito='$defeito',
            peca_defeito='$peca_defeito',valor_peca='$valor_peca',autorizacao='$autorizacao',statuss='$statuss' WHERE id='$id'";

            $result = $conexao->query($sqlUpdate);
        }

        if ($_SESSION['tipoUsuario'] == "Cliente"){
            header('Location: sistemaProdutoCliente.php');
        } else if ($_SESSION['tipoUsuario'] == "Tecnico"){
            header('Location: sistemaProdutoTecnico.php');
        } else if($_SESSION['tipoUsuario'] == "Administrador" || $_SESSION['tipoUsuario'] == "Administrador GM"){
            header('Location: sistemaProduto.php');
        }
    }

?>