<?php namespace App\Models;

class Produto extends Model
{
	protected $table = "produtos";
	protected $fields = ['id','nome','valor','descricao','quantidade'];
}