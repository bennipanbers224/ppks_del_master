@extends ('layouts.admin.app')
@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6>Formulir Berita</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.news.store') }}" class="form-group" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" name="news_title" class="form-control" placeholder="Judul Berita">
                </div>

                <div class="col">
                    <input type="date" name="publish_date" class="form-control" placeholder="Tanggal Publish Berita">
                </div>
            </div>
            <br>
            <hr>
            <div class="form-group">
                <label for="comment">Isi Berita:</label>
                <textarea name="news_content" id="summernote"></textarea>
            </div>
            <br>
            <hr>
            <div class="mb-12">
                <label for="formFile" class="form-label">Upload Gambar Berita:</label>
                <div style="height: 200px;" id="dropZone" class="border border-primary rounded p-4 text-center">
                    ----- Drag and drop a file here or click to select -----
                </div>
                <input type="file" id="formFile" name="news_foto" class="d-none" />
            </div>
            <br>
            <hr>
            <button type="submit" class="btn btn-outline-info btn-block" type="button"><i class="fas fa-paper-plane"></i>&nbsp Publish Berita</button>
        </form>
    </div>
</div>



<script>
    $('#summernote').summernote({
        placeholder: 'Isi Berita',
        tabsize: 2,
        height: 400,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
            ['alignment', ['alignLeft', 'alignCenter', 'alignRight']]
        ]
    });


    //drag and drop function
    const dropZone = document.getElementById('dropZone')
    const formFile = document.getElementById('formFile')

    dropZone.addEventListener('click', () => formFile.click())

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault()
        dropZone.classList.add('bg-light')
    })

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('bg-light')
    })

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault()
        dropZone.classList.remove('bg-light')
        formFile.files = e.dataTransfer.files
        updateDropZoneText()
    })

    formFile.addEventListener('change', updateDropZoneText)

    function updateDropZoneText() {
        dropZone.textContent =
            formFile.files.length > 0 ?
            formFile.files[0].name :
            'Drag and drop a file here or click to select'
    }
</script>
@endsection