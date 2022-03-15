<?php

use Illuminate\Database\Seeder;

class TaxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tax')->delete();

        DB::table('tax')->insert([
            [
                'nama' => 'pajak toko',
                'rate' => 0.1,
                'kode_pajak' => 1
            ],
            [
                'nama' => 'pph',
                'rate' => 0.05,
                'kode_pajak' => 1
            ],
            [
                'nama' => 'pajak toko',
                'rate' => 0.1,
                'kode_pajak' => 2
            ],
            [
                'nama' => 'pph',
                'rate' => 0.05,
                'kode_pajak' => 2
            ]
        ]);
    }
}
