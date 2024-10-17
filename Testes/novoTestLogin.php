<?php
    session_start();
    // print_r($_REQUEST);



    if(isset($_POST['submit']) && !empty($_POST['cpf']) && !empty($_POST['senha']))
    //if(isset($_POST['submit']) && !empty($_POST['cpf']) && !empty($_POST['verified']))
    //if(isset($_POST['submit']) && (!isset($_SESSION['cpf']) && !isset($_SESSION['senha']) && isset($_SESSION['senha']) && !password_verify($senha, $_SESSION['senha'])))    
    {
        //acessa
        include_once('config.php');
        // $cpf = $_POST['cpf'];
        // $senha = $_POST['senha'];

        // print_r('cpf: ' . $cpf);
        // echo "<br>";
        // print_r('senha: ' . $senha);

        //$stmt = $conexao->prepare("SELECT * FROM usuarios WHERE cpf = ?");
        $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE cpf = ? AND senha = ?");
        //$stmt->bind_param("ss", $cpf);
        $stmt->bind_param("ss", $cpf,$senha);
        $cpf = $_POST['cpf'];
        //$verified = password_verify($verified, $_SESSION['senha']);
        $senha = $_POST['senha'];
        $stmt->execute();
        $result = $stmt->get_result();

    // session_start(); // Iniciar a sessão se ainda não foi feita

    // if (isset($_POST['submit']) && !isset($_SESSION['cpf'])) {
    //     // Verificar se o CPF e a senha foram fornecidos
    //     if (isset($_POST['cpf']) && isset($_POST['senha'])) {
    //         include_once('config.php');

    //         // Preparar a consulta apenas com o CPF, pois a senha será verificada posteriormente
    //         $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE cpf = ?");
    //         $stmt->bind_param("s", $cpf);

    //         // Atribuir o valor de CPF fornecido pelo usuário
    //         $cpf = $_POST['cpf'];

    //         // Executar a consulta
    //         $stmt->execute();
    //         $result = $stmt->get_result();

    //         // Verificar se o usuário existe
    //         if ($result->num_rows > 0) {
    //             // Buscar os dados do usuário, incluindo o hash da senha
    //             $row = $result->fetch_assoc();
    //             $hash_senha = $row['senha'];

    //             // Verificar a senha fornecida com o hash armazenado
    //             if (password_verify($_POST['senha'], $hash_senha)) {
    //                 // Login bem-sucedido: definir variáveis de sessão
    //                 $_SESSION['cpf'] = $cpf;
    //                 $_SESSION['senha'] = $hash_senha;

    //                 echo 'Login bem-sucedido!';
    //             } else {
    //                 echo 'Senha incorreta!';
    //             }
    //         } else {
    //             echo 'Usuário não encontrado!';
    //         }

    //         // Fechar a declaração e a conexão
    //         $stmt->close();
    //         $conexao->close();
    //     } else {
    //         echo 'Por favor, forneça CPF e senha.';
    //     }
    // } else {
    //     echo 'Usuário já está autenticado ou a requisição é inválida.';
    // }

        $sql = "SELECT * FROM usuarios WHERE cpf = '$cpf' AND senha = '$senha'";
       
        $result = $conexao->query($sql);

        // print_r($sql);
        // print_r($result);

        if( $result->num_rows < 1)
        {
            // print_r('Não existe');
            // unset($_SESSION['cpf']);
            // unset($_SESSION['senha']);
            header('Location: login.php');
        }
        else
        {
            // print_r('Existe');
            $_SESSION['cpf'] = $cpf;
            $_SESSION['senha'] = $senha;
            $_SESSION['$result'] = $result;
            // while ($row = mysql_fetch_assoc($result)) {
            //     echo $row["nome"];
            // }
            
            foreach($result as $linha){
                $_SESSION['nome'] = $linha['nome'];
            }

            header('Location: sistema.php');
        }

    }
    else
    {
        // nao acessa
        header('Location: login.php');
        
    }

?>