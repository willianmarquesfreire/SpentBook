
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
	    
	    </tbody>
	</table>
	</div>
	<br><br>
	</div>
