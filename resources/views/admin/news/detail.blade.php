@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Judul dan Tanggal Berita -->
    <div class="card shadow-lg mb-4" style="border-radius: 15px;">
        <div class="card-header text-center" style="background: linear-gradient(to right, #007bff, #6c757d); color: white; border-radius: 15px 15px 0 0;">
            <h3 class="font-weight-bold">{{ $news->title }}</h3>
            <p class="text-light" style="font-size: 1.2rem;">{{ \Carbon\Carbon::parse($news->published_at)->isoFormat('D MMMM YYYY') }}</p>
        </div>

        <!-- Foto Header Berita -->
        <div class="card-body p-0">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <img src="{{ asset('news_storage/'.$news->foto) }}" class="img-fluid rounded-top shadow-lg" alt="News Header Image" style="transition: transform 0.3s ease-in-out;">
                </div>
            </div>
        </div>

        <!-- Konten Berita -->
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="content" style="font-size: 1.1rem; line-height: 1.6; max-height: 400px; overflow-y: auto;">
                        {!! $news->content !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="card-footer text-center py-4" style="background-color: #f8f9fa; border-radius: 0 0 15px 15px;">
            <div class="row text-center">
                <div class="col">
                    <form action="{{route('admin.news.edit')}}" method="post">
                        @csrf
                        <input type="hidden" name="news_id" value="{{$news->news_id}}">
                        <button class="btn btn-outline-success btn-block"><i class="fas fa-pen"></i>&nbsp Edit</button>
                    </form>
                </div>

                <div class="col">
                    <form action="{{route('admin.news.delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="news_id" value="{{$news->news_id}}">
                        <button class="btn btn-outline-danger btn-block"><i class="fas fa-trash"></i>&nbsp Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .img-hover:hover {
        transform: scale(1.05);
    }

    .hover-scale:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    .content img {
        max-width: 100%;
        margin: 20px 0;
        border-radius: 10px;
    }

    .card-body.p-0 {
        padding: 0;
    }

    .content {
        max-height: 400px;
        overflow-y: auto;
        padding-right: 10px;
        /* Menambah ruang agar scrollbar tidak terlalu dekat dengan teks */
    }

    .content::-webkit-scrollbar {
        width: 8px;
    }

    .content::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 10px;
    }

    .content::-webkit-scrollbar-thumb:hover {
        background-color: #555;
    }
</style>
@endsection