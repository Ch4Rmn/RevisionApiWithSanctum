<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function successResponse($data, $data2, $message)

    {
        return response()->json([
            "error" => false,
            "message" => $message,
            "data" => $data,
            "Token" => $data2
        ]);

        // $response = [

        //     'success' => true,

        //     'data'    => $result,

        //     'message' => $message,

        // ];


        // return response()->json($response, 200);
    }


    /**

     * return error response.

     *

     * @return \Illuminate\Http\Response

     */

    public function errorResponse($error, $errorMessages = [], $code = 404, $data = [])

    {

        $response = [

            'success' => false,

            'message' => $error,

            'data' => $data

        ];


        if (!empty($errorMessages)) {

            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}
