<?php

    include_once('config.php');

    if(isset($_POST['update']))
    {
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
    header('Location: sistema.php');

?>