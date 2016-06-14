<?php
session_start();
$table = $_GET['table'];
$request = $_POST;
$fields = null;
$values = null;
$sql = null;

foreach ($request as $k => $v) {
    $fields .= $k . ',';
    $values .= "'$v',";    
}
$fields = substr_replace($fields, "", strlen($fields)-1);
$values = substr_replace($values, "", strlen($values)-1);

$sql = "insert into $table(usuario, $fields) values('{$_SESSION['usuario']}', $values)";

try {
        $conn = new PDO("mysql:host=localhost;dbname=u274078877_wme", "root", "root");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (!empty($_POST['descricao'])) {
            $existe = $conn->exec($sql);
            header("Location:sistema.php?table=$table&&msg=cadastro_ok");
        }
        
    } catch(PDOException $e) {
        echo $e->getMessage();
        return false;
    } 

