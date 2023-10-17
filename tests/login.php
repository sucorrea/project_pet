<?php
session_start();

//Verifique se o usuário já está logado, em caso afirmativo, redirecione-o para a página de boas-vindas
// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//   header("location: index.php");

//   exit;
// }
//Incluir arquivo de configuração
require_once "config.php";

// Defina variáveis e inicialize com valores vazios
$usuario = $senha = "";
$usuario_err = $senha_err = $login_err = "";

// Processando dados do formulário quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Verifique se o nome de usuário está vazio
  if (empty(trim($_POST["usuario"]))) {
    $usuario_err = "Por favor, insira o nome de usuário.";
  } else {
    $usuario = trim($_POST["usuario"]);
  }

  // Verifique se a senha está vazia
  if (empty(trim($_POST["senha"]))) {
    $senha_err = "Por favor, insira sua senha.";
  } else {
    $senha = trim($_POST["senha"]);
  }

  // Validar credenciais
  if (empty($usuario_err) && empty($senha_err)) {
    // Prepare uma declaração selecionada
    $sql = "SELECT id_usuario, senha, cpf FROM usuarios WHERE  cpf = :usuario";

    echo $sql;

    if ($stmt = $pdo->prepare($sql)) {
      // Vincule as variáveis à instrução preparada como parâmetros
      $stmt->bindParam(":usuario", $param_usuario, PDO::PARAM_STR);

      // Definir parâmetros
      $param_usuario = trim($_POST["usuario"]);

      // Tente executar a declaração preparada
      if ($stmt->execute()) {
        // Verifique se o nome de usuário existe, se sim, verifique a senha
        if ($stmt->rowCount() == 1) {
          if ($row = $stmt->fetch()) {
            $id = $row["id_usuario"];
           
            $hashed_senha = $row["senha"];
            $cpf = $row["cpf"];

            

            $query = "SELECT nome, email FROM pessoas WHERE cpf = '$cpf'";
            $result = mysqli_query($conn, $query);
            $fetchs = mysqli_fetch_row($result);

            $consulta_funcao = "SELECT nome_funcao, departamento, funcionarios.fkfuncao
            FROM funcionarios
            INNER JOIN funcao ON  funcao.id = funcionarios.fkfuncao
            WHERE funcionarios.cpf_pessoa = '$cpf'";
            
            $result2 = mysqli_query($conn, $consulta_funcao);
            $retorno_funcao = mysqli_fetch_row($result2);
            echo ($retorno_funcao[0]);
            echo ($retorno_funcao[1]);

            if ($senha == $hashed_senha) {
              // A senha está correta, então inicie uma nova sessão

              session_start();




              // Armazene dados em variáveis de sessão
              $_SESSION["loggedin"] = true;
              $_SESSION["id_usuario"] = $id;
              $_SESSION["nome"] = $fetchs[0];
              $_SESSION["funcao"] = $retorno_funcao[0];
              $_SESSION["departamento"] = $retorno_funcao[1];
              $_SESSION["id_funcao"] = $retorno_funcao[2];



              // Redirecionar o usuário para a página de boas-vindas
              header("location: index.php");
            } else {
              // A senha não é válida, exibe uma mensagem de erro genérica
              $login_err = "Nome de usuário ou senha inválidos.";
            }
          }
        } else {
          // O nome de usuário não existe, exibe uma mensagem de erro genérica
          $login_err = "Nome de usuário ou senha inválidos.";
        }
      } else {
        echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
      }

      // Fechar declaração
      unset($stmt);
    }
  }
  unset($pdo);
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
                      <input type="senha" name="senha" class="form-control form-control-user <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>"" id=" exampleInputsenha" placeholder="senha" />
                      <span class="invalid-feedback"><?php echo $senha_err; ?></span>

                    </div>

                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Entrar">
                  </form>
                  <hr />
                  <div class="text-center">
                    <a class="small" href="recuperar-senha.php">Esqueceu a senha?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
</body>

</html>