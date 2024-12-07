<?php

if (!empty($_GET['id'])) {
    include_once('config.php');

    $id = intval($_GET['id']);  // Sanitização básica do ID

    // Uso de prepared statements para evitar SQL Injection
    $stmt = $conexao->prepare("SELECT * FROM produto WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        
        $id = $user_data['id'];
        $cpf = $user_data['cpf'];
        $marca = $user_data['marca'];
        $modelo = $user_data['modelo'];
        $defeito = $user_data['defeito'];
        $peca_defeito = $user_data['peca_defeito'];
        $valor_peca = $user_data['valor_peca'];
        $autorizacao = $user_data['autorizacao'];
        $statuss = $user_data['statuss'];
    } else {
        header('location: sistemaProdutoCliente.php');
        exit();  // Certifique-se de encerrar o script após redirecionar
    }

    $stmt->close();
}    
    else
    {
        header('location: sistemaProduto.php');
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
        #data_nascimento{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }
        #update{
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
    <a href="SistemaProduto.php" class="btn btn-danger me-5">Voltar</a>
</div>
    <div class="box">
        <form action="saveEditProduto.php" method="POST">
            <fieldset>
                <legend><b>Atualização de Produtos</b></legend>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" value="<?php echo $cpf ?>" required>
                    <label for="nome" class="labelInput">CPF</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="marca" id="marca" class="inputUser" value="<?php echo $marca ?>" required>
                    <label for="cpf" class="labelInput">Marca</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="modelo" id="modelo" class="inputUser" value="<?php echo $modelo ?>" required>
                    <label for="modelo" class="labelInput">Modelo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="defeito" id="defeito" class="inputUser" value="<?php echo $defeito ?>" required>
                    <label for="defeito" class="labelInput">Defeito</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="peca_defeito" id="peca_defeito" class="inputUser" value="<?php echo $peca_defeito ?>" required>
                    <label for="peca_defeito" class="labelInput">Peça com defeito</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="valor_peca" id="valor_peca" class="inputUser" value="<?php echo $valor_peca ?>" required>
                    <label for="valor_peca" class="labelInput">Valor da peça</label>
                </div>
                <br>
                <p>Autorização:</p>
                <input type="radio" id="autorizacao" name="autorizacao" value="sim" <?php echo ($autorizacao == 'sim') ? 'checked': '';?>>
                <label for="sim">Sim</label>
                <br>
                <input type="radio" id="autorizacao" name="autorizacao" value="nao" <?php echo ($autorizacao == 'nao') ? 'checked': '';?>>
                <label for="nao">Não</label>
                <br><br>           
                <div class="inputBox">
                    <!-- <input type="text" name="permissao" id="permissao" class="inputUser" value="<?php echo $permissao ?>" required> -->
                    
                    <label for="statuss" class="labelInput">statuss</label>
                    <br>
                    <select name="statuss" id="statuss" value="<?php echo $statuss ?>">
                        <option value=" ">Selecione</option>
                        <option name="statuss" id="statuss" value="AGUARDANDO AUTORIZAÇÃO">AGUARDANDO AUTORIZAÇÃO</option>
                        <option name="statuss" id="statuss" value="AUTORIZADO">AUTORIZADO</option>
                        <option name="statuss" id="statuss" value="EM MANUTENCAO">EM MANUTENÇÃO</option>
                        <option name="statuss" id="statuss" value="AGUARDANDO PECA">AGUARDANDO PEÇA</option>
                        <option name="statuss" id="statuss" value="PRONTO">PRONTO</option>
                        <option name="statuss" id="statuss" value="AGUARDANDO RETIRADA">AGUARDANDO RETIRADA</option>
                        <option name="statuss" id="statuss" value="FINALIZADO">FINALIZADO</option>
                    </select>
                    <br>
                    
                </div>
                <br><br>
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="submit" name="update" id="update" value="Atualizar">
            </fieldset>
        </form>
    </div>
</body>
</html>