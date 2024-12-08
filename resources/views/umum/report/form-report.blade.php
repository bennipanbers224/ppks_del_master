@extends('layouts.umum.app')
@section('content')
    <div class="title-container">
        <h1 class="title-styling">Form Laporan Kekerasan Seksual</h1>
    </div>

    <div class="container mt-4">
    
        <div class="card">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card-body">

            <form action="{{ route('report.store') }}" method="post">
            @csrf

                    <div class="mb-3">
                        
                        <div class="row">
                            
                            <div class="col">

                                <label for="exampleFormControlInput1" class="form-label">Tanggal Pelaporan</label>
                                <input type="date" class="form-control" id="exampleFormControlInput1">

                            </div>

                            <div class="col">

                                <label for="exampleDataList" class="form-label">Status Pelapor</label>
                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                                <datalist id="datalistOptions">
                                    <option value="Pegawai">
                                    <option value="Dosen">
                                    <option value="Mahasiswa">
                                </datalist>

                            </div>

                        </div>

                    </div>


                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Kronologi</label>
                        <textarea placeholder="Kronologi kejadian dengan jelas" class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
                    </div>

                    <br>
                    <hr>

                    <div class="mb-3">
                        <div class="card-header">
                            <h6 id="title-identity">Sebelum mengirim data laporan, silahkan isi terlebih dahulu akun anda untuk verifikasi data pelapor. <i class="bi bi-info-circle"><span class="text-information">* Akun yang digunakan adalah akun yang terdaftar atau digunakan di Institut Teknologi Del</span></i></h6>
                        </div>
                        <hr>
                        <br>

                        <div class="mb-3">

                            <div class="card">

                                <div class="card-body">
                                    <div class="row">

                                        <div class="col text-center">
                                            <label for="exampleFormControlInput1" class="form-label">Username</label>
                                            <input type="text"  class="form-control" name="username" id="inputPassword2" placeholder="Username" required>
                                        </div>

                                        <div class="col text-center">
                                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="inputPassword2" placeholder="Password" required>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <br>
                    <div class="mb-3 text-center">

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-outline-success">Kirim Laporan</button>
                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <br>

    <style>

        .bi {
            font-family: 'Font Awesome 5 Free';
            display: inline-block;
            transition: all 0.3s ease;
        }

        .bi::before {
            content: "\F431"; 
        }

        .bi:hover::before {
            content: "\F430";
        }

        .text-information{
            color : red;
            font: size 12px;
            display:none;
        }

        .text-information.change {
            display: block; /* Change text color when the change class is applied */
            position:absolute;
            display: inline-block;
            background: linear-gradient(135deg, #4CAF50, #81C784); /* Gradient background */
            color: white;
            font-size: 16px;
            padding: 20px;
            border-radius: 15px;
            max-width: 500px;
            word-wrap: break-word;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        

    </style>

    <script>
        document.querySelector('.bi').addEventListener('mouseenter', function() {
            document.querySelector('.text-information').classList.add('change');
        });

        document.querySelector('.bi').addEventListener('mouseleave', function() {
            document.querySelector('.text-information').classList.remove('change');
        });
    </script>
@endsection