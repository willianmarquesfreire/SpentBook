@extends('layout.principal')

@section('conteudo')

<h1>Novo Produto</h1>

@if(count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
@endif
@if(empty($id))
<form action= "/produtos/adiciona" method="post">
@else 
<form action= "/produtos/atualiza/{{$id}}" method="post">
@endif 
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
	
	<div class="form_group">
		<label>Nome:</label>
		<input class="form-control" name="nome" value="{{old('nome')}}">
	</div>
	<div class="form_group">
		<label>Descricao:</label>
		<input class="form-control" name="descricao" value="{{old('descricao')}}">
	</div>
	<div class="form_group">
		<label>Valor:</label>
		<input class="form-control" name="valor" value="{{old('valor')}}">
	</div>
	<div class="form_group">
	<label>Quantidade:</label>
	<input type="number" class="form-control" name="quantidade" value="{{old('quantidade')}}">
	</div>
	<button type="submit" class="btn btn-primary btn-bloc">Submit</button>
</form>

@stop


