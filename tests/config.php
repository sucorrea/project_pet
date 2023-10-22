
<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "all_pet_2023";
$port = "localhost";


try {
    $conection = new PDO("mysql:host=$host;port=$port;dbname=" .  $dbname, $user, $pass);
    $conn = mysqli_connect($host, $user, $pass, $dbname);

    echo "Conexão com Banco de Dados Realizados Com Sucesso!";

    // $consulta_funcao = "SELECT nome_funcao, departamento, funcionarios.fkfuncao as id_funcao
    //         FROM funcionarios
    //         INNER JOIN funcao ON  funcao.id = funcionarios.fkfuncao
    //         WHERE funcionarios.cpf_pessoa = '94951382059' LIMIT 1";
    // $stmtJoin = $conection->prepare($consulta_funcao);
    // $stmtJoin->execute();
    // $row_funcionarios = $stmtJoin->fetch();
    // $funcao_pessoa =$row_funcionarios["nome_funcao"];
    // $departamento_pessoa =$row_funcionarios["departamento"];
    // $id_funcao_pessoa =$row_funcionarios["id_funcao"];
    // echo $funcao_pessoa;
    // echo $departamento_pessoa;
    // echo $id_funcao_pessoa;
    
} catch (PDOException $err) {
    echo  $err->getMessage();
}

?>