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
            --skm-new-teal-2: #158488;
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
        }

        .card-produk-content h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--skm-new-teal-1);
            margin: 0 0 10px 0;
        }

        .card-produk-content .deskripsi {
            font-size: 0.95rem;
            color: var(--skm-gray);
            line-height: 1.5;
            margin: 0 0 15px 0;
            min-height: 60px;
        }

        .card-produk-content .harga {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--skm-accent);
            margin: 0 0 20px 0;
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
        }

        .btn-keranjang:hover {
            background-color: var(--skm-blue-2);
        }

        .btn-keranjang i {
            margin-right: 8px;
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
                <button class="filter-btn active" data-filter="karton">Karton</button>
                <button class="filter-btn" data-filter="plastik">Plastik</button>
                <button class="filter-btn" data-filter="kertas">Kertas</button>
                <button class="filter-btn" data-filter="aluminium">Aluminium</button>
                <button class="filter-btn" data-filter="lainnya">Lainnya</button>
            </div>

            <div class="grid-produk">

                <div class="card-produk" data-kategori="karton"
                    data-title="Kotak Kemasan Khusus"
                    data-img="{{ asset('assets/img/Product1.png') }}"
                    data-deskripsi="Didesain untuk memenuhi kebutuhan spesifik produk Anda."
                    data-harga="Rp 5.000 / pcs"
                    data-price="5000"
                    data-material="Karton B-Flute"
                    data-size="20x10x30 cm"
                    data-thumb1="{{ asset('assets/img/Product1.png') }}"
                    data-thumb2="{{ asset('assets/img/Product2.png') }}"
                    data-thumb3="{{ asset('assets/img/Product3.png') }}"
                    data-spek-lebar="20 cm"
                    data-spek-tinggi="10 cm"
                    data-spek-panjang="30 cm"
                    data-spek-bahan="Karton B-Flute"
                    data-spek-kapasitas="2 kg"
                >
                    <img src="{{ asset('assets/img/Product1.png') }}" alt="Kotak Kemasan Khusus">
                    <div class="card-produk-content">
                        <h3>Kotak Kemasan Khusus</h3>
                        <p class="deskripsi">Didesain untuk memenuhi kebutuhan spesifik produk Anda.</p>
                        <p class="harga">Rp 5.000 / pcs</p>
                        <button class="btn-keranjang"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
                    </div>
                </div>

                <div class="card-produk" data-kategori="karton"
                    data-title="Karton Bergelombang"
                    data-img="{{ asset('assets/img/Product2.png') }}"
                    data-deskripsi="Kekuatan dan ketahanan optimal untuk pengiriman yang aman."
                    data-harga="Rp 8.000 / pcs"
                    data-price="8000"
                    data-material="Karton Bergelombang"
                    data-size="25x20x35 cm"
                    data-thumb1="{{ asset('assets/img/Product2.png') }}"
                    data-thumb2="{{ asset('assets/img/Product5.png') }}"
                    data-thumb3="{{ asset('assets/img/Product1.png') }}"
                    data-spek-lebar="100 cm"
                    data-spek-tinggi="1 mm"
                    data-spek-panjang="100 cm"
                    data-spek-bahan="Corrugated Sheet C-Flute"
                    data-spek-kapasitas="N/A"
                >
                    <img src="{{ asset('assets/img/Product2.png') }}" alt="Karton Bergelombang">
                    <div class="card-produk-content">
                        <h3>Karton Bergelombang</h3>
                        <p class="deskripsi">Kekuatan dan ketahanan optimal untuk pengiriman yang aman.</p>
                        <p class="harga">Rp 8.000 / pcs</p>
                        <button class="btn-keranjang"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
                    </div>
                </div>

                <div class="card-produk" data-kategori="karton"
                    data-title="Kemasan Ramah Lingkungan"
                    data-img="{{ asset('assets/img/Product3.png') }}"
                    data-deskripsi="Solusi berkelanjutan yang terbuat dari bahan daur ulang."
                    data-harga="Rp 12.000 / pcs"
                    data-thumb1="{{ asset('assets/img/Product3.png') }}"
                    data-thumb2="{{ asset('assets/img/Product1.png') }}"
                    data-thumb3="{{ asset('assets/img/Product4.png') }}"
                    data-spek-lebar="18 cm"
                    data-spek-tinggi="12 cm"
                    data-spek-panjang="25 cm"
                    data-spek-bahan="Karton Daur Ulang"
                    data-spek-kapasitas="3 kg"
                >
                    <img src="{{ asset('assets/img/Product3.png') }}" alt="Kemasan Ramah Lingkungan">
                    <div class="card-produk-content">
                        <h3>Kemasan Ramah Lingkungan</h3>
                        <p class="deskripsi">Solusi berkelanjutan yang terbuat dari bahan daur ulang.</p>
                        <p class="harga">Rp 12.000 / pcs</p>
                        <button class="btn-keranjang"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
                    </div>
                </div>

                <div class="card-produk" data-kategori="karton"
                    data-title="Display & Promosi"
                    data-img="{{ asset('assets/img/Product4.png') }}"
                    data-deskripsi="Buat kemasan yang menonjol di rak toko."
                    data-harga="Rp 15.000 / pcs"
                    data-thumb1="{{ asset('assets/img/Product4.png') }}"
                    data-thumb2="{{ asset('assets/img/Product1.png') }}"
                    data-thumb3="{{ asset('assets/img/Product3.png') }}"
                    data-spek-lebar="30 cm"
                    data-spek-tinggi="10 cm"
                    data-spek-panjang="30 cm"
                    data-spek-bahan="Partisi Karton Keras"
                    data-spek-kapasitas="6 botol"
                >
                    <img src="{{ asset('assets/img/Product4.png') }}" alt="Display & Promosi">
                    <div class="card-produk-content">
                        <h3>Display & Promosi</h3>
                        <p class="deskripsi">Buat kemasan yang menonjol di rak toko.</p>
                        <p class="harga">Rp 15.000 / pcs</p>
                        <button class="btn-keranjang"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
                    </div>
                </div>

                <div class="card-produk" data-kategori="karton"
                    data-title="Kemasan Makanan"
                    data-img="{{ asset('assets/img/Product5.png') }}"
                    data-deskripsi="Aman dan kokoh untuk industri kuliner."
                    data-harga="Rp 9.500 / pcs"
                    data-price="8000"
                    data-material="Food Grade Paper"
                    data-size="15x15x5 cm"
                    data-thumb1="{{ asset('assets/img/Product5.png') }}"
                    data-thumb2="{{ asset('assets/img/Product2.png') }}"
                    data-thumb3="{{ asset('assets/img/Product1.png') }}"
                    data-spek-lebar="15 cm"
                    data-spek-tinggi="5 cm"
                    data-spek-panjang="20 cm"
                    data-spek-bahan="Food Grade Paper"
                    data-spek-kapasitas="1 porsi"
                >
                    <img src="{{ asset('assets/img/Product5.png') }}" alt="Kemasan Makanan">
                    <div class="card-produk-content">
                        <h3>Kemasan Makanan</h3>
                        <p class="deskripsi">Aman dan kokoh untuk industri kuliner.</p>
                        <p class="harga">Rp 9.500 / pcs</p>
                        <button class="btn-keranjang"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
                    </div>
                </div>

                <div class="card-produk" data-kategori="karton"
                    data-title="Kemasan Kosmetik"
                    data-img="{{ asset('assets/img/Product6.png') }}"
                    data-deskripsi="Elegan dan mewah untuk produk kecantikan."
                    data-harga="Rp 18.000 / pcs"
                    data-price="18000"
                    data-material="Hard Cover Karton"
                    data-size="8x5x3 cm"
                    data-thumb1="{{ asset('assets/img/Product6.png') }}"
                    data-thumb2="{{ asset('assets/img/Product1.png') }}"
                    data-thumb3="{{ asset('assets/img/Product3.png') }}"
                    data-spek-lebar="5 cm"
                    data-spek-tinggi="15 cm"
                    data-spek-panjang="5 cm"
                    data-spek-bahan="Hard Cover Karton"
                    data-spek-kapasitas="1 produk"
                >
                    <img src="{{ asset('assets/img/Product6.png') }}" alt="Kemasan Kosmetik">
                    <div class="card-produk-content">
                        <h3>Kemasan Kosmetik</h3>
                        <p class="deskripsi">Elegan dan mewah untuk produk kecantikan.</p>
                        <p class="harga">Rp 18.000 / pcs</p>
                        <button class="btn-keranjang"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
                    </div>
                </div>

                <div class="card-produk" data-kategori="plastik"
                    data-title="Botol Plastik PET"
                    data-img="{{ asset('assets/img/Product1.png') }}"
                    data-deskripsi="Kemasan plastik bening untuk minuman dan cairan."
                    data-harga="Rp 2.000 / pcs"
                    data-price="2000"
                    data-material="Plastik PET"
                    data-size="500 ml"
                    data-thumb1="{{ asset('assets/img/Product1.png') }}"
                    data-thumb2="{{ asset('assets/img/Product2.png') }}"
                    data-thumb3="{{ asset('assets/img/Product3.png') }}"
                    data-spek-lebar="8 cm"
                    data-spek-tinggi="15 cm"
                    data-spek-panjang="8 cm"
                    data-spek-bahan="Plastik PET"
                    data-spek-kapasitas="500 ml"
                >
                    <img src="{{ asset('assets/img/Product1.png') }}" alt="Kemasan Plastik">
                    <div class="card-produk-content">
                        <h3>Botol Plastik PET</h3>
                        <p class="deskripsi">Kemasan plastik bening untuk minuman dan cairan.</p>
                        <p class="harga">Rp 2.000 / pcs</p>
                        <button class="btn-keranjang"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
                    </div>
                </div>

                <div class="card-produk" data-kategori="kertas"
                    data-title="Paper Bag Kertas"
                    data-img="{{ asset('assets/img/Product1.png') }}"
                    data-deskripsi="Tas kertas ramah lingkungan untuk belanja."
                    data-harga="Rp 3.500 / pcs"
                    data-price="3500"
                    data-material="Kertas Kraft"
                    data-size="25x30x10 cm"
                    data-thumb1="{{ asset('assets/img/Product1.png') }}"
                    data-thumb2="{{ asset('assets/img/Product2.png') }}"
                    data-thumb3="{{ asset('assets/img/Product3.png') }}"
                    data-spek-lebar="25 cm"
                    data-spek-tinggi="30 cm"
                    data-spek-panjang="10 cm"
                    data-spek-bahan="Kertas Kraft"
                    data-spek-kapasitas="2 kg"
                >
                    <img src="{{ asset('assets/img/Product1.png') }}" alt="Kemasan Kertas">
                    <div class="card-produk-content">
                        <h3>Paper Bag Kertas</h3>
                        <p class="deskripsi">Tas kertas ramah lingkungan untuk belanja.</p>
                        <p class="harga">Rp 3.500 / pcs</p>
                        <button class="btn-keranjang"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
                    </div>
                </div>

                <div class="card-produk" data-kategori="aluminium"
                    data-title="Kaleng Aluminium"
                    data-img="{{ asset('assets/img/Product1.png') }}"
                    data-deskripsi="Kemasan kaleng untuk minuman bersoda."
                    data-harga="Rp 4.000 / pcs"
                    data-price="4000"
                    data-material="Aluminium"
                    data-size="330 ml"
                    data-thumb1="{{ asset('assets/img/Product1.png') }}"
                    data-thumb2="{{ asset('assets/img/Product2.png') }}"
                    data-thumb3="{{ asset('assets/img/Product3.png') }}"
                    data-spek-lebar="6 cm"
                    data-spek-tinggi="12 cm"
                    data-spek-panjang="6 cm"
                    data-spek-bahan="Aluminium"
                    data-spek-kapasitas="330 ml"
                >
                    <img src="{{ asset('assets/img/Product1.png') }}" alt="Kemasan Aluminium">
                    <div class="card-produk-content">
                        <h3>Kaleng Aluminium</h3>
                        <p class="deskripsi">Kemasan kaleng untuk minuman bersoda.</p>
                        <p class="harga">Rp 4.000 / pcs</p>
                        <button class="btn-keranjang"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
                    </div>
                </div>

                <div class="card-produk" data-kategori="lainnya"
                    data-title="Bubble Wrap"
                    data-img="{{ asset('assets/img/Product1.png') }}"
                    data-deskripsi="Pelindung guncangan untuk pengiriman barang."
                    data-harga="Rp 1.000 / meter"
                    data-price="1000"
                    data-material="Plastik Bubble"
                    data-size="100x100 cm"
                    data-thumb1="{{ asset('assets/img/Product1.png') }}"
                    data-thumb2="{{ asset('assets/img/Product2.png') }}"
                    data-thumb3="{{ asset('assets/img/Product3.png') }}"
                    data-spek-lebar="100 cm"
                    data-spek-tinggi="-"
                    data-spek-panjang="100 cm"
                    data-spek-bahan="Plastik Bubble"
                    data-spek-kapasitas="N/A"
                >
                    <img src="{{ asset('assets/img/Product1.png') }}" alt="Kemasan Lainnya">
                    <div class="card-produk-content">
                        <h3>Bubble Wrap</h3>
                        <p class="deskripsi">Pelindung guncangan untuk pengiriman barang.</p>
                        <p class="harga">Rp 1.000 / meter</p>
                        <button class="btn-keranjang"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
                    </div>
                </div>

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
                            <label><input type="radio" name="custom_design" value="ya"> Ya</label>
                            <label><input type="radio" name="custom_design" value="tidak" checked> Tidak</label>
                        </div>
                    </div>

                    <div class="modal-actions">
                        <button class="btn-modal btn-modal-primary" id="modal-add-to-cart"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
                        <button class="btn-modal btn-modal-secondary"><i class="fas fa-pen"></i> Sesuaikan Desain</button>
                    </div>
                </div>
            </div>
        </div>
        @include('sections.faq')
    </main>

    @include('layouts.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterContainer = document.querySelector('.filter-produk');
            const filterBtns = document.querySelectorAll('.filter-btn');
            const produkCards = document.querySelectorAll('.card-produk');

            function filterProduk(filter) {
                produkCards.forEach(card => {
                    if (card.dataset.kategori === filter) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            }

            const initialFilter = document.querySelector('.filter-btn.active').dataset.filter;
            filterProduk(initialFilter);

            filterContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('filter-btn')) {
                    filterBtns.forEach(btn => btn.classList.remove('active'));
                    e.target.classList.add('active');
                    const filterValue = e.target.dataset.filter;
                    filterProduk(filterValue);
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productCards = document.querySelectorAll('.card-produk');
            const modal = document.getElementById('modal-detail');
            const overlay = document.getElementById('modal-overlay');
            const closeModalBtn = document.getElementById('modal-close-btn');

            if (!modal || !overlay || !closeModalBtn) {
                console.error('Modal elements not found!');
                return;
            }

            const modalTitle = document.getElementById('modal-title');
            const modalImg = document.getElementById('modal-img-main');
            const modalDeskripsi = document.getElementById('modal-deskripsi');
            const modalHarga = document.getElementById('modal-harga');
            const modalThumbnails = document.getElementById('modal-thumbnails');
            const modalSpekTable = document.getElementById('modal-spek-tbody');

            // Tombol Kuantitas
            const qtyMinus = document.getElementById('qty-minus');
            const qtyPlus = document.getElementById('qty-plus');
            const qtyInput = document.getElementById('modal-qty');

            function openModal(card) {
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

                qtyInput.value = 1;

                modal.classList.add('active');
                overlay.classList.add('active');
            }

            function closeModal() {
                modal.classList.remove('active');
                overlay.classList.remove('active');
            }

            // --- Event Listeners ---
            productCards.forEach(card => {

                const cartButton = card.querySelector('.btn-keranjang');
                cartButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    // Get product data
                    const productName = card.dataset.title;
                    const price = card.dataset.price || card.dataset.harga.replace(/[^0-9]/g, '');
                    const material = card.dataset.material || card.dataset.spekBahan || 'Standard';
                    const size = card.dataset.size || (card.dataset.spekLebar + 'x' + card.dataset.spekTinggi + 'x' + card.dataset.spekPanjang) || 'Standard';
                    const productImage = card.dataset.img;
                    
                    // Call add to cart function
                    addToCart({
                        product_name: productName,
                        material: material,
                        size: size,
                        design: 'Standard',
                        quantity: 1,
                        unit_price: parseFloat(price),
                        product_image: productImage
                    });
                });

                card.addEventListener('click', () => {
                    openModal(card);
                });
            });

            closeModalBtn.addEventListener('click', closeModal);
            overlay.addEventListener('click', closeModal);

            // Logika klik thumbnail (Event Delegation)
            modalThumbnails.addEventListener('click', function(e) {
                if (e.target.tagName === 'IMG') {
                    modalThumbnails.querySelectorAll('img').forEach(img => img.classList.remove('active'));
                    e.target.classList.add('active');
                    modalImg.src = e.target.src;
                }
            });

            // Logika Kuantitas
            qtyPlus.addEventListener('click', () => {
                qtyInput.value = parseInt(qtyInput.value) + 1;
            });

            qtyMinus.addEventListener('click', () => {
                let currentVal = parseInt(qtyInput.value);
                if (currentVal > 1) {
                    qtyInput.value = currentVal - 1;
                }
            });

        });
    </script>

    <script>
        // ═══════════════════════════════════════════════════════════
        // ADD TO CART FUNCTIONALITY
        // ═══════════════════════════════════════════════════════════
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        
        // Add to Cart Function
        function addToCart(productData) {
            // Check if user is logged in
            @guest
                alert('Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.');
                window.location.href = '{{ route("login") }}';
                return;
            @endguest
            
            if (!csrfToken) {
                console.error('CSRF token not found');
                alert('Terjadi kesalahan. Silakan refresh halaman.');
                return;
            }
            
            // Show loading state
            const button = event.target.closest('button');
            const originalButtonText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menambahkan...';
            
            // Send request to add to cart
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(productData)
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 401 || response.status === 419) {
                        throw new Error('Silakan login terlebih dahulu.');
                    }
                    throw new Error('Terjadi kesalahan. Silakan coba lagi.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Show success notification
                    showNotification('success', data.message);
                    
                    // Update cart badge
                    if (typeof updateCartBadge === 'function') {
                        updateCartBadge(data.cart_count);
                    }
                    
                    // Reset button
                    button.disabled = false;
                    button.innerHTML = originalButtonText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', error.message);
                
                // Reset button
                button.disabled = false;
                button.innerHTML = originalButtonText;
                
                // Redirect to login if needed
                if (error.message.includes('login')) {
                    setTimeout(() => {
                        window.location.href = '{{ route("login") }}';
                    }, 2000);
                }
            });
        }
        
        // Show Notification Function
        function showNotification(type, message) {
            // Remove existing notification
            const existingNotification = document.querySelector('.cart-notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Create notification
            const notification = document.createElement('div');
            notification.className = `cart-notification cart-notification-${type}`;
            notification.innerHTML = `
                <div class="notification-content">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                    <span>${message}</span>
                </div>
                <button class="notification-close">&times;</button>
            `;
            
            // Add styles if not present
            if (!document.querySelector('#cart-notification-styles')) {
                const styles = document.createElement('style');
                styles.id = 'cart-notification-styles';
                styles.textContent = `
                    .cart-notification {
                        position: fixed;
                        top: 80px;
                        right: 20px;
                        min-width: 300px;
                        max-width: 400px;
                        padding: 15px 20px;
                        border-radius: 8px;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                        z-index: 9999;
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        animation: slideIn 0.3s ease-out;
                    }
                    
                    @keyframes slideIn {
                        from {
                            transform: translateX(400px);
                            opacity: 0;
                        }
                        to {
                            transform: translateX(0);
                            opacity: 1;
                        }
                    }
                    
                    .cart-notification-success {
                        background: #d4edda;
                        border: 1px solid #c3e6cb;
                        color: #155724;
                    }
                    
                    .cart-notification-error {
                        background: #f8d7da;
                        border: 1px solid #f5c6cb;
                        color: #721c24;
                    }
                    
                    .notification-content {
                        display: flex;
                        align-items: center;
                        gap: 10px;
                        flex: 1;
                    }
                    
                    .notification-content i {
                        font-size: 1.2rem;
                    }
                    
                    .notification-close {
                        background: none;
                        border: none;
                        font-size: 1.5rem;
                        cursor: pointer;
                        opacity: 0.7;
                        transition: opacity 0.2s;
                        padding: 0;
                        margin-left: 15px;
                        color: inherit;
                    }
                    
                    .notification-close:hover {
                        opacity: 1;
                    }
                `;
                document.head.appendChild(styles);
            }
            
            // Add to page
            document.body.appendChild(notification);
            
            // Close button
            notification.querySelector('.notification-close').addEventListener('click', function() {
                notification.remove();
            });
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.remove();
            }, 5000);
        }
        
        // Handle Modal Add to Cart Button
        document.addEventListener('DOMContentLoaded', function() {
            const modalAddToCartBtn = document.getElementById('modal-add-to-cart');
            if (modalAddToCartBtn) {
                let currentProduct = null;
                
                // Store current product when modal opens
                const openModalOriginal = window.openModal;
                window.openModal = function(card) {
                    currentProduct = {
                        product_name: card.dataset.title,
                        price: card.dataset.price || card.dataset.harga.replace(/[^0-9]/g, ''),
                        material: card.dataset.material || card.dataset.spekBahan || 'Standard',
                        size: card.dataset.size || (card.dataset.spekLebar + 'x' + card.dataset.spekTinggi + 'x' + card.dataset.spekPanjang) || 'Standard',
                        product_image: card.dataset.img
                    };
                    if (openModalOriginal) openModalOriginal(card);
                };
                
                modalAddToCartBtn.addEventListener('click', function() {
                    if (currentProduct) {
                        const quantity = parseInt(document.getElementById('modal-qty').value) || 1;
                        const customDesign = document.querySelector('input[name="custom_design"]:checked')?.value;
                        
                        addToCart({
                            product_name: currentProduct.product_name,
                            material: currentProduct.material,
                            size: currentProduct.size,
                            design: customDesign === 'ya' ? 'Custom' : 'Standard',
                            quantity: quantity,
                            unit_price: parseFloat(currentProduct.price),
                            product_image: currentProduct.product_image
                        });
                        
                        // Close modal after adding
                        setTimeout(() => {
                            const closeBtn = document.getElementById('modal-close-btn');
                            if (closeBtn) closeBtn.click();
                        }, 500);
                    }
                });
            }
        });
    </script>
    </body>
</html>