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
	
	$list = $conn->prepare("select * from contas where usuario = '{$_SESSION['usuario']}'");
	$list->execute();


?>
	<div class="container-fluid">
	
	<h1>Conta</h1>
	
	<form id="form" role="form" action="./cadastra.php?table=contas" method="POST" class="form">
	    <div class="form-group">
	        <label for="descricao" class="control-label">Descrição: </label>
	        <input type="text" name="descricao" class="form-control" placeholder="Digite uma descrição">
	        <br>
	        <label for="observacoes" class="control-label">Observações: </label>
	        <input type="text" name="observacoes" class="form-control" placeholder="Adicione detalhes sobre esta conta">
	        <br>
                <label for="saldoinicial" class="control-label">Saldo Inicial: </label>
	        <input type="text" name="saldoinicial" class="form-control" placeholder="Digite um Saldo Inicial">
	        <br>
                <label for="saldoatual" class="control-label">Saldo Atual: </label>
                <input type="text" value="0.00" name="saldoatual" class="form-control" disabled="disabled">
	        <br>
                <label for="tipo" class="control-label">Tipo: </label>
	        <select class="form-control" name='tipo'>
                    <option value="poupança" selected="selected">poupança</option>
                    <option value="corrente">corrente</option>
                </select>
                <br>
	        <button type="submit" class="btn btn-default">Salvar</button>
	    </div>
	</form>
	<br>
	<div class="table-all">
	<table id="int" class="table table-striped table-hover">
	    <thead class="success">
	    	<th>Descrição</th>
	        <th>Observações</th>
	        <th>Saldo Inicial</th>
	        <th>Saldo Atual</th>
	        <th>Tipo</th>
	        <th>Alterar</th>
	        <th>Excluir</th>
	    </thead>
	    <tbody>
	    <?php 
	    foreach ($list as $index => $reg):
            if ($reg['saldoatual'] < 0) {
                $opt = 'danger';
            } if ($reg['saldoatual'] < $reg['saldoinicial']) {
                $opt = 'warning';
            } else {
                $opt = 'success';
            }
	    ?>
	    <tr class="<?=$opt?>">
	        <td><?php echo $reg["descricao"];?></td>
	        <td><?php echo $reg["observacoes"];?></td>
                <td><?php echo $reg["saldoinicial"];?></td>
                <td><?php echo $reg["saldoatual"];?></td>
                <td><?php echo $reg["tipo"];?></td>
	        <td><a href=
	        		<?php echo
	        		"./altera.php?table=contas".
                    str_replace(" ", "_", "&&id={$reg['id']}").
	        		str_replace(" ", "_", "&&descricao={$reg['descricao']}").
                    str_replace(" ", "_", "&&saldoinicial={$reg['saldoinicial']}").
                    str_replace(" ", "_", "&&saldoatual={$reg['saldoatual']}").
                    str_replace(" ", "_", "&&tipo={$reg['tipo']}").
	        		str_replace(" ", "_", "&&observacoes={$reg['observacoes']}");
	        		?> id="altera" name="altera"><span class="glyphicon glyphicon-refresh"></span></p> </a></td>
	        <td><a href="./deleta.php?table=contas&&id=<?php echo $reg['id']; ?>" id="deleta"><span class="glyphicon glyphicon-remove"></span></p> </a></td> 	
	    </tr>
	    <?php endforeach; ?>	
	    </tbody>
	</table>
	</div>
	<br><br>
	</div>
