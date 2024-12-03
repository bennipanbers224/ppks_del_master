@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Tombol Tambah Berita -->
    <div class="mb-3 text-right">
        <a href="{{route('admin.news.create')}}" class="btn btn-outline-primary btn-sm btn-lg">
            <i class="fas fa-plus fa-sm"></i> Tambah Berita
        </a>
    </div>

    <!-- Tabel Data -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Berita</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Tanggal Terbit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ Carbon\Carbon::parse($item->published_at)->translatedFormat('d F Y') }}</td>
                            <td>
                                <form action="{{ route('admin.news.detail') }}" method="post" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="news_id" value="{{ $item->news_id }}">
                                    <button class="btn btn-light btn-sm" type="submit">
                                        Detail Berita &nbsp;<i class="fas fa-arrow-right"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection