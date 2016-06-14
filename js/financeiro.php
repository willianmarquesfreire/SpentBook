<?php 
	session_start();
	$server = $_SESSION["localhost"];
	$user = $_SESSION["server_user"];
	$pass = $_SESSION["server_pass"];
	$db = $_SESSION["server_db"];
	
	var_dump($user);
	var_dump($pass);
	var_dump($db);
	
	try {
		$conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	
	var_dump($conn);
	$list = $conn->prepare("select * from financeiro");
	$list->execute();
	
	
?>
	<div class="container-fluid">
	
	<h1>Financeiro</h1>
	
	<form id="form" role="form" action="./cadastra.php?table=financeiro" method="POST" class="form">
	    <div class="form-group">
	        <label for="descricao" class="control-label">Descrição: </label>
	        <input type="text" name="descricao" class="form-control" placeholder="Digite uma descrição">
	        <br>
	        <label for="categoria" class="control-label">Categoria: </label>
	        <input  type="text" name="categoria" class="form-control" placeholder="Selecione uma categoria">
	        <br>
	        <label for="status" class="control-label">Status: </label>
	        <input type="text" name="status" class="form-control" placeholder="Selecione um Status">
	        <br>
	        <label for="tipo" class="control-label">Tipo: </label>
	        <input type="text" name="tipo" class="form-control" placeholder="Selecione um tipo">
	        <br>
	        <label for="dtemissao" class="control-label">Data Emissão: </label>
	        <input value="<?php echo date('d-m-Y'); ?>"  type="text" name="dtemissao" class="form-control" disabled="disabled">
	        <br>
	        <label for="dtpagamento" class="control-label">Data Pagamento: </label>
	        <input type="text" name="dtpagamento" class="form-control" placeholder="Digite uma data para pagamento">
	        <br>
	        <label for="vlrbruto" class="control-label">Valor Bruto: </label>
	        <input value="0.00" type="text" name="vlrbruto" class="form-control" placeholder="">
	        <br>
	        <label for="vlrdesconto" class="control-label">Valor Desconto: </label>
	        <input value="0.00"  type="text" name="vlrdesconto" class="form-control" placeholder="Adicione desconto">
	        <br>
	        <label for="vlrjuros" class="control-label">Valor Juros: </label>
	        <input value="0.00"  type="text" name="vlrjuros" class="form-control" placeholder="Adicione Juros">
	        <br>
	        <label for="vlrliquido" class="control-label">Valor Liquido: </label>
	        <input value="0.00"  type="text" name="vlrliquido" class="form-control">
	        <br>
	        <label for="conta" class="control-label">Conta: </label>
	        <input type="text" name="conta" class="form-control" placeholder="Selecione uma Conta">
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
	        <th>Categoria</th>
	        <th>Status</th>
	        <th>Tipo</th>
	        <th>Data Emissão</th>
	        <th>Data Pagamento</th>
	        <th>Valor Bruto</th>
	        <th>Valor Desconto</th>
	        <th>Valor Juros</th>
	        <th>Valor Líquido</th>
	        <th>Conta</th>
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
	        <td><?php echo $reg["categoria"];?></td>
	        <td><?php echo $reg["status"];?></td>
	        <td><?php echo $reg["tipo"];?></td>
	        <td><?php echo $reg["dtemissao"];?></td>
	        <td><?php echo $reg["dtpagamento"];?></td>
	        <td><?php echo $reg["vlrbruto"];?></td>
	        <td><?php echo $reg["vlrdesconto"];?></td>
	        <td><?php echo $reg["vlrjuros"];?></td>
	        <td><?php echo $reg["vlrliquido"];?></td>
	        <td><?php echo $reg["conta"];?></td>
	        <td><?php echo $reg["observacoes"];?></td>
	        <td><a href=
	        		<?php echo
	        		"./altera.php?table=financeiro".
	        		"&&id={$reg['id']}".
	        		"&&descricao={$reg['descricao']}".
	        		"&&categoria={$reg['categoria']}".
	        		"&&status={$reg['status']}".
	        		"&&tipo={$reg['tipo']}".
	        		"&&dtemissao={$reg['dtemissao']}".
	        		"&&dtpagamento={$reg['dtpagamento']}".
	        		"&&vlrbruto={$reg['vlrbruto']}".
	        		"&&vlrdesconto={$reg['vlrdesconto']}".
	        		"&&vlrjuros={$reg['vlrjuros']}".
	        		"&&vlrliquido={$reg['vlrliquido']}".
	        		"&&conta={$reg['conta']}".
	        		"&&observacoes={$reg['observacoes']}";
	        		?> id="altera" name="altera"><span class="glyphicon glyphicon-refresh"></span></p> </a></td>
	        <td><a href="./deleta.php?table=financeiro&&id=<?php echo $reg['id']; ?>" id="deleta"><span class="glyphicon glyphicon-remove"></span></p> </a></td> 	
	    </tr>
	    <?php endforeach; ?>	
	    </tbody>
	</table>
	</div>
	<br><br>
	</div>
