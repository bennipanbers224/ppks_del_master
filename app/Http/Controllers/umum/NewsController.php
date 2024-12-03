<?php

namespace App\Http\Controllers\Umum;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('published_at', 'desc')->paginate(5);
        return view('umum.berita.index', compact('news'));
    }

    public function detail($encryptedNewsId)
    {
        try {
            $news_id = Crypt::decrypt($encryptedNewsId);
            $news = News::findOrFail($news_id);
            return view('umum.berita.detail', compact('news'));
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
