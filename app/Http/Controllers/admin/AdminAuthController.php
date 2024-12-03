<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Document;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = Hash::make($request->password);

        

        $user = DB::table('users')
                ->where('email', $email)
                ->first();

        if ($user && Hash::check($request->password, $user->password_hash)) {
            Session::put('user_id', $user->user_id);
            Session::put('name', $user->name);
            Session::put('role_id', $user->role_id);
            Session::put('email', $user->email);
            Session::put('isLoggin', TRUE);


            return redirect('/admin');
        }
        else{
            return redirect()->back()->withInput()->with('error', 'Akun Admin Belum Terdaftar');
        }

    }

    public function logout(){
        session()->flush();

        session()->invalidate();
        return redirect('/admin');
    }
}
