<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('status')->insert(
        [
	        [
	        	'name' => 'pendente',
	        	'display_name' => 'Pendente'
	        ],
	        [
	        	'name' => 'desenvolvimento',
	        	'display_name' => 'Em Desenvolvimento'
	        ],
	        [
	        	'name' => 'testando',
	        	'display_name' => 'Em teste'
	        ],
	        [
	        	'name' => 'concluido',
	        	'display_name' => 'Concluído'
	        ]
	    ]
    	);
    }
}
