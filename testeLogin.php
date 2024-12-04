<?php
session_start(); // Iniciar a sessão se ainda não foi feita

    if (isset($_POST['submit']) && !isset($_SESSION['cpf'])) {
        // Verificar se o CPF e a senha foram fornecidos
        if (isset($_POST['cpf']) && isset($_POST['senha'])) {
            include_once('config.php');

            // Preparar a consulta apenas com o CPF, pois a senha será verificada posteriormente
            $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE cpf = ?");
            $stmt->bind_param("s", $cpf);

            // Atribuir o valor de CPF fornecido pelo usuário
            $cpf = $_POST['cpf'];

            // Executar a consulta
            $stmt->execute();
            $result = $stmt->get_result();

    //$senhaHash = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            // Verificar se o usuário existe
            if ($result->num_rows > 0) {
                // Buscar os dados do usuário, incluindo o hash da senha
                $row = $result->fetch_assoc();
                $hash_senha = $row['senha'];

                // Verificar a senha fornecida com o hash armazenado
                
    
            
                if (password_verify($_POST['senha'], $hash_senha)) {
                    // Login bem-sucedido: definir variáveis de sessão
                    $_SESSION['cpf'] = $cpf;
                    $_SESSION['senha'] = $hash_senha;
                    $_SESSION['$result'] = $result;

                    $_SESSION['tipoUsuario'] = $row['permissao'];

                    foreach($result as $linha){
                        $_SESSION['nome'] = $linha['nome'];
                    }
                    
                    if ($row['permissao'] == "Administrador GM"){
                        header('Location: admin.php');
                    } else if ($row['permissao'] == "Administrador"){
                        header('Location: admin.php');
                    } else if ($row['permissao'] == "Tecnico"){
                        header('Location: sistemaProdutoTecnico.php');
                    } else if($row['permissao'] == "Cliente"){
                        header('Location: sistemaProdutoCliente.php');
                    }
                    
                    // header('Location: SistemaProduto.php');
                
                    //echo 'Login bem-sucedido!';
                } else {
                    header('Location: login.php');
                    // var_dump(password_verify('123', '$2y$10$NpXFmgGt9zrG9KNSkOGe0.y1k70eAftutF79Wq'));
                    // echo 'Senha incorreta!';
                    // echo "<br><br>";
                    // print_r('linha do id');
                    // echo "<br>";
                    // print_r($row);
                    // echo "<br><br>";
                    // print_r('senha sessão');
                    // echo "<br>";
                    // // print_r($_SESSION['senha']);
                    // // echo "<br><br>";
                    // print_r('senha input');
                    // echo "<br>";
                    // print_r($_POST['senha']);
                    // echo "<br><br>";
                    // print_r('senha hash bd');
                    // echo "<br>";
                    // print_r($hash_senha);
                }
            } else {
                header('Location: login.php');
            }
        

            // Fechar a declaração e a conexão
            $stmt->close();
            $conexao->close();
        } else {
            echo 'Por favor, forneça CPF e senha.';
        }
    } 
    else 
    {
        header('Location: login.php');
    }

?>

<!-- 2011 linhas feito ao todo -->