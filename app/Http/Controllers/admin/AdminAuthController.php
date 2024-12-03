<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        // $client = new Client([
        //     'headers' => [
        //         'Content-Type' => 'application/x-www-form-urlencoded', // Disable Expect header
        //         'Accept' => '*/*',
        //         'Accept-Encoding' => 'gzip, deflate, br',
        //         'Connection'=>'keep-alive',
        //     ],
        // ]);
        // $response = $client->post('https://cis-dev.del.ac.id/api/jwt-api/do-auth', [
        //     'form_params' => [
        //         'username' => "johannes",
        //         'password' => "Del@2022",
        //     ],
        //     'timeout' => 60, // Increase the timeout if needed
        //     'max_redirects' => 5, // Allow redirects
        //     'http_errors' => false, // Disable automatic HTTP error handling
        // ]);

        // $data = json_decode($response->getBody(), true);
        // echo $data;

        return view('admin.dashboard.dashboard');
    }
}
