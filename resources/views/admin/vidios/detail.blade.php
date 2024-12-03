@extends('layouts.admin.app')

@section('content')

<div class="card-header text-center">
    <h4>Detail Video Edukatif</h4>
    <a href="{{ route('admin.vidios.index') }}">
        <button class="btn btn-info">
            <i class="fas fa-arrow-left"></i>&nbsp Kembali ke Daftar Video
        </button>
    </a>
</div>

<br><br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="card-img-top" src="{{ $vidios->embedLink }}" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="card-body text-center">
                    <h3 class="card-title">{{ $vidios->judul }}</h3>
                    <p class="card-text">{{ $vidios->keterangan }}</p>
                    <p class="text-muted">
                        Ditambahkan pada:
                        @php
                        $shortMonthName = \Carbon\Carbon::parse($vidios->created_at)->format('d M Y');
                        @endphp
                        {{ $shortMonthName }}
                    </p>
                </div>

                <!-- Tombol Edit dan Delete -->
                <div class="card-footer text-center py-4" style="background-color: #f8f9fa; border-radius: 0 0 15px 15px;">
                    <div class="row text-center">
                        <!-- Tombol Edit -->
                        <div class="col">
                            <form action="{{ route('admin.vidios.edit') }}" method="post">
                                @csrf
                                <input type="hidden" name="vidios_id" value="{{ $vidios->vidios_id }}">
                                <button class="btn btn-outline-success btn-block">
                                    <i class="fas fa-pen"></i>&nbsp Edit
                                </button>
                            </form>
                        </div>

                        <!-- Tombol Delete -->
                        <div class="col">
                            <form action="{{ route('admin.vidios.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="vidios_id" value="{{ $vidios->vidios_id }}">
                                <button class="btn btn-outline-danger btn-block">
                                    <i class="fas fa-trash"></i>&nbsp Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection