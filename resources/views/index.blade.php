<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKEMAS - Protect Your Value</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f5f5;
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
            /* Tentukan tinggi navbar agar dropdown mobile pas */
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
            width: 100%; /* Pastikan container mengisi navbar */
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
            display: block; /* Menghilangkan spasi ekstra di bawah gambar */
        }

        .navbar-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .navbar-menu li a {
            text-decoration: none;
            color: #2c6b6d;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .navbar-menu li a:hover {
            color: #1a4a4c;
        }

        .navbar-profile {
            display: flex;
            align-items: center;
        }

        .profile-icon {
            width: 28px;
            height: 28px;
            border: 2px solid #2c6b6d;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-icon:hover {
            background-color: #2c6b6d;
        }

        .profile-icon svg {
            width: 16px;
            height: 16px;
            fill: #2c6b6d;
        }

        .profile-icon:hover svg {
            fill: white;
        }

        /* --- TAMBAHAN CSS: GAYA HAMBURGER --- */
        .navbar-toggle {
            display: none; /* Sembunyi di desktop */
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin-left: auto; /* Posisikan di kanan */
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
            background-color: #2c6b6d;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        /* --- AKHIR TAMBAHAN CSS --- */


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

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem 1.5rem;
            }

            /* --- PERUBAHAN CSS UNTUK MOBILE --- */
            .navbar-toggle {
                display: flex; /* Tampilkan hamburger */
            }

            .navbar-right {
                display: none; /* Sembunyikan menu desktop */
                position: absolute;
                top: 80px; /* Tepat di bawah navbar */
                left: 0;
                width: 100%;
                background-color: #ffffff;
                flex-direction: column;
                align-items: stretch; /* Buat item menu jadi full-width */
                gap: 0;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            /* Kelas .active ini akan di-toggle oleh JavaScript */
            .navbar-right.active {
                display: flex;
            }

            .navbar-menu {
                flex-direction: column; /* Susun link secara vertikal */
                gap: 0;
                width: 100%;
            }

            .navbar-menu li {
                width: 100%;
                text-align: center;
            }

            .navbar-menu li a {
                display: block; /* Buat link mengisi semua area 'li' */
                padding: 1rem;
                border-bottom: 1px solid #f0f0f0;
            }

            .navbar-profile {
                padding: 1rem;
                justify-content: center; /* Pusatkan ikon profil */
            }
            /* --- AKHIR PERUBAHAN CSS --- */

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
        }

        @media (max-width: 480px) {
            /* Hapus .navbar-menu { display: none; } dari sini karena sudah diatur di 768px */

            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 0.9rem;
            }
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
                    <li><a href="{{ url('/profile') }}">Profile</a></li>
                </ul>
                <div class="navbar-profile">
                    <div class="profile-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
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
        <img src="{{ asset('assets/img/section.png') }}" alt="Background" class="hero-background">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Protect Your Value</h1>
            <p>Menjadi partner sejarah pertumbuhan bisnis anda dengan menyediakan proteksi yang dapat menciptakan ekosistem bisnis yang berkelanjutan</p>
            <a href="{{ url('/produk') }}" class="cta-button">Lihat Produk Kami</a>
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