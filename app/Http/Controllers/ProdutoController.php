<?php namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Request;
use App\Produto;
use App\Http\Requests\ProdutoRequest;

class ProdutoController extends Controller 
{
	public function lista() {
		$produtos = Produto::all();
		return view('produto.listagem')->withProdutos($produtos);
	}
	
	public function mostra($id) {
		$resposta = Produto::find($id);
		
		if(empty($resposta)) {
			return "Esse produto não existe";
		}
		return view('produto.detalhes')->with('p', $resposta[0]);
	}
	
	public function novo() {
		return view('produto.formulario');
	}
	
	public function adiciona(ProdutoRequest $request) {
		
		Produto::create($request::all());
		
		return redirect()
			->action('ProdutoController@lista')
			->withInput(Request::only('nome'));
	}
	
	public function remove($id) {
		$produto = Produto::find($id);
		$produto->delete();
		return redirect()->action('ProdutoController@lista');
	}
	
	public function altera($id) {
		return view('produto.formulario')->with('id', $id);
	}
	
	public function atualiza($id) {
		
		$produto = Produto::find($id);
		$produto->update(Request::all());
		
		return redirect()->action('ProdutoController@lista');
	}
	
	public function listaJson() {
		$produtos = Produto::all();
		return response()->json($produtos);
	}
}

