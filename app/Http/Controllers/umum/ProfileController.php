<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function detail($item)
    {
        // Ambil data berdasarkan parameter item
        $data = DB::table('profile')
            ->where('item', $item)
            ->where('status', 'active')
            ->first();

        // Jika data tidak ditemukan, tampilkan halaman 404
        if (!$data) {
            abort(404, 'Halaman tidak ditemukan.');
        }

        // Kirim data ke view
        return view('umum.profile.item', compact('data'));
    }

    
}
