<?php

namespace App\Http\Controllers\Umum;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::orderBy('document_id', 'desc')->paginate(6);
        return view('umum.dokumen.index', compact('documents'));
    }


    public function download($document_id)
    {
        $document = Document::findOrFail($document_id);
        $filePath = public_path('document/' . $document->file_path);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->route('umum.dokumen')->with('error', 'File tidak ditemukan.');
        }
    }
}
