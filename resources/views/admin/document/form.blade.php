@extends('layouts.admin.app')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Upload Dokumentasi</h1>
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
        <h6>Formulir Dokumentasi</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.document.store') }}" class="form-group" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" name="document_title" class="form-control" placeholder="Judul Dokumentasi" required>
                </div>
            </div>
            <br>
            <hr>

            <!-- Preview PDF -->
            <div id="pdf-preview-container" style="margin-top: 20px; display: none;">
                <p>Preview:</p>
                <iframe id="pdf-preview" src="" style="width: 100%; height: 500px;" frameborder="0"></iframe>
            </div>
            <br>
            <hr>

            <!-- Dropzone -->
            <div class="mb-12">
                <label for="formFile" class="form-label">File Dokumentasi:</label>
                <div style="height: 200px;" id="dropZone" class="border border-primary rounded p-4 text-center">
                    ----- Drag and drop a file here or click to select -----
                </div>
                <input type="file" id="formFile" name="document_file" accept="application/pdf" onchange="previewPDF()" class="d-none" />
            </div>
            <br>
            <hr>

            <button type="submit" class="btn btn-outline-info btn-block" type="button"><i class="fas fa-paper-plane"></i>&nbsp Publish Dokumentasi</button>

        </form>
    </div>
</div>

<!-- Script -->
<script>
    // Menghubungkan Dropzone dengan input file
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('formFile');

    // Event untuk klik Dropzone
    dropZone.addEventListener('click', () => {
        fileInput.click();
    });

    // Event untuk drag-and-drop file
    dropZone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropZone.classList.add('border-success');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('border-success');
    });

    dropZone.addEventListener('drop', (event) => {
        event.preventDefault();
        dropZone.classList.remove('border-success');
        if (event.dataTransfer.files.length) {
            const file = event.dataTransfer.files[0];
            fileInput.files = event.dataTransfer.files; // Menyalin file ke input
            previewPDF(); // Memanggil fungsi untuk menampilkan preview
        }
    });

    // Fungsi untuk menampilkan preview PDF
    function previewPDF() {
        const previewContainer = document.getElementById('pdf-preview-container');
        const pdfPreview = document.getElementById('pdf-preview');

        if (fileInput.files && fileInput.files[0]) {
            const file = fileInput.files[0];

            // Validasi tipe file PDF
            if (file.type === 'application/pdf') {
                const fileURL = URL.createObjectURL(file);
                pdfPreview.src = fileURL;
                previewContainer.style.display = 'block';
                previewContainer.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            } else {
                alert('Silakan pilih file PDF yang valid.');
                previewContainer.style.display = 'none';
            }
        }
    }
</script>

<!-- Tambahan CSS -->
<style>
    #dropZone {
        cursor: pointer;
        transition: background-color 0.2s ease, border-color 0.2s ease;
    }

    #dropZone.border-success {
        border-color: green;
        background-color: #e9ffe9;
    }
</style>

@endsection