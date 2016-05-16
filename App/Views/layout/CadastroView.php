<!DOCTYPE html>
<html lang="pt-br">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>SpentBook</title>
<link rel="stylesheet" href="public/css/bootstrap.min.css">
<script src="public/js/jquery.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<style>
#int {
	border: 1px solid black;
}
</style>

<body>
<div class="container-fluid">
	<a href=<?php route("ProdutoController@listar"); ?>>Produtos</a>
	@include('interior')
</div>
</body>
</html>
