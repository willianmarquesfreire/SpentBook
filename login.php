<?php

if(isset($_POST['entrar'])) {
    if (login()) {
        session_start();
        $_SESSION['usuario'] = $_POST['usuario'];
        $_SESSION['senha'] = $_POST['senha'];
        header("Location:sistema.php");
    } else {
        header("Location:index.php?msg=error_login");
    }
} else {
    if (cadastra()) {
        session_start();
        $_SESSION['usuario'] = $_POST['usuario'];
        $_SESSION['senha'] = $_POST['senha'];
        header("Location:sistema.php");
    } else {
        header("Location:index.php?msg=error_login");
    }
}




function login(){
    try {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $conn = new PDO("mysql:host=localhost;dbname=u274078877_wme", "root", "root");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if (empty($usuario) || empty($senha)) {
            return false;
        } else {
            $existe = $conn->query("select * from usuarios where login = '$usuario' and senha = '$senha'");
            
            if($existe->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }  
    } catch(PDOException $e) {
        echo $e->getMessage();
    } 
}


function cadastra(){
    try {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $conn = new PDO("mysql:host=localhost;dbname=u274078877_wme", "root", "root");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (empty($usuario) || empty($senha)) {
           return false;
        } else {
            $existe = $conn->exec("insert into usuarios(login,senha) values('$usuario','$senha')");
            return true;
        }
        
    } catch(PDOException $e) {
        echo $e->getMessage();
        return false;
    } 
}


?>
