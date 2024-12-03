@extends ('layouts.admin.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Profile</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6>Formulir Edit Item Profile</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.profiles.update', $profile->profile_id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col">
                    <input type="text" name="profile_item" class="form-control" placeholder="Item" value="{{ old('profile_item', $profile->item) }}">
                </div>

                <div class="col">
                    <input type="date" name="created_at" class="form-control" placeholder="Tanggal Publish Berita" value="{{ old('created_at', isset($profile->created_at) ? \Carbon\Carbon::parse($profile->created_at)->format('Y-m-d') : '') }}">
                </div>
            </div>
            <br>
            <hr>
            <div class="form-group">
                <label for="comment">Deskripsi</label>
                <textarea name="profile_description" id="summernote">{{ old('profile_description', $profile->deskripsi) }}</textarea>
            </div>
            <br>
            <hr>
            <br>
            <hr>
            <button type="submit" class="btn btn-outline-info btn-block"><i class="fas fa-paper-plane"></i>&nbsp Update Berita</button>
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
            ['view', ['fullscreen', 'codeview', 'help']],
            ['alignment', ['alignLeft', 'alignCenter', 'alignRight']]
        ]
    });


    // drag and drop function
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