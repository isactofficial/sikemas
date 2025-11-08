<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKEMAS - Protect Your Value</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
        /* Mengubah warna background tombol alert */
        --swal2-confirm-button-background-color: #ff5722;
        /* Mengubah warna teks tombol konfirmasi */
        --swal2-confirm-button-text-color: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Besley', serif;
            background-color: #f5f5ff;
        }

        /* WHY US */
        .why-us-section {
            background-color: #ffffff;
            padding: 6rem 2rem;
        }

        .why-us-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .section-title-why-us {
            text-align: center;
            color: #074159;
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 1rem;
            position: relative;
        }

        .section-title-why-us::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background-color: #ff5722;
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .why-us-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 4rem;
        }

        .why-us-card {
            background-color: #F6FAFA;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            padding: 2.5rem 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .why-us-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .why-us-icon {
            margin-bottom: 1.5rem;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .why-us-icon img {
            height: 48px;
            width: auto;
        }

        .why-us-title {
            color: #074159;
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 0.75rem;
        }

        .why-us-description {
            color: #425B66;
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
        }


        /* Hero Section */
        .hero-section {
            margin-top: 0px;
            height: calc(100vh - 80px);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            max-width: 900px;
            padding: 2rem;
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-content p {
            font-size: 1.25rem;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .cta-button {
            display: inline-block;
            background-color: #ff5722;
            color: white;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(255, 87, 34, 0.3);
        }

        .cta-button:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255, 87, 34, 0.4);
        }

        /* Products Section */
        .products-section {
            background-color: #F4F7F6;
            padding: 5rem 2rem;
        }

        .products-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            color: #074159;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: #ff5722;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }

        .product-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .product-content {
            padding: 2rem;
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            color: #074159;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .product-description {
            color: #666;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .product-button {
            display: inline-block;
            background-color: #ff5722;
            color: white;
            padding: 0.75rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s ease;
            align-self: center;
        }

        .product-button:hover {
            background-color: #e64a19;
            transform: scale(1.05);
        }

        /* Tombol Lihat Semua Produk & Artikel */
        .btn-lihat-semua-produk,
        .btn-lihat-semua-artikel {
            display: inline-block;
            background-color: #ff5722;
            color: white;
            padding: 14px 40px;
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            border-radius: 999px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
            font-family: 'Besley', serif;
        }

        .btn-lihat-semua-produk:hover,
        .btn-lihat-semua-artikel:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 87, 34, 0.4);
        }

        .btn-lihat-semua-produk:active,
        .btn-lihat-semua-artikel:active {
            transform: translateY(0);
        }

        /* Start Project CTA Section */
        .start-project {
            margin-top: 56px;
            background: linear-gradient(180deg, #2CBABA 0%, #074159 70%);
            color: #FFFFFF;
            text-align: center;
            padding: 64px 16px;
        }

        .start-project .sp-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 12px;
        }

        .start-project h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .start-project p {
            font-size: 16px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
            max-width: 760px;
            margin: 0 auto 22px;
        }

        .start-project .sp-button {
            display: inline-block;
            background-color: #ff5722;
            color: #ffffff;
            padding: 12px 22px;
            font-weight: 700;
            border-radius: 6px;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(255, 87, 34, 0.35);
            transition: transform .15s ease, box-shadow .15s ease, background-color .15s ease;
        }

        .start-project .sp-button:hover {
            background-color: #e64a19;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(255, 87, 34, 0.45);
        }

        @media (max-width: 768px) {
            .start-project {
                padding: 48px 14px;
                margin-top: 44px;
            }

            .start-project h2 {
                font-size: 26px;
                margin-bottom: 10px;
            }

            .start-project p {
                font-size: 14px;
                margin-bottom: 18px;
            }

            .start-project .sp-button {
                padding: 10px 18px;
            }
        }

        /* KOMITMEN */
        .commitment-section {
            position: relative;
            padding: 6rem 2rem;
            background-color: #074159;
            color: #ffffff;
            text-align: center;
            overflow: hidden;
        }

        /* Pseudo-element background blur commitment */
        .commitment-section::before {
            content: '';
            position: absolute;
            top: -5%;
            left: -5%;
            width: 110%;
            height: 110%;
            background-image: url('{{ asset('assets/img/ekspansibisnisS.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            /* INI UNTUK MENGATUR BLUR */
            filter: blur(5px);
            z-index: 1;
        }

        .commitment-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(19, 51, 60, 0.425);
            z-index: 0;
        }

        .commitment-container {
            max-width: 1100px;
            margin: 0 auto;
            position: relative;
            z-index: 3;
        }

        .section-title-commitment {
            font-size: 36px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 1rem;
            position: relative;
        }

        .section-title-commitment::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background-color: #ff5722;
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .section-description-commitment {
            font-size: 16px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
            max-width: 760px;
            margin: 2rem auto 3rem;
        }

        .commitment-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .commitment-card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 2.5rem 2rem;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .commitment-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .commitment-icon {
            margin-bottom: 1.5rem;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .commitment-icon img {
            height: 64px;
            width: auto;
        }

        .commitment-icon.icon-efisiensi {
            height: 90px;
            margin-bottom: 0.35rem;
        }

        .commitment-icon.icon-efisiensi img {
            height: 80px;
        }

        .commitment-title {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.75rem;
        }

        .commitment-description {
            font-size: 16px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
        }

        /* KOMITMEN 2*/

        .commitment-2-section {
            padding: 6rem 2rem;
            background-color: #ffffff;
            overflow: hidden;
        }

        .commitment-2-container {
            max-width: 1100px;
            margin: 0 auto;
            text-align: center;
        }

        .commitment-2-section h2 {
            font-size: 30px;
            font-weight: 700;
            color: #074159;
            line-height: 1.4;
            max-width: 8000px;
            margin: 0 auto 0.25rem auto;
        }

        .domino-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 3.5rem;
            margin-bottom: 0.5rem;
            padding: 3rem 0;
        }

        /* .domino-tab (Ini adalah card utama) */
        .domino-tab {
            position: relative;
            width: 130px;
            height: 250px;
            background: linear-gradient(145deg, #095a7c, #074159);
            border-radius: 8px;
            color: white;
            cursor: pointer;
            transition: transform 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            font-family: 'Besley', serif;
        }

        /* .domino-tab span (Teks di dalam card) */
        .domino-tab span {
            font-weight: 700;
            font-size: 1rem;
            text-align: center;
            line-height: 1.4;
            font-family: 'Besley', serif;
        }

        /* .domino-tab:hover (Efek saat di-hover) */
        .domino-tab:hover {
            transform: translate(6px, -6px);
        }


        .domino-content-wrapper {
            margin: 0 auto;
            text-align: left;
        }

        .domino-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .domino-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .domino-content h3 {
            font-size: 28px;
            font-weight: 700;
            color: #074159;
            margin-bottom: 1rem;
        }

        .domino-content p {
            font-size: 16px;
            color: #425B66;
            line-height: 1.6;
            margin-bottom: 2.5rem;
        }

        .orange-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .orange-box {
            background-color: #ff5722;
            color: white;
            padding: 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            line-height: 1.5;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-height: 120px;
            box-shadow: 0 4px 10px rgba(255, 87, 34, 0.2);
            font-family: 'Besley', serif;
        }

        /* --- CSS untuk Tombol Gambar Domino --- */

        /* 1. Atur tombol agar hanya gambar yang terlihat */
        /*  untuk memperbesar ukuran */
        .domino-nav .domino-tab {
            border: none;
            background: none;
            padding: 0;
            cursor: pointer;
            max-width: 160px;
            width: 80%;
        }

        /* 2. Pastikan gambar responsif di dalam tombol */
        .domino-nav .domino-tab img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* 3. Logika untuk menukar gambar */

        /* Sembunyikan gambar 'aktif' (oranye) secara default */
        .domino-nav .domino-tab .img-active {
            display: none;
        }

        /* Tampilkan gambar 'tidak aktif' (biru) secara default */
        .domino-nav .domino-tab .img-inactive {
            display: block;
        }

        /* 4. Saat tombol memiliki kelas '.active' */

        /* Tampilkan gambar 'aktif' (oranye) */
        .domino-nav .domino-tab.active .img-active {
            display: block;
        }

        /* Sembunyikan gambar 'tidak aktif' (biru) */
        .domino-nav .domino-tab.active .img-inactive {
            display: none;
        }

        .domino-nav {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;/ margin-bottom: 25px;
        }

        /*CSS ALUR PROSES KAMI*/
        .our-process-section {
            background-color: #ffffff;
            padding: 2rem 2rem 6rem;
            font-family: 'Besley', serif;
        }

        .our-process-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title-process {
            text-align: center;
            color: #074159;
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 1rem;
            position: relative;
        }

        .section-title-process::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background-color: #ff5722;
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .our-process-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1.5rem;
            margin-top: 4rem;
        }

        .our-process-step {
            text-align: center;
        }

        .process-image-wrapper {
            margin-bottom: 1.5rem;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .process-image-wrapper img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .our-process-step:hover .process-image-wrapper img {
            transform: scale(1.05);
        }

        .process-step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #074159;
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            border: 3px solid #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            margin-top: -30px;
            z-index: 2;
        }

        .process-step-title {
            color: #074159;
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 0.75rem;
        }

        .process-step-description {
            color: #425B66;
            font-size: 15px;
            line-height: 1.6;
            margin: 0;
        }

        /* === CSS CUSTOM DESIGN SECTION  === */
        .custom-design-section {
            background-color: #F4F7F6;
            /* Background abu-abu muda */
            padding: 6rem 2rem;
            font-family: 'Besley', serif;
        }

        .custom-design-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title-custom-design {
            text-align: center;
            color: #074159;
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 1rem;
            position: relative;
        }

        .section-title-custom-design::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background-color: #ff5722;
            margin: 10px auto 0;
            border-radius: 2px;
        }

        /* === CSS BARU UNTUK 3 GAMBAR === */
        .custom-design-image-grid {
            display: grid;
            grid-template-columns: 0.7fr 2fr 0.8fr;
            gap: 2rem;
            margin-top: 4rem;
            align-items: center;
        }

        .custom-design-image-item {
            width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            object-fit: cover;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-design-image-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.15);
        }

        /* === CSS UNTUK TOMBOL CTA BAWAH === */
        .custom-design-cta {
            text-align: center;
            margin-top: 3rem;
        }

        .cta-button-design-new {
            display: inline-block;
            align-items: center;
            justify-content: center;
            background-color: #ff5722;
            color: white;
            padding: 1rem 2.5rem;
            font-size: 1.2rem;
            font-weight: 700;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(255, 87, 34, 0.35);
            text-transform: none;
        }

        .cta-button-design-new:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(255, 87, 34, 0.45);
        }

        .cta-button-icon {
            width: 32px;
            height: 32px;
            fill: white;
        }

        /*FREE DESIGN SECTION*/
        .free-design-section {
            position: relative;
            background-color: #13333c;
            padding: 8rem 2rem;
            color: #ffffff;
            text-align: center;
            overflow: hidden;
            font-family: 'Besley', serif;
        }

        .free-design-section::before {
            content: '';
            position: absolute;
            top: -5%;
            left: -5%;
            width: 110%;
            height: 110%;
            background-image: url('{{ asset('assets/img/desainGr.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            /* INI UNTUK MENGATUR BLUR */
            filter: blur(6px);
            z-index: 0;
        }

        .free-design-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(19, 51, 60, 0.425);
            z-index: 1;
        }

        .free-design-container {
            max-width: 1100px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .free-design-subtitle {
            font-size: 1.3rem;
            font-weight: 600;
            text-transform: lowercase;
            letter-spacing: 1px;
            margin-bottom: -0.65rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .free-design-title {
            font-size: 3.25rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 0.75rem;
            position: relative;
            text-transform: uppercase;
        }

        .free-design-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background-color: #ff5722;
            margin: 0 auto 2rem;
            border-radius: 2px;
        }

        .free-design-description {
            font-size: 1.125rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
            max-width: 500px;
            margin: 0 auto 2.5rem;
        }

        .free-design-button {
            display: inline-block;
            background-color: #ff5722;
            color: #ffffff;
            padding: 0.875rem 2.25rem;
            font-weight: 700;
            font-size: 1.1rem;
            border-radius: 6px;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(255, 87, 34, 0.35);
            transition: transform .15s ease, box-shadow .15s ease, background-color .15s ease;
        }

        .free-design-button:hover {
            background-color: #e64a19;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(255, 87, 34, 0.45);
        }

        .skm-alert {
            padding: 15px;
            margin: 20px 3rem;
            border: 1px solid transparent;
            border-radius: 4px;
            font-size: 16px;
            position: relative;
            z-index: 1001;
            top: 80px;
        }

        .skm-alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .skm-alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        /* CSS untuk Tombol Disabled di Section BARU Anda (Rule #3) */
        .free-design-button.disabled {
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .free-design-button.disabled:hover {
            background-color: #ccc;
            /* Tetap sama saat di-hover */

        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .cta-button {
                padding: 0.875rem 2rem;
                font-size: 1rem;
            }

            .products-section {
                padding: 3rem 1.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .products-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }


            .why-us-section {
                padding: 4rem 1.5rem;
            }

            .section-title-why-us {
                font-size: 28px;
            }

            .why-us-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-top: 3rem;
            }

            .commitment-section {
                padding: 4rem 1.5rem;
                background-attachment: scroll;
            }

            .section-title-commitment {
                font-size: 28px;
            }

            .section-description-commitment {
                font-size: 14px;
                margin-bottom: 2rem;
                margin-top: 1.5rem;
            }

            .commitment-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            /* --- CSS RESPONSIVE KOMITMEN 2  --- */
            .commitment-2-section {
                padding: 4rem 1.5rem;
            }

            .commitment-2-section h2 {
                font-size: 24px;
                margin-bottom: 2rem;
            }

            .domino-nav {
                flex-wrap: wrap;
                gap: 1rem;
                margin-bottom: 3rem;
                padding: 0;
            }

            .domino-tab,
            .domino-tab:hover,
            .domino-tab.active {
                width: calc(50% - 0.5rem);
                height: 60px;
                transform: none;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                margin: 0;
            }

            .domino-tab span {
                transform: none;
                font-size: 0.875rem;
            }

            .domino-tab:last-child {
                width: 100%;
            }

            .domino-content-wrapper {
                text-align: center;
            }

            .domino-content h3 {
                font-size: 22px;
            }

            .domino-content p {
                font-size: 15px;
                text-align: left;
            }

            .orange-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .orange-box {
                font-size: 1rem;
                min-height: 80px;
                padding: 1rem;
            }

            /* --- CSS RESPONSIVE ALUR PROSES --- */
            .our-process-section {
                padding: 4rem 1.5rem;
            }

            .section-title-process {
                font-size: 28px;
            }

            .our-process-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
                margin-top: 3rem;
            }

            .process-image-wrapper img {
                height: 200px;
            }

            /* --- CSS RESPONSIVE CUSTOM DESIGN--- */
            .custom-design-section {
                padding: 4rem 1.5rem;
            }

            .section-title-custom-design {
                font-size: 28px;
            }

            .custom-design-image-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-top: 3rem;
            }

            .cta-button-design-new {
                font-size: 1.1rem;
                padding: 1rem 1.5rem;

            }

            .cta-button-icon {
                width: 24px;
                height: 24px;
            }

            /* --- CSS RESPONSIVE FREE DESIGN --- */
            .free-design-section {
                padding: 4rem 1.5rem;
                background-attachment: scroll;
            }

            .free-design-title {
                font-size: 28px;
            }

            .free-design-description {
                font-size: 14px;
            }

            .free-design-button {
                padding: 10px 18px;
            }

        }

        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 0.9rem;
            }
        }

        /* CSS Untuk Artikel Section dari file Anda */
        .skm-articles {
            background: #F4F7F6;
            padding: 56px 16px 70px;
            font-family: 'Besley', serif;
        }

        .skm-a-wrap {
            max-width: 980px;
            margin: 0 auto;
        }

        .skm-articles h2 {
            color: #074159;
            font-size: 36px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 18px;
        }

        .skm-articles h2::after {
            content: "";
            display: block;
            width: 56px;
            height: 4px;
            background: #ff5722;
            border-radius: 2px;
            margin: 8px auto 0;
        }

        .skm-a-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
            margin-top: 26px;
        }

        @media (max-width: 900px) {
            .skm-a-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .skm-a-grid {
                grid-template-columns: 1fr;
            }
        }

        .skm-a-card {
            background: #FFFFFF;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .skm-a-card .thumb {
            height: 160px;
            overflow: hidden;
        }

        .skm-a-card .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .skm-a-card .body {
            padding: 14px 16px 16px;
        }

        .skm-a-card .title {
            color: #074159;
            font-size: 18px;
            font-weight: 800;
            line-height: 1.35;
            margin: 0 0 8px;
        }

        .skm-a-card .deskripsi {
            color: #425B66;
            font-size: 15px;
            line-height: 1.6;
            margin: 0 0 12px;
        }

        .skm-a-card .more {
            color: #ff5722;
            font-weight: 800;
            text-decoration: none;
        }

        .skm-a-card .more:hover {
            text-decoration: underline;
        }

        @media (max-width: 640px) {
            .skm-articles h2 {
                font-size: 28px;
            }

            .skm-a-card .title {
                font-size: 16px;
            }

            .skm-a-card .deskripsi {
                font-size: 14px;
            }
        }

        /* CSS Untuk Testimoni Section dari file Anda */
        .skm-testimonials {
            background: #FFFFFF;
            padding: 60px 16px 70px;
            font-family: 'Besley', serif;
        }

        .skm-t-wrap {
            max-width: 1100px;
            margin: 0 auto;
        }

        .skm-testimonials h2 {
            color: #074159;
            font-size: 36px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 18px;
        }

        .skm-testimonials h2::after {
            content: "";
            display: block;
            width: 66px;
            height: 4px;
            background: #ff5722;
            border-radius: 2px;
            margin: 8px auto 0;
        }

        .skm-t-single {
            max-width: 820px;
            margin: 0 auto;
            background: #F6FAFA;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            padding: 22px 24px;
            text-align: center;
        }

        .skm-t-single .quote {
            color: #074159;
            font-size: 17px;
            line-height: 1.65;
            margin: 0 0 6px;
            font-style: normal;
            letter-spacing: 0.2px;
        }

        .skm-t-single .credit {
            color: #074159;
            margin: 0;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0.2px;
        }

        .skm-t-single .credit strong {
            font-weight: 800;
        }

        @media (max-width: 640px) {
            .skm-testimonials h2 {
                font-size: 28px;
            }

            .skm-t-single {
                padding: 18px;
            }

            .skm-t-single .quote {
                font-size: 16px;
            }

            .skm-t-single .credit {
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <section class="hero-section">
        <img src="{{ asset('assets/img/Section.png') }}" alt="Background" class="hero-background">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Protect Your Value</h1>
            <p>Menjadi partner sejarah pertumbuhan bisnis anda dengan menyediakan proteksi yang dapat menciptakan
                ekosistem bisnis yang berkelanjutan</p>
            <a href="{{ url('/produk') }}" class="cta-button">Lihat Produk Kami</a>
        </div>
    </section>

    <section class="why-us-section" aria-labelledby="why-us-title">
        <div class="why-us-container">
            <h2 class="section-title-why-us" id="why-us-title">Mengapa Memilih Sikemas?</h2>
            <div class="why-us-grid">

                <div class="why-us-card">
                    <div class="why-us-icon">
                        <img src="{{ asset('assets/img/Symbol13.svg') }}" alt="">
                    </div>
                    <h3 class="why-us-title">Kustomisasi Tanpa Batas</h3>
                    <p class="why-us-description">Kami wujudkan ide desain Anda menjadi kemasan yang unik dan personal.
                    </p>
                </div>

                <div class="why-us-card">
                    <div class="why-us-icon">
                        <img src="{{ asset('assets/img/Symbol14.svg') }}" alt="">
                    </div>
                    <h3 class="why-us-title">Konsultasi Ahli</h3>
                    <p class="why-us-description">Tim profesional kami siap membantu Anda dari ide awal hingga produk
                        jadi.</p>
                </div>

                <div class="why-us-card">
                    <div class="why-us-icon">
                        <img src="{{ asset('assets/img/Container5.svg') }}" alt="">
                    </div>
                    <h3 class="why-us-title">Layanan Cepat & Andal</h3>
                    <p class="why-us-description">Proses produksi dan pengiriman kami dirancang untuk efisiensi dan
                        ketepatan waktu.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="products-section">
        <div class="products-container">
            <h2 class="section-title">Produk Unggulan Kami</h2>

            <div class="products-grid">
                @if(isset($products) && $products->count() > 0)
                    @foreach($products->take(3) as $product)
                    <div class="product-card">
                        @php
                            $productImage = null;
                            if (!empty($product->image)) {
                                $productImage = asset('storage/' . $product->image);
                            } elseif (!empty($product->featured_image)) {
                                $productImage = asset('storage/' . $product->featured_image);
                            } elseif (!empty($product->thumbnail)) {
                                $productImage = asset('storage/' . $product->thumbnail);
                            } else {
                                $productImage = asset('assets/img/Rectangle12.png');
                            }
                        @endphp
                        <img src="{{ $productImage }}"
                             alt="{{ $product->name }}"
                             class="product-image"
                             onerror="this.onerror=null; this.src='{{ asset('assets/img/Rectangle12.png') }}';">
                        <div class="product-content">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-description">{{ Str::limit(strip_tags($product->description ?? 'Produk berkualitas dari Sikemas'), 100) }}</p>
                            <a href="{{ route('produk') }}" class="product-button">Pesan Sekarang</a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="product-card">
                        <img src="{{ asset('assets/img/Rectangle12.png') }}" alt="Kotak Kemasan Khusus" class="product-image">
                        <div class="product-content">
                            <h3 class="product-title">Kotak Kemasan Khusus</h3>
                            <p class="product-description">Didesain untuk memenuhi kebutuhan spesifik produk Anda, dari ukuran hingga finishing.</p>
                            <a href="{{ route('produk') }}" class="product-button">Pesan Sekarang</a>
                        </div>
                    </div>

                    <div class="product-card">
                        <img src="{{ asset('assets/img/Rectangle12.png') }}" alt="Karton Bergelombang" class="product-image">
                        <div class="product-content">
                            <h3 class="product-title">Karton Bergelombang</h3>
                            <p class="product-description">Kekuatan dan ketahanan optimal untuk pengiriman dan penyimpanan yang aman.</p>
                            <a href="{{ route('produk') }}" class="product-button">Pesan Sekarang</a>
                        </div>
                    </div>

                    <div class="product-card">
                        <img src="{{ asset('assets/img/Rectangle12.png') }}" alt="Kemasan Ramah Lingkungan" class="product-image">
                        <div class="product-content">
                            <h3 class="product-title">Kemasan Ramah Lingkungan</h3>
                            <p class="product-description">Solusi kemasan berkelanjutan yang terbuat dari bahan daur ulang dan dapat didaur ulang.</p>
                            <a href="{{ route('produk') }}" class="product-button">Pesan Sekarang</a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Tombol Lihat Semua Produk -->
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('produk') }}" class="btn-lihat-semua-produk">Lihat Semua Produk</a>
            </div>
        </div>
    </section>

    <section class="commitment-section" aria-labelledby="commitment-title-id">
        <div class="commitment-overlay"></div>
        <div class="commitment-container">
            <h2 class="section-title-commitment" id="commitment-title-id">Komitmen Terhadap Bisnis Berkelanjutan</h2>
            <p class="section-description-commitment">
                Kami percaya bahwa kemasan yang baik tidak only melindungi produk, tetapi juga planet kita.
                Sikemas berkomitmen untuk menggunakan bahan baku yang bertanggung jawab dan proses produksi
                yang efisien untuk mengurangi dampak lingkungan.
            </p>
            <div class="commitment-grid">

                <div class="commitment-card">
                    <div class="commitment-icon">
                        <img src="{{ asset('assets/img/ContainerR.png') }}" alt="Bahan Berkualitas">
                    </div>
                    <h3 class="commitment-title">Bahan Berkualitas</h3>
                    <p class="commitment-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                        lobortis justo non condimentum efficitur.</p>
                </div>

                <div class="commitment-card">
                    <div class="commitment-icon">
                        <img src="{{ asset('assets/img/ContainerT.png') }}" alt="Bisnis Berkelanjutan">
                    </div>
                    <h3 class="commitment-title">Bisnis Berkelanjutan</h3>
                    <p class="commitment-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                        lobortis justo non condimentum efficitur.</p>
                </div>

                <div class="commitment-card">
                    <div class="commitment-icon icon-efisiensi">
                        <img src="{{ asset('assets/img/icon.png') }}" alt="Efisiensi Biaya">
                    </div>
                    <h3 class="commitment-title">Efisiensi Biaya</h3>
                    <p class="commitment-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                        lobortis justo non condimentum efficitur.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="commitment-2-section" aria-labelledby="commitment-2-title">
        <div class="commitment-2-container">
            <h2 id="commitment-2-title">Berkarya dengan hati untuk dedikasi menjadi partner membangun<br>bisnis yang
                berkelanjutan</h2>

            <nav class="domino-nav" aria-label="Komitmen Kami">

                <button class="domino-tab active" data-target="content-eco">
                    <img src="/assets/KomSect/EcoB.png" alt="Eco Solutions" class="img-inactive">
                    <img src="/assets/KomSect/EcoKlik.png" alt="Eco Solutions" class="img-active">
                </button>

                <button class="domino-tab" data-target="content-guidance">
                    <img src="/assets/KomSect/GuidenceB.png" alt="Guidance" class="img-inactive">
                    <img src="/assets/KomSect/GuidenceKlik.png" alt="Guidance" class="img-active">
                </button>

                <button class="domino-tab" data-target="content-quality">
                    <img src="/assets/KomSect/QB.png" alt="Quality & Delivery" class="img-inactive">
                    <img src="/assets/KomSect/QKlik.png" alt="Quality & Delivery" class="img-active">
                </button>

                <button class="domino-tab" data-target="content-transparency">
                    <img src="/assets/KomSect/TransparencyB.png" alt="Transparency" class="img-inactive">
                    <img src="/assets/KomSect/TKlik.png" alt="Transparency" class="img-active">
                </button>

                <button class="domino-tab" data-target="content-innovations">
                    <img src="/assets/KomSect/InnovationsB.png" alt="Innovations" class="img-inactive">
                    <img src="/assets/KomSect/InnovationsKlik.png" alt="Innovations" class="img-active">
                </button>

            </nav>

            <div class="domino-content-wrapper">

                <div class="domino-content active" id="content-eco">
                    <h3>The world Need Sustainable Packaging</h3>
                    <p>Meskipun banyak produsen menawarkan harga yang terkesan ekonomis, kualitas produk yang dihasilkan
                        sering kali Anda tidak optimal. Pilihan yang tampak murah di awal justru dapat menimbulkan
                        kerugian jangka panjang bagi bisnis Anda.</p>
                    <div class="orange-grid">
                        <div class="orange-box">Solusi paling sirkular di setiap kategori.</div>
                        <div class="orange-box">Pilihan bervariasi untuk kemasan, kardus, dan banyak lagi</div>
                        <div class="orange-box">Branding dan Desain Custom untuk setiap pilihan kemasan</div>
                        <div class="orange-box">Solusi untuk merek D2C sangat bervariasi</div>
                    </div>
                </div>

                <div class="domino-content" id="content-guidance">
                    <h3>Guidance & Support</h3>
                    <p>Kami memandu Anda melalui setiap langkah, dari konsep hingga kenyataan. Tim ahli kami siap
                        membantu Anda menemukan solusi kemasan terbaik untuk kebutuhan spesifik Anda, memastikan Anda
                        membuat pilihan yang tepat.</p>
                    <div class="orange-grid">
                        <div class="orange-box">Konsultasi Desain Gratis</div>
                        <div class="orange-box">Dukungan Teknis Ahli</div>
                        <div class="orange-box">Pemilihan Material Terbaik</div>
                        <div class="orange-box">Prototyping Cepat</div>
                    </div>
                </div>

                <div class="domino-content" id="content-quality">
                    <h3>Quality & Delivery</h3>
                    <p>Kualitas adalah janji kami. Kami menggunakan material terbaik dan proses produksi yang ketat
                        untuk memastikan setiap kemasan kokoh dan sempurna. Pengiriman tepat waktu adalah prioritas kami
                        agar bisnis Anda terus berjalan lancar.</p>
                    <div class="orange-grid">
                        <div class="orange-box">Kontrol Kualitas Berlapis</div>
                        <div class="orange-box">Jaminan Tepat Waktu</div>
                        <div class="orange-box">Material Premium Teruji</div>
                        <div class="orange-box">Garansi Produk</div>
                    </div>
                </div>

                <div class="domino-content" id="content-transparency">
                    <h3>Transparency</h3>
                    <p>Kami percaya pada kemitraan yang jujur. Anda akan mendapatkan informasi yang jelas dan terbuka
                        mengenai harga, material, dan proses produksi. Tidak ada biaya tersembunyi, hanya komitmen tulus
                        untuk kesuksesan Anda.</p>
                    <div class="orange-grid">
                        <div class="orange-box">Harga Jujur Tanpa Biaya Tersembunyi</div>
                        <div class="orange-box">Pelacakan Proses Produksi</div>
                        <div class="orange-box">Spesifikasi Material Jelas</div>
                        <div class="orange-box">Komunikasi Proaktif</div>
                    </div>
                </div>

                <div class="domino-content" id="content-innovations">
                    <h3>Innovations</h3>
                    <p>Dunia terus berubah, begitu pula kami. Sikemas terus berinovasi dalam teknologi dan desain untuk
                        memberikan Anda solusi kemasan yang tidak only fungsional tetapi juga modern dan terdepan di
                        pasar.</p>
                    <div class="orange-grid">
                        <div class="orange-box">Teknologi Cetak Terbaru</div>
                        <div class="orange-box">Desain Kemasan Pintar (Smart Packaging)</div>
                        <div class="orange-box">Riset Material Baru</div>
                        <div class="orange-box">Solusi Otomatisasi Kemasan</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="our-process-section" aria-labelledby="process-title">
        <div class="our-process-container">
            <h2 class="section-title-process" id="process-title">Alur Proses Kami</h2>
            <div class="our-process-grid">

                <div class="our-process-step">
                    <div class="process-image-wrapper">
                        <img src="{{ asset('assets/img/alur1.png') }}" alt="Konsultasi dan Desain">
                    </div>
                    <div class="process-step-number">1</div>
                    <h3 class="process-step-title">Konsultasi & Desain</h3>
                    <p class="process-step-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                        lobortis justo</p>
                </div>

                <div class="our-process-step">
                    <div class="process-image-wrapper">
                        <img src="{{ asset('assets/img/alur2.png') }}" alt="Pemilihan Material">
                    </div>
                    <div class="process-step-number">2</div>
                    <h3 class="process-step-title">Pemilihan Material</h3>
                    <p class="process-step-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                        lobortis justo</p>
                </div>

                <div class="our-process-step">
                    <div class="process-image-wrapper">
                        <img src="{{ asset('assets/img/alur3.png') }}" alt="Purchase / Dealing">
                    </div>
                    <div class="process-step-number">3</div>
                    <h3 class="process-step-title">Purchase / Dealing</h3>
                    <p class="process-step-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                        lobortis justo</p>
                </div>

                <div class="our-process-step">
                    <div class="process-image-wrapper">
                        <img src="{{ asset('assets/img/alur4.png') }}" alt="Produksi & Kontrol Kualitas">
                    </div>
                    <div class="process-step-number">4</div>
                    <h3 class="process-step-title">Produksi & Kontrol Kualitas</h3>
                    <p class="process-step-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                        lobortis justo</p>
                </div>

                <div class="our-process-step">
                    <div class="process-image-wrapper">
                        <img src="{{ asset('assets/img/alur5.png') }}" alt="Pengiriman">
                    </div>
                    <div class="process-step-number">5</div>
                    <h3 class="process-step-title">Pengiriman</h3>
                    <p class="process-step-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                        lobortis justo</p>
                </div>

            </div>
        </div>
    </section>

    <section class="custom-design-section" aria-labelledby="custom-design-title">
        <div class="custom-design-container">
            <h2 class="section-title-custom-design" id="custom-design-title">Custom Desain Anda Sendiri</h2>

            <div class="custom-design-image-grid">
                <img src="{{ asset('assets/img/custom1.png') }}" alt="Contoh Desain Box 1"
                    class="custom-design-image-item">
                <img src="{{ asset('assets/img/custom2.png') }}" alt="Contoh Desain Box 2"
                    class="custom-design-image-item">
                <img src="{{ asset('assets/img/custom3.png') }}" alt="Contoh Desain Box 3"
                    class="custom-design-image-item">
            </div>

            <div class="custom-design-cta">
                <a href="{{ url('/edit-design') }}" class="cta-button-design-new">
                    Buat Desain Sendiri Sekarang
                </a>
            </div>
        </div>
    </section>

    <section class="free-design-section" aria-labelledby="free-design-title">
        <div class="free-design-overlay"></div>
        <div class="free-design-container">
            <p class="free-design-subtitle">konsultasi</p>
            <h2 class="free-design-title" id="free-design-title">DESAIN GRATIS</h2>
            <p class="free-design-description">Kami siap membuat ide desainmu menjadi nyata. Konsultasikan sekarang
                juga secara gratis!</p>

            {{-- JIKA PENGGUNA BELUM LOGIN (GUEST) --}}
            @guest
                <a href="{{ route('login') }}" class="free-design-button" id="login-prompt-button"
                    aria-label="Konsultasi Gratis Sekarang (Login diperlukan)">
                    Konsultasi Gratis Sekarang
                </a>
            @endguest

            {{-- JIKA PENGGUNA SUDAH LOGIN --}}
            @auth
                {{-- Cek jika user punya konsultasi aktif --}}
                @if (Auth::user()->hasActiveConsultation())
                    {{-- Tampilkan tombol nonaktif --}}
                    <button class="free-design-button disabled" disabled
                        title="Anda sudah memiliki permintaan konsultasi aktif. Satu pengguna hanya bisa melakukan 1 kali konsultasi sampai sesi konsultasi berakhir.">
                        Menunggu Sesi Konsultasi
                    </button>
                @else
                    {{-- Tombol aktif. Gunakan ID "request-consultation-button" untuk AJAX --}}
                    <button type="button" class="free-design-button" id="request-consultation-button"
                        aria-label="Konsultasi Gratis Sekarang"
                        data-phone-filled="{{ Auth::user()->phone ? 'true' : 'false' }}"
                        data-profile-url="{{ route('profile.index') }}">
                        Konsultasi Gratis Sekarang
                    </button>
                @endif
            @endauth

        </div>
    </section>

    <section class="skm-articles" aria-labelledby="articles-title">
        <div class="skm-a-wrap">
            <h2 id="articles-title">Artikel &amp; Berita</h2>
            <div class="skm-a-grid">
                @if (isset($articles) && $articles->count() > 0)
                    @foreach ($articles->take(3) as $article)
                        <article class="skm-a-card">
                            <div class="thumb">
                                @php
                                    // Cek berbagai kemungkinan field gambar
                                    $articleImage = null;
                                    if (!empty($article->image)) {
                                        $articleImage = asset('storage/' . $article->image);
                                    } elseif (!empty($article->featured_image)) {
                                        $articleImage = asset('storage/' . $article->featured_image);
                                    } elseif (!empty($article->thumbnail)) {
                                        $articleImage = asset('storage/' . $article->thumbnail);
                                    } else {
                                        $articleImage = asset('assets/img/Article-image.png');
                                    }
                                @endphp
                                <img src="{{ $articleImage }}" alt="{{ $article->title }}"
                                    onerror="this.onerror=null; this.src='{{ asset('assets/img/Article-image.png') }}';">
                            </div>
                            <div class="body">
                                <h3 class="title">{{ $article->title }}</h3>
                                <p class="deskripsi">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                                <a class="more" href="{{ route('detail_artikel', $article->slug) }}"
                                    aria-label="Baca selengkapnya {{ $article->title }}">Baca Selengkapnya</a>
                            </div>
                        </article>
                    @endforeach
                @else
                    <article class="skm-a-card">
                        <div class="thumb">
                            <img src="{{ asset('assets/img/Article-image.png') }}"
                                alt="Trend Kemasan Ramah Lingkungan">
                        </div>
                        <div class="body">
                            <h3 class="title">Trend Kemasan Ramah Lingkungan</h3>
                            <p class="deskripsi">Membahas inovasi terbaru dalam industri kemasan karton yang
                                berkelanjutan dan ramah lingkungan.</p>
                            <a class="more" href="{{ route('artikel') }}"
                                aria-label="Baca selengkapnya Trend Kemasan Ramah Lingkungan">Baca Selengkapnya</a>
                        </div>
                    </article>
                    <article class="skm-a-card">
                        <div class="thumb">
                            <img src="{{ asset('assets/img/Article-image.png') }}"
                                alt="Pentingnya Kemasan yang Tepat">
                        </div>
                        <div class="body">
                            <h3 class="title">Pentingnya Kemasan yang Tepat</h3>
                            <p class="deskripsi">Bagaimana kemasan yang kuat dan menarik dapat meningkatkan nilai jual
                                produk Anda.</p>
                            <a class="more" href="{{ route('artikel') }}"
                                aria-label="Baca selengkapnya Pentingnya Kemasan yang Tepat">Baca Selengkapnya</a>
                        </div>
                    </article>
                    <article class="skm-a-card">
                        <div class="thumb">
                            <img src="{{ asset('assets/img/Article-image.png') }}" alt="Proses Produksi Kami">
                        </div>
                        <div class="body">
                            <h3 class="title">Proses Produksi Kami</h3>
                            <p class="deskripsi">Mengintip proses di balik produksi kemasan karton berkualitas tinggi
                                di pabrik Sikemas.</p>
                            <a class="more" href="{{ route('artikel') }}"
                                aria-label="Baca selengkapnya Proses Produksi Kami">Baca Selengkapnya</a>
                        </div>
                    </article>
                @endif
            </div>

            <!-- Tombol Lihat Semua Artikel -->
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('artikel') }}" class="btn-lihat-semua-artikel">Lihat Semua Artikel</a>
            </div>
        </div>
    </section>

    <section class="skm-testimonials" aria-labelledby="testi-title">
        <div class="skm-t-wrap">
            <h2 id="testi-title">Apa Kata Klien Kami</h2>
            <div class="skm-t-single">
                <blockquote class="quote">
                    “Sikemas selalu memberikan kemasan yang kokoh dan tepat waktu. Hasilnya tidak pernah mengecewakan.”
                </blockquote>
                <p class="credit">— John Doe, <strong>CEO Perusahaan Makanan</strong></p>
            </div>
        </div>
    </section>

    @include('sections.faq')

    <section class="start-project" aria-labelledby="sp-title">
        <div class="sp-container">
            <h2 id="sp-title">Siap memulai proyek Anda?</h2>
            <p>Hubungi kami hari ini untuk konsultasi gratis dan wujudkan kemasan impian Anda.</p>
            <a href="#" class="sp-button" aria-label="Hubungi Kami">Hubungi Kami</a>
        </div>
    </section>

    @include('layouts.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hamburgerButton = document.getElementById('navbar-hamburger');
            const mobileMenu = document.getElementById('navbar-mobile-menu');

            // Toggle open/close on hamburger
            hamburgerButton.addEventListener('click', function () {
                mobileMenu.classList.toggle('active');
                const expanded = hamburgerButton.getAttribute('aria-expanded') === 'true';
                hamburgerButton.setAttribute('aria-expanded', String(!expanded));
            });

            // Helper to close the mobile menu safely
            function closeMobileMenu() {
                if (mobileMenu.classList.contains('active')) {
                    mobileMenu.classList.remove('active');
                    hamburgerButton.setAttribute('aria-expanded', 'false');
                }
            }

            // 1) Click outside closes the menu (mobile)
            document.addEventListener('click', function (e) {
                const clickInsideMenu = mobileMenu.contains(e.target);
                const clickOnHamburger = hamburgerButton.contains(e.target);
                if (!clickInsideMenu && !clickOnHamburger) {
                    closeMobileMenu();
                }
            });

            // 2) Pressing Escape closes the menu
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeMobileMenu();
                }
            });

            // 3) Clicking a link inside the menu closes it
            mobileMenu.querySelectorAll('a').forEach(a => {
                a.addEventListener('click', function () {
                    closeMobileMenu();
                });
            });

            // --- SCRIPT BARU UNTUK KOMITMEN 2 ---
            const dominoTabs = document.querySelectorAll('.domino-tab');
            const dominoContents = document.querySelectorAll('.domino-content');

        dominoTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetId = tab.dataset.target;
                const targetContent = document.getElementById(targetId);

                dominoTabs.forEach(t => t.classList.remove('active'));
                dominoContents.forEach(c => c.classList.remove('active'));

                tab.classList.add('active');
                targetContent.classList.add('active');
            });
        });

            // --- Script Login Prompt ---
            const loginButton = document.getElementById('login-prompt-button');
            if (loginButton) {
                loginButton.addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah link langsung berpindah
                    const loginUrl = this.href;

                    // Ganti alert() dengan Swal.fire()
                    Swal.fire({
                        icon: 'info',
                        title: 'Login Diperlukan',
                        text: 'Anda harus login terlebih dahulu untuk melakukan konsultasi.',
                        confirmButtonText: 'Login Sekarang',
                        allowOutsideClick: false
                    }).then(() => {
                        // Arahkan ke halaman login setelah popup ditutup
                        window.location.href = loginUrl;
                    });
                });
            }

            // =======================
            // KODE REQUEST KONSULTASI
            // =======================
            const requestButton = document.getElementById('request-consultation-button');
            if (requestButton) {
                requestButton.addEventListener('click', async function() {
                    // Ambil data dari attribute
                    const isPhoneFilled = requestButton.dataset.phoneFilled === 'true';
                    const profileUrl = requestButton.dataset.profileUrl;

                    // Cek apakah nomor telepon sudah diisi
                    if (!isPhoneFilled) {
                        // Ganti alert() dengan Swal.fire()
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Belum Lengkap',
                            text: 'Anda harus melengkapi nomor telepon Anda di halaman Profil Saya sebelum dapat melakukan konsultasi.',
                            confirmButtonText: 'Lengkapi Profil',
                            allowOutsideClick: false
                        }).then(() => {
                            // Arahkan ke halaman profil setelah popup ditutup
                            window.location.href = profileUrl;
                        });
                        return; // Hentikan eksekusi
                    }

                    // Nonaktifkan visual tombol saat proses (Ini sudah bagus, tetap pertahankan)
                    requestButton.disabled = true;
                    requestButton.textContent = 'Memproses...';
                    requestButton.classList.add('disabled');

                    try {
                        const response = await fetch('{{ route('consultation.request') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                        });

                        const data = await response.json();

                        if (response.ok) {
                            // SUKSES: Ganti alert() dengan Swal.fire()
                            Swal.fire({
                                icon: 'success',
                                title: 'Permintaan Terkirim!',
                                text: data.message,
                                timer: 25000,
                                timerProgressBar: true
                            }).then(() => {
                                // Refresh halaman setelah popup sukses
                                window.location.reload();
                            });

                        } else {
                            // ERROR (Rule #3 atau error validasi)

                            // Cek jika ini adalah error 'redirect' dari controller
                            if (response.status === 403 && data.redirect) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: data.message,
                                }).then(() => {
                                    window.location.href = data.redirect;
                                });
                            } else {
                                // Tampilkan error lain
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Mengajukan Konsultasi',
                                    text: data.message,
                                });
                            }

                            // Kembalikan tombol ke keadaan semula jika error
                            requestButton.disabled = false;
                            requestButton.textContent = 'Konsultasi Gratis Sekarang';
                            requestButton.classList.remove('disabled');
                        }
                    } catch (error) {
                        console.error('Error:', error);

                        // ERROR KONEKSI: Ganti alert() dengan Swal.fire()
                        Swal.fire({
                            icon: 'error',
                            title: 'Koneksi Gagal',
                            text: 'Terjadi kesalahan koneksi. Silakan coba lagi.',
                        });

                        // Kembalikan tombol ke keadaan semula jika error
                        requestButton.disabled = false;
                        requestButton.textContent = 'Konsultasi Gratis Sekarang';
                        requestButton.classList.remove('disabled');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan koneksi. Silakan coba lagi.');

                    // Kembalikan tombol ke keadaan semula
                    requestButton.disabled = false;
                    requestButton.textContent = 'Konsultasi Gratis Sekarang';
                    requestButton.classList.remove('disabled');
                }
            });
        }

            // --- Script Touch Hover Navbar ---
            const navLinks = document.querySelectorAll('.navbar-menu a');
            if (navLinks && navLinks.length) {
                const addTouch = (e) => {
                    e.currentTarget.classList.add('touch-hover');
                };
                const removeTouch = (e) => {
                    e.currentTarget.classList.remove('touch-hover');
                };
                navLinks.forEach(a => {
                    a.addEventListener('touchstart', addTouch, { passive: true });
                    a.addEventListener('touchend', removeTouch, { passive: true });
                    a.addEventListener('touchcancel', removeTouch, { passive: true });
                    a.addEventListener('blur', removeTouch);
                    a.addEventListener('click', removeTouch);
                });
            }
        });
    </script>
</body>

</html>
