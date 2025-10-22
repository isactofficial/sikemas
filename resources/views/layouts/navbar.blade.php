<nav class="skm-navbar" role="navigation" aria-label="Main Navigation">
    <div class="skm-container">
        <!-- Left: Brand (Logo SIKEMAS) -->
        <a href="{{ url('/') }}" class="skm-logo" aria-label="SIKEMAS Home">
            <img src="{{ asset('assets/img/Rectangle.png') }}" alt="SIKEMAS Logo" loading="lazy">
        </a>

        <!-- Center: Menu -->
        <button id="navbar-hamburger" class="skm-nav-toggle" type="button" aria-expanded="false" aria-controls="navbar-mobile-menu">
            <span class="skm-bar" aria-hidden="true"></span>
            <span class="skm-bar" aria-hidden="true"></span>
            <span class="skm-bar" aria-hidden="true"></span>
            <span class="visually-hidden">Toggle navigation</span>
        </button>

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

            <!-- Mobile-only user dropdown -->
            <div class="skm-mobile-user-wrapper">
                @auth
                    <div class="skm-mobile-user-info">
                        <span>{{ Auth::user()->name }}</span>
                        <small>{{ Auth::user()->email }}</small>
                    </div>
                    <a href="#" class="skm-mobile-link">Profil Saya</a>
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

        <!-- Right: User icon with dropdown (Desktop) -->
        <div class="skm-user-dropdown">
            <button class="skm-user" aria-label="Akun" id="user-menu-button">
                <svg class="skm-user-icon" width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.6" />
                    <circle cx="12" cy="10" r="3.2" stroke="currentColor" stroke-width="1.6" />
                    <path d="M5.5 19.5c1.9-3.2 5-4.8 6.5-4.8s4.6 1.6 6.5 4.8" stroke="currentColor" stroke-width="1.6" fill="none" stroke-linecap="round" />
                </svg>
            </button>
            
            <!-- Dropdown Menu -->
            <div class="skm-dropdown-menu" id="user-dropdown">
                @auth
                    <div class="skm-dropdown-header">
                        <span>{{ Auth::user()->name }}</span>
                        <small>{{ Auth::user()->email }}</small>
                    </div>
                    <a href="#" class="skm-dropdown-item">Profil Saya</a>
                    <div class="skm-dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="skm-dropdown-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="skm-dropdown-item">Login</a>
                    <a href="{{ route('register') }}" class="skm-dropdown-item skm-dropdown-register">Daftar</a>
                @endauth
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
        }
        
        .skm-container { 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 10px 16px; 
            display: grid; 
            grid-template-columns: auto 1fr auto; 
            align-items: center; 
            gap: 16px; 
        }
        
        .skm-logo img { height: 48px; width: auto; display: block; }
        
        /* Menu aligned to the right */
        .skm-menu { justify-self: end; margin-right: 12px; }
        .skm-navbar .skm-links { 
            list-style: none; 
            display: flex; 
            align-items: center; 
            gap: 28px; 
            margin: 0; 
            padding: 0; 
        }
        .skm-navbar .skm-links a { 
            text-decoration: none; 
            color: var(--skm-link); 
            font-weight: 600; 
            font-size: 14px; 
            letter-spacing: 0.2px;
            transition: color 0.2s ease;
        }
        .skm-navbar .skm-links a:hover, 
        .skm-navbar .skm-links a.active { 
            color: var(--skm-link-hover); 
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
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .skm-user:hover { background-color: #f0f0f0; }
        .skm-user-icon { color: currentColor; }

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

        .skm-dropdown-divider {
            height: 1px;
            background-color: #f0f0f0;
            margin: 0.5rem 0;
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
            .skm-container { grid-template-columns: auto 1fr auto; }
            .skm-nav-toggle { 
                display: inline-block; 
                grid-column: 3; 
                justify-self: end; 
                align-self: center; 
            }
            .skm-logo img { height: 40px; }
            
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
            .skm-navbar .skm-links li:last-child a { border-bottom: 0; }
            
            /* Hide desktop user dropdown */
            .skm-user-dropdown { display: none; }
            
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
        }
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
        });
    </script>
</nav>