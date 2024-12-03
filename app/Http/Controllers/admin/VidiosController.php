<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vidios;
use Illuminate\Support\Facades\DB;

class VidiosController extends Controller
{
    public function index()
    {
        $vidios = Vidios::where('status', 'Active')->paginate(4);
        return view('admin.vidios.index', compact('vidios'));
    }

    public function formCreate()
    {
        return view('admin.vidios.create');
    }

    public function store(Request $request)
    {

        $vidios = Vidios::create([
            'judul' => $request->vidios_title,
            'keterangan' => $request->vidios_desc,
            'link' => $request->vidios_link,
            'status' => 'Active',
            'created_by' => "Admin",
            'updated_by' => "Admin"
        ]);

        return redirect()->route('admin.vidios.index');
    }

    // public function edit($id)
    // {
    //     $video = DB::table('vidios')->where('vidios_id', $id)->first();
    //     return view('admin.vidios.edit', compact('video'));
    // }

    public function edit(Request $request)
    {
        $videos = Vidios::find($request->vidios_id);

        if (!$videos) {
            return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan']);
        }

        return view('admin.vidios.edit', compact('videos'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'video_title' => 'required',
            'video_link' => 'required',
            'video_desc' => 'required',
        ]);

        // Update data di database
        DB::table('vidios')->where('vidios_id', $id)->update([
            'judul' => $request->video_title,
            'link' => $request->video_link,
            'keterangan' => $request->video_desc,
        ]);

        // Redirect setelah update
        return redirect()->route('admin.vidios.index')->with('success', 'Video updated successfully!');
    }

    public function detailVidios(Request $request)
    {
        $vidios = DB::table('vidios')->where('vidios_id', $request->id)->first();
        if (!$vidios) {
            return redirect()->route('admin.vidios.index')->with('error', 'Video tidak ditemukan!');
        }
        if ($vidios->link) {
            preg_match('/(?:v=)([^&]+)/', $vidios->link, $matches);
            if (isset($matches[1])) {
                $vidios->embedLink = 'https://www.youtube.com/embed/' . $matches[1];
            } else {
                $vidios->embedLink = null;
            }
        }

        return view('admin.vidios.detail', compact('vidios'));
    }


    public function delete(Request $request)
    {

        DB::table('vidios')
            ->where('vidios_id', $request->vidios_id)
            ->update([
                'status' => 'Inactive'
            ]);

        return redirect()->route('admin.vidios.index');
    }
}
