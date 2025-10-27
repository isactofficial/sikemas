<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - SIKEMAS</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Import Google Font Besley --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;600&display=swap" rel="stylesheet">

    {{-- CSS untuk Dashboard --}}
    <style>
        main {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .skm-admin-main {
            padding: 2rem;
        }

        .skm-admin-main h1 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            color: #333;
            font-weight: 600;
        }

        /*
         * CSS KARTU ATAS
        */

        /* Grid untuk Kartu Ringkasan Atas (Baris 1 dan 2) */
        .skm-dashboard-grid-top,
        .skm-dashboard-grid-middle {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Style kartu atas */
        .skm-summary-card {
            font-family: 'Besley', serif;
            background-color: #ffffff;
            border: 1px solid #34495e;
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
        }

        .skm-summary-card .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.95rem;
            color: #34495e;
            font-weight: 600;
        }

        .skm-summary-card .card-header .icon {
            font-size: 1rem;
            background-color: #34495e;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Style angka/value */
        .skm-summary-card .card-value {
            display: block;
            font-size: 1.5rem;
            font-weight: 400;
            color: #34495e;
            margin-top: 1rem;
        }

        /* Progress bar */
        .skm-summary-card .card-bar {
            height: 6px;
            border-radius: 3px;
            margin-top: 1.25rem;
            background-color: #f39c12;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        /* Bar progres di dalam card */
        .skm-summary-card .card-bar::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            border-radius: 3px;
            background-color: #34495e;
        }

        /* Atur lebar bar sesuai data (hardcoded sesuai desain) */
        .skm-summary-card.card-1 .card-bar::after { width: 80%; }
        .skm-summary-card.card-2 .card-bar::after { width: 60%; }
        .skm-summary-card.card-3 .card-bar::after { width: 50%; }
        .skm-summary-card.card-4 .card-bar::after { width: 40%; }
        .skm-summary-card.card-5 .card-bar::after { width: 90%; }
        .skm-summary-card.card-6 .card-bar::after { width: 70%; }


        /*
         * CSS KARTU BAWAH
        */

        /* Grid untuk Kartu Statistik Bawah */
        .skm-dashboard-grid-bottom {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        /* Kartu statistik bawah */
        .skm-stats-card {
            background-color: #ffffff;
            border: 1px solid #e8e6ef;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: none;
        }

        .skm-stats-card h3 {
            font-size: 1.15rem;
            color: #17a2b8;
            margin-top: 0;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 600;
        }

        /* Warna ikon judul */
        .skm-stats-card h3 .icon {
            color: #17a2b8;
        }

        .skm-stats-card h3 .icon-total {
            color: #17a2b8;
        }

        .skm-stats-card .total-visits-value {
            font-size: 3rem;
            font-weight: 700;
            color: #e84393;
            display: block;
            margin-bottom: 1rem;
        }

        /* Sub-judul "Homepage Stats" */
        .skm-stats-card h4 {
            font-size: 1rem;
            color: #6c757d;
            margin-top: 1.25rem;
            margin-bottom: 0.75rem;
            font-weight: 600;
            border-top: none;
            padding-top: 0;
        }

        .skm-stats-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .skm-stats-card li {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .skm-stats-card li .icon {
            font-size: 1.1rem;
            text-align: center;
        }

        /* --- WARNA IKON LIST--- */

        /* Card 1 (Page Visits) */
        .skm-stats-card:first-child li:nth-child(1) .icon { color: #e84393; }
        .skm-stats-card:first-child li:nth-child(2) .icon { color: #17a2b8; }
        .skm-stats-card:first-child li:nth-child(3) .icon { color: #f1c40f; }
        .skm-stats-card:first-child li:nth-child(4) .icon { color: #e84393; }

        /* Card 2 (Total Visits) */
        .skm-stats-card:last-child li:nth-child(1) .icon { color: #e84393; }
        .skm-stats-card:last-child li:nth-child(2) .icon { color: #17a2b8; }
        .skm-stats-card:last-child li:nth-child(3) .icon { color: #f1c40f; }
        .skm-stats-card:last-child li:nth-child(4) .icon { color: #e84393; }


        .skm-stats-card li strong {
            margin-left: 0;
            color: #34495e;
            font-weight: 700;
            margin-left: 0.25rem;
        }

        /*
         * --- CSS SECTION ARTIKEL & PRODUK ---
        */
        .skm-dashboard-articles {
            margin-top: 2rem;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }

        .skm-articles-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .skm-articles-header h2 {
            font-family: 'Besley', serif;
            font-size: 1.75rem;
            color: #34495e;
            margin: 0;
            font-weight: 600;
        }

        /* --- STYLE TOMBOL--- */
        .skm-articles-view-all {
            text-decoration: none;
            padding: 0.75rem 1.75rem;
            border: 2px solid #34495e;
            border-radius: 8px;
            color: #34495e;
            font-size: 1rem;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; /* Font sans-serif standar */
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .skm-articles-view-all:hover {
            background-color: #34495e;
            color: #ffffff;
        }

        .skm-articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .skm-article-card {
            background-color: #ffffff;
            border: 1px solid #e8e6ef;
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .skm-article-card img {
             width: 100%;
             height: 180px;
             object-fit: cover;
             display: block;
        }

        .skm-article-card-content {
            padding: 1.25rem;
        }

        .skm-article-card-content h3 {
            margin-top: 0;
            margin-bottom: 0.5rem;
            font-size: 1.15rem;
            font-weight: 600;
            color: #34495e;
        }

        .skm-article-card-content p {
            margin: 0;
            font-size: 0.9rem;
            color: #6c757d;
            line-height: 1.5;
        }

        /* Header untuk "Produk Terbaru" */
        .skm-products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            margin-top: 2.5rem;
        }

        .skm-products-header h2 {
            font-family: 'Besley', serif;
            font-size: 1.75rem;
            color: #34495e;
            margin: 0;
            font-weight: 600;
        }

    </style>
</head>
<body>
    {{-- Sidebar Admin --}}
    @include('layouts.sidebar_admin')

    {{-- Konten utama --}}
    <main class="skm-admin-main">

        {{-- Bagian 1: Section Kartu Ringkasan Atas --}}
        <section class="skm-dashboard-summary">
            {{-- Grid Baris 1 (4 Kartu) --}}
            <div class="skm-dashboard-grid-top">
                <div class="skm-summary-card card-1">
                    <div class="card-header">
                        <span>Total Artikel</span>
                        <span class="icon"><i class="fas fa-file-alt"></i></span>
                    </div>
                    <span class="card-value">105</span>
                    <div class="card-bar"></div>
                </div>
                <div class="skm-summary-card card-2">
                    <div class="card-header">
                        <span>Total Upload Artikel</span>
                        <span class="icon"><i class="fas fa-check-square"></i></span>
                    </div>
                    <span class="card-value">89</span>
                    <div class="card-bar"></div>
                </div>
                <div class="skm-summary-card card-3">
                    <div class="card-header">
                        <span>Total Galeri</span>
                        <span class="icon"><i class="fas fa-images"></i></span>
                    </div>
                    <span class="card-value">67</span>
                    <div class="card-bar"></div>
                </div>
                <div class="skm-summary-card card-4">
                    <div class="card-header">
                        <span>Total Upload Galeri</span>
                        <span class="icon"><i class="fas fa-upload"></i></span>
                    </div>
                    <span class="card-value">52</span>
                    <div class="card-bar"></div>
                </div>
            </div>

            {{-- Grid Baris 2 (2 Kartu) --}}
            <div class="skm-dashboard-grid-middle">
                <div class="skm-summary-card card-5">
                    <div class="card-header">
                        <span>Total Views</span>
                        <span class="icon"><i class="fas fa-eye"></i></span>
                    </div>
                    <span class="card-value">15,420</span>
                    <div class="card-bar"></div>
                </div>
                <div class="skm-summary-card card-6">
                    <div class="card-header">
                        <span>Total Views (Galleries)</span>
                        <span class="icon"><i class="fas fa-eye"></i></span>
                    </div>
                    <span class="card-value">8,930</span>
                    <div class="card-bar"></div>
                </div>
            </div>
        </section>


        {{-- Bagian 2: Section Statistik Bawah --}}
        <section class="skm-dashboard-stats">
            {{-- Grid Bawah --}}
            <div class="skm-dashboard-grid-bottom">
                <div class="skm-stats-card">
                    <h3><span class="icon"><i class="fas fa-chart-line"></i></span> Page Visits</h3>
                    <ul>
                        <li><span class="icon"><i class="fas fa-home fa-fw"></i></span> Homepage:<strong>140</strong> visits</li>
                        <li><span class="icon"><i class="fas fa-newspaper fa-fw"></i></span> Articles:<strong>28</strong> visits</li>
                        <li><span class="icon"><i class="fas fa-images fa-fw"></i></span> Galleries:<strong>23</strong> visits</li>
                        <li><span class="icon"><i class="fas fa-envelope fa-fw"></i></span> Contact:<strong>29</strong> visits</li>
                    </ul>
                </div>

                <div class="skm-stats-card">
                    <h3><span class="icon icon-total"><i class="fas fa-users"></i></span> Total Visits</h3>
                    <span class="total-visits-value">220</span>
                    <h4>Homepage Stats</h4>
                    <ul>
                        {{-- menggunakan ikon fa-calendar-alt --}}
                        <li><span class="icon"><i class="fas fa-calendar-alt fa-fw"></i></span> Today:<strong>0</strong></li>
                        <li><span class="icon"><i class="fas fa-calendar-alt fa-fw"></i></span> This Week:<strong>0</strong></li>
                        <li><span class="icon"><i class="fas fa-calendar-alt fa-fw"></i></span> This Month:<strong>0</strong></li>
                        <li><span class="icon"><i class="fas fa-calendar-alt fa-fw"></i></span> This Year:<strong>140</strong></li>
                    </ul>
                </div>
            </div>
        </section>


        {{-- Bagian 3: Section Artikel & Produk --}}
        <section class="skm-dashboard-articles">

            {{-- --- Bagian Artikel Terbaru --- --}}
            {{-- Header Section Artikel --}}
            <div class="skm-articles-header">
                <h2>Artikel Terbaru</h2>
                <a href="#" class="skm-articles-view-all">Lihat semuanya</a>
            </div>

            {{-- Grid Artikel --}}
            <div class="skm-articles-grid">

                {{-- Card Artikel 1 --}}
                <div class="skm-article-card">
                    <img src="{{ asset('assets/img/box1.png') }}" alt="Trend Kemasan">
                    <div class="skm-article-card-content">
                        <h3>Trend Kemasan Ramah Lingkungan</h3>
                        <p>Membahas inovasi terbaru dalam industri kemasan karton yang berkelanjutan...</p>
                    </div>
                </div>

                {{-- Card Artikel 2 --}}
                <div class="skm-article-card">
                    <img src="{{ asset('assets/img/box1.png') }}" alt="Trend Kemasan">
                    <div class="skm-article-card-content">
                        <h3>Trend Kemasan Ramah Lingkungan</h3>
                        <p>Membahas inovasi terbaru dalam industri kemasan karton yang berkelanjutan...</p>
                    </div>
                </div>

                {{-- Card Artikel 3 --}}
                <div class="skm-article-card">
                    <img src="{{ asset('assets/img/box1.png') }}" alt="Trend Kemasan">
                    <div class="skm-article-card-content">
                        <h3>Trend Kemasan Ramah Lingkungan</h3>
                        <p>Membahas inovasi terbaru dalam industri kemasan karton yang berkelanjutan...</p>
                    </div>
                </div>
            </div>


            {{-- --- Bagian Produk Terbaru --- --}}
            {{-- Header Section Produk --}}
            <div class="skm-products-header">
                <h2>Produk Terbaru</h2>
                <a href="#" class="skm-articles-view-all">Lihat semuanya</a>
            </div>

            {{-- Grid Produk --}}
            <div class="skm-articles-grid">

                {{-- Card Produk 1 --}}
                <div class="skm-article-card">
                    <img src="{{ asset('assets/img/box2.png') }}" alt="Kotak Kemasan">
                    <div class="skm-article-card-content">
                        <h3>Kotak Kemasan Khusus</h3>
                        <p>Didesain untuk memenuhi kebutuhan spesifik produk Anda, dari ukuran hingga finishing.</p>
                    </div>
                </div>

                {{-- Card Produk 2 --}}
                <div class="skm-article-card">
                    <img src="{{ asset('assets/img/box2.png') }}" alt="Kotak Kemasan">
                    <div class="skm-article-card-content">
                        <h3>Kotak Kemasan Khusus</h3>
                        <p>Didesain untuk memenuhi kebutuhan spesifik produk Anda, dari ukuran hingga finishing.</p>
                    </div>
                </div>

                {{-- Card Produk 3 --}}
                <div class="skm-article-card">
                    <img src="{{ asset('assets/img/box2.png') }}" alt="Kotak Kemasan">
                    <div class="skm-article-card-content">
                        <h3>Kotak Kemasan Khusus</h3>
                        <p>Didesain untuk memenuhi kebutuhan spesifik produk Anda, dari ukuran hingga finishing.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>
</body>
</html>
