<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Response;

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

            $found = true;
            $user = User::where('email', $email)->first();

            if($user == null) {
                return responder()->error(403, "The email address provided was not found.")->respond();
            }

            if (password_verify($password, $user->password))
            {
                return responder()->success($user)->respond();
                return response(['status' => 200, 'message' => 'Login successful.', 'user' => $user], 200);
            }
            else
            {
                return responder()->error(403, "Password invalid.")->respond();
            }

            
        }

    }

}
