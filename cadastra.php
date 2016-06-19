<?php
session_start();
$table = $_GET["table"];
$request = $_POST;
$server = $_SESSION["localhost"];
$user = $_SESSION["server_user"];
$pass = $_SESSION["server_pass"];
$db = $_SESSION["server_db"];
$erro = null;

$fields = null;
$values = null;

foreach ($request as $k => $v) {
        if ($k == 'dtemissao' || $k == 'dtpagamento') {
            $fields .= $k . ",";
            $values .= "'". date("Y-m-d", strtotime(str_replace("/", "-", $v))) . "',";
        } else if($k == 'vlrbruto' || $k == 'vlrdesconto' || $k == 'vlrjuros' || $k == 'vlrliquido' || $k == 'saldoinicial' || $k == 'saldoatual') { 
            $fields .= $k . ",";
            $values .= "'". str_replace(",", ".", $v) . "',";
        } else {
            $fields .= $k . ",";
            $values .= "'". $v . "',";
        }
}

$fields = substr($fields, 0, -1);
$values = substr($values, 0, -1);

if ($table != "categorias") {
    $sql = "insert into $table(usuario, id, $fields) values('{$_SESSION['usuario']}', null, $values);";
} else {
    $sql = "insert into $table(usuario, $fields) values('{$_SESSION['usuario']}', $values);";
}
//var_dump($sql);




try {
    if($_POST['descricao'] != '') {
	$conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->query($sql);
    }
    header("Location:sistema.php?msg=cadastro_ok&&table=$table");
        
} catch (PDOException $e) {
	$erro = $e->getMessage();
        header("Location:sistema.php?msg=cadastro_error&&table=$table");
}




?>

<!DOCTYPE html>
<html lang="pt-br">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SpentBook</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <style>
        .glyphicon {
            font-size: 25px;
        }
        #usuario {
            float: right;
            font-size: 15px;

        }
    </style>
    <body>
        <div class="container-fluid">
			<div id="panel panel-success">
				<h3><?php if($erro == null) { echo "Cadastrando!"; } else { echo "Erro! $erro"; } ?></h3>
			</div>
        </div>
    </body>
</html>
