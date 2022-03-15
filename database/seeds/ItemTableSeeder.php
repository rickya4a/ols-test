<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item')->insert([
            [
                'nama' => 'baju batik',
                'kode_pajak' => 1
            ],
            [
                'nama' => 'celana panjang',
                'kode_pajak' => 2
            ]
        ]);
    }
}
