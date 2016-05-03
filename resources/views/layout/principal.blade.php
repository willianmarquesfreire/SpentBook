<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="/public/css/app.css" rel="stylesheet">
<link href="/public/css/custom.css" rel="stylesheet">
<title>Controle de estoque</title>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="/produtos">
					Estoque Laravel
				</a>
				
				<ul class="nav navbar-nav navbar-rigt">
					<li><a href="{{action('ProdutoController@lista')}}">Listagem</a></li>
					<li><a href="{{action('ProdutoController@novo')}}">Novo</a></li>
				</ul>
			</div>
			</div>
		</nav>
		@yield('conteudo')
		<footer class="footer">
			<p>© Willian Marques Freire</p>
		</footer>
	</div>
</body>
</html>