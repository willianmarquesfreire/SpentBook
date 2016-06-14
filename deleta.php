<?php
session_start();
$table = $_GET["table"];
$request = $_POST;
$server = $_SESSION["localhost"];
$user = $_SESSION["server_user"];
$pass = $_SESSION["server_pass"];
$db = $_SESSION["server_db"];
$erro = null;

if ($table != categorias) {
    $sql = "Delete from $table where usuario = '{$_SESSION['usuario']}' and id = '{$_GET['id']}'";
} else {
    $sql = "Delete from $table where usuario = '{$_SESSION['usuario']}' and descricao = '{$_GET['descricao']}'";
}
//var_dump($sql);

try {
	$conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->query($sql);
        header("Location:sistema.php?msg=deleta_ok&&table=$table");
} catch (PDOException $e) {
	echo $e->getMessage();
        header("Location:sistema.php?msg=deleta_error&&table=$table");
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
                                <h3>Deletando!</h3>
			</div>
        </div>
    </body>
</html>
