
<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "all_pet_2023";
$port = "localhost";


try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=" .  $dbname, $user, $pass);
    $conn = mysqli_connect($host, $user, $pass, $dbname);

    echo "Conexão com Banco de Dados Realizados Com Sucesso!";
} catch (PDOException $err) {
    echo "Deu Merda!!!!!!!! " . $err->getMessage();
}

?>