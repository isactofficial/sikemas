<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Produk - SIKEMAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
    /* --- Root Variables & Basic Setup --- */
    :root {
        --skm-teal: #1F6D72;
        --skm-teal-2: #2CBABA;
        --skm-blue: #074159;
        --skm-blue-2: #053244;
        --skm-gray: #425B66;
        --skm-bg: #F4F7F6;
        --skm-accent: #ff5722;
        /* Oranye dari desain */
        --skm-white: #FFFFFF;
        --skm-new-teal-1: #0E6371;
        --skm-new-teal-2: #1588;
    }

    * {
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Besley', serif;
        background-color: #FFFFFF;
    }

    main {
        position: relative;
        z-index: 1;
    }

    /* --- Styling Produk Unggulan --- */
    .produk-unggulan {
        width: 100%;
        background: linear-gradient(to bottom,
                var(--skm-blue) 0%,
                var(--skm-blue) 37%,
                var(--skm-new-teal-1) 56%,
                var(--skm-new-teal-2) 70%,
                var(--skm-teal-2) 83%,
                var(--skm-bg) 93%,
                var(--skm-white) 100%);

        padding-bottom: 50px;
    }

    .header-produk {
        padding: 50px 20px 30px 20px;
        text-align: center;
    }

    .header-produk h2 {
        font-size: 2.8rem;
        color: #FFFFFF;
        margin: 0;
        position: relative;
        display: inline-block;
        font-weight: 600;
    }

    .header-produk h2::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 5px;
        background-color: var(--skm-accent);
    }

    .carousel-container {
        width: 100%;
        overflow: hidden;
        padding: 20px 0 40px 0;
        background-color: transparent;
        white-space: nowrap;
        position: relative;
    }

    .carousel-container:hover .carousel-track {
        animation-play-state: paused;
    }

    .carousel-track {
        display: inline-block;
        animation: scroll 60s linear infinite;
    }

    .carousel-slide {
        display: inline-block;
        width: 300px;
        margin: 0 15px;
        background: #FFFFFF;
        border-radius: 15px;
        padding: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #eee;
    }

    .carousel-slide img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        display: block;
        border-radius: 10px;
    }

    /* Animasi scrolling */
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-1980px);
        }
    }

    /* --- STYLING Lihat Produk Kami --- */

    .lihat-produk {
        width: 100%;
        padding: 60px 20px 20px 20px;
        background-color: var(--skm-bg);
    }

    .header-produk-grid {
        text-align: center;
        margin-bottom: 40px;
    }

    .header-produk-grid h2 {
        font-size: 2.8rem;
        color: var(--skm-blue);
        margin: 0;
        position: relative;
        display: inline-block;
        font-weight: 600;
    }

    .header-produk-grid h2::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 5px;
        background-color: var(--skm-accent);

    }

    .filter-produk {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .filter-btn {
        font-family: 'Besley', serif;
        font-size: 1rem;
        font-weight: 500;
        padding: 10px 25px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: var(--skm-white);
        color: var(--skm-gray);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-btn:hover {
        background-color: #f9f9f9;
        border-color: #ccc;
    }

    .filter-btn.active {
        background-color: var(--skm-accent);
        color: var(--skm-white);
        border-color: var(--skm-accent);
    }

    .grid-produk {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        max-width: 1100px;
        margin: 0 auto;
    }

    .card-produk {
        background: #FFFFFF;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #eee;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;

        /* === PERBAIKAN (BAGIAN 1) === */
        /* Menggunakan Flexbox untuk tata letak kolom */
        display: flex;
        flex-direction: column;
        height: 100%; /* Memastikan semua card sama tinggi (didukung oleh grid) */
    }

    .card-produk:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .card-produk.hidden {
        display: none;
    }

    .card-produk img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        display: block;
    }

    .card-produk-content {
    padding: 20px;
    text-align: center;

    /* === PERBAIKAN (BAGIAN 2) === */
    /* Membuat area konten ini mengisi sisa ruang */
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    min-height: 0; /* Penting untuk flexbox */
}

.card-produk-content h3 {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--skm-new-teal-1);
    margin: 0 0 10px 0;
    flex-shrink: 0; /* Judul tidak boleh menyusut */
}

.card-produk-content .deskripsi {
    font-size: 0.95rem;
    color: var(--skm-gray);
    line-height: 1.5;
    margin: 0 0 auto 0; /* margin-bottom: auto mendorong elemen di bawahnya */
    flex-grow: 0; /* Tidak perlu flex-grow */
    flex-shrink: 0; /* Deskripsi tidak boleh menyusut */
}

.card-produk-content .harga {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--skm-accent);
    margin: 15px 0 15px 0; /* Margin konsisten */
    flex-shrink: 0; /* Harga tidak boleh menyusut */
}

.btn-keranjang {
    display: block;
    width: 100%;
    padding: 12px;
    background-color: var(--skm-blue);
    color: var(--skm-white);
    border: none;
    border-radius: 8px;
    font-family: 'Besley', serif;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-align: center;
    flex-shrink: 0; /* Tombol tidak boleh menyusut */
    margin-top: 0; /* Tidak perlu margin-top karena harga sudah punya margin */
}


    .btn-keranjang:hover {
        background-color: var(--skm-blue-2);
    }

    .btn-keranjang i {
        margin-right: 8px;
    }

    /* Tombol Lihat Semua Produk */
    .btn-show-all {
        background: var(--skm-accent);
        color: #fff;
        border: none;
        padding: 14px 40px;
        border-radius: 999px;
        font-size: 16px;
        font-weight: 700;
        font-family: 'Besley', serif;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
    }
    .btn-show-all:hover {
        background: #e64a19;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(255, 87, 34, 0.4);
    }
    .btn-show-all:active {
        transform: translateY(0);
    }

    /* --- Responsive Grid --- */
    @media (max-width: 992px) {
        .grid-produk {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .grid-produk {
            grid-template-columns: 1fr;
        }

        .header-produk h2,
        .header-produk-grid h2 {
            font-size: 2.2rem;
        }

        .filter-produk {
            gap: 10px;
        }

        .filter-btn {
            font-size: 0.9rem;
            padding: 8px 15px;
        }
    }

    /* --- STYLING DETAIL PRODUK --- */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.3s ease, visibility 0s 0.3s;
    }

    .modal-detail {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.95);
        background: var(--skm-white);
        border-radius: 15px;
        z-index: 1001;
        max-width: 900px;
        width: 90%;
        max-height: 620px;
        overflow-y: auto;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease, visibility 0s 0.3s;
    }

    .modal-overlay.active,
    .modal-detail.active {
        visibility: visible;
        opacity: 1;
        transition-delay: 0s;
    }

    .modal-detail.active {
        transform: translate(-50%, -50%) scale(1);
    }

    .modal-close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        font-size: 2rem;
        color: var(--skm-gray);
        cursor: pointer;
        line-height: 1;
        padding: 0;
        z-index: 10;
    }

    .modal-close-btn:hover {
        color: #000;
    }

    .modal-content {
        display: flex;
        padding: 20px 25px;
        gap: 30px;
    }

    .modal-left { flex-basis: 40%; }
    .modal-right { flex-basis: 60%; }

    #modal-img-main {
        width: 100%;
        border-radius: 10px;
        border: 1px solid #eee;
        height: 320px;
        object-fit: contain;
        background-color: #f8f8f8;
    }

    .modal-thumbnails {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        justify-content: center;
    }

    .modal-thumbnails img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 5px;
        cursor: pointer;
        border: 2px solid #ddd;
        transition: border-color 0.2s;
    }

    .modal-thumbnails img:hover { border-color: #aaa; }
    .modal-thumbnails img.active { border-color: var(--skm-accent); }

    .modal-right h2 {
        font-size: 1.6rem;
        color: var(--skm-new-teal-1);
        margin: 0 0 5px;
        line-height: 1.2;
    }

    .modal-right #modal-deskripsi {
        font-size: 0.85rem;
        color: var(--skm-gray);
        line-height: 1.5;
        margin-bottom: 8px;
    }

    .modal-right #modal-harga {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--skm-accent);
        margin: 0 0 10px 0;
    }

    .modal-spek h3 {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--skm-blue);
        margin-bottom: 8px;
        border-bottom: 2px solid #eee;
        padding-bottom: 5px;
    }

    .modal-spek table {
        width: 100%;
        font-size: 0.9rem;
        border-collapse: collapse;
    }

    .modal-spek td {
        padding: 4px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .modal-spek td:first-child {
        font-weight: 600;
        color: #333;
        width: 110px;
    }

    .modal-spek td:last-child { color: var(--skm-gray); }

    .modal-spek .modal-form-group.quantity-group {
        justify-content: flex-start;
        padding: 4px 0;
        border-bottom: 1px solid #f0f0f0;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .modal-spek .modal-form-group.quantity-group label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #333;
        width: 110px;
        flex-shrink: 0;
    }

    .modal-form-group {
        margin-top: 10px;
    }

    .modal-form-group.quantity-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 15px;
    }

    .modal-form-group.quantity-group label {
        margin-bottom: 0;
    }

    .modal-form-group label {
        display: block;
        font-size: 1.0rem;
        font-weight: 700;
        color: var(--skm-blue);
        margin-bottom: 8px;
    }

    .quantity-input { display: flex; align-items: center; }

    .quantity-btn {
        width: 35px; height: 35px;
        background: var(--skm-blue);
        border: 1px solid var(--skm-blue);
        font-size: 1.2rem;
        cursor: pointer;
        font-weight: bold;
        line-height: 1.2rem;
        color: var(--skm-white);
    }

    .quantity-btn:hover {
        background: var(--skm-blue-2);
        border-color: var(--skm-blue-2);
    }

    #modal-qty {
        width: 50px; height: 35px;
        text-align: center;
        border: 1px solid var(--skm-blue);
        border-left: none; border-right: none;
        font-size: 0.95rem;
        font-family: 'Besley', serif;
        -moz-appearance: textfield;
        color: var(--skm-blue);
        font-weight: 600;
    }

    #modal-qty::-webkit-outer-spin-button,
    #modal-qty::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }

    .quantity-btn#qty-minus {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .quantity-btn#qty-plus {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .radio-group { display: flex; gap: 15px; }
    .radio-group label {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--skm-gray);
        cursor: pointer;
    }
    .radio-group input { margin-right: 5px; }

    .upload-group {
        margin-top: 15px;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
    }

    .upload-container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 8px;
    }

    .btn-upload {
        padding: 8px 16px;
        background-color: var(--skm-teal);
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-upload:hover {
        background-color: var(--skm-teal-dark);
    }

    .file-name {
        font-size: 0.85rem;
        color: #666;
        font-style: italic;
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .btn-modal {
        flex: 1;
        padding: 10px 15px;
        font-family: 'Besley', serif;
        font-size: 0.9rem;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .btn-modal i {
        margin-right: 6px;
    }

    .btn-modal-primary {
        background-color: var(--skm-accent);
        color: var(--skm-white);
    }

    .btn-modal-primary:hover { background-color: #e64a19; }

    .btn-modal-secondary {
        background-color: var(--skm-accent);
        color: var(--skm-white);
    }

    .btn-modal-secondary:hover { background-color: #e64a19; }


    /* Responsive for popup */
    @media (max-width: 768px) {
        .modal-content {
            flex-direction: column;
            padding: 40px 25px 25px 25px;
        }
        .modal-left, .modal-right { flex-basis: 100%; }
        #modal-img-main { height: 250px; }
        .modal-right h2 { font-size: 1.8rem; }
        .modal-actions { flex-direction: column; }
    }

    /* Fix Hamburger Menu Position for Mobile */
    @media (max-width: 768px) {
        nav {
            padding: 0.75rem 1rem !important;
        }

        nav .container,
        nav > div {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            width: 100% !important;
        }

        nav .logo,
        nav a:first-child {
            order: 1 !important;
            margin-right: auto !important;
        }

        nav .hamburger,
        nav .menu-toggle,
        nav button[class*="hamburger"],
        nav button[class*="menu"],
        nav .fa-bars {
            order: 3 !important;
            margin-left: auto !important;
        }

        nav ul,
        nav .nav-links {
            order: 2 !important;
        }
    }

</style>
</head>

<body>

    @include('layouts.navbar')

    <main>
        <section class="produk-unggulan">

            <div class="header-produk">
                <h2>Produk Unggulan</h2>
            </div>

            <div class="carousel-container">
                <div class="carousel-track">

                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/Product1.png') }}" alt="Produk Box Karton">
                    </div>
                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/Product2.png') }}" alt="Produk Corrugated Sheet">
                    </div>
                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/Product3.png') }}" alt="Produk Box Polos">
                    </div>
                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/Product4.png') }}" alt="Produk Partisi Karton">
                    </div>
                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/Product5.png') }}" alt="Tumpukan Corrugated Sheet">
                    </div>
                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/Product6.png') }}" alt="Limbah Karton">
                    </div>

                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/Product1.png') }}" alt="Produk Box Karton">
                    </div>
                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/Product2.png') }}" alt="Produk Corrugated Sheet">
                    </div>
                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/Product3.png') }}" alt="Produk Box Polos">
                    </div>
                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/Product4.png') }}" alt="Produk Partisi Karton">
                    </div>
                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/Product5.png') }}" alt="Tumpukan Corrugated Sheet">
                    </div>
                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/Product6.png') }}" alt="Limbah Karton">
                    </div>
                </div>
            </div>
        </section>

        <section class="lihat-produk">
            <div class="header-produk-grid">
                <h2>Lihat Produk Kami</h2>
            </div>

            <div class="filter-produk">
                <button class="filter-btn active" data-filter="semua">Semua</button>
                <button class="filter-btn" data-filter="karton">Karton</button>
                <button class="filter-btn" data-filter="plastik">Plastik</button>
                <button class="filter-btn" data-filter="kertas">Kertas</button>
                <button class="filter-btn" data-filter="aluminium">Aluminium</button>
                <button class="filter-btn" data-filter="lainnya">Lainnya</button>
            </div>

            <div class="grid-produk">
                @if(isset($products) && $products->count())
                    @foreach($products as $product)
                        <div class="card-produk" data-kategori="{{ strtolower($product->category ?? 'lainnya') }}"
                            data-title="{{ $product->name }}"
                            data-img="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/Article-image.png') }}"
                            data-deskripsi="{{ $product->description ?? 'Produk berkualitas dari Sikemas' }}"
                            data-harga="Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}"
                            data-price="{{ $product->price ?? 0 }}"
                            data-material="{{ $product->category ?? 'Standard' }}"
                            data-size="Standard"
                            data-thumb1="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/Article-image.png') }}"
                            data-thumb2="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/Article-image.png') }}"
                            data-thumb3="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/Article-image.png') }}"
                            data-spek-lebar="Standard"
                            data-spek-tinggi="Standard"
                            data-spek-panjang="Standard"
                            data-spek-bahan="{{ $product->category ?? 'Standard' }}"
                            data-spek-kapasitas="Standard"
                        >
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/Article-image.png') }}" alt="{{ $product->name }}">
                            <div class="card-produk-content">
                                <h3>{{ strtoupper($product->name) }}</h3>
                                <p class="deskripsi">{{ Str::limit($product->description ?? 'Produk berkualitas dari Sikemas', 80) }}</p>
                                <p class="harga">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                                <button class="btn-keranjang"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #6B8791;">
                        Belum ada produk tersedia
                    </div>
                @endif
            </div>
        </section>


        <div class="modal-overlay" id="modal-overlay"></div>
        <div class="modal-detail" id="modal-detail">
            <button class="modal-close-btn" id="modal-close-btn">&times;</button>
            <div class="modal-content">
                <div class="modal-left">
                    <img src="" alt="Produk" id="modal-img-main">
                    <div class="modal-thumbnails" id="modal-thumbnails">
                        </div>
                </div>
                <div class="modal-right">
                    <h2 id="modal-title">Nama Produk</h2>
                    <p id="modal-deskripsi">Deskripsi produk akan muncul di sini.</p>
                    <p id="modal-harga">Rp 0 / pcs</p>

                    <div class="modal-spek">
                        <h3>Spesifikasi Produk</h3>
                        <table>
                            <tbody id="modal-spek-tbody">
                                </tbody>
                        </table>

                        <div class="modal-form-group quantity-group">
                            <label for="modal-qty">Jumlah</label>
                            <div class="quantity-input">
                                <button class="quantity-btn" id="qty-minus">-</button>
                                <input type="number" id="modal-qty" value="1" min="1">
                                <button class="quantity-btn" id="qty-plus">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-group radio-group-container">
                        <label>Punya desain sendiri?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="custom_design" value="ya" id="radio-ya"> Ya</label>
                            <label><input type="radio" name="custom_design" value="tidak" id="radio-tidak" checked> Tidak</label>
                        </div>
                    </div>

                    <div class="modal-form-group upload-group" id="upload-group" style="display: none;">
                        <label for="custom-design-file">Upload File Desain</label>
                        <div class="upload-container">
                            <input type="file" id="custom-design-file" name="custom_design_file" accept=".jpg,.jpeg,.png,.pdf,.ai,.psd" style="display: none;">
                            <button type="button" class="btn-upload" id="btn-upload">
                                <i class="fas fa-cloud-upload-alt"></i> Pilih File
                            </button>
                            <span class="file-name" id="file-name">Belum ada file dipilih</span>
                        </div>
                        <small style="color: #666; font-size: 0.85rem; display: block; margin-top: 0.5rem;">
                            Format: JPG, PNG, PDF, AI, PSD (Max: 10MB)
                        </small>
                    </div>

                    <div class="modal-actions">
                        <button class="btn-modal btn-modal-primary" id="modal-add-to-cart"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
                        <button class="btn-modal btn-modal-secondary" id="btn-customize-design"><i class="fas fa-pen"></i> Sesuaikan Desain</button>
                    </div>
                </div>
            </div>
        </div>
        @include('sections.faq')
    </main>

    @include('layouts.footer')

    

    <script>
    // ═══════════════════════════════════════════════════════════
    // FUNGSI HELPER (didefinisikan di luar agar bisa diakses)
    // ═══════════════════════════════════════════════════════════
    
    // Ambil CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    
    /**
     * Helper untuk menangani response fetch
     */
    async function handleResponse(response) {
        if (response.status === 401 || response.status === 419) {
            let err = new Error('Sesi Anda telah berakhir. Silakan login kembali.');
            err.status = response.status;
            throw err;
        }

        const data = await response.json();
        if (!response.ok) {
            let message = data.message || 'Terjadi kesalahan.';
            if (data.errors) {
                message = Object.values(data.errors).flat().join('\n');
            }
            let err = new Error(message);
            err.status = response.status;
            err.data = data;
            throw err;
        }
        return data;
    }

    /**
     * Fungsi untuk menambah item ke keranjang (via JSON)
     * Digunakan untuk "Quick Add" dari kartu produk
     */
    function addToCart(productData, buttonElement) {
        @guest
            // Guest: simpan ke localStorage lalu arahkan ke halaman cart
            try {
                const key = 'skm_guest_cart';
                const items = JSON.parse(localStorage.getItem(key) || '[]');
                const idx = items.findIndex(it => (
                    String(it.product_name||'').toLowerCase() === String(productData.product_name||'').toLowerCase() &&
                    String(it.material||'') === String(productData.material||'') &&
                    String(it.size||'') === String(productData.size||'') &&
                    String(it.design||'') === String(productData.design||'') &&
                    Boolean(it.has_custom_design||false) === Boolean(Number(productData.has_custom_design||0))
                ));
                if (idx >= 0) {
                    items[idx].quantity = (parseInt(items[idx].quantity)||0) + (parseInt(productData.quantity)||1);
                } else {
                    items.push({
                        product_name: productData.product_name,
                        material: productData.material||null,
                        size: productData.size||null,
                        design: productData.design||'Standard',
                        quantity: parseInt(productData.quantity)||1,
                        unit_price: parseFloat(productData.unit_price)||0,
                        product_image: productData.product_image||null,
                        has_custom_design: Boolean(Number(productData.has_custom_design||0))
                    });
                }
                localStorage.setItem(key, JSON.stringify(items));
                // Update badge dan beri notifikasi singkat
                const totalQty = items.reduce((s,it)=> s + (parseInt(it.quantity)||0), 0);
                if (typeof updateCartBadge === 'function') updateCartBadge(totalQty);
                showNotification('success', 'Produk ditambahkan ke keranjang.');
                // Tetap di halaman, tidak redirect
            } catch(e) {
                console.error('Guest cart error:', e);
            }
            return;
        @endguest
        
        if (!csrfToken) {
            console.error('CSRF token not found');
            alert('Terjadi kesalahan. Silakan refresh halaman.');
            return;
        }
        
        let originalButtonText = '';
        if (buttonElement) {
            originalButtonText = buttonElement.innerHTML;
            buttonElement.disabled = true;
            buttonElement.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        }
        
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(productData)
        })
        .then(handleResponse)
        .then(data => {
            // === PERBAIKAN DI SINI ===
            // Kita gunakan 'data.message' yang berisi teks, bukan 'data.success' yang berisi 'true'
            showNotification('success', data.message || 'Produk berhasil ditambahkan!');
            // === AKHIR PERBAIKAN ===

            if (typeof updateCartBadge === 'function') {
                updateCartBadge(data.cart_count);
            }
        })
        .catch(error => {
            console.error('Error (addToCart):', error);
            showNotification('error', error.message);
            if (error.status === 401 || error.status === 419) {
                setTimeout(() => window.location.href = '{{ route("login") }}', 2000);
            }
        })
        .finally(() => {
            if (buttonElement) {
                buttonElement.disabled = false;
                buttonElement.innerHTML = originalButtonText;
            }
        });
    }

    /**
     * Fungsi untuk menambah item ke keranjang (via FormData)
     * Digunakan untuk "Add to Cart" dari dalam modal (karena ada file)
     */
    function addToCartWithFile(formData, buttonElement) {
        @guest
            // Guest: tidak dapat mengunggah file ke server. Simpan metadatanya saja.
            try {
                const data = Object.fromEntries(formData.entries());
                const key = 'skm_guest_cart';
                const items = JSON.parse(localStorage.getItem(key) || '[]');
                const hasCustom = data.has_custom_design === '1';
                if (hasCustom && data.custom_design_file) {
                    // Tidak menyimpan file; hanya tandai custom design
                    console.warn('Guest cannot upload files; storing as custom without file.');
                }
                const newItem = {
                    product_name: data.product_name,
                    material: data.material||null,
                    size: data.size||null,
                    design: hasCustom ? 'Custom' : (data.design||'Standard'),
                    quantity: parseInt(data.quantity)||1,
                    unit_price: parseFloat(data.unit_price)||0,
                    product_image: data.product_image||null,
                    has_custom_design: hasCustom
                };
                const idx = items.findIndex(it => (
                    String(it.product_name||'').toLowerCase() === String(newItem.product_name||'').toLowerCase() &&
                    String(it.material||'') === String(newItem.material||'') &&
                    String(it.size||'') === String(newItem.size||'') &&
                    String(it.design||'') === String(newItem.design||'') &&
                    Boolean(it.has_custom_design||false) === Boolean(newItem.has_custom_design)
                ));
                if (idx >= 0) {
                    items[idx].quantity = (parseInt(items[idx].quantity)||0) + newItem.quantity;
                } else {
                    items.push(newItem);
                }
                localStorage.setItem(key, JSON.stringify(items));

                const totalQty = items.reduce((s,it)=> s + (parseInt(it.quantity)||0), 0);
                if (typeof updateCartBadge === 'function') updateCartBadge(totalQty);
                showNotification('success', 'Produk ditambahkan ke keranjang. Login untuk checkout.');
                // Tutup modal
                document.getElementById('modal-detail')?.classList.remove('active');
                document.getElementById('modal-overlay')?.classList.remove('active');
                // Tetap di halaman, tidak redirect
            } catch(e) {
                console.error('Guest cart error:', e);
            }
            return;
        @endguest
        
        if (!csrfToken) {
            console.error('CSRF token not found');
            alert('Terjadi kesalahan. Silakan refresh halaman.');
            return;
        }
        
        const originalButtonText = buttonElement.innerHTML;
        buttonElement.disabled = true;
        buttonElement.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menambahkan...';
        
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
                // JANGAN set 'Content-Type' saat kirim FormData
            },
            body: formData
        })
        .then(handleResponse)
        .then(data => {
            // === PERBAIKAN DI SINI ===
            // Kita gunakan 'data.message' yang berisi teks, bukan 'data.success' yang berisi 'true'
            showNotification('success', data.message || 'Produk berhasil ditambahkan!');
            // === AKHIR PERBAIKAN ===
            
            if (typeof updateCartBadge === 'function') {
                updateCartBadge(data.cart_count);
            }
            
            // Tutup modal
            document.getElementById('modal-detail').classList.remove('active');
            document.getElementById('modal-overlay').classList.remove('active');
        })
        .catch(error => {
            console.error('Error (addToCartWithFile):', error);
            showNotification('error', error.message);
            if (error.status === 401 || error.status === 419) {
                setTimeout(() => window.location.href = '{{ route("login") }}', 2000);
            }
        })
        .finally(() => {
            if (buttonElement) {
                buttonElement.disabled = false;
                buttonElement.innerHTML = originalButtonText;
            }
        });
    }

    /**
     * Fungsi untuk menampilkan notifikasi
     */
    function showNotification(type, message) {
        const existingNotification = document.querySelector('.cart-notification');
        if (existingNotification) {
            existingNotification.remove();
        }
        
        const notification = document.createElement('div');
        notification.className = `cart-notification cart-notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            </div>
            <button class="notification-close">&times;</button>
        `;
        
        // (Styles untuk notifikasi, jika Anda perlukan)
        if (!document.querySelector('#cart-notification-styles')) {
            const styles = document.createElement('style');
            styles.id = 'cart-notification-styles';
            styles.textContent = `
                .cart-notification {
                    position: fixed; top: 80px; right: 20px; min-width: 300px; max-width: 400px;
                    padding: 15px 20px; border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); z-index: 9999;
                    display: flex; align-items: center; justify-content: space-between;
                    animation: slideIn 0.3s ease-out;
                }
                @keyframes slideIn {
                    from { transform: translateX(400px); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
                .cart-notification-success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
                .cart-notification-error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
                .notification-content { display: flex; align-items: center; gap: 10px; flex: 1; }
                .notification-content i { font-size: 1.2rem; }
                .notification-close {
                    background: none; border: none; font-size: 1.5rem; cursor: pointer;
                    opacity: 0.7; transition: opacity 0.2s; padding: 0;
                    margin-left: 15px; color: inherit;
                }
                .notification-close:hover { opacity: 1; }
            `;
            document.head.appendChild(styles);
        }
        
        document.body.appendChild(notification);
        
        notification.querySelector('.notification-close').addEventListener('click', function() {
            notification.remove();
        });
        
        setTimeout(() => {
            notification.remove();
        }, 5000);
    }


    // ═══════════════════════════════════════════════════════════
    // LOGIKA UTAMA (setelah DOM dimuat)
    // ═══════════════════════════════════════════════════════════
    document.addEventListener('DOMContentLoaded', function() {
        
        // --- Elemen Global ---
        const productCards = document.querySelectorAll('.card-produk');
        const modal = document.getElementById('modal-detail');
        const overlay = document.getElementById('modal-overlay');
        const closeModalBtn = document.getElementById('modal-close-btn');

        if (!modal || !overlay || !closeModalBtn) {
            console.error('Modal elements not found!');
            return;
        }

        // --- Elemen-elemen Modal ---
        const modalTitle = document.getElementById('modal-title');
        const modalImg = document.getElementById('modal-img-main');
        const modalDeskripsi = document.getElementById('modal-deskripsi');
        const modalHarga = document.getElementById('modal-harga');
        const modalThumbnails = document.getElementById('modal-thumbnails');
        const modalSpekTable = document.getElementById('modal-spek-tbody');
        const qtyMinus = document.getElementById('qty-minus');
        const qtyPlus = document.getElementById('qty-plus');
        const qtyInput = document.getElementById('modal-qty');
        
        // --- Elemen Custom Design ---
        const radioYa = document.getElementById('radio-ya');
        const radioTidak = document.getElementById('radio-tidak');
        const uploadGroup = document.getElementById('upload-group');
        const customDesignFile = document.getElementById('custom-design-file');
        const btnUpload = document.getElementById('btn-upload');
        const fileName = document.getElementById('file-name');
        const btnCustomizeDesign = document.getElementById('btn-customize-design');
        const modalAddToCartBtn = document.getElementById('modal-add-to-cart');

        // ═══════════════════════════════════════════════════════════
        // LOGIKA FILTER PRODUK (UPDATED: Tambah filter "Semua")
        // ═══════════════════════════════════════════════════════════
        const gridProduk = document.querySelector('.grid-produk');
        let currentFilter = 'semua'; // Default filter semua

        function filterProducts(category) {
            const allCards = document.querySelectorAll('.card-produk');

            allCards.forEach(card => {
                const cardCategory = card.dataset.kategori;
                // Jika filter "semua" atau kategori cocok, tampilkan
                if (category === 'semua' || cardCategory === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Event listener untuk tombol filter
        const filterButtons = document.querySelectorAll('.filter-btn');
        filterButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active state
                filterButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Filter produk
                currentFilter = this.dataset.filter;
                filterProducts(currentFilter);
            });
        });

        // Inisialisasi filter pertama kali
        filterProducts(currentFilter);

        // --- Variabel untuk menyimpan data produk saat modal dibuka ---
        let currentProductCard = null;

        // --- Fungsi Modal ---
        function openModal(card) {
            currentProductCard = card; // <-- Simpan card saat ini

            // 1. Isi data dari data-attributes
            modalTitle.textContent = card.dataset.title;
            modalImg.src = card.dataset.img;
            modalDeskripsi.textContent = card.dataset.deskripsi;
            modalHarga.textContent = card.dataset.harga;

            // 2. Isi Thumbnails
            modalThumbnails.innerHTML = `
                <img src="${card.dataset.thumb1}" alt="thumbnail 1" class="active">
                <img src="${card.dataset.thumb2}" alt="thumbnail 2">
                <img src="${card.dataset.thumb3}" alt="thumbnail 3">
            `;

            // 3. Isi Spesifikasi
            modalSpekTable.innerHTML = `
                <tr><td>Lebar</td><td>${card.dataset.spekLebar}</td></tr>
                <tr><td>Tinggi</td><td>${card.dataset.spekTinggi}</td></tr>
                <tr><td>Panjang</td><td>${card.dataset.spekPanjang}</td></tr>
                <tr><td>Bahan</td><td>${card.dataset.spekBahan}</td></tr>
                <tr><td>Kapasitas</td><td>${card.dataset.spekKapasitas}</td></tr>
            `;

            // 4. Reset Modal State
            qtyInput.value = 1;
            radioTidak.checked = true;
            uploadGroup.style.display = 'none';
            customDesignFile.value = '';
            fileName.textContent = 'Belum ada file dipilih';
            
            // 5. Tampilkan Modal
            modal.classList.add('active');
            overlay.classList.add('active');
        }

        function closeModal() {
            modal.classList.remove('active');
            overlay.classList.remove('active');
        }

        // --- Event Listener untuk Semua Card Produk ---
        productCards.forEach(card => {
            const cartButton = card.querySelector('.btn-keranjang');

            // 1. Event Listener Tombol Keranjang (Quick Add)
            cartButton.addEventListener('click', function(e) {
                e.stopPropagation(); // Hentikan event agar modal tidak terbuka
                
                // Ambil data produk
                const productName = card.dataset.title;
                const price = card.dataset.price || card.dataset.harga.replace(/[^0-9]/g, '');
                const material = card.dataset.material || card.dataset.spekBahan || 'Standard';
                const size = card.dataset.size || (card.dataset.spekLebar + 'x' + card.dataset.spekTinggi + 'x' + card.dataset.spekPanjang) || 'Standard';
                const productImage = card.dataset.img;
                
                // Panggil fungsi addToCart (JSON)
                addToCart({
                    product_name: productName,
                    material: material,
                    size: size,
                    design: 'Standard', // Quick add selalu standard
                    quantity: 1,
                    unit_price: parseFloat(price),
                    product_image: productImage,
                    has_custom_design: '0'
                }, e.currentTarget); // Kirim elemen tombol untuk loading state
            });

            // 2. Event Listener Card (untuk buka Modal)
            card.addEventListener('click', () => {
                openModal(card);
            });
        });

        // --- Event Listener Modal Lainnya ---
        closeModalBtn.addEventListener('click', closeModal);
        overlay.addEventListener('click', closeModal);

        modalThumbnails.addEventListener('click', function(e) {
            if (e.target.tagName === 'IMG') {
                modalThumbnails.querySelectorAll('img').forEach(img => img.classList.remove('active'));
                e.target.classList.add('active');
                modalImg.src = e.target.src;
            }
        });

        // Logika Kuantitas
        qtyPlus.addEventListener('click', () => { qtyInput.value = parseInt(qtyInput.value) + 1; });
        qtyMinus.addEventListener('click', () => {
            let currentVal = parseInt(qtyInput.value);
            if (currentVal > 1) qtyInput.value = currentVal - 1;
        });

        // ═══════════════════════════════════════════════════════════
        // CUSTOM DESIGN TOGGLE & FILE UPLOAD
        // ═══════════════════════════════════════════════════════════
        radioYa.addEventListener('change', function() {
            if (this.checked) {
                uploadGroup.style.display = 'block';
            }
        });

        radioTidak.addEventListener('change', function() {
            if (this.checked) {
                uploadGroup.style.display = 'none';
                customDesignFile.value = '';
                fileName.textContent = 'Belum ada file dipilih';
            }
        });

        btnUpload.addEventListener('click', function() {
            customDesignFile.click();
        });

        customDesignFile.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                fileName.textContent = this.files[0].name;
            } else {
                fileName.textContent = 'Belum ada file dipilih';
            }
        });

        // ═══════════════════════════════════════════════════════════
        // CUSTOMIZE DESIGN BUTTON
        // ═══════════════════════════════════════════════════════════
        btnCustomizeDesign.addEventListener('click', function() {
            window.location.href = '{{ route("edit.design") }}';
        });

        // ═══════════════════════════════════════════════════════════
        // ADD TO CART DARI MODAL (Menggunakan FormData)
        // ═══════════════════════════════════════════════════════════
        modalAddToCartBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (!currentProductCard) {
                console.error('currentProductCard is not set!');
                return;
            }
            
            // Ambil data produk dari card yang disimpan
            const productName = currentProductCard.dataset.title;
            const price = currentProductCard.dataset.price || currentProductCard.dataset.harga.replace(/[^0-9]/g, '');
            const material = currentProductCard.dataset.material || currentProductCard.dataset.spekBahan || 'Standard';
            const size = currentProductCard.dataset.size || (currentProductCard.dataset.spekLebar + 'x' + currentProductCard.dataset.spekTinggi + 'x' + currentProductCard.dataset.spekPanjang) || 'Standard';
            const productImage = currentProductCard.dataset.img;
            
            // Ambil data dari modal
            const quantity = parseInt(qtyInput.value);
            const hasCustomDesign = radioYa.checked;
            const customFile = customDesignFile.files[0];

            // =======================================================
            // ===               PERUBAHAN DI SINI               ===
            // =======================================================
            // Validasi: Jika pilih "Ya" tapi file kosong
            if (hasCustomDesign && !customFile) {
                // Ganti alert lama dengan SweetAlert2
                Swal.fire({
                    title: 'File Desain Dibutuhkan',
                    text: 'Anda telah memilih "Ya" untuk desain kustom. Silakan upload file desain Anda terlebih dahulu.',
                    icon: 'warning',
                    confirmButtonText: 'Mengerti',
                    confirmButtonColor: '#074159' // Sesuai tema --skm-blue
                });
                return; // Hentikan eksekusi
            }
            // =======================================================
            // ===             AKHIR PERUBAHAN DI SINI             ===
            // =======================================================

            // Buat FormData untuk kirim data + file
            const formData = new FormData();
            formData.append('product_name', productName);
            formData.append('material', material);
            formData.append('size', size);
            formData.append('design', hasCustomDesign ? 'Custom' : 'Standard');
            formData.append('quantity', quantity);
            formData.append('unit_price', parseFloat(price));
            formData.append('product_image', productImage);
            formData.append('has_custom_design', hasCustomDesign ? '1' : '0');
            
            if (hasCustomDesign && customFile) {
                formData.append('custom_design_file', customFile);
            }

            // Panggil fungsi addToCartWithFile (FormData)
            addToCartWithFile(formData, this); // 'this' adalah tombol 'modalAddToCartBtn'
        });

    }); // Akhir dari DOMContentLoaded
</script>

</body>
</html>