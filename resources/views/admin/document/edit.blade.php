@extends('layouts.admin.app')
@section('content')

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif


@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6>Detail Dokumentasi</h6>
        <form class="text-end" action="{{ route ('admin.document.delete') }}" method="post">
            @csrf
            <input type="hidden" value="{{$document->document_id}}" name="document_id">
            <button class="btn btn-outline-danger btn-sm">Hapus Dokumentasi &nbsp <i class="fas fa-trash"></i></button>
        </form>
    </div>
    <div class="card-body">
        <form action="{{ route ('admin.document.update') }}" class="form-group" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="hidden" name="document_id" value="{{$document->document_id}}">
                    <input type="text" name="document_title" class="form-control" value="{{$document->title}}" placeholder="Judul Dokumentasi" required>
                </div>
            </div>
            <br>
            <hr>

            <div id="pdf-preview-container" style="margin-top: 20px; display: block;">
                <p>Preview:</p>
                <iframe id="pdf-preview" src="{{asset($document->file_path)}}" style="width: 100%; height: 500px;" frameborder="0"></iframe>
            </div>
            <br>
            <hr>

            <div class="mb-12">
                <label for="formFile" class="form-label">Unggah File Baru (PDF):</label>
                <input type="file" id="formFile" name="document_file" accept="application/pdf" onchange="previewPDF()" class="form-control" />
            </div>
            <br>
            <hr>

            <button type="submit" class="btn btn-outline-info btn-block" type="button"><i class="fas fa-paper-plane"></i>&nbsp Publish Perubahan Dokumentasi</button>
        </form>

    </div>
</div>

<script>
    function previewPDF() {
        const fileInput = document.getElementById('formFile');
        const previewContainer = document.getElementById('pdf-preview-container');
        const pdfPreview = document.getElementById('pdf-preview');

        // Check if a file is selected
        if (fileInput.files && fileInput.files[0]) {
            const file = fileInput.files[0];

            // Ensure it's a PDF file
            if (file.type === 'application/pdf') {
                const fileURL = URL.createObjectURL(file); // Create a blob URL
                pdfPreview.src = fileURL; // Set the blob URL as iframe src
                previewContainer.style.display = 'block'; // Show the preview container
                previewContainer.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            } else {
                alert('Please select a valid PDF file.');
                previewContainer.style.display = 'none'; // Hide the preview container
            }
        }
    }
</script>

@endsection