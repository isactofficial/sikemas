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

        @php($testi=[
            ['img'=>'orang1.png','name'=>'Haekal','role'=>'Pengusaha','text'=>'congue lectus ut, tincidunt est. In laoreet vehicula tincidunt. Curabitur'],
            ['img'=>'orang2.png','name'=>'Aisha','role'=>'Founder','text'=>'congue lectus ut, tincidunt est. In laoreet vehicula tincidunt. Curabitur'],
            ['img'=>'orang3.png','name'=>'Danu','role'=>'UMKM','text'=>'congue lectus ut, tincidunt est. In laoreet vehicula tincidunt. Curabitur'],
            ['img'=>'orang4.png','name'=>'Sinta','role'=>'Marketing','text'=>'congue lectus ut, tincidunt est. In laoreet vehicula tincidunt. Curabitur'],
        ])

        <div class="t-grid">
            @foreach($testi as $i=>$t)
            <figure class="t-card">
                <img src="{{ asset('assets/img/'.$t['img']) }}" alt="Foto {{ $t['name'] }}" loading="lazy">
                <figcaption class="t-overlay">
                    <h3 class="t-name">{{ $t['name'] }}</h3>
                    <div class="t-role">{{ $t['role'] }}</div>
                    <p class="t-quote">{{ $t['text'] }}.</p>
                </figcaption>
            </figure>
            @endforeach
        </div>
    </div>

    <style>
        /* Section wrapper */
        .t-section{background:#eef3f1;padding:28px 12px}
        .t-wrap{max-width:1100px;margin:0 auto}
        .t-wrap h2{color:#074159;text-align:center;font-size:28px;font-weight:800;margin:4px 0 18px}

        /* Grid */
        .t-grid{display:grid;grid-template-columns:repeat(4,1fr)}

        /* Card */
        .t-card{position:relative;overflow:hidden;border-radius:0;background:#fff}
        .t-card img{width:100%;height:auto;display:block;aspect-ratio:4/5;object-fit:cover;transition:transform .35s ease}

        /* Overlay base (hidden for non-default) */
        .t-overlay{position:absolute;inset:0;display:grid;align-content:center;gap:6px;color:#fff;padding:22px;transition:all .35s ease}
        .t-name{font-weight:800;font-size:34px;line-height:1;margin:0}
        .t-role{opacity:.9;margin-bottom:6px}
        .t-quote{font-size:14px;line-height:1.5;max-width:32ch}

        /* Start state: hanya foto (overlay tersembunyi) */
        .t-overlay{opacity:0;background:rgba(0,0,0,0);transform:translateY(8px)}

        /* Hover state (like image 2: full gelap, teks di tengah) */
        .t-card:hover img{transform:scale(1.04)}
        .t-card:hover .t-overlay{opacity:1;background:rgba(0,0,0,.6);justify-items:center;text-align:center;transform:translateY(0)}
        .t-card:hover .t-name{font-size:36px}

        /* Responsive */
        @media (max-width:900px){
            .t-grid{grid-template-columns:1fr 1fr;gap:2px}
            .t-name{font-size:28px}
        }
        @media (max-width:560px){
            .t-grid{grid-template-columns:1fr;gap:2px}
            .t-section{padding:22px 10px}
        }
    </style>
</section>

 <!-- FAQ -->
 @include('sections.faq')

 @include('layouts.footer')

</body>
</html>