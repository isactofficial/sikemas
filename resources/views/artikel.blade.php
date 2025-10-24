<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Artikel & Berita - SIKEMAS</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
	<style>
		:root {
			--skm-teal: #1F6D72;
			--skm-teal-2: #2CBABA;
			--skm-blue: #074159;
			--skm-blue-2: #053244;
			--skm-gray: #425B66;
			--skm-bg: #F4F7F6;
			--skm-accent: #ff5722;
		}

		* { box-sizing: border-box; }
		html, body { margin: 0; padding: 0; font-family: 'Besley', serif; }

		.skm-page { background: var(--skm-bg); min-height: 100vh; }

		/* Hero heading */
	.skm-hero { padding: 34px 16px 16px; background: var(--skm-bg); border: 0; }
		.skm-hero-inner { max-width: 1100px; margin: 0 auto; text-align: center; }
	.skm-title { color: var(--skm-blue); font-size: 38px; font-weight: 800; margin: 16px 0 10px; position: relative; display: inline-block; }
	.skm-title::after { content: ""; display: block; width: 56px; height: 6px; background: var(--skm-accent); border-radius: 4px; margin: 10px auto 0; }
	.skm-sub { color: #6B8791; font-size: 13.5px; margin: 10px 0 0; }

		@media (max-width: 720px) {
			.skm-title { font-size: 30px; }
			.skm-sub { font-size: 13px; }
		}

		/* Filter pills */
	.skm-filters { padding: 16px 16px 6px; background: var(--skm-bg); }
	.skm-filters-inner { max-width: 1100px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
	.skm-group { display: flex; flex-wrap: wrap; gap: 16px; }
	.skm-pill { border: 1.5px solid var(--skm-blue); background: transparent; color: var(--skm-blue); font-weight: 700; padding: 8px 14px; border-radius: 999px; font-size: 13px; cursor: pointer; transition: background-color .15s ease, color .15s ease, border-color .15s ease; }
	.skm-pill:hover { background: var(--skm-accent); border-color: var(--skm-accent); color: #fff; }
	.skm-pill:focus-visible { outline: 2px solid var(--skm-accent); outline-offset: 2px; }
	/* Active state for CATEGORY pills (left group): filled orange like the mock */
	.skm-filters-inner .skm-group:not(.skm-sort) .skm-pill[aria-pressed="true"] {
		background: var(--skm-accent);
		border-color: var(--skm-accent);
		color: #fff;
	}
	/* Sort group active pill orange */
	.skm-sort .skm-pill[aria-pressed="true"] { background: var(--skm-accent); border-color: var(--skm-accent); color: #fff; }
	@media (max-width: 720px) { .skm-filters-inner { flex-direction: column; align-items: flex-start; } }

		/* Grid */
		.skm-wrap { max-width: 1100px; margin: 0 auto; padding: 14px 16px 30px; }
		.skm-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
		@media (max-width: 980px) { .skm-grid { grid-template-columns: repeat(2, 1fr); } }
		@media (max-width: 640px) { .skm-grid { grid-template-columns: 1fr; } }

		/* Card */
		.skm-card { background: #fff; border-radius: 12px; box-shadow: 0 3px 12px rgba(0,0,0,.06); display: flex; flex-direction: column; padding: 16px; }
		/* Inset image inside card padding */
		.skm-thumb { height: 150px; background: #EAF1F3; border-radius: 8px; overflow: hidden; }
			.skm-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
		.skm-card-body { padding: 0; display: flex; flex-direction: column; gap: 10px; }
		.skm-meta { color: #78929C; font-size: 12px; margin-top: 10px; }
			.skm-card h3 { font-size: 18px; color: var(--skm-blue); margin: 2px 0 0; line-height: 1.35; font-weight: 800; }
			.skm-excerpt { color: var(--skm-gray); font-size: 14px; line-height: 1.55; margin: 0; }
		/* CTA with arrow, no bullet */
		.skm-more { margin-top: 6px; color: var(--skm-accent); font-weight: 800; font-size: 14px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
		.skm-more::before { content: none; }
		.skm-more::after { content: '→'; }
		.skm-more:hover { text-decoration: underline; }

		/* Pagination */
		.skm-pager { display: flex; align-items: center; justify-content: center; gap: 16px; margin: 28px 0 14px; }
		.skm-page-btn { position: relative; border: none; background: var(--skm-blue); color: #fff; width: 44px; height: 44px; border-radius: 12px; font-size: 0; cursor: pointer; transition: background-color .15s ease, opacity .15s ease; display: inline-flex; align-items: center; justify-content: center; }
		/* Chevron arrow */
		.skm-page-btn::before { content: ""; display: block; width: 10px; height: 10px; border-top: 3px solid #fff; border-right: 3px solid #fff; }
		.skm-page-btn.is-next::before { transform: rotate(45deg); }
		.skm-page-btn.is-prev::before { transform: rotate(225deg); }
		.skm-page-btn:hover:not([disabled]) { background: var(--skm-blue-2); }
		.skm-page-btn[disabled] { background: #8AA2AD; color: #EAF1F3; cursor: not-allowed; }
		.skm-page-btn[disabled]::before { border-color: #EAF1F3; }
		.skm-page-label { color: #6B8791; font-size: 14px; white-space: nowrap; }
	</style>
</head>
<body class="skm-page">
	@include('layouts.navbar')

	<header class="skm-hero" role="banner">
		<div class="skm-hero-inner">
			<h1 class="skm-title">Artikel &amp; Berita Terbaru</h1>
			<p class="skm-sub">Wawasan terkini dan panduan praktis untuk kemasan yang visioner.</p>
		</div>
	</header>

	<section class="skm-filters" aria-label="Filter & Urutkan Artikel">
		<div class="skm-filters-inner">
			<div class="skm-group" id="filterPills"><!-- Filter pills rendered by JS --></div>
			<div class="skm-group skm-sort" id="sortPills"><!-- Sort pills rendered by JS --></div>
		</div>
	</section>

	<main class="skm-wrap" id="articlesApp">
		<div class="skm-grid" id="articlesGrid" aria-live="polite" aria-busy="false">
			<!-- Cards rendered by JS -->
		</div>

		<nav class="skm-pager" aria-label="Navigasi halaman">
			<button id="prevBtn" class="skm-page-btn is-prev" type="button" aria-label="Halaman sebelumnya"></button>
			<span id="pageLabel" class="skm-page-label" aria-live="polite"></span>
			<button id="nextBtn" class="skm-page-btn is-next" type="button" aria-label="Halaman berikutnya"></button>
		</nav>
	</main>

	@include('layouts.footer')

	<script>
		// Base URL untuk halaman detail artikel
		const DETAIL_BASE = "{{ url('/artikel') }}";
		// Dataset dummy
		const ARTICLES = [
			{ id: 1,  title: 'Trend Kemasan Ramah Lingkungan', cat: ['Keberlanjutan'], date: '10 Juli 2024', ts: 1750012800000, pop: 78, img: '{{ asset('assets/img/Rectangle12.png') }}', excerpt: 'Membahas inovasi terbaru dalam industri kemasan karton yang berkelanjutan dan ramah lingkungan.' },
			{ id: 2,  title: 'Pentingnya Kemasan yang Tepat', cat: ['Bisnis'], date: '08 Juli 2024', ts: 1749753600000, pop: 65, img: '{{ asset('assets/img/Pentingnya_Kemasan_yang_Tepat.png') }}', excerpt: 'Bagaimana kemasan yang kuat dan menarik dapat meningkatkan nilai jual produk Anda.' },
			{ id: 3,  title: 'Proses Produksi Kami', cat: ['Teknologi'], date: '05 Juli 2024', ts: 1749408000000, pop: 90, img: '{{ asset('assets/img/Proses_Produksi_Kami.png') }}', excerpt: 'Mengintip proses di balik produksi kemasan karton berkualitas tinggi di pabrik Sikemas.' },
			{ id: 4,  title: 'Inovasi Material Karton Terbaru', cat: ['Teknologi'], date: '02 Juli 2024', ts: 1749148800000, pop: 50, img: '{{ asset('assets/img/karton_banyak.png') }}', excerpt: 'Memperkenalkan material karton inovatif yang lebih kuat dan ringan untuk efisiensi pengiriman.' },
			{ id: 5,  title: 'Strategi Branding dengan Kemasan', cat: ['Desain'], date: '30 Juni 2024', ts: 1748976000000, pop: 84, img: '{{ asset('assets/img/Strategi_Branding_dengan_Kemasan.png') }}', excerpt: 'Pelajari cara memanfaatkan kemasan sebagai alat pemasaran yang efektif untuk brand Anda.' },
			{ id: 6,  title: 'Kemasan Tahan Air untuk Produk Makanan', cat: ['Bisnis'], date: '28 Juni 2024', ts: 1748803200000, pop: 73, img: '{{ asset('assets/img/kardus2.png') }}', excerpt: 'Solusi kemasan tahan air yang menjaga produk makanan tetap segar dan aman selama distribusi.' },
			{ id: 7,  title: 'Teknik Cetak pada Karton', cat: ['Teknologi','Desain'], date: '25 Sep 2025', ts: 1748544000000, pop: 92, img: '{{ asset('assets/img/Article-image.png') }}', excerpt: 'Perbandingan flexo vs offset untuk kemasan.' },
			{ id: 8,  title: 'Menghitung Ukuran Kotak dengan Tepat', cat: ['Bisnis'], date: '22 Sep 2025', ts: 1748284800000, pop: 60, img: '{{ asset('assets/img/Article-image.png') }}', excerpt: 'Cara menentukan dimensi agar efisien dan aman.' },
			{ id: 9,  title: 'Karton Gelombang: Tipe & Kegunaan', cat: ['Teknologi'], date: '20 Sep 2025', ts: 1748112000000, pop: 58, img: '{{ asset('assets/img/Article-image.png') }}', excerpt: 'B-, C-, dan E-flute: mana yang cocok untuk Anda?' },
			{ id: 10, title: 'Desain Ramah Daur Ulang', cat: ['Keberlanjutan','Desain'], date: '18 Sep 2025', ts: 1747939200000, pop: 88, img: '{{ asset('assets/img/Article-image.png') }}', excerpt: 'Desain yang mempermudah proses daur ulang.' },
			{ id: 11, title: 'Optimasi Packing untuk Ekspedisi', cat: ['Bisnis'], date: '15 Sep 2025', ts: 1747680000000, pop: 55, img: '{{ asset('assets/img/Article-image.png') }}', excerpt: 'Mengurangi kerusakan saat pengiriman massal.' },
			{ id: 12, title: 'Kontrol Kualitas Produksi', cat: ['Teknologi'], date: '12 Sep 2025', ts: 1747420800000, pop: 70, img: '{{ asset('assets/img/Article-image.png') }}', excerpt: 'Tahapan QC untuk menjaga standar kemasan.' },
		];

		const CATEGORIES = ['Semua', 'Keberlanjutan', 'Desain', 'Teknologi', 'Bisnis'];

		const state = {
			page: 1,
			perPage: 6,
			filter: 'Semua',
			sort: 'Terbaru', // or 'Terpopuler'
			get filtered() {
				if (this.filter === 'Semua') return ARTICLES;
				return ARTICLES.filter(a => a.cat.includes(this.filter));
			},
			get ordered() {
				const arr = [...this.filtered];
				if (this.sort === 'Terpopuler') {
					arr.sort((a,b) => b.pop - a.pop);
				} else {
					arr.sort((a,b) => b.ts - a.ts);
				}
				return arr;
			},
			get pages() { return Math.max(1, Math.ceil(this.ordered.length / this.perPage)); },
			get slice() {
				const start = (this.page - 1) * this.perPage;
				return this.ordered.slice(start, start + this.perPage);
			}
		};

		const grid = document.getElementById('articlesGrid');
		const pageLabel = document.getElementById('pageLabel');
		const prevBtn = document.getElementById('prevBtn');
		const nextBtn = document.getElementById('nextBtn');
		const pills = document.getElementById('filterPills');
		const sortPills = document.getElementById('sortPills');

		function renderPills() {
			pills.innerHTML = '';
			CATEGORIES.forEach(cat => {
				const b = document.createElement('button');
				b.className = 'skm-pill';
				b.type = 'button';
				b.textContent = cat;
				b.setAttribute('data-filter', cat);
				b.setAttribute('aria-pressed', String(state.filter === cat));
				b.addEventListener('click', () => {
					state.filter = cat;
					state.page = 1;
					renderAll();
				});
				pills.appendChild(b);
			});
		}

		function renderSort() {
			sortPills.innerHTML = '';
			['Terbaru','Terpopuler'].forEach(opt => {
				const s = document.createElement('button');
				s.className = 'skm-pill';
				s.type = 'button';
				s.textContent = opt;
				s.setAttribute('data-sort', opt);
				s.setAttribute('aria-pressed', String(state.sort === opt));
				s.addEventListener('click', () => {
					state.sort = opt;
					state.page = 1;
					renderAll();
				});
				sortPills.appendChild(s);
			});
		}

		function cardTpl(a) {
			return `
				<article class="skm-card" data-id="${a.id}">
					<div class="skm-card-body">
						<div class="skm-thumb"><img src="${a.img}" alt="${a.title}"></div>
						<div class="skm-meta"><span>${a.date}</span></div>
						<h3>${a.title}</h3>
						<p class="skm-excerpt">${a.excerpt}</p>
						<a class="skm-more" href="${DETAIL_BASE}/${a.id}" aria-label="Baca selengkapnya ${a.title}">Baca Selengkapnya</a>
					</div>
				</article>
			`;
		}

		function renderGrid() {
			grid.setAttribute('aria-busy', 'true');
			const cards = state.slice.map(cardTpl).join('');
			grid.innerHTML = cards || `<div style="grid-column: 1 / -1; text-align:center; color:#6B8791; padding: 30px 0;">Tidak ada artikel pada kategori ini.</div>`;
			grid.setAttribute('aria-busy', 'false');
		}

		function renderPager() {
			// Prev/Next enablement
			prevBtn.disabled = state.page <= 1;
			nextBtn.disabled = state.page >= state.pages;
			// Center label "Halaman X dari Y"
			pageLabel.textContent = `Halaman ${state.page} dari ${state.pages}`;
		}

		function updatePillStates() {
			[...pills.querySelectorAll('.skm-pill')].forEach(el => {
				el.setAttribute('aria-pressed', String(el.dataset.filter === state.filter));
			});
			[...sortPills.querySelectorAll('.skm-pill')].forEach(el => {
				el.setAttribute('aria-pressed', String(el.dataset.sort === state.sort));
			});
		}

		function renderAll(resetPills = true) {
			renderGrid();
			renderPager();
			if (resetPills) updatePillStates();
		}

		prevBtn.addEventListener('click', () => { if (state.page > 1) { state.page--; renderAll(false); } });
		nextBtn.addEventListener('click', () => { if (state.page < state.pages) { state.page++; renderAll(false); } });

		// Init
		renderPills();
		renderSort();
		renderAll();
	</script>
</body>
</html>
