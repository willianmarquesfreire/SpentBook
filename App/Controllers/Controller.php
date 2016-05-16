<?php namespace App\Controllers;

use App\Views\View;

class Controller
{
	public static function db() {
		return $_SESSION['conn'];
	}
}