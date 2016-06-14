
	<div class="container-fluid">
	
	<h1>Financeiro</h1>
	
	<form id="form" role="form" action="./cadastra.php?table=financeiro" method="POST" class="form">
	    <div class="form-group">
	        <label for="descricao" class="control-label">Descrição: </label>
	        <input type="text" name="descricao" class="form-control" placeholder="Digite uma descrição">
	        <br>
	        <label for="categoria" class="control-label">Categoria: </label>
	        <select class="form-control" name='categoria'>
		        
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
                
	   	
	    </tbody>
	</table>
	</div>
	<br><br>
	</div>
