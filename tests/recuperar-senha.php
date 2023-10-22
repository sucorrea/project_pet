<?php
session_start();
ob_start();

require_once "config.php";



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../lib/vendor/phpmailer/phpmailer/src/Exception.php';
require '../lib/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../lib/vendor/phpmailer/phpmailer/src/SMTP.php';
date_default_timezone_set('Etc/UTC');
require '../lib/vendor/autoload.php';
$mail = new PHPMailer();



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
                                        <h2>Recuperar Senha</h2>
                                        <?php
                                        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                                        if (!empty($dados['SendRecupSenha'])) {
                                            var_dump($dados);
                                            $query_usuario = "SELECT id_usuario, usuario,cpf
                    FROM usuarios 
                    WHERE cpf =:usuario  
                    LIMIT 1";
                                            $result_usuario = $conection->prepare($query_usuario);
                                            $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
                                            $result_usuario->execute();

                                            if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                                                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                                                $chave_recuperar_senha = password_hash($row_usuario['id_usuario'], PASSWORD_DEFAULT);

                                                $query_up_usuario = "UPDATE usuarios SET recuperar_senha =:recuperar_senha WHERE id_usuario =:id_usuario LIMIT 1";
                                                $result_up_usuario = $conection->prepare($query_up_usuario);
                                                $result_up_usuario->bindParam(':recuperar_senha', $chave_recuperar_senha, PDO::PARAM_STR);
                                                $result_up_usuario->bindParam(':id_usuario', $row_usuario['id_usuario'], PDO::PARAM_INT);
                                                $cpf = $row_usuario['cpf'];
                                                
                                                $query = "SELECT nome, email FROM pessoas WHERE cpf = '$cpf' LIMIT 1";
                                                $stmtNew = $conection->prepare($query);
                                                $stmtNew->execute();
                                                $row_pessoas = $stmtNew->fetch();
                                                $nome_pessoa = $row_pessoas["nome"];
                                                $email_pessoa = $row_pessoas["email"];
                                                if ($result_up_usuario->execute()) {
                                                    $link = "http://localhost/loginemail/atualizar_senha.php?chave=$chave_recuperar_senha";


                                                    try {
                                                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                                        $mail->CharSet = 'UTF-8';
                                                        $mail->isSMTP();
                                                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                                        $mail->Host = 'sandbox.smtp.mailtrap.io';
                                                        $mail->SMTPAuth = true;
                                                        $mail->Port = 2525;
                                                        $mail->Username = '10bf2bf1258fd9';
                                                        $mail->Password = '09d5637d01939d';
                                                        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

                                                        //quem envia
                                                        $mail->setFrom('atendimento@allpet.com', 'Atendimento');
                                                        $mail->addAddress($email_pessoa,  $nome_pessoa);
                                                        $mail->isHTML(true);                                  //Set email format to HTML
                                                        $mail->Subject = '[All Pet] Recuperação de senha';
                                                        $mail->Body     = 'Prezado(a) ' .  $nome_pessoa . ".<br><br>Você solicitou alteração de senha.<br><br>
                    Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador:
                     <br><br><a href='" . $link . "'>" . $link . "</a><br><br>Se você não solicitou essa alteração, nenhuma ação é 
                     necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br>";
                                                        $mail->AltBody = 'Prezado(a) ' .  $nome_pessoa . "\n\nVocê solicitou alteração de senha.\n\n
                    Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço 
                    no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária.
                    Sua senha permanecerá a mesma até que você ative este código.\n\n";

                                                        $mail->send();
                                                        $_SESSION['msg'] = "<p style='color: green'>Enviado e-mail com instruções para recuperar a senha. Acesse a sua caixa de e-mail para recuperar a senha!</p>";
                                                        header("Location: index.php");
                                                    } catch (Exception $e) {
                                                        echo "Erro: E-mail não enviado. Mailer Error:
                    {$mail->ErrorInfo}";
                                                    }
                                                }
                                            }
                                        }

                                        if (isset($_SESSION['msg_rec'])) {
                                            echo $_SESSION['msg_rec'];
                                            unset($_SESSION['msg_rec']);
                                        }
                                        ?>

                                        <form method="post" action="">
                                            <?php
                                            $usuario = "";
                                            if (isset($dados['usuario'])) {
                                                $usuario = $dados['usuario'];
                                            } ?>
                                            <div class="form-group">
                                                <label>Digite o usuário</label>
                                                <input type="text" name="usuario" placeholder="Digite o usuário" value="<?php echo $usuario; ?>"><br><br>
                                                <!-- <span class="invalid-feedback"><?php echo $nova_senha_err; ?></span> -->
                                            </div>

                                            <div class="form-group">
                                                <a class="btn btn-link ml-2" href="login.php">Cancelar</a>
                                                <input type="submit" class="btn btn-primary" value="Recuperar Senha" name="SendRecupSenha">
                                            </div>
                                        </form>
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