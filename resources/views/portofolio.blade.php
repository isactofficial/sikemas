<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - SIKEMAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        html, body { margin: 0; padding: 0; }
        * { box-sizing: border-box; }
        body { font-family: 'Besley', serif; color:#074159; overflow-x: hidden; background:#ffffff; }
        h1, h2, h3, strong { font-family: 'Besley', serif; }
        @media (max-width: 900px) { h2 { font-size: 26px; } p { font-size: 16px; line-height: 1.55; } }
        @media (max-width: 560px) { h2 { font-size: 24px; } p { font-size: 15px; } }
    </style>
    
</head>
<body>

@include('layouts.navbar')

<style>
    /* Import Besley to match other pages */
    @import url('https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800;900&display=swap');

    html, body { margin: 0; padding: 0; }
    body { font-family: 'Besley', serif; color:#074159; }
    h1, h2, h3, strong { font-family: 'Besley', serif; }
    /* Minor rhythm adjustments for mobile */
    @media (max-width: 900px) {
        h2 { font-size: 26px; }
        p { font-size: 16px; line-height: 1.55; }
    }
    @media (max-width: 560px) {
        h2 { font-size: 24px; }
        p { font-size: 15px; }
    }
    /* Prevent stray horizontal scroll on small devices */
    * { box-sizing: border-box; }
    body { overflow-x: hidden; }
</style>

<!-- Hero Section -->
<header class="skm-hero" role="banner">
    <div class="skm-hero-wrap">
        <div class="skm-hero-media">
            <img src="{{ asset('assets/img/Berbagai_jenis_kemasan.png') }}" alt="Contoh kemasan karton" loading="lazy">
        </div>
        <div class="skm-hero-copy">
            <h1>Portofolio</h1>
            <p>Lihat Hasil Kerja dan Dengarkan Pelanggan Kami.</p>
        </div>
    </div>

    <style>
        .skm-hero{background:linear-gradient(90deg,#074159 0%,#1F6D72 55%,#28979e 100%);padding:34px 16px 40px;margin-bottom:34px}
        .skm-hero-wrap{max-width:1100px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:28px;align-items:center}
        .skm-hero-media img{width:100%;height:auto;border-radius:8px;box-shadow:0 8px 30px rgba(0,0,0,.15)}
        .skm-hero-copy{color:#fff}
        .skm-hero-copy h1{font-size:42px;line-height:1.15;font-weight:800;margin:4px 0 8px}
        .skm-hero-copy p{font-size:18px;line-height:1.6;color:#e8f4f6;max-width:540px}
        @media (max-width:900px){
            .skm-hero{padding:22px 12px 26px}
            .skm-hero-wrap{grid-template-columns:1fr;gap:14px}
            /* show text first on mobile */
            .skm-hero-copy{order:1;text-align:center;margin:0 auto}
            .skm-hero-media{order:2}
            .skm-hero-media img{max-width:520px;margin:0 auto;display:block}
            .skm-hero-copy h1{font-size:28px}
            .skm-hero-copy p{font-size:15.5px;max-width:620px;margin-left:auto;margin-right:auto}
        }
    </style>
</header>

<!-- Hasil Kerja Kami -->
<section class="skm-results" aria-labelledby="results-title">
    <div class="skm-results-wrap">
        <h2 id="results-title">Hasil Kerja Kami</h2>

        <div class="skm-result-grid">
            <article class="skm-result-card">
                <img src="{{ asset('assets/img/Container.png') }}" alt="Kotak kemasan khusus" loading="lazy">
                <h3>Kotak Kemasan Khusus</h3>
                <p>Pellentesque a imperdiet leo. Vivamus non augue vel justo commodo ornare. Ut a enim maximus, congue lectus ut, tincidunt est. In laoreet vehicula tincidunt. Curabitur non facilisis quam.</p>
            </article>
            <article class="skm-result-card">
                <img src="{{ asset('assets/img/karton_buka.png') }}" alt="Karton Bergelombang" loading="lazy">
                <h3>Karton Bergelombang</h3>
                <p>Pellentesque a imperdiet leo. Vivamus non augue vel justo commodo ornare. Ut a enim maximus, congue lectus ut, tincidunt est. In l.</p>
            </article>
            <article class="skm-result-card">
                <img src="{{ asset('assets/img/karton_banyak.png') }}" alt="Kemasan massal beragam ukuran" loading="lazy">
                <h3>Kemasan Ramah Lingkungan</h3>
                <p>Pellentesque a imperdiet leo. Vivamus non augue vel justo commodo ornare. Ut a enim maximus, congue lectus ut, tincidunt est. In laoreet vehicula tincidunt. Curabitur non facilisis quam. Aliquam gravida purus sed tellus pulvinar, eu accumsan orci tincidunt. Duis sagittis, diam ultricies semper pharetra, metus sem mattis nulla.</p>
            </article>
        </div>
    </div>

    <style>
        .skm-results{padding:12px 12px 28px;background:#fff}
        .skm-results-wrap{max-width:1100px;margin:0 auto}
        .skm-results h2{color:#074159;text-align:center;font-size:30px;font-weight:800;margin:6px 0 14px}
        .skm-result-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
        .skm-result-card{background:#fff;border-radius:12px;box-shadow:0 8px 20px rgba(7,65,89,.08);padding:14px;text-align:center}
        .skm-result-card img{width:100%;height:auto;display:block;border-radius:8px;margin-bottom:10px;aspect-ratio:4/3;object-fit:cover}
        .skm-result-card h3{color:#074159;font-size:18px;font-weight:800;margin-bottom:6px}
        .skm-result-card p{color:#355a68;font-size:14px;line-height:1.6}
        @media (max-width:900px){
            .skm-result-grid{grid-template-columns:1fr;gap:14px}
            .skm-results{padding:10px 10px 22px}
        }
    </style>
</section>

<!-- Testimoni -->
<section class="t-section" aria-labelledby="testimoni-title">
    <div class="t-wrap">
        <h2 id="testimoni-title">Testimoni</h2>

        @if(isset($testimonies) && $testimonies->count() > 0)
        <div class="t-carousel" data-count="{{ $testimonies->count() }}">
            <button class="t-nav t-prev" aria-label="Sebelumnya" disabled>
                <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M15.41 7.41 14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>
            </button>
            <div class="t-viewport">
                <div class="t-track">
                    @foreach($testimonies as $t)
                        @php
                            $img = $t->image ? asset('storage/'.$t->image) : asset('assets/img/Container.png');
                        @endphp
                        <div class="t-slide">
                            <figure class="t-card">
                                <img src="{{ $img }}" alt="Foto {{ $t->name }}" loading="lazy">
                                <figcaption class="t-overlay">
                                    <h3 class="t-name">{{ $t->name }}</h3>
                                    <div class="t-role">{{ $t->job ?? '-' }}</div>
                                    <p class="t-quote">{{ Str::limit($t->testimony ?? '', 160) }}</p>
                                </figcaption>
                            </figure>
                        </div>
                    @endforeach
                </div>
            </div>
            <button class="t-nav t-next" aria-label="Berikutnya">
                <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M10 6 8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
            </button>
            <div class="t-dots" role="tablist" aria-label="Navigasi testimoni"></div>
        </div>
        @else
            <p style="text-align:center; color:#355a68">Belum ada testimoni untuk ditampilkan.</p>
        @endif
    </div>

    <style>
        /* Section wrapper */
        .t-section{background:#eef3f1;padding:28px 12px}
        .t-wrap{max-width:1100px;margin:0 auto}
        .t-wrap h2{color:#074159;text-align:center;font-size:28px;font-weight:800;margin:4px 0 18px}

        /* Carousel */
        .t-carousel{position:relative; --per:3}
    .t-viewport{overflow:hidden}
        .t-track{display:flex; gap:16px; transition:transform .45s ease}
        .t-slide{flex:0 0 calc(100% / var(--per))}
    .t-nav{position:absolute; top:50%; transform:translateY(-50%); background:#fff; color:#074159; border:1px solid #d7e3e0; box-shadow:0 4px 14px rgba(7,65,89,.08); width:38px; height:38px; border-radius:50%; display:grid; place-items:center; cursor:pointer; z-index:3}
        .t-prev{left:-6px}
        .t-next{right:-6px}
        .t-nav[disabled]{opacity:.5; cursor:not-allowed}
        .t-dots{display:flex; justify-content:center; gap:6px; margin-top:12px}
        .t-dots button{width:8px; height:8px; border-radius:50%; border:0; background:#c9d9d5; cursor:pointer}
        .t-dots button[aria-current="true"]{background:#074159}

        /* Card */
        .t-card{position:relative;overflow:hidden;border-radius:10px;background:#fff}
        .t-card img{width:100%;height:auto;display:block;aspect-ratio:4/5;object-fit:cover;transition:transform .35s ease}
        .t-overlay{position:absolute;inset:0;display:grid;align-content:center;gap:6px;color:#fff;padding:22px;transition:all .35s ease; opacity:0; background:rgba(0,0,0,0);}
        .t-name{font-weight:800;font-size:26px;line-height:1;margin:0}
        .t-role{opacity:.9;margin-bottom:6px}
        .t-quote{font-size:14px;line-height:1.5;max-width:40ch}
        .t-card:hover img{transform:scale(1.04)}
        .t-card:hover .t-overlay{opacity:1;background:rgba(0,0,0,.6);justify-items:center;text-align:center}

        /* Responsive: adjust items per view */
        @media (max-width:900px){ .t-carousel{ --per:2 } }
        @media (max-width:560px){ .t-carousel{ --per:1 } .t-section{padding:22px 10px} }
    </style>

    <script>
        (function(){
            const root = document.currentScript.previousElementSibling.previousElementSibling.closest('.t-section');
            const carousel = root.querySelector('.t-carousel');
            if(!carousel) return;
            const viewport = carousel.querySelector('.t-viewport');
            const track = carousel.querySelector('.t-track');
            const slides = Array.from(track.children);
            const btnPrev = carousel.querySelector('.t-prev');
            const btnNext = carousel.querySelector('.t-next');
            const dotsWrap = carousel.querySelector('.t-dots');

            function per(){
                const styles = getComputedStyle(carousel);
                return Math.max(1, parseInt(styles.getPropertyValue('--per')) || 1);
            }

            let page = 0;
            function pages(){ return Math.max(1, Math.ceil(slides.length / per())); }

            function updateDots(){
                dotsWrap.innerHTML = '';
                const total = pages();
                for(let i=0;i<total;i++){
                    const b = document.createElement('button');
                    b.type = 'button';
                    b.setAttribute('aria-label', 'Ke halaman ' + (i+1));
                    if(i===page) b.setAttribute('aria-current','true');
                    b.addEventListener('click', ()=>{ page=i; render(); });
                    dotsWrap.appendChild(b);
                }
            }

            function render(){
                const total = pages();
                if(page >= total) page = total-1;
                const offset = (100 / per()) * page;
                track.style.transform = `translateX(-${offset}%)`;
                btnPrev.disabled = page === 0;
                btnNext.disabled = page >= total - 1;
                Array.from(dotsWrap.children).forEach((d, i)=>{
                    if(i===page) d.setAttribute('aria-current','true'); else d.removeAttribute('aria-current');
                });
            }

            btnPrev.addEventListener('click', ()=>{ if(page>0){ page--; render(); } });
            btnNext.addEventListener('click', ()=>{ if(page < pages()-1){ page++; render(); } });
            window.addEventListener('resize', ()=>{ updateDots(); render(); });

            updateDots();
            render();
        })();
    </script>
</section>

 <!-- FAQ -->
 @include('sections.faq')

 @include('layouts.footer')

</body>
</html>