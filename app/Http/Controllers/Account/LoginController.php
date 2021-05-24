<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Firebase\JWT\JWT;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function login(Request $request)
    {

        if (isset($_POST))
        {

            $email = $request->email;
            $password = $request->password;

            $user = User::where('email', $email)->first();

            if($user == null) {
                return responder()->error(403, "The email address provided was not found.")->respond();
            }

            if (password_verify($password, $user->password))
            {

                $payload = array(
                    "iss" => "Brazuk API",
                    "aud" => "brazuk-api",
                    "iat" => time(),
                    "exp" => time() + 7889400,
                    "sub" => $user->email,
                    "name" => $user->name,
                    "surname" => $user->surname,
                    "email" => $user->email
                );

                $jwt = JWT::encode($payload, env('JWT_KEY'));

                $data = $user;
                $data->token = $jwt;

                return responder()->success($data)->respond();
                return response(['status' => 200, 'message' => 'Login successful.', 'user' => $user], 200);
            }
            else
            {
                return responder()->error(403, "Password invalid.")->respond();
            }

            
        }

    }

    public function logout(Request $request)
    {
        return "hey";
    }

}
