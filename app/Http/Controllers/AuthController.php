<?php

namespace App\Http\Controllers;

use App\Models\{User, UserDetail};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\{LoginRequest, RegisterRequest, ChangePasswordRequest};
use Illuminate\Support\Facades\Auth;
   

class AuthController extends BaseController {

    public function login(LoginRequest $request) {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $auth = Auth::user(); 
            $success['token'] =  $auth->createToken('LaravelSanctumAuth')->plainTextToken; 
            $success['name'] =  $auth->name;
            $success['user'] =  $auth;
            return $this->sendResponse($success, 'User logged-in!');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function register(RegisterRequest $request) {
        $input = $request->all();
        $user = User::create($input);
        $userData['user_id'] = $user->id;
        $userData['gender'] = $request['gender']??1;
        $userData['wa_country_code'] = $request['mob_country_code']??971;
        $userData['wa_mobile_no'] = $request['mobile_no']??'';
        UserDetail::create($userData);
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] =  $user->name;
        return $this->sendResponse($success, 'User successfully registered!');
    }

    public function changePassword(ChangePasswordRequest $request){
        $user = User::find(auth()->user()->id);
        if(isset($user->id)){
            if(Hash::check($request->current_password, $user->password)){
                $user->password = $request->new_password;
                $user->save();
                return $this->sendResponse('', 'Password changed successfully');
            }
            else{
                return $this->sendError('Incorrect Current password');
            }
        }
        else{
        $data['message'] =  "Login First";
        $data['status'] =  202;
        }
        return response()->json($data, 202);
    }

    public function user(Request $request){
        $user = $request->user();
        if(isset($user->id))
            return $this->sendResponse($user, 'Success');
        else
            return $this->sendError('Incorrect login');
    }

    //Logout user (Revoke the token)
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
        'message' => 'Successfully logged out'
        ]);
    }

}
