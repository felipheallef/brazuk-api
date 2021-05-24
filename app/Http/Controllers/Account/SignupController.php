<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class SignupController extends Controller
{

    private $fields = ['name', 'surname', 'username', 'birthday', 'email', 'password'];
        
    public function signup(Request $request)
    {

        if (isset($_POST))
        {

            // check if email is valid
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL))
            {

                $isEmpty = $this->checkEmpty($request, $this->fields);

                if (!$isEmpty) {

                    // check if the email is already used
                    if(User::where('email', '=', $request->email)->exists()) {
                        return responder()->error(500, "The email address provided is already used.")->respond();
                    }

                    // check if the username is already used
                    if(User::where('username', '=', $request->username)->exists()) {
                        return responder()->error(500, "The username provided is already used.")->respond();
                    }

                    $bithDate = new \DateTime($request->birthday);
                    $todayDate = new \DateTime(date("d-m-Y"));

                    $interval = $bithDate->diff($todayDate);

                    if ($interval->y < 16) // check if user is 16 or older
                    {
                        return responder()->error(500, "You must be 16 or older in order to sign up.")->respond();
                    }

                    if ($this->validatePassword($request->password))
                    {

                        // if everything is ok, then create a User instance and save it to the database
                        $user = User::create([
                            'name' => $request->name,
                            'surname' => $request->surname,
                            'username' => $request->username,
                            'birthday' => $request->birthday,
                            'email' => $request->email,
                            'password' => password_hash($request->password, PASSWORD_DEFAULT),
                        ]);
                        
                        return responder()->success($user)->respond(201);

                    } else 
                    {
                        return responder()->error(500, "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.")->respond();
                    }
                    
                } else {
                    return $isEmpty;
                }

            } else {
                return responder()->error(500, "The email address provided is invalid.")->respond();
            }

        }

    }

    function checkEmpty($request, $fields)
    {
        foreach ($fields as $field) {

            if (empty($request->$field))
                return responder()->error(500, "The attribute '{$field}' should not be empty.")->respond();
        }

        return false;
    }

    function validatePassword($password)
    {
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
            return false;
        } else {
            return true;
        }

    }

}