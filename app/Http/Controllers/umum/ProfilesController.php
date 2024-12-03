<?php

namespace App\Http\Controllers\Umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilesController extends Controller
{

    public function detail($item){
        $data = DB::table('profiles')
            ->where('item', $item)
            ->where('status', 'active')
            ->first();

        // Jika data tidak ditemukan, tampilkan halaman 404
        if (!$data) {
            abort(404, 'Halaman tidak ditemukan.');
        }
        return view("umum.profil.profile_item", compact('data'));
    }
}
