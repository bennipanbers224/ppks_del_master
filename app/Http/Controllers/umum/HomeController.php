<?php

namespace App\Http\Controllers\Umum;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Vidios;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $newsPage = $request->query('page_news', 1);
        $videosPage = $request->query('page_videos', 1);

        // Paginasi video dan berita dengan halaman yang berbeda
        $vidios = Vidios::orderBy('created_at', 'desc')->paginate(6, ['*'], 'page_videos', $videosPage);
        $news = News::orderBy('published_at', 'desc')->paginate(3, ['*'], 'page_news', $newsPage);

        if ($request->ajax()) {
            // Jika permintaan AJAX adalah untuk video
            if ($request->has('page_videos')) {
                $vidioHtml = view('umum.vidios-list', compact('vidios'))->render();
                $paginationHtml = view('umum.pagination', ['pagination' => $vidios])->render();
                return response()->json([
                    'content' => $vidioHtml,
                    'paginationHtml' => $paginationHtml
                ]);
            }

            // Jika permintaan AJAX adalah untuk berita
            if ($request->has('page_news')) {
                $newsHtml = view('umum.news-list', compact('news'))->render();
                $paginationHtml = view('umum.pagination', ['pagination' => $news])->render();
                return response()->json([
                    'content' => $newsHtml,
                    'paginationHtml' => $paginationHtml
                ]);
            }
        }

        return view('umum.home', compact('vidios', 'news'));
    }
}
