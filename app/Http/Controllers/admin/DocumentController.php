<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function index()
    {
        $document = Document::where('status', 'Active')->get();
        return view('admin.document.index', compact('document'));
    }

    public function form()
    {
        return view('admin.document.form');
    }

    public function store(Request $request)
    {
        if ($request->file('document_file') !== null) {
            $file = $request->file('document_file');
            $extension = $file->getClientOriginalExtension();

            if ($extension != "pdf") {
                return redirect()->back()->with('error', 'Format file harus PDF');
            } else {
                $path = 'document_storage';
                $file = $request->file('document_file');
                $fileName = $file->getClientOriginalName();
                $file->move(public_path($path), $fileName);

                $document = Document::create([
                    'title' => $request->document_title,
                    'file_path' => $path . '/' . $fileName,
                    'status' => 'Active'
                ]);

                return redirect()->back()->with('success', 'Upload File Dokumentasi Sukses');
            }
        } else {
            return redirect()->back()->with('error', 'Formulir file tidak boleh kosong');
        }
    }

    public function edit(Request $request)
    {
        $document = Document::where('document_id', $request->document_id)->first();
        return view('admin.document.edit', compact('document'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'document_id' => 'required|exists:documents,document_id',
            'document_title' => 'required|string|max:255',
            'document_file' => 'nullable|file|mimes:pdf|max:2048', // Opsional, hanya jika ada file baru
        ]);

        // Cek apakah file diunggah
        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $extension = $file->getClientOriginalExtension();

            // Path penyimpanan
            $path = 'document_storage';
            $fileName = time() . '_' . $file->getClientOriginalName(); // Nama unik
            $file->move(public_path($path), $fileName);

            // Update dengan file baru
            DB::table('documents')
                ->where('document_id', $request->document_id)
                ->update([
                    'title' => $request->document_title,
                    'file_path' => $path . '/' . $fileName,
                ]);
        } else {
            // Update hanya judul
            DB::table('documents')
                ->where('document_id', $request->document_id)
                ->update([
                    'title' => $request->document_title,
                ]);
        }

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.document.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'document_id' => 'required|exists:documents,document_id',
        ]);

        DB::table('documents')
            ->where('document_id', $request->document_id)
            ->update(['status' => 'Inactive']);

        return redirect()->route('admin.document.index')
            ->with('success', 'Dokumen berhasil dihapus.');
    }
}
