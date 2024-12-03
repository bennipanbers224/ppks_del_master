<?php

namespace App\Http\Controllers\Umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilesController extends Controller
{

    public function directToPengantar(){
        $data = DB::table('profiles')
            ->where('item', "Pengantar")
            ->where('status', 'active')
            ->first();

        // Jika data tidak ditemukan, tampilkan halaman 404
        if (!$data) {
            abort(404, 'Halaman tidak ditemukan.');
        }
        return view("umum.profil.pengantar", compact('data'));
    }

    public function directToRuangLingkup(){
        $data = DB::table('profiles')
            ->where('item', "Ruang Lingkup")
            ->where('status', 'active')
            ->first();

        // Jika data tidak ditemukan, tampilkan halaman 404
        if (!$data) {
            abort(404, 'Halaman tidak ditemukan.');
        }
        return view("umum.profil.ruangLingkup", compact('data'));
    }

    public function directToTugas(){
        $data = DB::table('profiles')
            ->where('item', "Tugas Dan Wewenang")
            ->where('status', 'active')
            ->first();

        // Jika data tidak ditemukan, tampilkan halaman 404
        if (!$data) {
            abort(404, 'Halaman tidak ditemukan.');
        }
        return view("umum.profil.tugas", compact('data'));
    }
    
    public function directToAlurPelaporan(){
        $data = DB::table('profiles')
            ->where('item', "Alur Pelaporan")
            ->where('status', 'active')
            ->first();

        // Jika data tidak ditemukan, tampilkan halaman 404
        if (!$data) {
            abort(404, 'Halaman tidak ditemukan.');
        }
        return view ("umum.profil.alurPelaporan", compact('data'));
    }

    public function directToStruktur(){
        $data = DB::table('profiles')
            ->where('item', "Struktur Organisasi")
            ->where('status', 'active')
            ->first();

        // Jika data tidak ditemukan, tampilkan halaman 404
        if (!$data) {
            abort(404, 'Halaman tidak ditemukan.');
        }
        return view("umum.profil.strukturOrganisasi", compact('data'));
    }
}
