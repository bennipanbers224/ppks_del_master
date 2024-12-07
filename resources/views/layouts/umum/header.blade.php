<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="">
            <img src="{{ asset('images/favicon.ico') }}" alt="Logo" class="logo-animated">
            Institut Teknologi Del
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item {{ request()->routeIs('umum.home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('umum.home') }}">Beranda</a>
                </li>
                <li class="nav-item dropdown {{ request()->is('profile*') ? 'active' : '' }}">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($menuItems as $item)
                            <li><a class="dropdown-item" href="{{ route('profile.detail', ''.$item->item) }}">{{$item->item}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item {{ request()->routeIs('umum.dokumen.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('umum.dokumen.index') }}">Dokumen</a>
                </li>
                <li class="nav-item {{ request()->routeIs('umum.berita.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('umum.berita.index') }}">Berita</a>
                </li>
                <li class="nav-item {{ request()->is('report.form') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('report.form') }}">Laporkan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>