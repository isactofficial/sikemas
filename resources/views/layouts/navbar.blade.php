<nav class="skm-navbar" role="navigation" aria-label="Main Navigation">
    <div class="skm-container">
        <!-- Left: Brand (Logo SIKEMAS 2) -->
        <a href="#" class="skm-logo" aria-label="SIKEMAS Home">
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
            @php
                $links = [
                    ['label' => 'Beranda', 'href' => '#'],
                    ['label' => 'Produk', 'href' => '#'],
                    ['label' => 'Artikel', 'href' => '#'],
                    ['label' => 'Portofolio', 'href' => '#'],
                    ['label' => 'About Us', 'href' => '#'],
                    ['label' => 'Profile', 'href' => '#'],
                ];
            @endphp
            <ul class="skm-links">
                @foreach ($links as $link)
                    <li>
                        <a href="{{ $link['href'] }}">{{ $link['label'] }}</a>
                    </li>
                @endforeach
            </ul>

            <!-- Mobile-only user icon (centered at the bottom of dropdown) -->
            <div class="skm-mobile-user" aria-hidden="true">
                <svg class="skm-user-icon" width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.6" />
                    <circle cx="12" cy="10" r="3.2" stroke="currentColor" stroke-width="1.6" />
                    <path d="M5.5 19.5c1.9-3.2 5-4.8 6.5-4.8s4.6 1.6 6.5 4.8" stroke="currentColor" stroke-width="1.6" fill="none" stroke-linecap="round" />
                </svg>
            </div>
        </div>

        <!-- Right: User icon (simple, no badge like in screenshot) -->
        <a class="skm-user" href="#" aria-label="Akun">
            <svg class="skm-user-icon" width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.6" />
                <circle cx="12" cy="10" r="3.2" stroke="currentColor" stroke-width="1.6" />
                <path d="M5.5 19.5c1.9-3.2 5-4.8 6.5-4.8s4.6 1.6 6.5 4.8" stroke="currentColor" stroke-width="1.6" fill="none" stroke-linecap="round" />
            </svg>
        </a>
    </div>

    <style>
        /* Basic reset for this component */
        :root {
            /* Brand & links */
            --skm-teal: #1F6D72;         /* accent line color */
            --skm-teal-dark: #15565A;    /* hover/alt */
            --skm-link: #074159;         /* menu text (Tarawera tone) */
            --skm-link-hover: #053244;   /* menu hover - slightly darker */
        }
        /* Sticky white bar with teal accent line like in the reference image */
    .skm-navbar { position: sticky; top: 0; z-index: 50; background: #ffffff; border-bottom: 0; }
        .skm-container { max-width: 1200px; margin: 0 auto; padding: 10px 16px; display: grid; grid-template-columns: auto 1fr auto; align-items: center; gap: 16px; }
        .skm-logo img { height: 48px; width: auto; display: block; }

    /* Menu aligned closer to the right (near profile icon) */
    .skm-menu { justify-self: end; margin-right: 12px; }
    .skm-navbar .skm-links { list-style: none; display: flex; align-items: center; gap: 28px; margin: 0; padding: 0; }
        .skm-navbar .skm-links a { text-decoration: none; color: var(--skm-link); font-weight: 600; font-size: 14px; letter-spacing: 0.2px; }
        .skm-navbar .skm-links a:hover, .skm-navbar .skm-links a.active { color: var(--skm-link-hover); }

        /* Right icon */
        .skm-user { color: var(--skm-link); display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 9999px; }
        .skm-user:hover { color: var(--skm-link-hover); }
    .skm-user-icon { color: currentColor; }
    /* Hidden by default, shown only on mobile */
    .skm-mobile-user { display: none; color: var(--skm-link); }

        /* Toggle (hamburger) */
    .skm-nav-toggle { display: none; background: transparent; border: 0; padding: 6px; cursor: pointer; }
    .skm-nav-toggle .skm-bar { display: block; width: 22px; height: 2px; background: var(--skm-link); margin: 4px 0; transition: transform .2s ease; }
        .visually-hidden { position: absolute !important; height: 1px; width: 1px; overflow: hidden; clip: rect(1px, 1px, 1px, 1px); white-space: nowrap; }

        /* Responsive */
        @media (max-width: 900px) {
            .skm-container { grid-template-columns: auto 1fr auto; }
            .skm-nav-toggle { display: inline-block; grid-column: 3; justify-self: end; align-self: center; }
            /* Logo slightly smaller on mobile for balance */
            .skm-logo img { height: 40px; }
            /* Drop the menu right under the bar regardless of bar height */
            .skm-menu { position: absolute; left: 0; right: 0; top: 100%; background: #fff; box-shadow: 0 8px 20px rgba(0,0,0,0.06); border-top: 1px solid rgba(0,0,0,0.06); justify-self: stretch; }
            /* Stack items full width with centered text and separators like the mock */
            .skm-navbar .skm-links { flex-direction: column; align-items: stretch; gap: 0; }
            .skm-navbar .skm-links li { width: 100%; }
            .skm-navbar .skm-links a { display: block; width: 100%; padding: 16px 20px; text-align: center; border-bottom: 1px solid #E6EEF0; }
            .skm-navbar .skm-links li:last-child a { border-bottom: 0; }
            /* Hide top-right user icon on mobile and replace with centered one inside menu */
            .skm-user { display: none; }
            .skm-mobile-user { display: flex; justify-content: center; align-items: center; padding: 14px 0 18px; }
            .skm-menu:not(.active) { display: none; }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hamburgerButton = document.getElementById('navbar-hamburger');
            const mobileMenu = document.getElementById('navbar-mobile-menu');

            if (!hamburgerButton || !mobileMenu) return;

            hamburgerButton.addEventListener('click', function () {
                mobileMenu.classList.toggle('active');
                // Keep ARIA in sync for accessibility
                const expanded = hamburgerButton.getAttribute('aria-expanded') === 'true';
                hamburgerButton.setAttribute('aria-expanded', String(!expanded));
            });
        });
    </script>
</nav>
