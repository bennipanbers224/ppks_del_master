@php
$currentPage = $news->currentPage();
$lastPage = $news->lastPage();
$startPage = max(1, $currentPage - 1);
$endPage = min($lastPage, $currentPage + 1);
@endphp
<div class="news-container mt-4">
    <h1 class="news-title text-center mb-4">Berita Terbaru</h1>
    <div class="row" id="news-list">
        @foreach($news as $item)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm" style="min-height: 350px;">
                <img src="{{ asset('news_storage/' . $item->foto) }}" class="card-img-top img-fluid" style="max-height: 200px; object-fit: cover;" alt="{{ $item->title }}">
                <div class="card-body p-3 d-flex flex-column">
                    <h5 class="card-title mb-2">{{ $item->title }}</h5>
                    <p class="text-muted small mb-1" style="font-style: italic;">
                        {{ \Carbon\Carbon::parse($item->published_at)->format('d M Y') }}
                    </p>
                    <p class="card-text text-muted">{!! Str::limit($item->content, 100) !!}</p>
                    <div class="mt-auto">
                        <a href="{{ route('umum.berita.detail', ['news' => encrypt($item->news_id)]) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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

    <!-- Custom Pagination Controls for News -->



</div>


<style>

</style>