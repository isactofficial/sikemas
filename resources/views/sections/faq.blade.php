<section class="skm-faq" aria-labelledby="faq-title">
    <div class="skm-faq-wrap">
        <h2 id="faq-title">Pertanyaan yang Sering Diajukan</h2>

        <div class="faq-list">
            <!-- Item 1 (default closed) -->
            <div class="faq-card">
                <button class="faq-q" aria-expanded="false">
                    Bagaimana cara memesan kemasan kustom?
                </button>
                <div class="faq-a">
                    laoreet dolor bibendum. Vestibulum turpis mi, vulputate a est ut, facilisis tincidunt sapien. Curabitur quis ultrices dolor. Nam pellentesque, neque sit amet dapibus viverra
                </div>
            </div>

            <!-- Item 2 -->
            <div class="faq-card">
                <button class="faq-q" aria-expanded="false">
                    Apakah ada minimum order?
                </button>
                <!-- <div class="faq-a">
                    Minimum order bergantung pada jenis kemasan dan spesifikasi. Silakan hubungi kami untuk detail dan penawaran terbaik.
                </div> -->
            </div>

            <!-- Item 3 -->
            <div class="faq-card">
                <button class="faq-q" aria-expanded="false">
                    Berapa lama waktu produksi?
                </button>
                <!-- <div class="faq-a">
                    Rata-rata 7 sampai 14 hari kerja setelah desain dan spesifikasi disetujui. Proyek kompleks dapat memerlukan waktu tambahan.
                </div> -->
            </div>

            <!-- Item 4 -->
            <div class="faq-card">
                <button class="faq-q" aria-expanded="false">
                    Apakah produk Anda ramah lingkungan?
                </button>
                <!-- <div class="faq-a">
                    Kami menyediakan opsi bahan daur ulang dan proses ramah lingkungan untuk membantu mengurangi dampak terhadap alam.
                </div> -->
            </div>
        </div>
    </div>

    <style>
        .skm-faq { background: #F4F7F6; padding: 64px 16px 72px; font-family: 'Besley', serif; }
        .skm-faq-wrap { max-width: 980px; margin: 0 auto; }
        /* Title */
        .skm-faq h2 { color: #074159; font-size: 40px; line-height: 1.2; font-weight: 800; letter-spacing: 0.2px; text-align: center; position: relative; margin-bottom: 28px; }
        .skm-faq h2::after { content: ""; display: block; width: 66px; height: 4px; background: #ff5722; border-radius: 2px; margin: 8px auto 0; }

        /* List & cards */
        .faq-list { display: flex; flex-direction: column; gap: 14px; }
        .faq-card { background: #FFFFFF; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }

        /* Question row */
        .faq-q { width: 100%; text-align: left; background: #FFFFFF; border: none; padding: 16px 18px; color: #074159; cursor: pointer; font-size: 17px; font-weight: 600; letter-spacing: 0.2px; line-height: 1.45; }
        .faq-q:hover { background: #F6FAFA; }

    /* Answer box - match question typography */
    .faq-a { display: none; margin: 0 16px 16px; padding: 14px 16px; border: 2px solid #ff5722; border-radius: 8px; color: #074159; background: #FFFFFF; font-size: 17px; line-height: 1.55; font-weight: 600; letter-spacing: 0.2px; }
        .faq-card.active .faq-q { background: #FFFFFF; }

        @media (max-width: 768px) {
            .skm-faq { padding: 48px 14px 56px; }
            .skm-faq h2 { font-size: 28px; margin-bottom: 22px; }
            .faq-q { font-size: 16px; }
            .faq-a { font-size: 16px; font-weight: 600; }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.skm-faq .faq-card');
            cards.forEach((card, idx) => {
                const btn = card.querySelector('.faq-q');
                const ans = card.querySelector('.faq-a');
                const id = `faq-a-${idx}`;
                if (ans) {
                    ans.id = id;
                    btn.setAttribute('aria-controls', id);
                }

                btn.addEventListener('click', () => {
                    const isExpanded = btn.getAttribute('aria-expanded') === 'true';
                    // close all safely (skip missing answers)
                    cards.forEach(c => {
                        c.classList.remove('active');
                        const b = c.querySelector('.faq-q');
                        const a = c.querySelector('.faq-a');
                        if (b) b.setAttribute('aria-expanded', 'false');
                        if (a) a.style.display = 'none';
                    });
                    // toggle current only if there's an answer block
                    if (!isExpanded && ans) {
                        btn.setAttribute('aria-expanded', 'true');
                        ans.style.display = 'block';
                        card.classList.add('active');
                    } else {
                        btn.setAttribute('aria-expanded', 'false');
                    }
                });
            });
        });
    </script>
</section>
