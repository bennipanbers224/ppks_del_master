<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('status', 'Active')->get();
        return view('admin.news.index', compact('news'));
    }

    public function directForm()
    {
        return view('admin/news/create');
    }

    public function detailNews(Request $request)
    {
        $news = News::find($request->news_id);
        if (!$news) {
            return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan']);
        }
        return view('admin.news.detail', compact('news'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'news_foto' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
            'news_title' => 'required|string|max:255',
            'news_content' => 'required|string',
        ]);

        $uploadUrl = public_path('news_storage');

        if ($request->hasFile('news_foto')) {
            $file = $request->file('news_foto');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move($uploadUrl, $filename);

            $news = News::create([
                'title' => $request->news_title,
                'content' => $request->news_content,
                'foto' => $filename,
                'status' => "Active",
                'published_at' => $request->publish_date,
            ]);

            return redirect()->route('admin.news.index');
        }

        return back()->with('error', 'File upload failed.');
    }

    public function edit(Request $request)
    {
        $news = News::find($request->news_id);

        if (!$news) {
            return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan']);
        }

        return view('admin.news.edit', compact('news'));
    }

    public function delete(Request $request)
    {
        DB::table('news')
            ->where('news_id', $request->news_id)
            ->update([
                'status' => "Inactive"
            ]);

        return redirect()->route('admin.news.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'news_foto' => 'nullable|file|mimes:jpg,png,jpeg|max:2048', // Validasi untuk gambar
            'news_title' => 'required|string|max:255',
            'news_content' => 'required|string',
        ]);

        $news = News::findOrFail($id);

        // Cek apakah ada gambar yang diupload
        if ($request->hasFile('news_foto')) {
            if ($news->foto) { // Gunakan 'foto' di sini
                $oldImagePath = public_path('news_storage/' . $news->foto);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Proses upload gambar baru
            $file = $request->file('news_foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('news_storage'), $filename);

            // Update kolom foto
            $news->foto = $filename;  // Pastikan kolom yang digunakan adalah 'foto'
        }

        // Update data berita lain
        $news->title = $request->news_title;
        $news->content = $request->news_content;
        $news->published_at = $request->publish_date;

        // Simpan perubahan
        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui');
    }
}
