<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\Discount;
use App\Models\Product;

use function PHPUnit\Framework\isEmpty;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }


    public function CollectionPagination($data, $request)
    {
        if (isEmpty($request->per_page) && isEmpty($request->limit)) {
            $request->per_page = 0;
            $request->limit = 10;
        }
        return $data->skip(@$request->per_page)->take(@$request->limit);
    }
}
