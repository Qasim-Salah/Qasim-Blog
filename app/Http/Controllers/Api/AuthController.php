<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    use GeneralTrait;

    public function register(Request $request)
    {
        try {
            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile' => ['required', 'numeric', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ];
            $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) {
                $code = $this->returnCodeAccordingToInput($validation);
                return $this->returnValidationError($code, $validation);
            }

            $data['name'] = $request->name;
            $data['username'] = $request->username;
            $data['email'] = $request->email;
            $data['email_verified_at'] = Carbon::now();
            $data['mobile'] = $request->mobile;
            $data['role_id'] = 3;
            $data['password'] = bcrypt($request->password);
            $data['status'] = 1;

            $user = User::create($data);

            return $this->returnData('user', $user);
        } catch (\Exception $ex) {
            return $this->returnError('E001', 'Unauthorized');

        }
    }

    public function login(Request $request)
    {
        try {
            $rules = ["username" => "required", "password" => "required"];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            //login

            $user = User::where('username', $request->username)
                ->orwhere('password', $request->password)->first();

            $token = $user->createToken('access_Token')->accessToken;
            return $this->returnData('token', $token);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


}
