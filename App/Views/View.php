<?php namespace App\Views;

class View
{
	
	
	public static function show($view, $args = null, $location = 'App/Views/') {
		
		
		$page = $location . $view . 'View.php';
		$template = self::getTemplate($page);
		if ($args !== null) {
			$templateFinal = self::parseTemplate( $template, $args );
		} else {
			$templateFinal = $template;
		}
		
		echo $templateFinal;
		
		return __CLASS__;
	}
	
	public static function getTemplate( $template) {
	$arqTemp = $template; // criando var com caminho do arquivo
	if ( is_file( $arqTemp ) ) { // verificando se o arq existe
		ob_start();
		include $arqTemp;
		$contents = ob_get_contents();
		ob_end_clean();
		return $contents;
	} else
		return FALSE;
	}
	
	public static function parseTemplate( $template, $array ) {
		foreach ($array as $a => $b) { // recebemos um array com as tags
			if (is_string($b)) {
				$template = str_replace( "{{".$a."}}", $b, $template );
			} else {
				$foreach = substr($template, strpos($template,"@foreach($a)") + strlen("@foreach($a)"), 
											 strpos($template,"@endforeach")-strpos($template,"@foreach($a)") - 13);
				$novoforeach = $foreach;
				$concatforeach = "";
				
				foreach ($b as $data) {
					$novoforeach = $foreach;
					foreach ($data as $k => $v) {
						//var_dump($v);
						$novoforeach = str_replace( "{{".$a."=>".$k."}}", $v, $novoforeach);
					}
					$concatforeach .= $novoforeach;
				}
				
				$template = substr_replace($template, $concatforeach, strpos($template,"@foreach($a)"), 
											 strpos($template,"@endforeach"));
				
			}
		}
		
		
		$namelayout = substr(substr($template, strpos($template, "@layout('")+9),0, strpos($template, "')")-9);
		$layout = null;
		if ($namelayout != null) {
			ob_start();
			include __DIR__."/layout/$namelayout.php";
			$layout = ob_get_contents();
			ob_end_clean();
			//var_dump($layout);
		}
		
		$section = substr(substr($template, strpos($template, "@section('")+10),0, strpos($template, "')")-13);
		
		$template = substr_replace($template, "", strpos($template,"@section('$section')"),  strlen("@section('$section')"));
		$template = substr_replace($template, "", strpos($template,"@layout('$namelayout')"),  strlen("@layout('$namelayout')"));
		
		
		$layout = substr_replace($layout, $template, 
				strpos($layout,"@include('$section')"),
				strlen($section) + 12);		
		
		
		return $layout; // retorno o html com conteúdo final
	}
	
	
}