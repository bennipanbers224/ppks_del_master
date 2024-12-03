@extends ('layouts.admin.app')
@section('content')

<!-- Form Tambah Profil -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Profil</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.profiles.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="item" class="form-label">Nama Item</label>
                <input type="text" name="item" id="item" class="form-control" placeholder="Masukkan nama item" required>
            </div>

            <div class="form-group">
                <label for="comment">Isi Berita:</label>
                <textarea name="deskripsi" id="summernote"></textarea>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Profil
                </button>
            </div>
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