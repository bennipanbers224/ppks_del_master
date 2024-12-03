@php
$currentPage = $vidios->currentPage(); // Halaman aktif
$lastPage = $vidios->lastPage(); // Total halaman
$startPage = max(1, $currentPage - 1); // Halaman awal
$endPage = min($lastPage, $currentPage + 1); // Halaman akhir
@endphp

<div class="vidio-container mt-4">
    <h1 class="vidio-title text-center mb-4">Vidio Terbaru</h1>
    <div class="row">
        @foreach($vidios as $vidio)
        <div class="col-md-4 mb-3 d-flex">
            <div class="card shadow-sm w-100">
                <iframe class="card-img-top" src="{{ $vidio->embed_link }}" frameborder="0" allowfullscreen></iframe>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $vidio->judul }}</h5>
                    <p class="card-text text-muted">{{ $vidio->created_at->format('d M Y') }}</p>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($vidio->keterangan, 100) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Custom Pagination -->
    <div class="d-flex justify-content-center align-items-center mt-4">
        <div class="pagination-container">
            <!-- Tombol "First" -->
            @if ($currentPage > 1)
            <a href="{{ $vidios->url(1) }}" class="btn btn-sm btn-outline-primary">First</a>
            @endif

            <!-- Tombol Sebelumnya -->
            @if ($currentPage > 1)
            <a href="{{ $vidios->previousPageUrl() }}" class="btn btn-sm btn-outline-primary">&laquo;</a>
            @endif

            <!-- Nomor Halaman -->
            @for ($i = $startPage; $i <= $endPage; $i++) <a href="{{ $vidios->url($i) }}" class="btn btn-sm {{ $i == $currentPage ? 'btn-primary' : 'btn-outline-primary' }}">
                {{ $i }}
                </a>
                @endfor

                <!-- Tombol Berikutnya -->
                @if ($currentPage < $lastPage) <a href="{{ $vidios->nextPageUrl() }}" class="btn btn-sm btn-outline-primary">&raquo;</a>
                    @endif

                    <!-- Tombol "Last" -->
                    @if ($currentPage < $lastPage) <a href="{{ $vidios->url($lastPage) }}" class="btn btn-sm btn-outline-primary">Last</a>
                        @endif
        </div>
    </div>
</div>