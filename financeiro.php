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
	
	$list = $conn->prepare("select * from financeiro where usuario = '{$_SESSION['usuario']}'");
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
	        <select class="form-control" name='categoria'>
		        <?php 
		        $categorias = $conn->prepare("select * from categorias where usuario = '{$_SESSION['usuario']}'");
		        $categorias->execute();
		        foreach ($categorias as $index => $reg):
		        ?> 
		        <option value="<?php echo $reg['descricao']?>"><?php echo $reg['descricao']?></option> 
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
                <input value="<?php echo date('d-m-Y'); ?>" id="dtemissao"  type="date" name="dtemissao" class="form-control">
	        <br>
	        <label for="dtpagamento" class="control-label">Data Pagamento: </label>
	        <input type="date" name="dtpagamento" id="dtpagamento" class="form-control" placeholder="Digite uma data para pagamento">
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
	        <select class="form-control" name='conta'>
		        <?php 
		        $contas = $conn->prepare("select * from contas where usuario = '{$_SESSION['usuario']}'");
		        $contas->execute();
		        foreach ($contas as $index => $reg):
		        ?> 
		        <option value="<?php echo $reg['id']?>"><?php echo $reg['descricao']?></option> 
		        <?php endforeach; ?>
	        </select>
	        <br>
	        <label for="observacoes" class="control-label">Observações: </label>
	        <input type="text" name="observacoes" class="form-control" placeholder="Adicione detalhes sobre este vencimento">
	        <br>
	        <button type="submit" class="btn btn-default">Salvar</button>
	    </div>
	</form>
	<br>
	<div class="table-all">
	<table id="int" class="table table-striped table-hover">
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
                if(date('Y-m-d') >= $reg['dtpagamento'] && $reg['status'] == "aberto") {
                    $opt = "danger";
                } else if($reg['status'] == 'cancelado') {
                    $opt = "warning";
                } else if($reg['status'] == 'fechado') {
                    $opt = "success";
                } else {
                    $opt = "";
                }
	    ?>
	    <tr class="<?=$opt?>">
	        <td><?php echo $reg["descricao"];?></td>
	        <td><?php echo $reg["categoria"];?></td>
	        <td><?php echo $reg["status"];?></td>
	        <td><?php echo $reg["tipo"];?></td>
	        <td><?php echo date("d-m-Y", strtotime($reg["dtemissao"]));?></td>
	        <td><?php echo date("d-m-Y", strtotime($reg["dtpagamento"]));?></td>
	        <td><?php echo "R$ " . $reg["vlrbruto"];?></td>
	        <td><?php echo "R$ " . $reg["vlrdesconto"];?></td>
	        <td><?php echo "R$ " . $reg["vlrjuros"];?></td>
	        <td><?php echo "R$ " . $reg["vlrliquido"];?></td>
	        <td>
	        <?php 
	        	try {
			        $contas = $conn->prepare("select * from contas where usuario = '{$_SESSION['usuario']}' and id = '{$reg['conta']}';");
			        $contas->execute();
			        foreach ($contas as $i => $r) {
			        	echo $r['descricao'];
			        }
	        	} catch (PDOException $e) {
	        		echo $e->getMessage();
	        	}
		    ?>
		    </td>
	        <td><?php echo $reg["observacoes"];?></td>
	        <td><a href=
	        		<?php echo
	        		"./altera.php?table=financeiro".
	        		str_replace(" ", "_", "&&id={$reg['id']}").
	        		str_replace(" ", "_", "&&descricao={$reg['descricao']}").
	        		str_replace(" ", "_", "&&categoria={$reg['categoria']}").
	        		str_replace(" ", "_", "&&status={$reg['status']}").
	        		str_replace(" ", "_", "&&tipo={$reg['tipo']}").
	        		str_replace(" ", "_", "&&dtemissao=".date('d-m-Y', strtotime($reg['dtemissao']))).
	        		str_replace(" ", "_", "&&dtpagamento=".date('d-m-Y', strtotime($reg['dtpagamento']))).
	        		str_replace(" ", "_", "&&vlrbruto={$reg['vlrbruto']}").
	        		str_replace(" ", "_", "&&vlrdesconto={$reg['vlrdesconto']}").
	        		str_replace(" ", "_", "&&vlrjuros={$reg['vlrjuros']}").
	        		str_replace(" ", "_", "&&vlrliquido={$reg['vlrliquido']}").
	        		str_replace(" ", "_", "&&conta={$reg['conta']}").
	        		str_replace(" ", "_", "&&observacoes={$reg['observacoes']}")
	        		?> id="altera" name="altera"><span class="glyphicon glyphicon-refresh"></span></p> </a></td>
	        <td><a href="./deleta.php?table=financeiro&&id=<?php echo $reg['id']; ?>" id="deleta"><span class="glyphicon glyphicon-remove"></span></p> </a></td> 	
	    </tr>
	    <?php endforeach; ?>	
	    </tbody>
	</table>
	</div>
	<br><br>
	</div>
