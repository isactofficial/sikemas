<nav class="skm-navbar" role="navigation" aria-label="Main Navigation">
    <div class="skm-container">
        <a href="{{ url('/') }}" class="skm-logo" aria-label="SIKEMAS Home">
            <img src="{{ asset('assets/img/Rectangle.png') }}" alt="SIKEMAS Logo" loading="lazy">
        </a>

        <button id="navbar-hamburger" class="skm-nav-toggle" type="button" aria-expanded="false" aria-controls="navbar-mobile-menu">
            <span class="skm-bar" aria-hidden="true"></span>
            <span class="skm-bar" aria-hidden="true"></span>
            <span class="skm-bar" aria-hidden="true"></span>
            <span class="visually-hidden">Toggle navigation</span>
        </button>

        <div class="skm-right">
        <div id="navbar-mobile-menu" class="skm-menu">
            <ul class="skm-links">
                <li><a href="{{ url('/beranda') }}">Beranda</a></li>
                <li><a href="{{ url('/produk') }}">Produk</a></li>
                <li><a href="{{ url('/artikel') }}">Artikel</a></li>
                <li><a href="{{ url('/portofolio') }}">Portofolio</a></li>
                <li><a href="{{ url('/about') }}">About Us</a></li>
                @guest
                    <li><a href="{{ route('login') }}">Profile</a></li>
                @endguest
            </ul>

            <div class="skm-mobile-user-wrapper">
                {{-- **START: SEARCH MOBILE BARU** --}}
                <a href="{{ route('search') }}" class="skm-mobile-link skm-mobile-search">
                    <i class="fas fa-search"></i> Cari
                </a>
                {{-- **END: SEARCH MOBILE BARU** --}}

                {{-- **HTML TRANSLATE MOBILE** --}}
                <div class="skm-mobile-link translate-mobile-wrapper">
                    <div id="google_translate_element_mobile"></div>
                </div>

                @auth
                    <div class="skm-mobile-user-info">
                        <span>{{ Auth::user()->name }}</span>
                        <small>{{ Auth::user()->email }}</small>
                    </div>
                    @php
                        // Deteksi admin untuk menu mobile
                        $__isAdmin_m = false;
                        try {
                            $__um = Auth::user();
                            if (isset($__um->role) && strtolower((string) $__um->role) === 'admin') {
                                $__isAdmin_m = true;
                            } elseif (isset($__um->is_admin) && (bool) $__um->is_admin) {
                                $__isAdmin_m = true;
                            } else {
                                $listm = env('ADMIN_EMAILS');
                                if ($listm) {
                                    $emailsm = array_filter(array_map('trim', explode(',', $listm)));
                                    $__isAdmin_m = in_array(strtolower($__um->email), array_map('strtolower', $emailsm), true);
                                }
                            }
                        } catch (\Throwable $e) { $__isAdmin_m = false; }
                    @endphp
                    @if ($__isAdmin_m)
                        <a href="{{ route('admin.index') }}" class="skm-mobile-link">Halaman Admin</a>
                    @endif
                    <a href="{{ route('cart.index') }}" class="skm-mobile-link">
                        <i class="fas fa-shopping-cart"></i> Keranjang Belanja
                    </a>
                    <a href="{{ route('profile.index') }}" class="skm-mobile-link">Profil Saya</a>
                        <a href="{{ route('logout') }}" class="skm-mobile-link" 
                           onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                            Logout
                        </a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="skm-mobile-link">Login</a>
                    <a href="{{ route('register') }}" class="skm-mobile-link skm-mobile-register">Daftar</a>
                @endauth
            </div>
        </div>

        <div class="skm-right-icons">
            {{-- **START: SEARCH BAR DESKTOP BARU** --}}
            <form action="{{ route('search') }}" method="GET" class="skm-search-form" id="skm-search-form" role="search">
                <input type="search" name="q" placeholder="Cari artikel, produk..." class="skm-search-input" id="skm-search-input">
                <button type="button" class="skm-search-toggle" id="skm-search-toggle" aria-label="Buka Kolom Pencarian">
                    <svg class="skm-search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 17C13.866 17 17 13.866 17 10C17 6.13401 13.866 3 10 3C6.13401 3 3 6.13401 3 10C3 13.866 6.13401 17 10 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M21 21L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </form>
            {{-- **END: SEARCH BAR DESKTOP BARU** --}}

            <a href="{{ route('cart.index') }}" class="skm-cart-link" aria-label="Keranjang Belanja">
                <svg class="skm-cart-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 2L7 7H21L19 2H9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7 7C5.34315 7 4 8.34315 4 10V19C4 20.6569 5.34315 22 7 22H17C18.6569 22 20 20.6569 20 19V10C20 8.34315 18.6569 7 17 7H7Z" stroke="currentColor" stroke-width="2"/>
                    <circle cx="9" cy="15" r="1" fill="currentColor"/>
                    <circle cx="15" cy="15" r="1" fill="currentColor"/>
                </svg>
                <span class="skm-cart-badge" data-cart-count style="display:none;">0</span>
            </a>
            
            {{-- **HTML TRANSLATE DESKTOP** --}}
            <div id="google_translate_element_desktop"></div>
            
            <div class="skm-user-dropdown">
                <button class="skm-user" aria-label="Akun" id="user-menu-button">
                    <svg class="skm-user-icon" width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.6" />
                        <circle cx="12" cy="10" r="3.2" stroke="currentColor" stroke-width="1.6" />
                        <path d="M5.5 19.5c1.9-3.2 5-4.8 6.5-4.8s4.6 1.6 6.5 4.8" stroke="currentColor" stroke-width="1.6" fill="none" stroke-linecap="round" />
                    </svg>
                </button>
                
                <div class="skm-dropdown-menu" id="user-dropdown">
                    @auth
                        <div class="skm-dropdown-header">
                            <span>{{ Auth::user()->name }}</span>
                            <small>{{ Auth::user()->email }}</small>
                        </div>
                        <a href="{{ route('profile.index') }}" class="skm-dropdown-item">Profil Saya</a>
                        @php
                            // Deteksi admin untuk menampilkan link "Halaman Admin" tepat di bawah Profil Saya
                            $__isAdmin_d = false;
                            try {
                                $__ud = Auth::user();
                                if (isset($__ud->role) && strtolower((string) $__ud->role) === 'admin') {
                                    $__isAdmin_d = true;
                                } elseif (isset($__ud->is_admin) && (bool) $__ud->is_admin) {
                                    $__isAdmin_d = true;
                                } else {
                                    $listd = env('ADMIN_EMAILS');
                                    if ($listd) {
                                        $emailsd = array_filter(array_map('trim', explode(',', $listd)));
                                        $__isAdmin_d = in_array(strtolower($__ud->email), array_map('strtolower', $emailsd), true);
                                    }
                                }
                            } catch (\Throwable $e) { $__isAdmin_d = false; }
                        @endphp
                        @if ($__isAdmin_d)
                            <a href="{{ route('admin.index') }}" class="skm-dropdown-item">Halaman Admin</a>
                        @endif
                        <a href="{{ route('cart.index') }}" class="skm-dropdown-item">
                            <i class="fas fa-shopping-cart"></i> Keranjang Belanja
                        </a>
                        <div class="skm-dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="skm-dropdown-item"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="skm-dropdown-item skm-dropdown-login">Login</a>
                        <a href="{{ route('register') }}" class="skm-dropdown-item skm-dropdown-register">Daftar</a>
                    @endauth
                </div>
            </div>
    </div>
    </div>
    </div>

    <style>
        /* Basic reset for this component */
        :root {
            --skm-teal: #1F6D72;
            --skm-teal-dark: #15565A;
            --skm-link: #074159;
            --skm-link-hover: #053244;
        }
        
        /* Sticky navbar */
        .skm-navbar { 
            position: sticky; 
            top: 0; 
            z-index: 50; 
            background: #ffffff; 
            border-bottom: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            height: 80px;
            display: flex;
            align-items: center;
        }
        
        .skm-container { 
            max-width: 1400px;
            margin: 0 auto; 
            padding: 1rem 3rem;
            display: flex;
            align-items: center; 
            gap: 15px; /* Mengurangi gap sedikit karena ada search bar baru */
            width: 100%;
        }
        
        .skm-logo img { height: 50px; width: auto; display: block; }
        
        /* Right group (menu + user) */
        .skm-right { display: flex; align-items: center; gap: 2rem; margin-left: auto; }
        .skm-menu { margin: 0; }

        .skm-navbar .skm-links { 
            list-style: none; 
            display: flex; 
            align-items: center; 
            gap: 2rem;
            margin: 0; 
            padding: 0; 
            box-sizing: border-box;
        }
        .skm-navbar .skm-links a { 
            text-decoration: none; 
            color: var(--skm-link); 
            font-weight: 500;
            font-size: 1rem;
            letter-spacing: 0.2px;
            position: relative;
            transition: color 0.25s ease, transform 0.18s ease, text-shadow 0.18s ease;
        }
        /* underline accent without layout shift */
        .skm-navbar .skm-links a::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -6px;
            width: 0;
            height: 2px;
            background: #ff5722;
            border-radius: 2px;
            transform: translateX(-50%);
            transition: width 0.18s ease;
        }
        .skm-navbar .skm-links a:hover, 
        .skm-navbar .skm-links a:focus-visible, 
        .skm-navbar .skm-links a.active, 
        .skm-navbar .skm-links a.touch-hover { 
            color: var(--skm-link-hover); 
            transform: scale(1.06);
        }
        .skm-navbar .skm-links a:hover::after,
        .skm-navbar .skm-links a:focus-visible::after,
        .skm-navbar .skm-links a.active::after,
        .skm-navbar .skm-links a.touch-hover::after { width: 60%; }
        .skm-navbar .skm-links a:active { transform: scale(0.98); color: #ff5722; }

        /* Right Icons Container */
        .skm-right-icons {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* --- START: CSS BARU UNTUK SEARCH BAR DESKTOP --- */
        .skm-search-form {
            position: relative;
            display: flex;
            align-items: center;
            height: 32px;
            width: 32px; /* Awalnya hanya selebar ikon */
            transition: width 0.3s ease;
        }

        .skm-search-toggle {
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            color: var(--skm-link);
            transition: color 0.2s, background 0.2s;
            position: absolute;
            right: 0;
            z-index: 10;
        }
        
        .skm-search-toggle:hover {
            background-color: #f0f0f0;
        }

        .skm-search-input {
            width: 0;
            padding: 0;
            border: 1px solid transparent;
            border-radius: 16px;
            height: 32px;
            font-size: 14px;
            background: #f8f8f8;
            transition: width 0.3s ease, padding 0.3s ease, border-color 0.3s ease;
            opacity: 0;
            pointer-events: none;
            color: var(--skm-link);
        }

        /* State when active (expanded) */
        .skm-search-form.active {
            width: 200px; /* Lebar total form saat aktif */
        }
        
        .skm-search-form.active .skm-search-input {
            width: 100%; /* Penuhi lebar form */
            padding: 0 40px 0 15px; /* Padding untuk teks, dan ruang untuk ikon submit/toggle */
            border-color: #ddd;
            opacity: 1;
            pointer-events: all;
        }
        
        .skm-search-form.active .skm-search-toggle {
            color: white;
            background-color: var(--skm-link);
            border-radius: 0 16px 16px 0;
            width: 40px;
            height: 32px;
        }
        
        .skm-search-form.active .skm-search-toggle:hover {
            background-color: var(--skm-link-hover);
        }
        /* --- END: CSS BARU UNTUK SEARCH BAR DESKTOP --- */


        /* Cart Icon */
        .skm-cart-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--skm-link);
            text-decoration: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            transition: background 0.2s ease;
        }
        
        .skm-cart-link:hover {
            background-color: #f0f0f0;
        }
        
        .skm-cart-icon {
            color: currentColor;
        }
        
        .skm-cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #ff5722;
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
            line-height: 1;
        }
        
        .skm-cart-badge:empty {
            display: none;
        }

        /* User icon & dropdown */
        .skm-user-dropdown { position: relative; }
        .skm-user { 
            color: var(--skm-link); 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            width: 32px; 
            height: 32px; 
            border-radius: 50%; 
            background: transparent;
            border: none;
            padding: 0;
            line-height: 1;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .skm-user:hover { background-color: #f0f0f0; }
        .skm-user-icon { color: currentColor; display: block; }

        /* Dropdown menu */
        .skm-dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            min-width: 220px;
            overflow: hidden;
            padding: 0.5rem 0;
        }
        .skm-dropdown-menu.show { display: block; }

        .skm-dropdown-header {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 0.5rem;
        }
        .skm-dropdown-header span {
            display: block;
            font-weight: 700;
            color: var(--skm-link);
            font-size: 14px;
        }
        .skm-dropdown-header small {
            color: #666;
            font-size: 12px;
        }

        /* Item dropdown biasa */
        .skm-dropdown-item {
            display: block;
            padding: 0.75rem 1rem;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.2s ease;
        }
        .skm-dropdown-item:hover {
            background-color: #f5f5f5;
            color: var(--skm-link);
        }
        
        .skm-dropdown-item i {
            margin-right: 8px;
            color: var(--skm-teal);
        }

        .skm-dropdown-divider {
            height: 1px;
            background-color: #f0f0f0;
            margin: 0.5rem 0;
        }

        /* CSS Login/Daftar di Dropdown (rata tengah) - Sesuai permintaan sebelumnya */
        .skm-dropdown-login {
            margin: 0.5rem 1rem; 
            padding: 0.75rem 1rem;
            text-align: center; 
            border-radius: 6px;
            font-weight: 600;
            border: 1px solid var(--skm-link);
            color: var(--skm-link) !important;
            background-color: transparent;
        }
        .skm-dropdown-login:hover {
            background-color: var(--skm-link) !important;
            color: white !important;
        }

        .skm-dropdown-register {
            margin: 0.5rem 1rem;
            padding: 0.75rem 1rem;
            background-color: #ff5722;
            color: white !important;
            text-align: center;
            border-radius: 4px;
            font-weight: 600;
        }
        .skm-dropdown-register:hover {
            background-color: #e64a19 !important;
        }
        /* --- AKHIR CSS MODIFIKASI LOGIN/DAFTAR --- */


        /* Mobile user section - hidden by default */
        .skm-mobile-user-wrapper { display: none; }

        /* Toggle (hamburger) */
        .skm-nav-toggle { 
            display: none; 
            background: transparent; 
            border: 0; 
            padding: 6px; 
            cursor: pointer; 
        }
        .skm-nav-toggle .skm-bar { 
            display: block; 
            width: 22px; 
            height: 2px; 
            background: var(--skm-link); 
            margin: 4px 0; 
            transition: transform .2s ease; 
        }
        .visually-hidden { 
            position: absolute !important; 
            height: 1px; 
            width: 1px; 
            overflow: hidden; 
            clip: rect(1px, 1px, 1px, 1px); 
            white-space: nowrap; 
        }

        /* Responsive */
        @media (max-width: 900px) {
            .skm-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1rem 1.5rem;
            }

            .skm-logo {
                order: 1;
                margin-right: auto;
            }

            .skm-nav-toggle { 
                display: inline-block;
                order: 3;
                margin-left: auto;
            }

            .skm-right {
                order: 2;
                margin-left: 0;
            }

            .skm-logo img { height: 50px; }
            
            .skm-menu { 
                position: absolute; 
                left: 0; 
                right: 0; 
                top: 100%; 
                background: #fff; 
                box-shadow: 0 8px 20px rgba(0,0,0,0.06); 
                border-top: 1px solid rgba(0,0,0,0.06); 
                justify-self: stretch; 
            }
            
            .skm-navbar .skm-links { 
                flex-direction: column; 
                align-items: stretch; 
                gap: 0; 
            }
            .skm-navbar .skm-links li { width: 100%; }
            .skm-navbar .skm-links a { 
                display: block; 
                width: 100%; 
                padding: 16px 20px; 
                text-align: center; 
                border-bottom: 1px solid #E6EEF0; 
            }
            .skm-navbar .skm-links a:hover,
            .skm-navbar .skm-links a:focus-visible,
            .skm-navbar .skm-links a.touch-hover { transform: scale(1.02); }
            .skm-navbar .skm-links a::after { bottom: 0; }
            .skm-navbar .skm-links li:last-child a { border-bottom: 0; }
            
            /* Hide desktop search, cart and user dropdown */
            .skm-right-icons { display: none; }
            
            /* Show mobile user section */
            .skm-mobile-user-wrapper { 
                display: block; 
                border-top: 1px solid #E6EEF0;
            }
            
            .skm-mobile-user-info {
                padding: 12px 20px;
                background: #f9f9f9;
                text-align: center;
            }
            .skm-mobile-user-info span {
                display: block;
                font-weight: 700;
                color: var(--skm-link);
                font-size: 14px;
            }
            .skm-mobile-user-info small {
                color: #666;
                font-size: 12px;
            }
            
            .skm-mobile-link {
                display: block;
                padding: 16px 20px;
                text-align: center;
                color: var(--skm-link);
                text-decoration: none;
                border-bottom: 1px solid #E6EEF0;
                font-weight: 600;
                font-size: 14px;
            }
            .skm-mobile-link:hover {
                background: #f5f5f5;
            }
            
            .skm-mobile-register {
                background-color: #ff5722;
                color: white !important;
                border-bottom: 0;
            }
            .skm-mobile-register:hover {
                background-color: #e64a19 !important;
            }
            
            .skm-menu:not(.active) { display: none; }

            /* Mobile Translate Fix */
            .translate-mobile-wrapper {
                padding: 0;
                text-align: left;
                border-bottom: 0;
            }

            #google_translate_element_mobile {
                display: block !important;
                text-align: center;
                padding: 16px 20px;
                background: #fff;
                border-bottom: 1px solid #E6EEF0; 
            }
        }
        /* --- END: Responsive --- */


        /* --- START: Google Translate CSS --- */
        #google_translate_element_mobile {
            display: none !important;
        }
        
        @media (max-width: 900px) {
            #google_translate_element_desktop {
                display: none !important;
            }
        }
        
        #google_translate_element_desktop,
        #google_translate_element_mobile {
            display: inline-block;
        }

        .goog-te-gadget {
            font-family: 'Poppins', sans-serif !important;
            font-size: 0 !important;
            white-space: nowrap;
        }

        .goog-te-gadget .goog-te-combo {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            border: none !important;
            border-radius: 20px !important;
            padding: 8px 16px !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            font-family: 'Poppins', sans-serif !important;
            cursor: pointer !important;
            outline: none !important;
            min-width: 120px !important;
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3) !important;
            transition: all 0.3s ease !important;
        }

        .goog-te-gadget .goog-te-combo:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%) !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4) !important;
            transform: translateY(-1px) !important;
        }

        .goog-te-gadget .goog-te-combo:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3) !important;
        }

        .goog-te-gadget-simple .goog-te-menu-value span:first-child {
            display: none;
        }

        .goog-te-gadget-simple .goog-te-menu-value:before {
            content: '🌐 Language';
            font-size: 14px;
            font-weight: 500;
        }

        .goog-te-banner-frame {
            display: none !important;
        }

        body {
            top: 0 !important;
        }

        .skiptranslate>iframe {
            visibility: hidden !important;
            height: 0 !important;
            width: 0 !important;
        }

        .home-page .navbar .goog-te-gadget .goog-te-combo {
            background: rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(10px) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: white !important;
        }

        .home-page .navbar .goog-te-gadget .goog-te-combo:hover {
            background: rgba(255, 255, 255, 0.25) !important;
        }
        /* --- END: Google Translate CSS --- */
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Hamburger menu toggle
            const hamburgerButton = document.getElementById('navbar-hamburger');
            const mobileMenu = document.getElementById('navbar-mobile-menu');

            if (hamburgerButton && mobileMenu) {
                hamburgerButton.addEventListener('click', function () {
                    mobileMenu.classList.toggle('active');
                    const expanded = hamburgerButton.getAttribute('aria-expanded') === 'true';
                    hamburgerButton.setAttribute('aria-expanded', String(!expanded));
                });

                // Helper to close the mobile menu
                function closeMobileMenu() {
                    if (mobileMenu.classList.contains('active')) {
                        mobileMenu.classList.remove('active');
                        hamburgerButton.setAttribute('aria-expanded', 'false');
                    }
                }

                // Close when clicking outside menu/hamburger
                document.addEventListener('click', function (e) {
                    const clickInside = mobileMenu.contains(e.target);
                    const clickHamburger = hamburgerButton.contains(e.target);
                    if (!clickInside && !clickHamburger) {
                        closeMobileMenu();
                    }
                });

                // Close on Escape key
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        closeMobileMenu();
                    }
                });

                // Close after choosing a link
                mobileMenu.querySelectorAll('a').forEach(a => {
                    a.addEventListener('click', closeMobileMenu);
                });
            }

            // Desktop dropdown toggle
            const userButton = document.getElementById('user-menu-button');
            const userDropdown = document.getElementById('user-dropdown');

            if (userButton && userDropdown) {
                userButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('show');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!userButton.contains(e.target) && !userDropdown.contains(e.target)) {
                        userDropdown.classList.remove('show');
                    }
                });
            }

            // --- START: SEARCH BAR DESKTOP LOGIC BARU ---
            const searchForm = document.getElementById('skm-search-form');
            const searchInput = document.getElementById('skm-search-input');
            const searchToggle = document.getElementById('skm-search-toggle');

            if (searchForm && searchInput && searchToggle) {
                // Function to expand the search bar
                function expandSearch() {
                    searchForm.classList.add('active');
                    searchInput.focus();
                    searchToggle.setAttribute('type', 'submit'); // Ganti menjadi submit saat expanded
                    searchToggle.setAttribute('aria-label', 'Cari');
                }

                // Function to collapse the search bar
                function collapseSearch() {
                    // Hanya collapse jika input kosong
                    if (searchInput.value.trim() === '') {
                        searchForm.classList.remove('active');
                        searchToggle.setAttribute('type', 'button'); // Kembalikan menjadi button
                        searchToggle.setAttribute('aria-label', 'Buka Kolom Pencarian');
                    }
                }

                // Event listener for the icon click
                searchToggle.addEventListener('click', function(e) {
                    // Jika belum aktif, expand. Jika sudah aktif, biarkan submit form.
                    if (!searchForm.classList.contains('active')) {
                        e.preventDefault(); // Cegah submit saat expand
                        expandSearch();
                    }
                });
                
                // Event listener for focusout (blur)
                searchInput.addEventListener('blur', collapseSearch);

                // Handle form submission when input is empty (prevents submission and collapses)
                searchForm.addEventListener('submit', function(e) {
                    if (searchInput.value.trim() === '') {
                        e.preventDefault();
                        collapseSearch();
                    }
                });
            }
            // --- END: SEARCH BAR DESKTOP LOGIC BARU ---
            
            // Load cart count on page load
            @auth
            fetch('{{ route("cart.count") }}', {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                updateCartBadge(data.count);
            })
            .catch(error => {
                console.error('Error loading cart count:', error);
            });

            // After login: merge guest cart from localStorage (if any)
            try {
                const guestItemsRaw = localStorage.getItem('skm_guest_cart');
                if (guestItemsRaw) {
                    const guestItems = JSON.parse(guestItemsRaw);
                    if (Array.isArray(guestItems) && guestItems.length > 0) {
                        // Prefer meta CSRF, fallback to logout form hidden _token
                        let csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
                        if (!csrf) {
                            const tokenInput = document.querySelector('#logout-form input[name="_token"], #logout-form-mobile input[name="_token"]');
                            if (tokenInput) csrf = tokenInput.value;
                        }
                        fetch('{{ route('cart.merge') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrf
                            },
                            body: JSON.stringify({ items: guestItems })
                        })
                        .then(r => r.json())
                        .then(d => {
                            // Clear local guest cart on success
                            try { localStorage.removeItem('skm_guest_cart'); } catch (e) {}
                            if (typeof updateCartBadge === 'function' && typeof d.cart_count !== 'undefined') {
                                updateCartBadge(d.cart_count);
                            }
                        })
                        .catch(err => console.error('Merge guest cart failed:', err));
                    }
                }
            } catch (e) { /* no-op */ }
            @else
            // Guest: show cart count from localStorage (can add items before login)
            try {
                const items = JSON.parse(localStorage.getItem('skm_guest_cart') || '[]');
                const count = Array.isArray(items) ? items.reduce((s, it) => s + (parseInt(it.quantity)||0), 0) : 0;
                updateCartBadge(count);
            } catch (e) { updateCartBadge(0); }
            @endauth
            
            // Function to update cart badge
            function updateCartBadge(count) {
                const badges = document.querySelectorAll('[data-cart-count]');
                badges.forEach(badge => {
                    badge.textContent = count;
                    if (count > 0) {
                        badge.style.display = 'inline-block';
                    } else {
                        badge.style.display = 'none';
                    }
                });
            }
            
            // Make updateCartBadge available globally
            window.updateCartBadge = updateCartBadge;

            // Touch-mimicked hover for menu links on mobile
            const menuLinks = document.querySelectorAll('.skm-navbar .skm-links a');
            if (menuLinks && menuLinks.length) {
                const addTouch = (e) => e.currentTarget.classList.add('touch-hover');
                const removeTouch = (e) => e.currentTarget.classList.remove('touch-hover');
                menuLinks.forEach(a => {
                    a.addEventListener('touchstart', addTouch, { passive: true });
                    a.addEventListener('touchend', removeTouch, { passive: true });
                    a.addEventListener('touchcancel', removeTouch, { passive: true });
                    a.addEventListener('blur', removeTouch);
                    a.addEventListener('click', removeTouch);
                });
            }
            
            // --- START: Google Translate Scripts (DARI FILE BARU) ---
            
            // Inisialisasi GTranslate untuk ID Desktop dan Mobile
            function googleTranslateElementInit() {
                // Inisialisasi Desktop
                new google.translate.TranslateElement({
                    pageLanguage: 'id',
                    includedLanguages: 'id,en',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                    autoDisplay: false
                }, 'google_translate_element_desktop');

                // Inisialisasi Mobile
                new google.translate.TranslateElement({
                    pageLanguage: 'id',
                    includedLanguages: 'id,en',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                    autoDisplay: false
                }, 'google_translate_element_mobile');
            }

            // Load Google Translate Script
            (function() {
                var gtScript = document.createElement('script');
                gtScript.type = 'text/javascript';
                gtScript.async = true;
                gtScript.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';

                gtScript.onload = function() {
                    console.log('Google Translate loaded successfully');
                    // Tambahkan fungsi init ke window agar bisa dipanggil oleh GTranslate
                    window.googleTranslateElementInit = googleTranslateElementInit; 
                };

                gtScript.onerror = function() {
                    console.error('Failed to load Google Translate');
                };

                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(gtScript, s);
            })();

            // Clean up Google Translate UI after load
            window.addEventListener('load', function() {
                setTimeout(function() {
                    // Hide banner
                    var banner = document.querySelector('.goog-te-banner-frame');
                    if (banner) {
                        banner.style.display = 'none';
                    }

                    // Reset body position
                    document.body.style.top = '0px';
                    document.body.style.position = 'static';

                    // Hide notification iframe
                    var skiptranslate = document.querySelector('.skiptranslate');
                    if (skiptranslate) {
                        var iframe = skiptranslate.querySelector('iframe');
                        if (iframe) {
                            iframe.style.visibility = 'hidden';
                            iframe.style.height = '0px';
                            iframe.style.width = '0px';
                        }
                    }
                }, 2000);
            });
            // --- END: Google Translate Scripts ---

        });
    </script>
</nav>