<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        
        $this->call('ProdutoTableSeeder');

        //Model::reguard();
    }
}



class ProdutoTableSeeder extends Seeder
{
	public function run() {
		DB::insert('insert into produtos
				(nome, quantidade, valor, descricao)
				values (?,?,?,?)',
				array('Geladeira', 2, 5900.00,
						'Side by Side com Gelo na Porta'));

				DB::insert('insert into produtos
		(nome, quantidade, valor, descricao)
		values (?,?,?,?)',
						array('Fog�o', 5, 950.00,
								'Painel autom�tico e forno el�trico'));

						DB::insert('insert into produtos
		(nome, quantidade, valor, descricao)
		values (?,?,?,?)',
								array('Microondas', 1, 1520.00,
										'Manda SMS quando termina de esquentar'));


	}
}