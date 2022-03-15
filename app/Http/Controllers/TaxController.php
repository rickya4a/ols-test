<?php

namespace App\Http\Controllers;

use App\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'nama' => 'required',
            'kode_pajak' => 'required|numeric',
            'rate' => 'required|numeric|between:0,99.99'
        );

        $messages = array(
            'nama.required' => 'Masukkan nama produk',
            'kode_pajak.required' => 'Masukkan kode pajak',
            'kode_pajak.numeric' => 'Kode pajak hanya menggunakan angka',
            'rate.required' => 'Masukkan rate pajak',
            'rate.numeric' => 'Rate pajak hanya menggunakan angka'
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();

            return \response([
                'data' => null,
                'status' => false,
                'message' => $errors
            ]);
        }

        $add = Tax::addNew($request);

        if (!$add) return $this->reseponseError();

        return $this->responseSuccess('Data berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'nama' => 'required',
            'kode_pajak' => 'required|numeric',
            'rate' => 'required|numeric|between:0,99.99'
        );

        $messages = array(
            'nama.required' => 'Masukkan nama produk',
            'kode_pajak.required' => 'Masukkan kode pajak',
            'kode_pajak.numeric' => 'Kode pajak hanya menggunakan angka',
            'rate.required' => 'Masukkan rate pajak',
            'rate.numeric' => 'Rate pajak hanya menggunakan angka'
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();

            return \response([
                'data' => null,
                'status' => false,
                'message' => $errors
            ]);
        }

        $add = Tax::updateData($request, $id);

        if (!$add) return $this->reseponseError();

        return $this->responseSuccess('Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Tax::deleteData($id);

        if (!$delete) return $this->reseponseError('ID tidak ditemukan');

        return $this->responseSuccess('Data berhasil dihapus');
    }
}
