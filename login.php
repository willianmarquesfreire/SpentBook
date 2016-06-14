<?php
	session_start();
	
	$_SESSION["localhost"] = "localhost";
	$_SESSION["server_user"] = "root";
	$_SESSION["server_pass"] = "";
	$_SESSION["server_db"] = "u274078877_wme";
	$logado = "false";


	if(isset($_POST["entrar"])) {
		$_SESSION["usuario"] = $_POST["usuario"];
		$_SESSION["senha"]   = $_POST["senha"];
		
		try {
			$conn = new PDO("mysql:host={$_SESSION['localhost']};dbname={$_SESSION['server_db']}", $_SESSION["server_user"], $_SESSION["server_pass"]);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
		$list = $conn->prepare("select * from usuarios");
		$list->execute();
		
		
		foreach ($list as $k=>$v) {
			var_dump($list);
			if ($v["login"] == $_SESSION["usuario"] && $v["senha"] == $_SESSION["senha"]) {
				$logado = true;
				break;
			} else {
				$logado = false;
			}
		}
		
		if ($logado) {
			header("location:sistema.php");
		} else {
			header("location:index.php?msg=error_login");
			
		}
	} else {
		$_SESSION["usuario"] = $_POST["usuario"];
		$_SESSION["senha"]   = $_POST["senha"];
		
		$sql = "insert into usuarios(login, senha) values('{$_POST["usuario"]}','{$_POST["senha"]}');";
		
		try {
			$conn = new PDO("mysql:host={$_SESSION['localhost']};dbname={$_SESSION['server_db']}", $_SESSION['server_user'], $_SESSION['server_pass']);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $conn->exec($sql);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
		
		
		header("location:sistema.php?msg=usuariocadastrado");
	}
	


?>
