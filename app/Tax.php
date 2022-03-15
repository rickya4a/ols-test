<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tax extends Model
{
    protected $fillable = [
        'nama', 'kode_pajak', 'rate'
    ];

    public static function addNew($data)
    {
        $tax = DB::table('tax')->insert([
            [
                'nama' => $data->nama,
                'kode_pajak' => $data->kode_pajak,
                'rate' => $data->rate
            ]
        ]);

        return $tax;
    }

    public static function updateData($data, $id)
    {
        $_getTax = DB::table('tax')->where('id', $id)->get();

        if ($_getTax->count() == 0) return false;

        $update = DB::table('tax')
                    ->where('id', $id)
                    ->update([
                        'nama' => $data->nama,
                        'kode_pajak' => $data->kode_pajak,
                        'rate' => $data->rate
                    ]);

        return true;
    }

    public static function deleteData($id)
    {
        $_getItem = DB::table('tax')->where('id', $id)->get();

        if ($_getItem->count() == 0) return false;

        $delete = DB::table('tax')->delete($id);

        return true;
    }
}
