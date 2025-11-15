<footer class="skm-footer" role="contentinfo">
    <div class="skm-footer-container">
        <div class="skm-footer-col skm-brand">
            <img src="{{ asset('assets/img/logo_sikemas_1.png') }}" alt="SIKEMAS Logo" class="skm-footer-logo" loading="lazy">
            <p class="skm-desc">
                laoreet dolor bibendum. Vestibulum turpis mi, vulputate a est ut, facilisis tincidunt sapien. Curabitur quis
            </p>
            <ul class="skm-socials" aria-label="Sosial Media">
                <li>
                    <a href="#" aria-label="Instagram">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="18" height="18" rx="5" stroke="white" stroke-width="1.6"/>
                            <circle cx="12" cy="12" r="3.5" stroke="white" stroke-width="1.6"/>
                            <circle cx="17.5" cy="6.5" r="1.2" fill="white"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" aria-label="WhatsApp">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 11.5a8.5 8.5 0 0 1-12.6 7.4L3 21l2.2-5.1A8.5 8.5 0 1 1 21 11.5z" stroke="white" stroke-width="1.6" fill="none"/>
                            <path d="M9.8 9.3c.2-.4.4-.4.6-.4h.5c.2 0 .4 0 .4.3 0 .3-.1.6-.3.9-.3.3-.6.6-.5.9.2.4.7 1.1 1.3 1.5.7.5 1.2.7 1.6.6.3 0 .5-.3.7-.6.2-.3.3-.4.6-.3l1 .4c.3.1.4.3.4.6 0 .3-.2.8-.6 1.1-.5.4-1.2.5-1.9.3-.9-.2-1.9-.7-2.8-1.5-.9-.7-1.6-1.7-2-2.5-.3-.7-.3-1.4.1-1.9.1-.2.3-.4.6-.5z" fill="white"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" aria-label="Email">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="5" width="18" height="14" rx="2" stroke="white" stroke-width="1.6"/>
                            <path d="M4 7l8 6 8-6" stroke="white" stroke-width="1.6"/>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>

        <div class="skm-footer-col">
            <h3 class="skm-col-title">Layanan</h3>
            <ul class="skm-links">
                <li><a href="{{ route('produk') }}">Produk</a></li>
                <li><a href="{{ route('artikel') }}">Artikel</a></li>
                <li><a href="{{ route('portofolio') }}">Portofolio</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
            </ul>
        </div>

        <div class="skm-footer-col">
            <h3 class="skm-col-title">Kontak</h3>
            <ul class="skm-contacts">
                <li><a href="#">+62 1231234123</a></li>
                <li><a href="#">unknown@sikemas.com</a></li>
                <li><span>Jogjakarta, Indonesia</span></li>
            </ul>
        </div>
    </div>

    <div class="skm-footer-bottom">
        <p>© 2025 Sikemas. Hak Cipta Dilindungi.</p>
    </div>

    <style>
    .skm-footer { background: #074159; color: #FFFFFF; margin-top: 0; }
    .skm-footer-container { max-width: 1200px; margin: 0 auto; padding: 32px 16px 18px; display: grid; grid-template-columns: 1.6fr 1fr 1fr; gap: 24px; align-items: start; }
    /* Match navbar logo size on desktop */
    .skm-footer-logo { height: 48px; width: auto; margin-bottom: 10px; display: block; }
        .skm-desc { color: #D9E8ED; font-size: 14px; line-height: 1.55; margin: 6px 0 14px; max-width: 520px; }
    .skm-socials { display: flex; gap: 12px; list-style: none; padding: 0; margin: 0; }
    .skm-socials a { display: inline-flex; align-items: center; justify-content: center; text-decoration: none; }
    .skm-socials svg { width: 18px; height: 18px; }
    .skm-socials a:hover svg { opacity: 0.9; }

    .skm-col-title { font-size: 16px; font-weight: 700; margin: 4px 0 10px; color: #FFFFFF; }
    .skm-footer .skm-links, .skm-footer .skm-contacts { list-style: none; padding: 0; margin: 0; }
    .skm-footer .skm-links li, .skm-footer .skm-contacts li { margin: 8px 0; }
    .skm-footer .skm-links a, .skm-footer .skm-contacts a { color: #D9E8ED; text-decoration: none; }
    .skm-footer .skm-links a:hover, .skm-footer .skm-contacts a:hover { color: #FFFFFF; text-decoration: underline; }

    .skm-footer-bottom { padding: 12px 16px 18px; text-align: center; color: #D9E8ED; font-size: 14px; border-top: 0; }

        @media (max-width: 900px) {
            /* Stack to a single column but keep desktop-like left alignment for a consistent look */
            .skm-footer-container { grid-template-columns: 1fr; gap: 24px; padding: 24px 16px 12px; }
            .skm-brand, .skm-footer-col { text-align: left; }
            /* Match navbar logo size on mobile */
            .skm-footer-logo { height: 40px; margin-left: 0; margin-right: 0; }
            .skm-desc { max-width: 560px; margin: 8px 0 16px; font-size: 13px; }
            .skm-socials { justify-content: flex-start; gap: 16px; }

            /* Keep the same visual style as desktop (no extra separators) */
            .skm-footer-col:not(.skm-brand) { border-top: 0; padding-top: 0; }
            .skm-col-title { margin: 6px 0 10px; }
            .skm-footer .skm-links li, .skm-footer .skm-contacts li { margin: 10px 0; }
            .skm-footer .skm-links a, .skm-footer .skm-contacts a { display: inline-block; }

            .skm-footer-bottom { text-align: center; padding: 14px 16px; font-size: 13px; }
        }
    </style>
</footer>
