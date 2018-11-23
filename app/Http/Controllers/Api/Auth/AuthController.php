<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        $rules = [
            'username' => 'required|string'
        ];
        $this->validate($req, $rules);

        return $_SERVER['HTTP_HOST'];
    }

    public function logout()
    {

    }
}
