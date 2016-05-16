<?php namespace App\Controllers;


use App\Models\Produto;
use App\Views\View;
use tools;

class ProdutoController extends Controller
{	
	public function listar() {
		
		$produto = new Produto();

		$_REQUEST['produtos'] = $produto->listAll();
		$req = $produto->listAll();
		
		View::show('Produto',
				["titulo"=>"wmfwmfwmf",
				 "pro"=>$req]);
	}
}