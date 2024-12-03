@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Tombol Tambah Profil -->
    <div class="mb-3 text-right">
        <a href="{{ route('admin.profiles.create') }}" class="btn btn-outline-primary btn-sm btn-lg">
            <i class="fas fa-plus fa-sm"></i> Tambah Profil
        </a>
    </div>

    <!-- Tabel Data Profil -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Profil</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Publish</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profiles as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->item }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                            <td>
                                <form action="{{ route('admin.profiles.detail') }}" method="post" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="profile_id" value="{{ $item->profile_id }}">
                                    <button class="btn btn-light btn-sm" type="submit">
                                        Detail Profil &nbsp;<i class="fas fa-arrow-right"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection