<?php


namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller as Controller;


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
            // Convert associative array to a flat list of errors
            $errors = [];
    
            foreach ($errorMessages as $type => $message) {
                $errors[] = [
                    'type' => $type,
                    'error_message' => $message,
                ];
            }
    
            $response['data'] = $errors;
        }
    

        return response()->json($response, $code);
    }

    protected function checkBearerToken(Request $request)
    {
        $bearerToken = $request->bearerToken();

        if (empty($bearerToken)) {
            return Inertia::render('Error', ['message' => 'Bearer token is missing.']);
        }
    }
}
