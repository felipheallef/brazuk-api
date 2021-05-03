<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use App\Http\Controllers\Controller;
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

    public function login()
    {

        if (isset($_POST))
        {

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $found = true;
            $user = User::where('email', $email)->first();

            if($user == null) {
                return response(['status' => 403, 'message' => 'The email address provided was not found.', 'user' => null], 200);
            }

            if (password_verify($password, $user->password))
            {
                return response(['status' => 200, 'message' => 'Login successful.', 'user' => $user], 200);
            }
            else
            {
                return response(['status' => 403, 'message' => 'Password invalid.', 'user' => null], 200);
            }

            
        }

    }

}
