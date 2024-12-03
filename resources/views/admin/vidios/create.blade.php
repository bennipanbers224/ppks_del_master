@extends('layouts.admin.app')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Upload Vidio</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6>Formulir Upload Vidio</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.vidios.store') }}" class="form-group" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" name="vidios_title" class="form-control" placeholder="Judul Vidio" required>
                </div>

                <div class="col">
                    <input type="text" name="vidios_link" id="vidios_code" class="form-control" placeholder="Link vidios" required>
                </div>
            </div>
            <br><br>
            <div class="form-group">
                <textarea name="vidios_desc" class="form-control" placeholder="Deskripsi vidios" required></textarea>
            </div>
            <br>
            <hr>
            <div id="frame_vidios_parent" style="display:none;" class="mb-12">
                <label for="formFile" class="form-label">Vidios Frame</label>
                <div style="height: 400px;" class="border border-light rounded p-4 text-center h-200">
                    <iframe id="vidios_frame" src="" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <br><br>

            <button type="submit" class="btn btn-outline-info btn-block" type="button"><i class="fas fa-paper-plane"></i>&nbsp Publish Vidio</button>

        </form>
    </div>
</div>

<script>
    const videoCodeEmbed = document.getElementById('video_code');
    const videoFrame = document.getElementById('vidios_frame');
    const videoFrameParent = document.getElementById("frame_vidios_parent");


    function getYouTubeVideoID(url) {
        const regExp = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
        const match = url.match(regExp);
        return match ? match[1] : null;
    }

    videoCodeEmbed.addEventListener('input', () => {
        const videoId = getYouTubeVideoID(videoCodeEmbed.value.trim());
        const videoSrc = `https://www.youtube.com/embed/${videoId}`;
        setTimeout(() => {
            if (videoId) {
                videoFrameParent.style.display = "block"; // Tampilkan frame
                videoFrame.src = videoSrc; // Atur sumber video
                videoFrame.style.height = '400px'; // Tinggi frame
                videoFrame.style.width = "100%"; // Lebar frame
            } else {
                alert('Please enter a valid YouTube URL.');
            }
        }, 200);
    });
</script>

@endsection