@extends('layouts.admin.app')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Daftar File Dokumentasi PPKS</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('admin.document.form') }}" class="btn btn-outline-primary btn-sm btn-lg"><i class="fas fa-plus fa-sm"></i>&nbsp Tambah File Dokumentasi</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($document as $document)
                    <tr>
                        <td>{{$document->title}}</td>
                        <td>{{$document->file_path}}</td>
                        <td>
                            <form action="{{ route('admin.document.edit') }}" method="post">
                                @csrf
                                <input type="hidden" name="document_id" value="{{$document->document_id}}">
                                <button class="btn btn-light btn-sm" type="submit">Detail Dokumen &nbsp<i class="fas fa-arrow-right"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection