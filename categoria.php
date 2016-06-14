<?php 
	session_start();
	$server = $_SESSION["localhost"];
	$user = $_SESSION["server_user"];
	$pass = $_SESSION["server_pass"];
	$db = $_SESSION["server_db"];
	$conn = null;
	
	try {
		$conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo $e->getMessage();
                
	}
	
	$list = $conn->prepare("select * from categorias where usuario = '{$_SESSION['usuario']}'");
	$list->execute();


?>
	<div class="container-fluid">
	
	<h1>Categoria</h1>
	
	<form id="form" role="form" action="./cadastra.php?table=categorias" method="POST" class="form">
	    <div class="form-group">
	        <label for="descricao" class="control-label">Descrição: </label>
	        <input type="text" name="descricao" class="form-control" placeholder="Digite uma descrição">
	        <br>
	        <label for="observacoes" class="control-label">Observações: </label>
	        <input type="text" name="observacoes" class="form-control" placeholder="Adicione detalhes sobre este vencimento">
	        <br>
	        <button type="submit" class="btn btn-default">Salvar</button>
	    </div>
	</form>
	<br>
	<div class="table-all">
	<table id="int" class="table table-striped">
	    <thead class="success">
	    	<th>Descrição</th>
	        <th>Observações</th>
	        <th>Alterar</th>
	        <th>Excluir</th>
	    </thead>
	    <tbody>
	    <?php 
	    foreach ($list as $index => $reg): 
	    ?>
	    <tr>
	        <td><?php echo $reg["descricao"];?></td>
	        <td><?php echo $reg["observacoes"];?></td>
	        <td><a href=
	        		<?php echo
	        		"./altera.php?table=categorias".
	        		str_replace(" ", "_", "&&descricao={$reg['descricao']}").
	        		str_replace(" ", "_", "&&observacoes={$reg['observacoes']}");
	        		?> id="altera" name="altera"><span class="glyphicon glyphicon-refresh"></span></p> </a></td>
	        <td><a href="./deleta.php?table=categorias&&descricao=<?php echo $reg['descricao']; ?>" id="deleta"><span class="glyphicon glyphicon-remove"></span></p> </a></td> 	
	    </tr>
	    <?php endforeach; ?>	
	    </tbody>
	</table>
	</div>
	<br><br>
	</div>
