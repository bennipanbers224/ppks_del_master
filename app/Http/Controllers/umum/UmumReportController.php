<?php

namespace App\Http\Controllers\umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

class UmumReportController extends Controller
{
    public function directToForm(){
        return view ('umum.report.form-report');
    }

    public function store(Request $request){

        $client = new Client();
        $url = env('API_URL')."jwt-api/do-auth";

        try {
            $response = $client->post($url, [
                'form_params' => [
                    'username' => $request->input('username'),
                    'password' => $request->input('password'),
                ],
                'headers'=> [
                    'Accept'=>'application/json',
                ],
                'timeout'=> 30, // Timeout yang lebih wajar
            ]);

            $body = json_decode($response->getBody(), true);
            
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                // echo "Data". $e->getResponse()->getBody();
                if($e->getResponse()->getStatusCode() == 200){
                    $data = json_decode($e->getResponse()->getBody(), true);
                    if($data['result']){
                        $user = $data['user'];
                        $dataResponse = $this->getUserDetail($user['user_id']);
                            
                        $message = json_decode($dataResponse->getContent());

                        if($message->success == "Success Response"){
                            return redirect()->back()->withInput()->with('success', 'Verifikasi akun berhasil, laporan berhasil dikirimkan.');
                        }else{
                            return redirect()->back()->withInput()->with('error', $message->error);
                        }

                    }else{
                        return redirect()->back()->withInput()->with('error', $data['error']);
                    }
                }
            }
            else{
                return redirect()->back()->withInput()->with('error', "Gagal terhubung ke server. Silahkan coba lagi!");
            }
        } catch (Exception $e) {
            // Log error umum
            Log::error("Error: " . $e->getMessage());
            Log::error("File: " . $e->getFile());
            Log::error("Line: " . $e->getLine());

            return redirect()->back()->withInput()->with('error', "Terjadi Kesalahan");
        }

    }

    public function getUserDetail($user_id){

        $url = env('API_URL')."library-api/pegawai?userid=".$user_id;
        $token = trim(Cache::get('token'));

        $client = new Client();

        try {
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,  // Ensure no extra spaces
                ],
            ]);
        
            $data = json_decode($response->getBody(), true);

            $detailUser = $data['data'];
            $dataDetailUser = $detailUser['pegawai'];

            return response()->json([
                'success' => 'Success Response',
                'error' => ''
            ], 200);

        } catch (RequestException $e) {
            if ($e->getResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $responseBody = $e->getResponse()->getBody()->getContents();
        
                return response()->json([
                    'success'=>'',
                    'error' => 'Invalid token or other authentication error',
                    'details' => $responseBody
                ], $statusCode);
            } else {
                return response()->json(['success'=>'','error' => 'An unknown error occurred'], 500);
            }
        }
        
    }

}
