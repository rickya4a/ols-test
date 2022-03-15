<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Error response
     *
     * @param string $message
     * @return void
     */
    public function reseponseError($message = 'Terjadi kesalahan')
    {
        return \response([
            'data' => null,
            'status' => false,
            'message' => $message
        ]);
    }

    /**
     * Success reponse
     *
     * @param string $message
     * @param array|object|null $data
     * @return void
     */
    public function responseSuccess($message, $data = null)
    {
        return \response([
            'data' => $data,
            'status' => true,
            'message' => $message
        ]);
    }
}
