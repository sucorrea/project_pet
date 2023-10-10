<?php
// Inicialize a sessão
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once "config.php";

$nova_senha = $confirmar_senha = "";
$nova_senha_err = $confirmar_senha_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["nova_senha"]))) {
        $nova_senha_err = "Por favor insira a nova senha.";
    } elseif (strlen(trim($_POST["nova_senha"])) < 6) {
        $nova_senha_err = "A senha deve ter pelo menos 6 caracteres.";
    } else {
        $nova_senha = trim($_POST["nova_senha"]);
    }

    if (empty(trim($_POST["confirmar_senha"]))) {
        $confirmar_senha_err = "Por favor, confirme a senha.";
    } else {
        $confirmar_senha = trim($_POST["confirmar_senha"]);
        if (empty($nova_senha_err) && ($nova_senha != $confirmar_senha)) {
            $confirmar_senha_err = "A senha não confere.";
        }
    }

    if (empty($nova_senha_err) && empty($confirmar_senha_err)) {
        $sql = "UPDATE usuarios SET senha = :senha WHERE id_usuario = :id";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":senha", $param_senha, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);

            $param_senha = password_hash($nova_senha, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id_usuario"];

            if ($stmt->execute()) {
                // Senha atualizada com sucesso. Destrua a sessão e redirecione para a página de login
                session_destroy();
                header("location: login.php");
                exit();
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }

    // Fechar conexão
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Redefinir senha</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
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
                                        <h2>Redefinir senha</h2>
                                        <p>Por favor, preencha este formulário para redefinir sua senha.</p>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <div class="form-group">
                                                <label>Nova senha</label>
                                                <input type="senha" name="nova_senha" class="form-control <?php echo (!empty($nova_senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nova_senha; ?>">
                                                <span class="invalid-feedback"><?php echo $nova_senha_err; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Confirme a senha</label>
                                                <input type="senha" name="confirmar_senha" class="form-control <?php echo (!empty($confirmar_senha_err)) ? 'is-invalid' : ''; ?>">
                                                <span class="invalid-feedback"><?php echo $confirmar_senha_err; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary" value="Redefinir">
                                                <a class="btn btn-link ml-2" href="login.php">Cancelar</a>
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