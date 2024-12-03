@extends('layouts.admin.app')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Detail Video</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6>Formulir Update Video</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.vidios.update', $videos->vidios_id) }}" class="form-group" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <input type="hidden" value="{{ $videos->vidios_id }}" name="id">
                    <input type="text" name="video_title" class="form-control" value="{{ $videos->judul }}" placeholder="Judul Video" required>
                </div>

                <div class="col">
                    <input type="text" name="video_link" id="video_code" value="{{ $videos->link }}" class="form-control" placeholder="Link Video" required>
                </div>
            </div>
            <br><br>
            <div class="form-group">
                <textarea name="video_desc" class="form-control" placeholder="Deskripsi Video" required>
                {{ $videos->keterangan }}
                </textarea>
            </div>
            <br>
            <hr>
            <div id="frame_video_parent" style="display:none;" class="mb-12">
                <label for="formFile" class="form-label">Video Frame</label>
                <div style="height: 400px;" class="border border-light rounded p-4 text-center h-200">
                    <iframe id="video_frame" src="" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <br><br>

            <button type="submit" class="btn btn-outline-info btn-block" type="button"><i class="fas fa-paper-plane"></i>&nbsp Update Video</button>
        </form>
    </div>
</div>

<script>
    const videoCodeEmbed = document.getElementById('video_code');
    const videoFrame = document.getElementById('video_frame');
    const videoFrameParent = document.getElementById("frame_video_parent")

    function getYouTubeVideoID(url) {
        const regExp = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
        const match = url.match(regExp);
        return match ? match[1] : null;
    }

    if (videoCodeEmbed.value.trim != null) {
        const videoId = getYouTubeVideoID(videoCodeEmbed.value.trim());
        const videoSrc = `https://www.youtube.com/embed/${videoId}`
        setTimeout(() => {
            if (videoId) {

                videoFrameParent.style.display = "block"

                videoFrame.src = videoSrc;
                videoFrame.style.height = '400px'
                videoFrame.style.width = "100%"


            } else {
                alert('Please enter a valid YouTube URL.');
            }
        }, 200);
    }

    videoCodeEmbed.addEventListener('input', () => {
        const videoId = getYouTubeVideoID(videoCodeEmbed.value.trim());
        const videoSrc = `https://www.youtube.com/embed/${videoId}`
        setTimeout(() => {
            if (videoId) {

                videoFrameParent.style.display = "block"

                videoFrame.src = videoSrc;
                videoFrame.style.height = '400px'
                videoFrame.style.width = "100%"


            } else {
                alert('Please enter a valid YouTube URL.');
            }
        }, 200);

    })
</script>

@endsection