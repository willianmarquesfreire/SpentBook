<?php


require __DIR__.'/../App/routes.php';
$url = strtolower($_SERVER['REQUEST_URI']);
$route = substr_replace($url, '', 0, strpos($url, '.php') + 4);
if ($route == "" || $route == "/") {
	include __DIR__."/../public/server.php";
} else {
	open($routes, $route);
}

function open($routes, $route) {
	foreach ($routes as $k => $v) {
		if($v[1] == $route) {
			$nameClass = substr($v[2], 0, strpos($v[2], '@'));
			$location = typeLocation($nameClass);
				
			$class = $location . $nameClass;
			$method = substr($v[2], strpos($v[2], '@') + 1, strlen($v[2]));
			
			$obj = new $class();
			$obj->$method();
		}
	}
}


function typeLocation($nameClass) {
	if (strstr($nameClass, 'Controller')) {
		return "App\\Controllers\\";
	} else if (strstr($nameClass, 'View')) {
		return  "App\\views\\";
	} else {
		return  "";
	}
}

function route($act) {
	require __DIR__.'/../App/routes.php';
	foreach ($routes as $k => $v) {
		if($v[2] == $act) {
			echo $_SERVER["REQUEST_URI"] . $v[1];
		}
	}
}




