@extends('layouts.umum.app')
@section('content')
<div class="container mt-4">
    <div class="title-container">
        <h1 class="title-styling">Berita Terbaru</h1>
    </div>

    @if($news->isEmpty())
    <p class="text-center">Belum ada berita untuk ditampilkan.</p>
    @else
    <div class="row">
        @foreach($news as $item)
        <div class="col-10 mb-4 mx-auto">
            <div class="card shadow-sm" style="min-height: 350px;">
                <!-- Gambar -->
                <img src="{{ asset('news_storage/' . $item->foto) }}" class="card-img-top img-fluid" style="max-height: 200px; object-fit: cover;" alt="{{ $item->title }}">

                <!-- Body Card -->
                <div class="card-body p-3 d-flex flex-column">
                    <!-- Tanggal Penerbitan -->
                    <p class="text-muted small mb-1" style="font-style: italic;">
                        {{ \Carbon\Carbon::parse($item->published_at)->format('d M Y') }}
                    </p>

                    <!-- Judul dan Konten -->
                    <h5 class="card-title mb-2">{{ $item->title }}</h5>
                    <p class="card-text text-muted">{!! Str::limit($item->content, 100) !!}</p>

                    <!-- Tombol -->
                    <div class="mt-auto">
                        <a href="{{ route('umum.berita.detail', ['news' => encrypt($item->news_id)]) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        <ul class="pagination align-items-center">
            <!-- Previous Page -->
            <li class="page-item {{ $news->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $news->previousPageUrl() }}">
                    <i class="bi bi-arrow-left"></i> Previous
                </a>
            </li>

            <!-- Keterangan jumlah data -->
            <li class="page-item disabled">
                <span class="page-link">
                    Menampilkan {{ $news->count() }} dari {{ $news->total() }} berita
                </span>
            </li>

            <!-- Next Page -->
            <li class="page-item {{ $news->nextPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $news->nextPageUrl() }}">
                    Next <i class="bi bi-arrow-right"></i>
                </a>
            </li>
        </ul>
    </div>
    @endif
</div>
@endsection