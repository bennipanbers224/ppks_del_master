@extends('layouts.umum.app')


@section('content')
<div class="container mt-4">
    <!-- Informasi Utama -->
    <div id="photoCarousel" class="carousel slide shadow-lg" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('images/home.jpg')}}" class="d-block w-100" alt="Foto 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Pelaporan Insiden Kekerasan Seksual</h5>
                    <p>Aplikasi ini bisa menyediakan fitur bagi korban atau saksi untuk melaporkan insiden kekerasan seksual secara anonim
                        atau langsung. Pengguna dapat mengisi formulir pelaporan yang mencakup rincian kejadian, identitas pelaku (jika diketahui),
                        serta lokasi dan waktu kejadian. Fitur ini dapat dilengkapi dengan validasi untuk memastikan bahwa informasi yang diberikan lengkap dan jelas.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('images/home.jpg')}}" class="d-block w-100" alt="Foto 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Edukasi dan Kesadaran</h5>
                    <p>Aplikasi bisa menyajikan konten edukatif berupa artikel, vidio, dan infografis terkait pencegahan kekerasan seksual,
                        pemahaman hak-hak korban, serta prosedur hukum yang berlaku. Edukasi ini sangat penting untuk meningkatkan kesadaran
                        di kalangan masyarakat tentang dampak kekerasan seksual dan cara melindungi diri.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('images/home.jpg')}}" class="d-block w-100" alt="Foto 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Proses Pelaporan yang Aman dan Transparan</h5>
                    <p>Aplikasi harus memastikan bahwa pelaporan yang dilakukan terlindungi dengan sistem enkripsi yang kuat,
                        serta menyediakan akses yang aman bagi pengguna untuk melacak status laporan mereka. Ini akan memberikan
                        rasa aman bagi pelapor, memastikan bahwa data mereka terlindungi.
                    </p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#photoCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#photoCarousel" data-bs-slide=">">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Video Section -->
    <div id="vidio-container">
        @include('umum.vidios-list', ['vidios' => $vidios])
    </div>

    <!-- News -->
    <div id="news-container">
        @include('umum.news-list', ['news' => $news])
    </div>



    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script>
        // Fungsi untuk memuat konten berdasarkan tipe dan halaman
        document.querySelectorAll('.vidio-pagination a, .news-pagination a').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                let page = this.getAttribute('data-page');
                let type = this.closest('.vidio-pagination') ? 'vidio' : 'news';
                loadContent(type, page);
            });
        });

        function loadContent(type, page) {
            fetch(`/content-pagination?page=${page}&type=${type}`)
                .then(response => response.text())
                .then(html => {
                    if (type === 'vidio') {
                        document.querySelector('.vidio-pagination').innerHTML = html;
                    } else {
                        document.querySelector('.news-pagination').innerHTML = html;
                    }
                })
                .catch(error => {
                    alert("Terjadi kesalahan saat memuat konten.");
                    console.error('Error:', error);
                });
        }

        // Menangani perubahan warna footer saat scroll
        document.addEventListener('DOMContentLoaded', function() {
            const footer = document.querySelector('footer');
            footer.style.transition = "background-color 0.5s ease";

            window.addEventListener('scroll', function() {
                if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight) {
                    footer.style.backgroundColor = '#0056b3'; // Ganti warna footer saat scroll ke bawah
                } else {
                    footer.style.backgroundColor = '#007bff'; // Warna awal footer
                }
            });

            // Animasi footer tampil saat scroll
            const footerCustom = document.querySelector('.footer-custom');
            footerCustom.style.opacity = '0';
            footerCustom.style.transition = 'opacity 2s ease-in-out';

            window.addEventListener('scroll', () => {
                const footerTop = footerCustom.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (footerTop < windowHeight) {
                    footerCustom.style.opacity = '1'; // Tampilkan saat terlihat
                }
            });

            // Mengubah warna footer section saat scroll
            const footerSection = document.querySelector('.footer-section');
            window.addEventListener('scroll', function() {
                const scrollPosition = window.scrollY;
                if (scrollPosition > 200) {
                    footerSection.style.backgroundColor = '#198754'; // Warna hijau
                } else {
                    footerSection.style.backgroundColor = '#145a32'; // Warna hijau lebih gelap
                }
            });

            // Menangani pagination berita dengan event delegation
            document.querySelector('.news-pagination').addEventListener('click', function(e) {
                const target = e.target.closest('a');
                if (target && !target.classList.contains('disabled')) {
                    e.preventDefault();
                    const page = target.getAttribute('data-page');
                    loadContent('news', page);
                }
            });

            // Menangani pagination video dengan event delegation
            document.querySelector('.vidio-pagination').addEventListener('click', function(e) {
                const target = e.target.closest('a');
                if (target && !target.classList.contains('disabled')) {
                    e.preventDefault();
                    const page = target.getAttribute('data-page');
                    loadContent('vidio', page);
                }
            });
        });
    </script> -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event delegation untuk menangkap klik pada tombol pagination
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('ajax-pagination')) {
                    e.preventDefault();

                    // Ambil data dari atribut tombol yang diklik
                    const url = e.target.getAttribute('data-url');
                    const page = e.target.getAttribute('data-page');
                    const type = e.target.getAttribute('data-type'); // 'videos' atau 'news'

                    if (!url || !page || !type) return;

                    // Kirim request AJAX
                    fetch(`${url}?page_${type}=${page}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest' // Penting untuk identifikasi AJAX
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            // Tentukan elemen target berdasarkan tipe
                            const targetElementId = type === 'videos' ? 'vidio-list' : 'news-list';
                            const targetElement = document.getElementById(targetElementId);

                            if (targetElement) {
                                // Perbarui konten dengan hasil respons
                                targetElement.innerHTML = html;

                                // Perbarui juga pagination
                                const paginationElementId = type === 'videos' ? 'vidio-pagination' : 'news-pagination';
                                const paginationElement = document.querySelector(`.${paginationElementId}`);
                                if (paginationElement) {
                                    paginationElement.innerHTML = response.paginationHtml;
                                }
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>