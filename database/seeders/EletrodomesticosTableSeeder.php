<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EletrodomesticosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eletrodomesticos')->insert([

            [
                'nome' => 'Geladeira',
                'descricao' => 'Este produto é totalmente versátil. Tudo para ser
             personalizado para comportar o que você preferir',
                'tensao' => '220v',
                'fk_marca' => 2
            ],
            [
                'nome' => 'TV',
                'descricao' => 'Este produto é totalmente versátil. Tudo para ser
             personalizado para comportar o que você preferir',
                'tensao' => '220v',
                'fk_marca' => 4
            ],
            [
                'nome' => 'Fogão',
                'descricao' => 'Este produto é totalmente versátil. Tudo para ser
             personalizado para comportar o que você preferir',
                'tensao' => '220v',
                'fk_marca' => 1
            ],
            [
                'nome' => 'Forno Elétrico',
                'descricao' => 'Este produto é totalmente versátil. Tudo para ser
             personalizado para comportar o que você preferir',
                'tensao' => '220v',
                'fk_marca' => 3
            ]

        ]);
    }
}
