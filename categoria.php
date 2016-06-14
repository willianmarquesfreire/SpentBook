<?php 
    session_start();
    try {
        $conn = new PDO("mysql:host=localhost;dbname=u274078877_wme", "root", "root");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
    
    $categorias = $conn->query("select * from categorias where usuario = '{$_SESSION['usuario']}'");
    
    

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
                <?php foreach($categorias->fetchAll() as $k => $v): ?>
                <tr>
                    <td><?php echo $v['descricao']; ?></td>
                    <td><?php echo $v['observacoes']; ?></td>
                    <td><a href='' class='glyphicon glyphicon-refresh'></a></td>
                    <td><a href='' class='glyphicon glyphicon-remove'></a></td>
                </tr>
                <?php endforeach; ?>
	    
	    </tbody>
	</table>
	</div>
	<br><br>
	</div>
