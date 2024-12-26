<?php
namespace App\Traits;
trait HttpResponseTrait
{

    /**
     * Function : common function to display success - json response
     * @param array $data
     * @param string $message
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data=[],$message=null,$code=200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'Request was successful',
            'message' => $message,
            'data' => $data

        ],$code);

    }
    /**
     * Function : common function to display error - json response
     * @param string $message
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error( $message = null, $code): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $code);
    }

    }
