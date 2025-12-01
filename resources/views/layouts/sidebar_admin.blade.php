<button class="skm-sidebar-toggle" aria-controls="skmSidebar" aria-expanded="false" aria-label="Toggle sidebar">
    <span class="skm-toggle-bars" aria-hidden="true">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </span>
</button>

<aside id="skmSidebar"
    class="skm-sidebar {{ request()->is('admin') ? 'is-dashboard' : '' }} {{ request()->is('admin/transactions*') ? 'is-transactions' : '' }}"
    aria-label="Admin Sidebar">
    <div class="skm-sidebar__inner">
        <div class="skm-sidebar__brand">
            <span class="skm-brand__icon" aria-hidden="true">
                <img src="{{ asset('assets/img/dashboard.png') }}" alt="Dashboard Logo" class="skm-brand__img">
            </span>
            <h2 class="skm-brand__title">Dashboard</h2>
        </div>

        <nav class="skm-sidebar__nav" role="navigation">
            <a href="{{ url('/admin') }}" class="skm-nav__link {{ request()->is('admin') ? 'is-active' : '' }}">
                Dashboard
            </a>

            <a href="{{ url('/admin/articles') }}"
                class="skm-nav__link {{ request()->is('admin/articles*') ? 'is-active' : '' }}">
                Manage Artikel
            </a>

            <a href="{{ url('/admin/products') }}"
                class="skm-nav__link {{ request()->is('admin/products*') ? 'is-active' : '' }}">
                Manage Product
            </a>

            <a href="{{ url('/admin/testimonials') }}"
                class="skm-nav__link {{ request()->is('admin/testimonials*') ? 'is-active' : '' }}">
                Manage Testimoni
            </a>

            <a href="{{ url('/admin/transactions') }}"
                class="skm-nav__link {{ request()->is('admin/transactions*') ? 'is-active' : '' }}">
                Manage Transactions
            </a>

            <a href="{{ route('admin.free-consultations.index') }}"
                class="skm-nav__link {{ request()->is('admin/free-consultations*') ? 'is-active' : '' }}">
                Manajemen Konsultasi
            </a>

            <a href="{{ route('admin.messages.index') }}"
                class="skm-nav__link {{ request()->routeIs('admin.messages*') ? 'is-active' : '' }}">
                Manajemen Pesan
            </a>
        </nav>

        <div class="skm-sidebar__footer">
            <a href="{{ route('beranda') }}" class="skm-sidebar__btn is-back" title="Kembali ke Beranda">
                <span class="icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" style="display:block">
                        <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
                <span class="text">Beranda</span>
                <span class="chev" aria-hidden="true">›</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="skm-sidebar__logout-form">
                @csrf
                <button type="submit" class="skm-sidebar__btn is-logout" title="Log Out">
                    <span class="icon" aria-hidden="true">
                        <img src="{{ asset('assets/img/log_out2.png') }}" alt="" class="skm-logout__icon">
                    </span>
                    <span class="text">Log Out</span>
                    <span class="chev" aria-hidden="true">›</span>
                </button>
            </form>
        </div>
    </div>
</aside>
<div class="skm-sidebar__overlay" aria-hidden="true"></div>

<style>
    .skm-sidebar {
        position: fixed;
        inset: 0 auto 0 0;
        width: 240px;
        background: transparent;
        z-index: 1000;
        transition: transform .25s ease;
    }

    .skm-sidebar__inner {
        display: flex;
        flex-direction: column;
        height: 100%;
        padding: 12px 10px;
    }

    /* Brand */
    .skm-sidebar__brand {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 8px 16px;
        overflow: hidden;
    }

    .skm-brand__icon {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .skm-brand__img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .skm-brand__title {
        color: #111111;
        font-size: 26px;
        font-weight: 800;
        margin: 0;
        letter-spacing: .2px;
        flex: 1 1 auto;
        min-width: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Nav */
    .skm-sidebar__nav {
        display: grid;
        gap: 14px;
    }

    .skm-nav__link {
        display: block;
        color: #ff5722;
        text-decoration: none;
        font-weight: 700;
        font-size: 12.5px;
        padding: 12px 14px;
        border-radius: 18px;
        background: #ffffff;
        box-shadow: 0 6px 22px rgba(7, 65, 89, 0.08);
        transition: transform .15s ease, box-shadow .15s ease, background-color .15s ease, color .15s ease, letter-spacing .15s ease;
        text-align: center;
        position: relative;
    }

    .skm-nav__link:hover {
        transform: translateY(-1px) scale(1.02);
        box-shadow: 0 10px 28px rgba(7, 65, 89, 0.12);
        background-color: #074159;
        color: #ffffff;
        letter-spacing: .2px;
    }

    /* Touch-mimicked hover state */
    .skm-nav__link.touch-hover {
        transform: translateY(-1px) scale(1.02);
        box-shadow: 0 10px 28px rgba(7, 65, 89, 0.12);
        background-color: #074159;
        color: #ffffff;
        letter-spacing: .2px;
    }

    .skm-nav__link:focus-visible {
        outline: 2px solid #074159;
        outline-offset: 2px;
        background-color: #074159;
        color: #ffffff;
    }

    .skm-nav__link:active {
        transform: translateY(0) scale(0.99);
        background-color: #053244;
        color: #ffffff;
    }

    .skm-nav__link.is-active {
        background: #074159;
        color: #ffffff;
        box-shadow: 0 10px 28px rgba(7, 65, 89, 0.18);
    }

    /* Footer */
    .skm-sidebar__footer {
        margin-top: auto;
        padding: 10px 0 8px;
        display: grid;
        grid-auto-rows: auto;
        gap: 8px;
    }

    .skm-sidebar__footer form {
        width: 100%;
        margin: 0;
    }

    /* Unified footer button style to guarantee identical width/height */
    .skm-sidebar__btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 12px 14px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
        text-decoration: none;
        border: 0;
        outline: 0;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        transition: background-color .15s ease, transform .15s ease, box-shadow .15s ease;
    }

    .skm-sidebar__btn .icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border: 2px solid rgba(255, 255, 255, 0.95);
        border-radius: 10px;
        padding: 4px;
        box-sizing: border-box;
    }

    .skm-sidebar__btn .text {
        flex: 1 1 auto;
        text-align: left;
    }

    .skm-sidebar__btn .chev {
        font-size: 18px;
        line-height: 1;
        opacity: .95;
    }

    /* Variants */
    /* Make Beranda button same width as other buttons */
    .skm-sidebar__btn.is-back {
        background: #074159;
        color: #fff;
        box-shadow: 0 8px 24px rgba(7, 65, 89, 0.28);
        width: 100%;
        margin: 0;
    }

    .skm-sidebar__btn.is-back:hover {
        background: #063e52;
        transform: translateY(-1px);
        box-shadow: 0 12px 28px rgba(7, 65, 89, 0.36);
    }

    /* Exceptions: On Dashboard and Manage Transactions keep the previous slightly narrower width */
    .skm-sidebar.is-dashboard .skm-sidebar__btn.is-back,
    .skm-sidebar.is-transactions .skm-sidebar__btn.is-back {
        width: 89%;
        margin: 0 auto;
    }

    .skm-sidebar__btn.is-logout {
        background: #e53935;
        color: #fff;
        box-shadow: 0 8px 24px rgba(229, 57, 53, 0.28);
        cursor: pointer;
    }

    .skm-sidebar__btn.is-logout:hover {
        background: #d32f2f;
        transform: translateY(-1px);
        box-shadow: 0 12px 28px rgba(229, 57, 53, 0.36);
    }

    .skm-logout__icon {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
        filter: brightness(0) invert(1) opacity(.98);
    }

    /* Content area spacing for admin pages */
    .skm-admin-main {
        margin-left: 240px;
        padding: 24px;
    }

    @media (max-width: 1023px) {

        /* tablet */
        .skm-sidebar {
            width: 200px;
        }

        .skm-admin-main {
            margin-left: 200px;
        }
    }

    /* Mobile behavior: off-canvas sidebar with overlay and toggle */
    .skm-sidebar-toggle {
        position: fixed;
        left: 16px;
        top: 16px;
        display: none;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        border: 1px solid #E5E7EB;
        color: inherit;
        border-radius: 10px;
        padding: 10px;
        z-index: 1100;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .06);
    }

    .skm-toggle-bars {
        position: relative;
        width: 24px;
        height: 18px;
        display: inline-block;
    }

    .skm-toggle-bars .bar {
        position: absolute;
        left: 0;
        width: 24px;
        height: 2px;
        background: #074159;
        display: block;
        border-radius: 2px;
        transition: transform .2s ease, opacity .2s ease, top .2s ease;
    }

    .skm-toggle-bars .bar:nth-child(1) {
        top: 0;
    }

    .skm-toggle-bars .bar:nth-child(2) {
        top: 8px;
    }

    .skm-toggle-bars .bar:nth-child(3) {
        top: 16px;
    }

    .skm-sidebar-toggle.is-open .skm-toggle-bars .bar:nth-child(1) {
        top: 8px;
        transform: rotate(45deg);
    }

    .skm-sidebar-toggle.is-open .skm-toggle-bars .bar:nth-child(2) {
        opacity: 0;
    }

    .skm-sidebar-toggle.is-open .skm-toggle-bars .bar:nth-child(3) {
        top: 8px;
        transform: rotate(-45deg);
    }

    .skm-sidebar__overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .32);
        display: none;
        z-index: 900;
    }

    @media (max-width: 767px) {

        /* mobile */
        .skm-sidebar {
            width: 80%;
            max-width: 300px;
            background: #fff;
            box-shadow: 4px 0 24px rgba(0, 0, 0, .15);
            transform: translateX(-100%);
        }

        .skm-sidebar.is-open {
            transform: translateX(0);
        }

        .skm-sidebar-toggle {
            display: inline-flex;
        }

        /* push page content below the fixed hamburger so it never overlaps */
        .skm-admin-main {
            margin-left: 0;
            padding: 16px;
            margin-top: 72px;
        }

        /* show overlay only when sidebar open */
        .skm-sidebar.is-open+.skm-sidebar__overlay {
            display: block;
        }

        /* No close button inside sidebar on mobile */

        /* Reserve space inside sidebar header so the fixed X doesn't cover the title */
        .skm-sidebar.is-open .skm-sidebar__brand {
            padding-left: 56px;
        }

        /* Smaller title size on narrow widths and ensure truncation */
        .skm-brand__title {
            font-size: 20px;
        }

        /* Keep Beranda button full width on most pages */
        .skm-sidebar__btn.is-back {
            width: 100%;
        }

        /* But on Dashboard and Transactions, use the narrower look to match design */
        .skm-sidebar.is-dashboard .skm-sidebar__btn.is-back,
        .skm-sidebar.is-transactions .skm-sidebar__btn.is-back {
            width: 89%;
            margin: 0 auto;
        }

        /* tone down hover scale on mobile */
        .skm-nav__link:hover {
            transform: translateY(-1px) scale(1.005);
        }

        .skm-nav__link.touch-hover {
            transform: translateY(-1px) scale(1.005);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('skmSidebar');
        const toggle = document.querySelector('.skm-sidebar-toggle');
        const overlay = document.querySelector('.skm-sidebar__overlay');
        const links = sidebar ? sidebar.querySelectorAll('.skm-sidebar__nav a') : [];

        if (toggle && sidebar) {
            toggle.addEventListener('click', () => {
                const isOpen = sidebar.classList.toggle('is-open');
                toggle.classList.toggle('is-open', isOpen);
                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('is-open');
                if (toggle) {
                    toggle.classList.remove('is-open');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });
        }

        // Touch-mimicked hover for sidebar links on mobile
        if (links && links.length) {
            const addTouch = (e) => e.currentTarget.classList.add('touch-hover');
            const removeTouch = (e) => e.currentTarget.classList.remove('touch-hover');
            links.forEach(a => {
                a.addEventListener('touchstart', addTouch, {
                    passive: true
                });
                a.addEventListener('touchend', removeTouch, {
                    passive: true
                });
                a.addEventListener('touchcancel', removeTouch, {
                    passive: true
                });
                a.addEventListener('blur', removeTouch);
                a.addEventListener('click', removeTouch);
            });
        }

        links.forEach(a => a.addEventListener('click', () => {
            sidebar.classList.remove('is-open');
            if (toggle) {
                toggle.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        }));
    });
</script>
</style>
