@extends('layouts.umum.app')
@section('content')
<div class="container mt-4">
    <div class="title-container">
        <h1 class="title-styling">Daftar Dokumen</h1>
    </div>

    <div class="row">
        @foreach($documents as $document)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $document->title }}</h5>
                    <p class="card-text text-muted">Diterbitkan: {{ $document->created_at->format('d M Y') }}</p>
                    <a href="{{ asset($document->file_path) }}" class="btn btn-primary" download>
                        <i class="bi bi-download"></i> Download
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <ul class="pagination align-items-center">
            <!-- Previous Page -->
            <li class="page-item {{ $documents->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $documents->previousPageUrl() }}">
                    <i class="bi bi-arrow-left"></i> Previous
                </a>
            </li>

            <!-- Keterangan jumlah data -->
            <li class="page-item disabled">
                <span class="page-link">
                    Menampilkan {{ $documents->count() }} dari {{ $documents->total() }} dokumen
                </span>
            </li>

            <!-- Next Page -->
            <li class="page-item {{ $documents->nextPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $documents->nextPageUrl() }}">
                    Next <i class="bi bi-arrow-right"></i>
                </a>
            </li>
        </ul>
    </div>
</div>

@endsection