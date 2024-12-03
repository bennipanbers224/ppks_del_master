<?php

namespace App\Http\Controllers\Umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilesController extends Controller
{

    public function directToPengantar(){
        return view("umum.profil.pengantar");
    }

    public function directToRuangLingkup(){
        return view("umum.profil.ruangLingkup");
    }

    public function directToTugas(){
        return view("umum.profil.tugas");
    }
    
    public function directToAlurPelaporan(){
        return view ("umum.profil.alurPelaporan");
    }

    public function directToStruktur(){
        return view("umum.profil.strukturOrganisasi");
    }
}
