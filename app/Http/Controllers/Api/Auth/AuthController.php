<?php
namespace App\Http\Controllers\Api\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\PersonalAccessToken;


class AuthController extends BaseController
{

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Form tidak valid',['error' => $validator->errors()]);
        }

        if(Auth::attempt($request->only('email','password'))){ 
            $user = Auth::user(); 

            if($user->role == 'penjual'){
                $success['token'] =  $user->createToken('RolePenjual')->plainTextToken; 
            }else if($user->role == 'pembeli'){
                $success['token'] =  $user->createToken('RolePembeli',['produk:show','produk:index','transaksi:show','transaksi:create','transaksi:delete'])->plainTextToken; 
            }
            $success['name'] =  $user->name;
            $success['userId'] = $user->id;
            $success['role'] = $user->role;
            return $this->sendResponse($success, 'User Berhasil Login');
        } 
        else{ 

            return $this->sendError('email dan password tidak di temukan', ['error'=>'Username dan password tidak di temukan']);
        } 
    }

    public function register(Request $reqest):JsonResponse
    {

        
    }

    public function logout(Request $request): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();
        return $this->sendResponse([], 'User logged out successfully.');
    }
}