<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{

    protected $fillable = [
        'nama', 'kode_pajak'
    ];

    public static function getItems($id = null)
    {
        if ($id != null) {
            return DB::table('item')->where('id', $id)->get();
        }

        $data = DB::select("
            SELECT a.id, a.nama,
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'id',
                        b.id,
                        'nama',
                        b.nama,
                        'rate',
                        CONCAT(FORMAT( b.rate * 100, 0 ), '%' ))
                ) AS pajak
            FROM item a
            LEFT JOIN tax b ON a.kode_pajak = b.kode_pajak
            GROUP BY a.id, a.nama
        ");

        // convert JSON_ARRAYAGG to JSON
        foreach ($data as $row) {
            $row->pajak = json_decode($row->pajak);
        }

        return $data;
    }

    public static function addNew($data)
    {
        $item = DB::table('item')->insert([
            ['nama' => $data->nama, 'kode_pajak' => $data->kode_pajak]
        ]);

        return $item;
    }

    public static function updateData($data, $id)
    {
        $_getItem = self::getItems($id);

        if ($_getItem->count() == 0) return false;

        $update = DB::table('item')
                    ->where('id', $id)
                    ->update([
                        'nama' => $data->nama,
                        'kode_pajak' => $data->kode_pajak
                    ]);

        return true;
    }

    public static function deleteData($id)
    {
        $_getItem = self::getItems($id);

        if ($_getItem->count() == 0) return false;

        $delete = DB::table('item')->delete($id);

        return true;
    }
}
