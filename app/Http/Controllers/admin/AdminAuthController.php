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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;


class AdminAuthController extends Controller
{

    public function login(Request $request)
    {

        
        $client = new Client();

        try {
            $response = $client->post(env('API_URL')."jwt-api/do-auth", [
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
                        if($user['role'] == "Mahasiswa"){
                            return redirect()->back()->withInput()->with('error', 'Mohon maaf, Anda tidak memiliki akses untuk login');
                        }else{
                            Session::put('role', $user['role']);
                        
                            Cache::put('token', $data['token'], now()->addHour());

                            $dataResponse = $this->getUserDetail($user['user_id']);
                            
                            $message = json_decode($dataResponse->getContent());

                            if($message->success == "Success Response"){
                                return redirect('/admin');
                            }else{
                                return redirect()->back()->withInput()->with('error', $message->error);
                            }
                        }

                    }else{

                        return redirect()->back()->withInput()->with('error', $data['error']);
                    }
                }
            }
            else{
                return response()->json(['error' => 'Permintaan gagal.'], 500);
            }
        } catch (Exception $e) {
            // Log error umum
            Log::error("Error: " . $e->getMessage());
            Log::error("File: " . $e->getFile());
            Log::error("Line: " . $e->getLine());

            return response()->json(['error' => 'Terjadi kesalahan.'], 500);
        }

    }

    //function for hit api detail user
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

            Session::put('user_id', $dataDetailUser[0]['user_id']);
            Session::put('name', $dataDetailUser[0]['nama']);
            Session::put('email', $dataDetailUser[0]['email']);
            Session::put('token', $token);
            Session::put('isLoggin', TRUE);

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

    public function logout(){
        session()->flush();

        session()->invalidate();
        return redirect('/admin');
    }
}
