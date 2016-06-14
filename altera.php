<?php
session_start();
$server = $_SESSION["localhost"];
$user = $_SESSION["server_user"];
$pass = $_SESSION["server_pass"];
$db = $_SESSION["server_db"];

if (isset($_POST["salvar"])) {
	
	$request = $_POST;
	$update = null;
	
	foreach ($request as $k => $v) {
		if ($v == $_POST["table"] || $k == "id" || $k == "salvar" || $k == "descricaoanterior") {
			continue;
		} else {
                    if ($k == 'dtemissao' || $k == 'dtpagamento') {
                        $update .= "$k = '".date("Y-m-d", strtotime(str_replace("/", "-", $v)))."',";
                    } else if($k == 'vlrbruto' || $k == 'vlrdesconto' || $k == 'vlrjuros' || $k == 'vlrliquido' || $k == 'saldoinicial' || $k == 'saldoatual') { 
                        $update .= "$k = '". str_replace(",", ".", $v) . "',";
                    } else {
                        $update .= "$k = '$v',";
                    }
		}
	}
	
	$update = substr($update, 0, -1);
	
	if ($_POST['table'] != 'categorias') {
            $sql = "update {$_POST['table']} set $update where usuario = '{$_SESSION['usuario']}' and id = '{$_POST['id']}'";
        } else {
            $sql = "update {$_POST['table']} set $update where usuario = '{$_SESSION['usuario']}' and descricao = '{$_POST['descricaoanterior']}'";
            
        }
	
        //var_dump($sql);
	try {
		$conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->query($sql);
        header("Location:sistema.php?msg=altera_ok&&table={$_POST['table']}");
	} catch (PDOException $e) {
		echo $e->getMessage();
        header("Location:sistema.php?msg=altera_error&&table={$_POST['table']}");
	}
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
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
        .table-all {
        	overflow-x: scroll;
        }
    </style>
</head>
<body>
	<?php if ($_GET["table"] != null) {?>
	<div class="container-fluid">
		<?php if ($_GET["table"] == "financeiro") { ?>
		<h1>Financeiro</h1>
		<form id="form" role="form" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="POST" class="form">
		    <div class="form-group">
		    	<input type="hidden" name="table" value="<?php echo str_replace("_", " ", $_GET['table']); ?>">
		    	<input type="hidden" name="id" value="<?php echo str_replace("_", " ", $_GET['id']); ?>">
		    	
		        <label for="descricao" class="control-label">Descrição: </label>
		        <input value="<?php echo str_replace("_", " ", $_GET['descricao']); ?>" type="text" name="descricao" class="form-control">
		        <br>
		        <label for="categoria" class="control-label">Categoria: </label>
		        <select class="form-control" name='categoria'>
		        	<?php 
		        	$conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
		        	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			        $categorias = $conn->prepare("select * from categorias where usuario = '{$_SESSION['usuario']}'");
			        $categorias->execute();
			        
			        foreach ($categorias as $index => $reg):
			        ?> 
			        <option value="<?php echo $reg['descricao']; ?>" <?php if($reg['descricao']==str_replace("_", " ", $_GET['categoria'])){ echo " selected='selected' "; }?>><?php echo $reg['descricao'];?></option> 
			        <?php endforeach; ?>
		        </select>	
		        <br>
		        <label for="status" class="control-label">Status: </label>
                        <select class="form-control" name='status'>
                            <option value="aberto" selected="selected">aberto</option>
                            <option value="fechado">fechado</option>
                            <option value="cancelado">cancelado</option>
                        </select>
                        <br>
                        <label for="tipo" class="control-label">Tipo: </label>
                        <select class="form-control" name='tipo'>
                            <option value="débito" selected="selected">débito</option>
                            <option value="crédito">crédito</option>
                        </select>
                        <br>
		        <label for="dtemissao" class="control-label">Data Emissão: </label>
		        <input value="<?php echo str_replace("_", " ", $_GET['dtemissao']); ?>"  type="date" name="dtemissao" class="form-control">
		        <br>
		        <label for="dtpagamento" class="control-label">Data Pagamento: </label>
		        <input value="<?php echo str_replace("_", " ", $_GET['dtpagamento']); ?>"  type="date" name="dtpagamento" class="form-control">
		        <br>
		        <label for="vlrbruto" class="control-label">Valor Bruto: </label>
		        <input value="<?php echo str_replace("_", " ", $_GET['vlrbruto']); ?>"  type="text" name="vlrbruto" class="form-control">
		        <br>
		        <label for="vlrdesconto" class="control-label">Valor Desconto: </label>
		        <input value="<?php echo str_replace("_", " ", $_GET['vlrdesconto']); ?>"  type="text" name="vlrdesconto" class="form-control">
		        <br>
		        <label for="vlrjuros" class="control-label">Valor Juros: </label>
		        <input value="<?php echo str_replace("_", " ", $_GET['vlrjuros']); ?>"  type="text" name="vlrjuros" class="form-control">
		        <br>
		        <label for="vlrliquido" class="control-label">Valor Liquido: </label>
		        <input value="<?php echo str_replace("_", " ", $_GET['vlrliquido']); ?>"  type="text" name="vlrliquido" class="form-control">
		        <br>
		        <label for="conta" class="control-label">Conta: </label>
		        <select class="form-control" name='conta'>
		        	<?php 
		        	$conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
		        	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			        $contas = $conn->prepare("select * from contas where usuario = '{$_SESSION['usuario']}'");
			        $contas->execute();
			        foreach ($contas as $index => $reg):
			        //if ($_GET['conta'] == $reg['descricao']) { $selected = "selected='selected'"; } else { $selected = ''; }
			        ?> 
			        <option value="<?php echo $reg['id']?>" <?php if($reg['id']==str_replace("_", " ", $_GET['conta'])){ echo " selected='selected' "; }?> ><?php echo $reg['descricao']?></option> 
			        <?php endforeach; ?>
		        </select>
		        <br>
		        <label for="observacoes" class="control-label">Observações: </label>
		        <input value="<?php echo str_replace("_", " ", $_GET['observacoes']); ?>"  type="text" name="observacoes" class="form-control">
		        <br>
		        <button name="salvar" type="submit" class="btn btn-default">Salvar</button>
		    </div>
		</form>
                <?php } else if ($_GET["table"] == "categorias") { ?>
                <h1>Categoria</h1>
	
                <form id="form" role="form" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="POST" class="form">
		    <div class="form-group">
                        
                        <input type="hidden" name="table" value="<?php echo str_replace("_", " ", $_GET['table']); ?>">
		    	<input type="hidden" name="descricaoanterior" value="<?php echo str_replace("_", " ", $_GET['descricao']); ?>">
                        
                               
                        <label for="descricao" class="control-label">Descrição: </label>
                        <input placeholder="<?php echo str_replace("_", " ", $_GET['descricao']); ?>" type="text" name="descricao" class="form-control">
                        <br>
                        <label for="observacoes" class="control-label">Observações: </label>
                        <input value="<?php echo str_replace("_", " ", $_GET['observacoes']); ?>" type="text" name="observacoes" class="form-control">
                        <br>
                        
                        
                        
                        <button name="salvar" type="submit" class="btn btn-default">Salvar</button>
                    </div>
                </form>
                <?php } else if ($_GET["table"] == "contas") { ?>
                <h1>Conta</h1>
	
                <form id="form" role="form" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="POST" class="form">
		    <div class="form-group">
                        <input type="hidden" name="table" value="<?php echo str_replace("_", " ", $_GET['table']); ?>">
		    	<input type="hidden" name="id" value="<?php echo str_replace("_", " ", $_GET['id']); ?>"
                               
                        <label for="descricao" class="control-label">Descrição: </label>
                        <input value="<?php echo str_replace("_", " ", $_GET['descricao']); ?>"  type="text" name="descricao" class="form-control" placeholder="Digite uma descrição">
                        <br>
                        <label for="observacoes" class="control-label">Observações: </label>
                        <input value="<?php echo str_replace("_", " ", $_GET['observacoes']); ?>"  type="text" name="observacoes" class="form-control" placeholder="Adicione detalhes sobre esta conta">
                        <br>
                        <label for="saldoinicial" class="control-label">Saldo Inicial: </label>
                        <input value="<?php echo str_replace("_", " ", $_GET['saldoinicial']); ?>"  type="text" name="saldoinicial" class="form-control" placeholder="Digite um Saldo Inicial">
                        <br>
                        <label for="saldoatual" class="control-label">Saldo Atual: </label>
                        <input value="<?php echo str_replace("_", " ", $_GET['saldoatual']); ?>"  type="text" value="0.00" name="saldoatual" class="form-control" disabled="disabled">
                        <br>
                        <label for="tipo" class="control-label">Tipo: </label>
                        <select class="form-control" name='tipo'>
                            <option value="débito" selected="selected">débito</option>
                            <option value="crédito">crédito</option>
                        </select>
                        <br>
                        <button name="salvar" type="submit" class="btn btn-default">Salvar</button>
                    </div>
                </form>
                <?php } ?>
                
	</div>
	<?php } ?>
</body>
</html>