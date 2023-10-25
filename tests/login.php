<?php
session_start();
require_once "config.php";

$usuario = $senha = "";
$usuario_err = $senha_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty(trim($_POST["usuario"]))) {
    $usuario_err = "Por favor, insira o nome de usuário.";
  } else {
    $usuario = trim($_POST["usuario"]);
  }

  if (empty(trim($_POST["senha_usuario"]))) {
    $senha_err = "Por favor, insira sua senha.";
  } else {
    $senha = trim($_POST["senha_usuario"]);
  }


  if (empty($usuario_err) && empty($senha_err)) {
    $sql = "SELECT id_usuario, senha_usuario, cpf FROM usuarios WHERE  cpf = :usuario";
    if ($stmt = $conection->prepare($sql)) {
      $param_usuario = trim($_POST["usuario"]);
      $stmt->bindParam(":usuario", $param_usuario, PDO::PARAM_STR);

      if ($stmt->execute()) {
        if ($stmt->rowCount() == 1) {
          if ($row = $stmt->fetch()) {
            $id = $row["id_usuario"];
            $hashed_senha = $row["senha_usuario"];
            $cpf = $row["cpf"];
            //tabela pessoas  
            $query = "SELECT nome, email FROM pessoas WHERE cpf = '$cpf' LIMIT 1";
            $stmtNew = $conection->prepare($query);
            $stmtNew->execute();
            $row_pessoas = $stmtNew->fetch();
            $nome_pessoa = $row_pessoas["nome"];
            $email_pessoa = $row_pessoas["email"];

            //tabela funcionarios
            $consulta_funcao = "SELECT nome_funcao, departamento, funcionarios.fkfuncao as id_funcao
            FROM funcionarios
            INNER JOIN funcao ON  funcao.id = funcionarios.fkfuncao
            WHERE funcionarios.cpf_pessoa = '$cpf' LIMIT 1";
            $stmtJoin = $conection->prepare($consulta_funcao);
            $stmtJoin->execute();
            $row_funcionarios = $stmtJoin->fetch();
            $funcao_pessoa = $row_funcionarios["nome_funcao"];
            $departamento_pessoa = $row_funcionarios["departamento"];
            $id_funcao_pessoa = $row_funcionarios["id_funcao"];


            if (password_verify($senha, $hashed_senha)) {
              session_start();
              $_SESSION["loggedin"] = true;
              $_SESSION["id_usuario"] = $id;
              $_SESSION["nome"] = $nome_pessoa;
              $_SESSION["email"] = $email_pessoa;
              $_SESSION["funcao"] = $funcao_pessoa;
              $_SESSION["departamento"] = $departamento_pessoa;
              $_SESSION["id_funcao"] = $id_funcao_pessoa;
              header("location: index.php");
            } else {
              $login_err = "Nome de usuário ou senha inválidos.";
            }
          }
        } else {
          $login_err = "Nome de usuário ou senha inválidos.";
        }
      } else {
        echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
      }
      unset($stmt);
    }
  }
  unset($conection);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <title>All Pet - Login</title>
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
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <?php
                  if (!empty($login_err)) {
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                  }
                  ?>
                  <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                      <input type="text" name="usuario" class="form-control form-control-user  <?php echo (!empty($usuario_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $usuario; ?>" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="usuário" />
                      <span class="invalid-feedback"><?php echo $usuario_err; ?></span>
                    </div>
                    <div class="form-group">
                      <input type="senha_usuario" name="senha_usuario" class="form-control form-control-user <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>" id=" exampleInputsenha" placeholder="Senha" />
                      <span class="invalid-feedback"><?php echo $senha_err; ?></span>
                    </div>
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Entrar">
                  </form>
                  <hr />
                  <div class="text-center">
                    <a class="small" href="recuperar.php">Esqueceu a senha?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="/..vendor/jquery-easing/jquery.easing.min.js"></script> -->
  <script src="../js/sb-admin-2.min.js"></script>
</body>

</html>