<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class DemoController extends Controller
{
    public function dashboard(){
        dd(Auth::user());
        return view('dashboard');
    }

    public function save_demo(Request $request){
        $data = [];
        $success = false;
        $status_code = 200;
        $errors_fields = [];
        $response_message = "something went wrong please try again.";

        $userDetails = User::where('username', $request->username)->first();

        $isLoginFailed = true;
        if ($userDetails) {
            if (Hash::check($request->password, $userDetails->password)) {
                Auth::login(User::find($userDetails->id));

                if (Auth::check()) {
                    $success = true;

                    $status_code = 200;
                    $data['redirectRoute'] = route('dashboard');
                    $response_message = "Login Successfully";
                    $isLoginFailed = false;
                }
            }
        }

        if ($isLoginFailed) {
            $status_code = 400;

            $response_message = "Invalid Password Enter";
            $errors_fields = [
                "password" => "Invalid Password Enter",
            ];
        }

        return Response::json([
            'success'       => $success,
            'data'          => $data,
            'message'       => $response_message,
            'errors_fields' => $errors_fields,
        ], $status_code);
    }

    public function check_connection(){
        try {
            $result = User::all();

            echo "Database connected successfully!";
        } catch (QueryException $e) {
            echo "Failed to connect to the database: " . $e->getMessage();
        }
    }
}
