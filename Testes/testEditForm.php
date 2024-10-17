if(!empty($_GET['id']))
    {
        include_once('config.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $id = $user_data['id'];
                $nome = $user_data['nome'];
                $email = $user_data['email'];
                $cpf = $user_data['cpf'];
                //$senha = $user_data['senha'];
                $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $telefone = $user_data['telefone'];
                $sexo = $user_data['sexo'];
                $data_nasc = $user_data['data_nasc'];
                $cidade = $user_data['cidade'];
                $estado = $user_data['estado'];
                $endereco = $user_data['endereco'];
            }
            
        }
        else
        {
            header('location: sistema.php');
        }

    }