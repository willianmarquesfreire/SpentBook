@layout('CadastroView')
<?php 
$produtos = $_REQUEST['produtos'];
?>

@section('interior')
{{titulo}}
	<table id="int">
		<tr><th>ID</th>
		<th>Nome</th>
		<th>Descricao</th>
		<th>Quantidade</th>
		</tr>
		@foreach(pro)
		<tr>
			<td>{{pro=>id}}</td>
			<td>{{pro=>nome}}</td>
			<td>{{pro=>descricao}}</td>
			<td>{{pro=>quantidade}}</td>
		</tr>
		@endforeach
			
	</table>
@endsection
