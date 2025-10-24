<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Detail Artikel - Sikemas</title>
	<style>
		:root {
			--skm-blue: #0E4B63;
			--skm-blue-2: #0B3D52;
			--skm-accent: #F28C28;
			--skm-gray: #475B63;
			--skm-bg: #F6FAFB;
		}
		body.skm-page { margin: 0; font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans", sans-serif; color: #0F2A34; background: #fff; }
		/* Top area should be white (not gray) and seamless (no bottom border) */
		.skm-hero { background: #ffffff; padding: 38px 16px; border-bottom: none; }
		.skm-hero-inner { max-width: 900px; margin: 0 auto; }
		/* Breadcrumb hidden as requested */
		.skm-breadcrumb { display: none; gap: 10px; color: #6B8791; font-size: 13px; align-items: center; }
		.skm-breadcrumb a { color: #6B8791; text-decoration: none; }
		.skm-breadcrumb a:hover { text-decoration: underline; }
		/* Topline (pills left, date/views right) */
		.skm-topline { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-top: 8px; }
		.skm-pills { display: flex; gap: 10px; flex-wrap: wrap; }
		.skm-info { color: #6B8791; font-size: 13.5px; display: flex; align-items: center; gap: 18px; flex-wrap: wrap; }
		.skm-info .item { display: inline-flex; align-items: center; gap: 8px; }

		/* Fluid, readable title size */
		.skm-title { margin: 8px 0 6px; font-size: clamp(28px, 4.2vw, 40px); line-height: 1.2; color: var(--skm-blue); font-weight: 800; }
		.skm-author { color: #6B8791; font-size: 14px; margin: 0; }
		.skm-author a { color: var(--skm-blue); font-weight: 700; text-decoration: none; }
		.skm-author a:hover { text-decoration: underline; }
		/* Author name styled like link color but without being a link */
		.skm-author .skm-author-name { color: var(--skm-blue); font-weight: 700; }
		
		/* Thicker divider per mock */
		.skm-divider { height: 3px; background: #0B3D52; margin-top: 14px; border-radius: 2px; }

		/* Chips */
		.skm-chip { display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 999px; font-weight: 900; font-size: 11.5px; letter-spacing: .3px; text-transform: uppercase; line-height: 1; }

		/* Solid fill like mock */
		.skm-chip.is-published { background: #20C8B5; color: #fff; border: 1px solid #20C8B5; }
		.skm-chip.is-category { background: #F28C28; color: #fff; border: 1px solid #F28C28; }

		/* Layout */
		.skm-wrap { max-width: 900px; margin: 0 auto; padding: 26px 16px 40px; }
		/* Reset default figure margins so the image aligns flush to the left */
		.skm-cover { width: 100%; margin: 0; border-radius: 12px; overflow: hidden; border: 1px solid #E3EEF1; background: #EAF1F3; }
		.skm-cover img { width: 100%; height: auto; display: block; object-fit: cover; aspect-ratio: 16 / 9; }

		/* Comfortable reading size and line length */
		.skm-content { margin-top: 22px; color: var(--skm-gray); line-height: 1.8; font-size: clamp(15px, 1.7vw, 16.5px); }
		/* Section heading styled like the mock: left accent bar + bold teal title */
		.skm-content h2 { 
			color: var(--skm-blue); 
			margin: 26px 0 10px; 
			font-size: clamp(20px, 2.6vw, 24px); 
			font-weight: 800;
			display: inline-flex; 
			align-items: center; 
			gap: 12px; 
		}
		.skm-content h2::before {
			content: "";
			display: inline-block;
			width: 4px; 
			height: 28px; 
			background: var(--skm-accent); 
			border-radius: 2px;
		}
		.skm-content p { margin: 0 0 14px; }
		.skm-content ol { padding-left: 18px; }
		.skm-content li { margin: 8px 0; }

		/* Comments styled like mock */
		.skm-comments { margin-top: 28px; border-top: 1px solid #E3EEF1; padding-top: 18px; }
		.skm-comments h3 { font-size: 18px; margin: 0 0 14px; color: var(--skm-blue); font-weight: 800; }
		.skm-login-banner {
			background: #F3F8F7; /* slightly greenish light bg */
			border: 1px solid #E6F0EE;
			padding: 12px 16px;
			border-radius: 8px;
			text-align: center;
			color: #6B8791;
			font-size: 14px;
		}
		.skm-login-banner .skm-login-link { color: var(--skm-accent); font-weight: 800; text-decoration: none; }
		.skm-login-banner .skm-login-link:hover { text-decoration: underline; }
		.skm-comments .empty-note { margin-top: 10px; color: #6B8791; font-size: 12.5px; font-style: italic; text-align: center; }

		@media (max-width: 640px) {
			/* With fluid sizes above, only tweak accent height on small screens */
			.skm-content h2::before { height: 24px; }
		}
	</style>
</head>
<body class="skm-page">
	@include('layouts.navbar')

	<header class="skm-hero" role="banner">
		<div class="skm-hero-inner">
			<nav aria-label="Breadcrumb" class="skm-breadcrumb">
				<a href="{{ route('beranda') }}">Beranda</a>
				<span aria-hidden="true">›</span>
				<a href="{{ route('artikel') }}">Artikel</a>
				<span aria-hidden="true">›</span>
				<span aria-current="page">Detail</span>
			</nav>
			<div class="skm-topline">
				<div class="skm-pills">
					<span class="skm-chip is-published">PUBLISHED</span>
					<span class="skm-chip is-category">KEBERLANJUTAN</span>
				</div>
				<div class="skm-info">
					<span class="item" title="Tanggal publikasi">
						<svg aria-hidden="true" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 2v3M17 2v3M3 9h18M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z" stroke="#6B8791" stroke-width="2" stroke-linecap="round"/></svg>
						<span>10 Juli 2024</span>
					</span>
					<span class="item" title="Jumlah dilihat">
						<svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z" stroke="#6B8791" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="#6B8791" stroke-width="2"/></svg>
						<span>Dilihat 1200</span>
					</span>
				</div>
			</div>

			<h1 class="skm-title">5 Tren Desain Kemasan Ramah Lingkungan 2024</h1>
			<p class="skm-author">Ditulis oleh <span class="skm-author-name">Admin Sikemas</span></p>
			<div class="skm-divider" role="presentation"></div>
		</div>
	</header>

	<main class="skm-wrap">
		<figure class="skm-cover">
			<img src="{{ asset('assets/img/Rectangle12.png') }}" alt="Gambar artikel: Tren kemasan ramah lingkungan" />
		</figure>

		<article class="skm-content">
			<p>
				Dalam industri yang terus berkembang pesat, desain kemasan tidak lagi sekadar tentang estetika, melainkan juga tentang
				fungsionalitas dan tanggung jawab terhadap lingkungan. Tren kemasan ramah lingkungan semakin menjadi sorotan utama bagi
				brand yang ingin menonjolkan citra positif di mata konsumen.
			</p>

			<p>
				Pada tahun 2024, lima tren utama mendefinisikan arah inovasi dalam kemasan berkelanjutan. Tren ini bukan hanya mencakup 
				penggunaan material yang dapat didaur ulang, tetapi juga metode produksi yang efisien dan desain yang minimalis namun tetap
				fungsional.
			</p>

			<h2>1. Material Berbasis Nabati</h2>
			<p>Kemasan yang terbuat dari bahan nabati seperti pati jagung, ampas tebu, atau bambu semakin populer. Bahan-bahan ini menawarkan alternatif yang kokoh dan dapat terurai secara hayati (biodegradable), mengurangi ketergantungan pada plastik konvensional.</p>

			<h2>2. Desain Minimalis dan Fungsional</h2>
			<p>Desain yang ringkas dan tanpa elemen berlebihan tidak hanya terlihat elegan, tetapi juga mengurangi jumlah material yang digunakan. Fungsionalitas tetap menjadi prioritas, dengan fitur-fitur seperti penutup yang mudah dibuka dan dapat disegel kembali.</p>

			<h2>3. Tinta Ramah Lingkungan</h2>
			<p>Penggunaan tinta berbahan dasar kedelai atau air menggantikan tinta berbahan kimia beracun. Hal ini tidak hanya mengurangi polusi, tetapi juga mempermudah proses daur ulang kemasan.</p>

			<h2>4. Kemasan Dapat Digunakan Kembali</h2>
			<p>Inovasi dalam kemasan yang dapat digunakan kembali, seperti botol kaca atau wadah logam, mendorong konsumen untuk mengadopsi gaya hidup yang lebih berkelanjutan dan mengurangi limbah sekali pakai.</p>

			<h2>5. Transparansi Rantai Pasok</h2>
			<p>Konsumen modern semakin peduli terhadap asal-usul produk. Merek yang secara transparan mencantumkan informasi tentang material, sumber, dan proses daur ulang pada kemasan mereka akan mendapatkan kepercayaan yang lebih besar.</p>

			<p>Dengan mengadopsi tren-tren ini, bisnis tidak hanya dapat mengurangi jejak karbon, tetapi juga membangun hubungan yang lebih kuat dan positif dengan konsumen yang sadar lingkungan.</p>
		</article>

		<section class="skm-comments" aria-labelledby="komentarHeading">
			<h3 id="komentarHeading">Komentar (0)</h3>
			<div class="skm-login-banner" role="note">
				<strong><a class="skm-login-link" href="{{ url('/login') }}">Silakan login</a></strong>
				untuk memberikan komentar.
			</div>
			<p class="empty-note">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
		</section>
	</main>

	@include('layouts.footer')
</body>
</html>
