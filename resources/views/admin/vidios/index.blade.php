@extends('layouts.admin.app')
@section('content')

<div class="card-header text-center">
    <h4>Video Edukatif</h4>
    <a href="{{ route('admin.vidios.create') }}">
        <button class="btn btn-info">
            <i class="fas fa-plus"></i>&nbsp Tambah Video
        </button>
    </a>

    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<br><br>

<!-- Kontainer untuk daftar video -->
<div class="container">
    <div class="row">
        <!-- Looping melalui daftar video -->
        @foreach($vidios as $video)
        <div class="col-md-3 mb-4"> <!-- Kolom untuk setiap video -->
            <div class="card h-100" style="width: 100%;"> <!-- Menjaga proporsi kartu agar seragam -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="card-img-top" src="{{ $video->embedLink }}" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $video->judul }}</h5>
                    <p class="text-muted">
                        @php
                        $shortMonthName = \Carbon\Carbon::parse($video->created_at)->format('d M y');
                        @endphp
                        {{ $shortMonthName }}
                    </p>
                    <form action="{{ route('admin.vidios.detail') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $video->vidios_id }}">
                        <button class="btn btn-outline-danger btn-sm" type="submit">
                            Detail Video <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $vidios->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection