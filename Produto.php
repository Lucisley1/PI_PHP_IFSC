<?php

    if(isset($_POST['submit']))
    {
        include_once('config.php');

        $cpf = $_POST['cpf'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $defeito = $_POST['defeito'];
        $peca_defeito = $_POST['peca_defeito'];
        $valor_peca = $_POST['valor_peca'];
        $autorizacao = $_POST['autorizacao'];
        $statuss = $_POST['statuss'];
        
        $result1 = mysqli_query($conexao, "
            SELECT id FROM usuarios WHERE usuarios.cpf = '$cpf'
        ");

        //var_dump($result1);

        if (mysqli_num_rows($result1) == 0) {
            echo "cpf não cadastrado";
            $erroCPF = true;
        } else {
            $result = mysqli_query($conexao, "
            INSERT INTO produto (id_usuarios, cpf, marca, modelo, defeito, peca_defeito, valor_peca, autorizacao, statuss) 
            VALUES (
                (SELECT id FROM usuarios WHERE usuarios.cpf = '$cpf'),
                '$cpf',
                '$marca',
                '$modelo',
                '$defeito',
                '$peca_defeito',
                '$valor_peca',
                '$autorizacao',
                '$statuss'
            )
        ");
        header('Location: admin.php');
        }




        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 23%;
        }
        fieldset{
            border: 3px solid dodgerblue;
        }
        legend{
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }
        #submit{
            background-image: linear-gradient(to right,rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right,rgb(0, 80, 172), rgb(80, 19, 195));
        }
    </style>
</head>
<body>
<div> 
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
    <a href="home.php" class="btn btn-danger me-5">Inicio</a>
</div>
    <div class="box">
        <form action="produto.php" method="POST">
            <fieldset>
                <legend><b>Informações do Produto</b></legend>
                <br>
                <p style="color:red"><?php if (isset($erroCPF) && $erroCPF == true) { echo 'Erro no cpf'; } ?></p>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" required>
                    <label for="cpf" class="labelInput">CPF</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="marca" id="marca" class="inputUser" required>
                    <label for="marca" class="labelInput">Produto e Marca</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="modelo" id="modelo" class="inputUser" required>
                    <label for="modelo" class="labelInput">Modelo do Produto</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="defeito" name="defeito" id="defeito" class="inputUser" required>
                    <label for="defeito" class="labelInput">Defeito do Produto</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="peca_defeito" id="peca_defeito" class="inputUser" required>
                    <label for="peca_defeito" class="labelInput">Peça com Defeito</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="valor_peca" id="valor_peca" class="inputUser" required>
                    <label for="valor_peca" class="labelInput">Valor da Peça com defeito</label>
                </div>
                <br><br>
                <p>Autorização:</p>
                <input type="radio" id="autorizacao" name="autorizacao" value="sim" required>
                <label for="sim">Sim</label>
                <br>
                <input type="radio" id="autorizacao" name="autorizacao" value="nao" required>
                <label for="nao">Não</label>
                <br><br>
                <!-- <div class="inputBox">
                    <input type="text" name="autorizacao" id="autorizacao" class="inputUser" required>
                    <label for="autorizacao" class="labelInput">Autorização</label>
                </div> -->
                <!-- <br> -->
                <div class="inputBox">
                    <!-- <input type="text" name="statuss" id="statuss" class="inputUser" required>
                    <label for="statuss" class="labelInput">Status do Produto</label> -->
                    <label for="statuss" class="labelInput">Status do Produto</label>
                    <br>
                    <select name="statuss">
                        <option value=" ">SELECIONE</option>
                        <!-- <option value="AUTORIZADO">AUTORIZADO</option>
                        <option value="NÃO AUTORIZADO">NÃO AUTORIZADO</option> -->
                        <option value="AGUARDANDO AUTORIZAÇÃO">AGUARDANDO AUTORIZAÇÃO</option>
                        <option value="AUTORIZADO">AUTORIZADO</option>
                        <option value="EM MANUTENÇÃO">EM MANUTENÇÃO</option>
                        <option value="AGUARDANDO PEÇA">AGUARDANDO PEÇA</option>
                        <option value="PRONTO">PRONTO </option>
                        <option value="AGUARDANDO RETIRADA">AGUARDANDO RETIRADA</option>
                        <option value="FINALIZADO">FINALIZADO</option>
                    </select>
                </div>
                <br><br>
                <input type="submit" name="submit" id="submit" value="Cadastrar">
            </fieldset>
        </form>
    </div>
</body>
</html>