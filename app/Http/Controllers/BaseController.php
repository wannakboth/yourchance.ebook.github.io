<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function noDataAvailable($message = null)
    {
        return response()->json([
            'code' => Response::HTTP_NOT_FOUND,
            'description' => $message ?? app_lang('No Data Available.' , 'មិនមានទិន្នន័យ')
        ]);
    }
    public function normalResponse($data = null)
    {
        $response['code'] = Response::HTTP_OK;
        $response['description'] = app_lang('Success', 'ជោគជ័យ');
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response);
    }
    public function customResponse($data = [])
    {
        $response['code'] = Response::HTTP_OK;
        $response['description'] = app_lang('Success', 'ជោគជ័យ');
        return response()->json(array_merge($response, $data));
    }

    public function errorsResponse(\Throwable $errors)
    {
        $class = $errors->getFile();
        $file = '(C):' . class_basename($class);
        $line = '(L):' . $errors->getLine();
        $message = '(M):' . $errors->getMessage();
        return response()->json([
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'description' => $file . $line . $message,
        ]);
    }
}
