<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKEMAS - Protect Your Value</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Besley', serif;
            background-color: #f5f5ff; /* Sesuai file asli Anda */
        }

        /* Navbar Styles */
        .navbar {
            background-color: #ffffff;
            padding: 1rem 3rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            height: 80px; 
            display: flex;
            align-items: center;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
            gap: 2rem;
            width: 100%;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 3rem;
            margin-left: auto;
        }

        .navbar-logo img {
            height: 50px;
            width: auto;
            display: block;
        }

        .navbar-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .navbar-menu li a {
            text-decoration: none;
            color: #074159;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .navbar-menu li a:hover {
            color: #053244;
        }

        .navbar-profile {
            display: flex;
            align-items: center;
        }

        /* Profile Icon Styles (dari kode Anda) */
        .profile-icon {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: transparent;
            padding: 0;
        }

        .profile-icon:hover {
            background-color: #f0f0f0;
        }

        .profile-icon svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: #074159;
            stroke-width: 1.5;
            transition: stroke 0.3s ease;
        }

        .profile-icon:hover svg {
            stroke: #053244;
        }

        .navbar-toggle {
            display: none; 
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin-left: auto; 
            z-index: 1001;
        }

        .hamburger-icon {
            display: flex;
            flex-direction: column;
            gap: 5px;
            width: 24px;
            height: 20px;
            justify-content: center;
        }

        .hamburger-icon .bar {
            height: 3px;
            width: 100%;
            background-color: #074159;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        
        /* =========================================== */
        /* === CSS BARU DITAMBAHKAN MULAI DARI SINI === */
        /* =========================================== */

        /* CSS UNTUK PROFIL DROPDOWN (Guest & Logged In) */
        .profile-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .profile-dropdown-menu {
            display: none; /* Sembunyikan secara default */
            position: absolute;
            right: 0;
            top: 100%; /* <-- UBAH INI (dari 140%) */
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            min-width: 220px;
            z-index: 1001;
            overflow: hidden;
            padding-top: 1rem; /* <-- UBAH INI (dari 0.5rem) */
            padding-bottom: 0.5rem;
        }

        .profile-dropdown:hover .profile-dropdown-menu {
            display: block;
        }

        /* Header khusus untuk user yang sudah login */
        .profile-dropdown-menu .dropdown-header {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 0.5rem;
        }
        .profile-dropdown-menu .dropdown-header span {
            display: block;
            font-weight: 700;
            color: #074159;
            white-space: nowrap;
        }
        .profile-dropdown-menu .dropdown-header small {
            color: #666;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .profile-dropdown-menu a {
            display: block;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: #333;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .profile-dropdown-menu a:hover {
            background-color: #f5f5f5;
            color: #074159;
        }
        
        .profile-dropdown-menu .dropdown-divider {
            height: 1px;
            background-color: #f0f0f0;
            margin: 0.5rem 0;
        }

        /* Tombol "Daftar" di dropdown */
        .profile-dropdown-menu a.dropdown-button-primary {
            margin: 0.5rem 1rem 0;
            padding: 0.75rem 1rem;
            background-color: #ff5722;
            color: white;
            text-align: center;
            border-radius: 4px;
            font-weight: 600;
        }
        .profile-dropdown-menu a.dropdown-button-primary:hover {
            background-color: #e64a19;
            color: white;
        }
        
        /* ========================================= */
        /* === CSS BARU BERAKHIR DI SINI === */
        /* ========================================= */


        /* Hero Section */
        .hero-section {
            margin-top: 80px;
            height: calc(100vh - 80px);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        /* ... (sisa CSS Anda untuk .hero-section, .products-section, dll. tetap sama) ... */
        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            max-width: 900px;
            padding: 2rem;
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-content p {
            font-size: 1.25rem;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .cta-button {
            display: inline-block;
            background-color: #ff5722;
            color: white;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(255, 87, 34, 0.3);
        }

        .cta-button:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255, 87, 34, 0.4);
        }

        /* Products Section */
        .products-section {
            background-color: #F4F7F6;
            padding: 5rem 2rem;
        }

        .products-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            color: #074159;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: #ff5722;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }

        .product-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .product-content {
            padding: 2rem;
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            color: #074159;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .product-description {
            color: #666;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .product-button {
            display: inline-block;
            background-color: #ff5722;
            color: white;
            padding: 0.75rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s ease;
            align-self: center;
        }

        .product-button:hover {
            background-color: #e64a19;
            transform: scale(1.05);
        }

        /* Start Project CTA Section */
        .start-project {
            margin-top: 56px;
            background: linear-gradient(180deg, #2CBABA 0%, #074159 70%);
            color: #FFFFFF;
            text-align: center;
            padding: 64px 16px;
        }
        .start-project .sp-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 12px;
        }
        .start-project h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
        }
        .start-project p {
            font-size: 16px;
            line-height: 1.6;
            color: rgba(255,255,255,0.9);
            max-width: 760px;
            margin: 0 auto 22px;
        }
        .start-project .sp-button {
            display: inline-block;
            background-color: #ff5722;
            color: #ffffff;
            padding: 12px 22px;
            font-weight: 700;
            border-radius: 6px;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(255, 87, 34, 0.35);
            transition: transform .15s ease, box-shadow .15s ease, background-color .15s ease;
        }
        .start-project .sp-button:hover {
            background-color: #e64a19;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(255, 87, 34, 0.45);
        }

        @media (max-width: 768px) {
            .start-project { padding: 48px 14px; margin-top: 44px; }
            .start-project h2 { font-size: 26px; margin-bottom: 10px; }
            .start-project p { font-size: 14px; margin-bottom: 18px; }
            .start-project .sp-button { padding: 10px 18px; }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem 1.5rem;
            }

            .navbar-toggle {
                display: flex;
            }

            .navbar-right {
                display: none; 
                position: absolute;
                top: 80px; 
                left: 0;
                width: 100%;
                background-color: #ffffff;
                flex-direction: column;
                align-items: stretch; 
                gap: 0;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .navbar-right.active {
                display: flex;
            }

            .navbar-menu {
                flex-direction: column; 
                gap: 0;
                width: 100%;
            }

            .navbar-menu li {
                width: 100%;
                text-align: center;
            }

            .navbar-menu li a {
                display: block; 
                padding: 1rem;
                border-bottom: 1px solid #f0f0f0;
            }

            .navbar-profile {
                justify-content: center; 
                width: 100%;
                padding: 1rem; /* Beri padding untuk ikon di mobile */
                border-bottom: 1px solid #f0f0f0;
            }

            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .cta-button {
                padding: 0.875rem 2rem;
                font-size: 1rem;
            }

            .products-section {
                padding: 3rem 1.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .products-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            /* --- CSS RESPONSIVE BARU UNTUK DROPDOWN --- */
            
            .profile-dropdown {
                width: 100%;
            }
            .profile-dropdown-toggle {
                /* Tombol ikon di mobile */
                text-align: center;
                width: 100%;
                border-radius: 0;
                display: flex;
                justify-content: center;
            }
            .profile-dropdown-toggle:hover {
                background-color: #f5f5f5;
            }
            .profile-dropdown-toggle svg {
                margin: 0 auto; /* Pusatkan ikon */
            }
            
            /* Menu dropdown di mobile */
            .profile-dropdown-menu {
                position: static;
                display: block;
                box-shadow: none;
                border-radius: 0;
                min-width: 0;
                width: 100%;
                background: none;
                border-top: 1px solid #f0f0f0;
                padding: 0;
            }
            .profile-dropdown:hover .profile-dropdown-menu {
                display: block;
            }
            .profile-dropdown-menu .dropdown-header {
                 display: none;
            }
            .profile-dropdown-menu a {
                text-align: center;
                padding: 1rem;
                border-bottom: 1px solid #f0f0f0;
                color: #074159;
            }
            .profile-dropdown-menu a:hover {
                background: #f5f5f5;
            }
            .profile-dropdown-menu .dropdown-divider {
                display: none;
            }
             /* Tombol "Daftar" di mobile */
            .profile-dropdown-menu a.dropdown-button-primary {
                margin: 0;
                border-radius: 0;
                color: white;
                background-color: #ff5722;
            }
            .profile-dropdown-menu a.dropdown-button-primary:hover {
                background-color: #e64a19;
            }
            /* --- AKHIR CSS RESPONSIVE BARU --- */

        }

        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 0.9rem;
            }
        }
        
        /* CSS Untuk Artikel Section dari file Anda */
        .skm-articles { background: #F4F7F6; padding: 56px 16px 70px; font-family: 'Besley', serif; }
        .skm-a-wrap { max-width: 980px; margin: 0 auto; }
        .skm-articles h2 { color: #074159; font-size: 36px; font-weight: 800; text-align: center; margin-bottom: 18px; }
        .skm-articles h2::after { content: ""; display: block; width: 56px; height: 4px; background: #ff5722; border-radius: 2px; margin: 8px auto 0; }
        .skm-a-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; margin-top: 26px; }
        @media (max-width: 900px) { .skm-a-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 600px) { .skm-a-grid { grid-template-columns: 1fr; } }
        .skm-a-card { background: #FFFFFF; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); overflow: hidden; }
        .skm-a-card .thumb { height: 160px; overflow: hidden; }
        .skm-a-card .thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .skm-a-card .body { padding: 14px 16px 16px; }
        .skm-a-card .title { color: #074159; font-size: 18px; font-weight: 800; line-height: 1.35; margin: 0 0 8px; }
        .skm-a-card .excerpt { color: #425B66; font-size: 15px; line-height: 1.6; margin: 0 0 12px; }
        .skm-a-card .more { color: #ff5722; font-weight: 800; text-decoration: none; }
        .skm-a-card .more:hover { text-decoration: underline; }
        @media (max-width: 640px) {
            .skm-articles h2 { font-size: 28px; }
            .skm-a-card .title { font-size: 16px; }
            .skm-a-card .excerpt { font-size: 14px; }
        }

        /* CSS Untuk Testimoni Section dari file Anda */
        .skm-testimonials { background: #FFFFFF; padding: 60px 16px 70px; font-family: 'Besley', serif; }
        .skm-t-wrap { max-width: 1100px; margin: 0 auto; }
        .skm-testimonials h2 { color: #074159; font-size: 36px; font-weight: 800; text-align: center; margin-bottom: 18px; }
        .skm-testimonials h2::after { content: ""; display: block; width: 66px; height: 4px; background: #ff5722; border-radius: 2px; margin: 8px auto 0; }
        .skm-t-single { max-width: 820px; margin: 0 auto; background: #F6FAFA; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.08); padding: 22px 24px; text-align: center; }
        .skm-t-single .quote { color: #074159; font-size: 17px; line-height: 1.65; margin: 0 0 6px; font-style: normal; letter-spacing: 0.2px; }
        .skm-t-single .credit { color: #074159; margin: 0; font-size: 16px; font-weight: 800; letter-spacing: 0.2px; }
        .skm-t-single .credit strong { font-weight: 800; }
        @media (max-width: 640px) {
            .skm-testimonials h2 { font-size: 28px; }
            .skm-t-single { padding: 18px; }
            .skm-t-single .quote { font-size: 16px; }
            .skm-t-single .credit { font-size: 15px; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/Rectangle.png') }}" alt="SIKEMAS Logo">
                </a>
            </div>

            <div class="navbar-right" id="navbar-mobile-menu">
                <ul class="navbar-menu">
                    <li><a href="{{ url('/beranda') }}">Beranda</a></li>
                    <li><a href="{{ url('/produk') }}">Produk</a></li>
                    <li><a href="{{ url('/artikel') }}">Artikel</a></li>
                    <li><a href="{{ url('/portofolio') }}">Portofolio</a></li>
                    <li><a href="{{ url('/about') }}">About Us</a></li>

                    @guest
                        <li><a href="{{ route('login') }}">Profile</a></li>
                    @endguest
                </ul>

                <div class="navbar-profile">
                    <div class="profile-dropdown">
                        
                        <button class="profile-icon profile-dropdown-toggle" aria-label="User Menu">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                        
                        <div class="profile-dropdown-menu">
                            @auth
                                <div class="dropdown-header">
                                    <span>{{ Auth::user()->name }}</span>
                                    <small>{{ Auth::user()->email }}</small>
                                </div>
                                <a href="#">Profil Saya</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login') }}">Login</a>
                                <a href="{{ route('register') }}" class="dropdown-button-primary">Daftar</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            <button class="navbar-toggle" id="navbar-hamburger" aria-label="Toggle menu">
                <div class="hamburger-icon">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </button>

        </div>
    </nav>

    <section class="hero-section">
    <img src="{{ asset('assets/img/Section.png') }}" alt="Background" class="hero-background">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Protect Your Value</h1>
            <p>Menjadi partner sejarah pertumbuhan bisnis anda dengan menyediakan proteksi yang dapat menciptakan ekosistem bisnis yang berkelanjutan</p>
            <a href="{{ url('/produk') }}" class="cta-button">Lihat Produk Kami</a>
        </div>
    </section>

    <section class="products-section">
        <div class="products-container">
            <h2 class="section-title">Produk Unggulan Kami</h2>
            
            <div class="products-grid">
                <div class="product-card">
                    <img src="{{ asset('assets/img/Rectangle12.png') }}" alt="Kotak Kemasan Khusus" class="product-image">
                    <div class="product-content">
                        <h3 class="product-title">Kotak Kemasan Khusus</h3>
                        <p class="product-description">Didesain untuk memenuhi kebutuhan spesifik produk Anda, dari ukuran hingga finishing.</p>
                        <a href="#" class="product-button">Pesan Sekarang</a>
                    </div>
                </div>

                <div class="product-card">
                    <img src="{{ asset('assets/img/Rectangle12.png') }}" alt="Karton Bergelombang" class="product-image">
                    <div class="product-content">
                        <h3 class="product-title">Karton Bergelombang</h3>
                        <p class="product-description">Kekuatan dan ketahanan optimal untuk pengiriman dan penyimpanan yang aman.</p>
                        <a href="#" class="product-button">Pesan Sekarang</a>
                    </div>
                </div>

                <div class="product-card">
                    <img src="{{ asset('assets/img/Rectangle12.png') }}" alt="Kemasan Ramah Lingkungan" class="product-image">
                    <div class="product-content">
                        <h3 class="product-title">Kemasan Ramah Lingkungan</h3>
                        <p class="product-description">Solusi kemasan berkelanjutan yang terbuat dari bahan daur ulang dan dapat didaur ulang.</p>
                        <a href="#" class="product-button">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="skm-articles" aria-labelledby="articles-title">
        <div class="skm-a-wrap">
            <h2 id="articles-title">Artikel &amp; Berita</h2>
            <div class="skm-a-grid">
                <article class="skm-a-card">
                    <div class="thumb">
                        <img src="{{ asset('assets/img/Article-image.png') }}" alt="Trend Kemasan Ramah Lingkungan">
                    </div>
                    <div class="body">
                        <h3 class="title">Trend Kemasan Ramah Lingkungan</h3>
                        <p class="excerpt">Membahas inovasi terbaru dalam industri kemasan karton yang berkelanjutan dan ramah lingkungan.</p>
                        <a class="more" href="#" aria-label="Baca selengkapnya Trend Kemasan Ramah Lingkungan">Baca Selengkapnya</a>
                    </div>
                </article>
                <article class="skm-a-card">
                    <div class="thumb">
                        <img src="{{ asset('assets/img/Article-image.png') }}" alt="Pentingnya Kemasan yang Tepat">
                    </div>
                    <div class="body">
                        <h3 class="title">Pentingnya Kemasan yang Tepat</h3>
                        <p class="excerpt">Bagaimana kemasan yang kuat dan menarik dapat meningkatkan nilai jual produk Anda.</p>
                        <a class="more" href="#" aria-label="Baca selengkapnya Pentingnya Kemasan yang Tepat">Baca Selengkapnya</a>
                    </div>
                </article>
                <article class="skm-a-card">
                    <div class="thumb">
                        <img src="{{ asset('assets/img/Article-image.png') }}" alt="Proses Produksi Kami">
                    </div>
                    <div class="body">
                        <h3 class="title">Proses Produksi Kami</h3>
                        <p class="excerpt">Mengintip proses di balik produksi kemasan karton berkualitas tinggi di pabrik Sikemas.</p>
                        <a class="more" href="#" aria-label="Baca selengkapnya Proses Produksi Kami">Baca Selengkapnya</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="skm-testimonials" aria-labelledby="testi-title">
        <div class="skm-t-wrap">
            <h2 id="testi-title">Apa Kata Klien Kami</h2>
            <div class="skm-t-single">
                <blockquote class="quote">
                    “Sikemas selalu memberikan kemasan yang kokoh dan tepat waktu. Hasilnya tidak pernah mengecewakan.”
                </blockquote>
                <p class="credit">— John Doe, <strong>CEO Perusahaan Makanan</strong></p>
            </div>
        </div>
    </section>

    @include('sections.faq')

    <section class="start-project" aria-labelledby="sp-title">
        <div class="sp-container">
            <h2 id="sp-title">Siap memulai proyek Anda?</h2>
            <p>Hubungi kami hari ini untuk konsultasi gratis dan wujudkan kemasan impian Anda.</p>
            <a href="#" class="sp-button" aria-label="Hubungi Kami">Hubungi Kami</a>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hamburgerButton = document.getElementById('navbar-hamburger');
            const mobileMenu = document.getElementById('navbar-mobile-menu');

            hamburgerButton.addEventListener('click', function () {
                mobileMenu.classList.toggle('active');
            });
        });
    </script>
</body>
</html>