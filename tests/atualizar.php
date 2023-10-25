<?php
session_start();
ob_start();
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Redefinir senha</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="../css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h2>Atualizar Senha</h2>

                                        <?php
                                        $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);


                                        if (!empty($chave)) {
                                            //var_dump($chave);

                                            $query_usuario = "SELECT id_usuario 
                            FROM usuarios 
                            WHERE recuperar_senha =:recuperar_senha  
                            LIMIT 1";
                                            $result_usuario = $conection->prepare($query_usuario);
                                            $result_usuario->bindParam(':recuperar_senha', $chave, PDO::PARAM_STR);
                                            $result_usuario->execute();

                                            if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                                                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                                                $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                                                var_dump($dados);
                                                if (!empty($dados['SendNovaSenha'])) {
                                                    $senha_usuario = password_hash($dados['senha_usuario'], PASSWORD_DEFAULT);
                                                    $recuperar_senha = 'NULL';

                                                    $query_up_usuario = "UPDATE usuarios 
                        SET senha_usuario =:senha_usuario,
                        recuperar_senha =:recuperar_senha
                        WHERE id_usuario =:id_usuario 
                        LIMIT 1";
                                                    $result_up_usuario = $conection->prepare($query_up_usuario);
                                                    $result_up_usuario->bindParam(':senha_usuario', $senha_usuario, PDO::PARAM_STR);
                                                    $result_up_usuario->bindParam(':recuperar_senha', $recuperar_senha);
                                                    $result_up_usuario->bindParam(':id_usuario', $row_usuario['id_usuario'], PDO::PARAM_INT);

                                                    if ($result_up_usuario->execute()) {
                                                        $_SESSION['msg'] = "<p style='color: green'>Senha atualizada com sucesso!</p>";
                                                        header("Location: login.php");
                                                    } else {
                                                        echo "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
                                                    }
                                                }
                                            } else {
                                                $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
                                                header("Location: recuperar.php");
                                            }
                                        } else {
                                            $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
                                            header("Location: recuperar.php");
                                        }

                                        ?>

                                        <form method="POST" action="">
                                            <?php
                                            $usuario = "";
                                            if (isset($dados['senha_usuario'])) {
                                                $usuario = $dados['senha_usuario'];
                                            } ?>
                                            <label>Senha</label>
                                            <input type="password" name="senha_usuario" placeholder="Digite a nova senha" value="<?php echo $usuario; ?>"><br><br>

                                            <input type="submit" value="Atualizar" name="SendNovaSenha">
                                        </form>

                                        <br>
                                        Lembrou? <a href="login.php">clique aqui</a> para logar

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>