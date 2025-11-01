<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKEMAS - Protect Your Value</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Besley', serif;
            background-color: #f5f5ff;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #ffffff;
            padding: 1rem 3rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            height: 80px;
            display: flex;
            align-items: center;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
            gap: 2rem;
            width: 100%;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 3rem;
            margin-left: auto;
        }

        .navbar-logo img {
            height: 50px;
            width: auto;
            display: block;
        }

        .navbar-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .navbar-menu li a {
            text-decoration: none;
            color: #074159;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .navbar-menu li a:hover {
            color: #053244;
        }

        .navbar-profile {
            display: flex;
            align-items: center;
        }

        /* Profile Icon Styles */
        .profile-icon {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: transparent;
            padding: 0;
        }

        .profile-icon:hover {
            background-color: #f0f0f0;
        }

        .profile-icon svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: #074159;
            stroke-width: 1.5;
            transition: stroke 0.3s ease;
        }

        .profile-icon:hover svg {
            stroke: #053244;
        }

        .navbar-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin-left: auto;
            z-index: 1001;
        }

        .hamburger-icon {
            display: flex;
            flex-direction: column;
            gap: 5px;
            width: 24px;
            height: 20px;
            justify-content: center;
        }

        .hamburger-icon .bar {
            height: 3px;
            width: 100%;
            background-color: #074159;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        /* CSS UNTUK PROFIL DROPDOWN (Guest & Logged In) */
        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .profile-dropdown-menu {
            display: none; /* Sembunyikan secara default */
            position: absolute;
            right: 0;
            top: 100%; /* <-- UBAH INI (dari 140%) */
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            min-width: 220px;
            z-index: 1001;
            overflow: hidden;
            padding-top: 1rem; /* <-- UBAH INI (dari 0.5rem) */
            padding-bottom: 0.5rem;
        }

        .profile-dropdown:hover .profile-dropdown-menu {
            display: block;
        }

        /* Header khusus untuk user yang sudah login */
        .profile-dropdown-menu .dropdown-header {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 0.5rem;
        }
        .profile-dropdown-menu .dropdown-header span {
            display: block;
            font-weight: 700;
            color: #074159;
            white-space: nowrap;
        }
        .profile-dropdown-menu .dropdown-header small {
            color: #666;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .profile-dropdown-menu a {
            display: block;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: #333;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .profile-dropdown-menu a:hover {
            background-color: #f5f5f5;
            color: #074159;
        }

        .profile-dropdown-menu .dropdown-divider {
            height: 1px;
            background-color: #f0f0f0;
            margin: 0.5rem 0;
        }

        /* Tombol "Daftar" di dropdown */
        .profile-dropdown-menu a.dropdown-button-primary {
            margin: 0.5rem 1rem 0;
            padding: 0.75rem 1rem;
            background-color: #ff5722;
            color: white;
            text-align: center;
            border-radius: 4px;
            font-weight: 600;
        }
        .profile-dropdown-menu a.dropdown-button-primary:hover {
            background-color: #e64a19;
            color: white;
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
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            padding: 2.5rem 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .why-us-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
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
            margin-top: 80px;
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
            color: rgba(255,255,255,0.9);
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
            .start-project { padding: 48px 14px; margin-top: 44px; }
            .start-project h2 { font-size: 26px; margin-bottom: 10px; }
            .start-project p { font-size: 14px; margin-bottom: 18px; }
            .start-project .sp-button { padding: 10px 18px; }
        }

        /* KOMITMEN */
        .commitment-section {
            position: relative;
            padding: 6rem 2rem;
            background-image: url('{{ asset('assets/img/ekspansibisnisS.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ffffff;
            text-align: center;
            overflow: hidden;
        }
        .commitment-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(7, 65, 89, 0.9);
            z-index: 1;
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
            background: linear-gradient(145deg, #095a7c, #074159); /* Gradient biru */
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

            /* EFEK SHADOW 3D TEBAL (10 lapis) - ATAS & KANAN */
            box-shadow: 1px -1px #053244,
                        2px -2px #053244,
                        3px -3px #053244,
                        4px -4px #053244,
                        5px -5px #053244,
                        6px -6px #053244,
                        7px -7px #053244,
                        8px -8px #053244,
                        9px -9px #053244,
                        10px -10px #053244,
                        10px -10px 15px rgba(0,0,0,0.2);
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

            /* Bayangan memanjang saat hover (12 lapis) */
            box-shadow: 1px -1px #053244,
                        2px -2px #053244,
                        3px -3px #053244,
                        4px -4px #053244,
                        5px -5px #053244,
                        6px -6px #053244,
                        7px -7px #053244,
                        8px -8px #053244,
                        9px -9px #053244,
                        10px -10px #053244,
                        11px -11px #053244,
                        12px -12px #053244,
                        12px -12px 20px rgba(0,0,0,0.25);
        }

        /* Style untuk tab AKTIF (Orange) */
        .domino-tab.active {
            background: linear-gradient(145deg, #ff7a50, #ff5722); /* Gradient orange */
            transform: translate(6px, -6px);

            /* Shadow warna orange (12 lapis) */
            box-shadow: 1px -1px #e64a19,
                        2px -2px #e64a19,
                        3px -3px #e64a19,
                        4px -4px #e64a19,
                        5px -5px #e64a19,
                        6px -6px #e64a19,
                        7px -7px #e64a19,
                        8px -8px #e64a19,
                        9px -9px #e64a19,
                        10px -10px #e64a19,
                        11px -11px #e64a19,
                        12px -12px #e64a19,
                        12px -12px 20px rgba(0,0,0,0.25);
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
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
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

        /*CSS ALUR PROSES KAMI*/
        .our-process-section {
            background-color: #ffffff;
            /* padding: 6rem 2rem; */ /* <-- DIUBAH */
            padding: 2rem 2rem 6rem; /* <-- Jarak atas dikurangi, jarak bawah tetap 6rem */
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
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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

        /* =========================================== */
        /* === CSS CUSTOM DESIGN SECTION (DIUBAH) === */
        /* =========================================== */
        .custom-design-section {
            background-color: #F4F7F6; /* Background abu-abu muda */
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
            background-image: url('{{ asset('assets/img/desainGr.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 8rem 2rem;
            color: #ffffff;
            text-align: center;
            overflow: hidden;
            font-family: 'Besley', serif;
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


        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem 1.5rem;
            }

            .navbar-toggle {
                display: flex;
            }

            .navbar-right {
                display: none;
                position: absolute;
                top: 80px;
                left: 0;
                width: 100%;
                background-color: #ffffff;
                flex-direction: column;
                align-items: stretch;
                gap: 0;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .navbar-right.active {
                display: flex;
            }

            .navbar-menu {
                flex-direction: column;
                gap: 0;
                width: 100%;
            }

            .navbar-menu li {
                width: 100%;
                text-align: center;
            }

            .navbar-menu li a {
                display: block;
                padding: 1rem;
                border-bottom: 1px solid #f0f0f0;
            }

            .navbar-profile {
                justify-content: center;
                width: 100%;
                padding: 1rem; /* Beri padding untuk ikon di mobile */
                border-bottom: 1px solid #f0f0f0;
            }

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


            /* --- CSS RESPONSIVE UNTUK DROPDOWN --- */

            .profile-dropdown {
                width: 100%;
            }
            .profile-dropdown-toggle {
                /* Tombol ikon di mobile */
                text-align: center;
                width: 100%;
                border-radius: 0;
                display: flex;
                justify-content: center;
            }
            .profile-dropdown-toggle:hover {
                background-color: #f5f5f5;
            }
            .profile-dropdown-toggle svg {
                margin: 0 auto; /* Pusatkan ikon */
            }

            /* Menu dropdown di mobile */
            .profile-dropdown-menu {
                position: static;
                display: block;
                box-shadow: none;
                border-radius: 0;
                min-width: 0;
                width: 100%;
                background: none;
                border-top: 1px solid #f0f0f0;
                padding: 0;
            }
            .profile-dropdown:hover .profile-dropdown-menu {
                display: block;
            }
            .profile-dropdown-menu .dropdown-header {
                 display: none;
            }
            .profile-dropdown-menu a {
                text-align: center;
                padding: 1rem;
                border-bottom: 1px solid #f0f0f0;
                color: #074159;
            }
            .profile-dropdown-menu a:hover {
                background: #f5f5f5;
            }
            .profile-dropdown-menu .dropdown-divider {
                display: none;
            }
             /* Tombol "Daftar" di mobile */
            .profile-dropdown-menu a.dropdown-button-primary {
                margin: 0;
                border-radius: 0;
                color: white;
                background-color: #ff5722;
            }
            .profile-dropdown-menu a.dropdown-button-primary:hover {
                background-color: #e64a19;
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
        .skm-articles { background: #F4F7F6; padding: 56px 16px 70px; font-family: 'Besley', serif; }
        .skm-a-wrap { max-width: 980px; margin: 0 auto; }
        .skm-articles h2 { color: #074159; font-size: 36px; font-weight: 800; text-align: center; margin-bottom: 18px; }
        .skm-articles h2::after { content: ""; display: block; width: 56px; height: 4px; background: #ff5722; border-radius: 2px; margin: 8px auto 0; }
        .skm-a-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; margin-top: 26px; }
        @media (max-width: 900px) { .skm-a-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 600px) { .skm-a-grid { grid-template-columns: 1fr; } }
        .skm-a-card { background: #FFFFFF; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); overflow: hidden; }
        .skm-a-card .thumb { height: 160px; overflow: hidden; }
        .skm-a-card .thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .skm-a-card .body { padding: 14px 16px 16px; }
        .skm-a-card .title { color: #074159; font-size: 18px; font-weight: 800; line-height: 1.35; margin: 0 0 8px; }
        .skm-a-card .excerpt { color: #425B66; font-size: 15px; line-height: 1.6; margin: 0 0 12px; }
        .skm-a-card .more { color: #ff5722; font-weight: 800; text-decoration: none; }
        .skm-a-card .more:hover { text-decoration: underline; }
        @media (max-width: 640px) {
            .skm-articles h2 { font-size: 28px; }
            .skm-a-card .title { font-size: 16px; }
            .skm-a-card .excerpt { font-size: 14px; }
        }

        /* CSS Untuk Testimoni Section dari file Anda */
        .skm-testimonials { background: #FFFFFF; padding: 60px 16px 70px; font-family: 'Besley', serif; }
        .skm-t-wrap { max-width: 1100px; margin: 0 auto; }
        .skm-testimonials h2 { color: #074159; font-size: 36px; font-weight: 800; text-align: center; margin-bottom: 18px; }
        .skm-testimonials h2::after { content: ""; display: block; width: 66px; height: 4px; background: #ff5722; border-radius: 2px; margin: 8px auto 0; }
        .skm-t-single { max-width: 820px; margin: 0 auto; background: #F6FAFA; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.08); padding: 22px 24px; text-align: center; }
        .skm-t-single .quote { color: #074159; font-size: 17px; line-height: 1.65; margin: 0 0 6px; font-style: normal; letter-spacing: 0.2px; }
        .skm-t-single .credit { color: #074159; margin: 0; font-size: 16px; font-weight: 800; letter-spacing: 0.2px; }
        .skm-t-single .credit strong { font-weight: 800; }
        @media (max-width: 640px) {
            .skm-testimonials h2 { font-size: 28px; }
            .skm-t-single { padding: 18px; }
            .skm-t-single .quote { font-size: 16px; }
            .skm-t-single .credit { font-size: 15px; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/Rectangle.png') }}" alt="SIKEMAS Logo">
                </a>
            </div>

            <div class="navbar-right" id="navbar-mobile-menu">
                <ul class="navbar-menu">
                    <li><a href="{{ url('/beranda') }}">Beranda</a></li>
                    <li><a href="{{ url('/produk') }}">Produk</a></li>
                    <li><a href="{{ url('/artikel') }}">Artikel</a></li>
                    <li><a href="{{ url('/portofolio') }}">Portofolio</a></li>
                    <li><a href="{{ url('/about') }}">About Us</a></li>

                    @guest
                        <li><a href="{{ route('login') }}">Profile</a></li>
                    @endguest
                </ul>

                <div class="navbar-profile">
                    <div class="profile-dropdown">

                        <button class="profile-icon profile-dropdown-toggle" aria-label="User Menu">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>

                        <div class="profile-dropdown-menu">
                            @auth
                                <div class="dropdown-header">
                                    <span>{{ Auth::user()->name }}</span>
                                    <small>{{ Auth::user()->email }}</small>
                                </div>
                                <a href="{{ route('profile.index') }}">Profil Saya</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login') }}">Login</a>
                                <a href="{{ route('register') }}" class="dropdown-button-primary">Daftar</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            <button class="navbar-toggle" id="navbar-hamburger" aria-label="Toggle menu">
                <div class="hamburger-icon">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </button>

        </div>
    </nav>

    <section class="hero-section">
    <img src="{{ asset('assets/img/Section.png') }}" alt="Background" class="hero-background">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Protect Your Value</h1>
            <p>Menjadi partner sejarah pertumbuhan bisnis anda dengan menyediakan proteksi yang dapat menciptakan ekosistem bisnis yang berkelanjutan</p>
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
                    <p class="why-us-description">Kami wujudkan ide desain Anda menjadi kemasan yang unik dan personal.</p>
                </div>

                <div class="why-us-card">
                    <div class="why-us-icon">
                        <img src="{{ asset('assets/img/Symbol14.svg') }}" alt="">
                    </div>
                    <h3 class="why-us-title">Konsultasi Ahli</h3>
                    <p class="why-us-description">Tim profesional kami siap membantu Anda dari ide awal hingga produk jadi.</p>
                </div>

                <div class="why-us-card">
                    <div class="why-us-icon">
                        <img src="{{ asset('assets/img/Container5.svg') }}" alt="">
                    </div>
                    <h3 class="why-us-title">Layanan Cepat & Andal</h3>
                    <p class="why-us-description">Proses produksi dan pengiriman kami dirancang untuk efisiensi dan ketepatan waktu.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="products-section">
        <div class="products-container">
            <h2 class="section-title">Produk Unggulan Kami</h2>

            <div class="products-grid">
                <div class="product-card">
                    <img src="{{ asset('assets/img/Rectangle12.png') }}" alt="Kotak Kemasan Khusus" class="product-image">
                    <div class="product-content">
                        <h3 class="product-title">Kotak Kemasan Khusus</h3>
                        <p class="product-description">Didesain untuk memenuhi kebutuhan spesifik produk Anda, dari ukuran hingga finishing.</p>
                        <a href="#" class="product-button">Pesan Sekarang</a>
                    </div>
                </div>

                <div class="product-card">
                    <img src="{{ asset('assets/img/Rectangle12.png') }}" alt="Karton Bergelombang" class="product-image">
                    <div class="product-content">
                        <h3 class="product-title">Karton Bergelombang</h3>
                        <p class="product-description">Kekuatan dan ketahanan optimal untuk pengiriman dan penyimpanan yang aman.</p>
                        <a href="#" class="product-button">Pesan Sekarang</a>
                    </div>
                </div>

                <div class="product-card">
                    <img src="{{ asset('assets/img/Rectangle12.png') }}" alt="Kemasan Ramah Lingkungan" class="product-image">
                    <div class="product-content">
                        <h3 class="product-title">Kemasan Ramah Lingkungan</h3>
                        <p class="product-description">Solusi kemasan berkelanjutan yang terbuat dari bahan daur ulang dan dapat didaur ulang.</p>
                        <a href="#" class="product-button">Pesan Sekarang</a>
                    </div>
                </div>
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
                    <p class="commitment-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis justo non condimentum efficitur.</p>
                </div>

                <div class="commitment-card">
                    <div class="commitment-icon">
                        <img src="{{ asset('assets/img/ContainerT.png') }}" alt="Bisnis Berkelanjutan">
                    </div>
                    <h3 class="commitment-title">Bisnis Berkelanjutan</h3>
                    <p class="commitment-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis justo non condimentum efficitur.</p>
                </div>

                <div class="commitment-card">
                    <div class="commitment-icon icon-efisiensi">
                        <img src="{{ asset('assets/img/icon.png') }}" alt="Efisiensi Biaya">
                    </div>
                    <h3 class="commitment-title">Efisiensi Biaya</h3>
                    <p class="commitment-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis justo non condimentum efficitur.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="commitment-2-section" aria-labelledby="commitment-2-title">
        <div class="commitment-2-container">
            <h2 id="commitment-2-title">Berkarya dengan hati untuk dedikasi menjadi partner membangun<br>bisnis yang berkelanjutan</h2>
            <nav class="domino-nav" aria-label="Komitmen Kami">
                <button class="domino-tab active" data-target="content-eco">
                    <span>Eco Solutions</span>
                </button>
                <button class="domino-tab" data-target="content-guidance">
                    <span>Guidance</span>
                </button>
                <button class="domino-tab" data-target="content-quality">
                    <span>Quality & Delivery</span>
                </button>
                <button class="domino-tab" data-target="content-transparency">
                    <span>Transparency</span>
                </button>
                <button class="domino-tab" data-target="content-innovations">
                    <span>Innovations</span>
                </button>
            </nav>

            <div class="domino-content-wrapper">
                <div class="domino-content active" id="content-eco">
                    <h3>The world Need Sustainable Packaging</h3>
                    <p>Meskipun banyak produsen menawarkan harga yang terkesan ekonomis, kualitas produk yang dihasilkan sering kali tidak optimal. Pilihan yang tampak murah di awal justru dapat menimbulkan kerugian jangka panjang bagi bisnis Anda.</p>
                    <div class="orange-grid">
                        <div class="orange-box">Solusi paling sirkular di setiap kategori.</div>
                        <div class="orange-box">Pilihan bervariasi untuk kemasan, kardus, dan banyak lagi</div>
                        <div class="orange-box">Branding dan Desain Custom untuk setiap pilihan kemasan</div>
                        <div class="orange-box">Solusi untuk merek D2C sangat bervariasi</div>
                    </div>
                </div>

                <div class="domino-content" id="content-guidance">
                    <h3>Guidance & Support</h3>
                    <p>Kami memandu Anda melalui setiap langkah, dari konsep hingga kenyataan. Tim ahli kami siap membantu Anda menemukan solusi kemasan terbaik untuk kebutuhan spesifik Anda, memastikan Anda membuat pilihan yang tepat.</p>
                    <div class="orange-grid">
                        <div class="orange-box">Konsultasi Desain Gratis</div>
                        <div class="orange-box">Dukungan Teknis Ahli</div>
                        <div class="orange-box">Pemilihan Material Terbaik</div>
                        <div class="orange-box">Prototyping Cepat</div>
                    </div>
                </div>

                <div class="domino-content" id="content-quality">
                    <h3>Quality & Delivery</h3>
                    <p>Kualitas adalah janji kami. Kami menggunakan material terbaik dan proses produksi yang ketat untuk memastikan setiap kemasan kokoh dan sempurna. Pengiriman tepat waktu adalah prioritas kami agar bisnis Anda terus berjalan lancar.</p>
                    <div class="orange-grid">
                        <div class="orange-box">Kontrol Kualitas Berlapis</div>
                        <div class="orange-box">Jaminan Tepat Waktu</div>
                        <div class="orange-box">Material Premium Teruji</div>
                        <div class="orange-box">Garansi Produk</div>
                    </div>
                </div>

                <div class="domino-content" id="content-transparency">
                    <h3>Transparency</h3>
                    <p>Kami percaya pada kemitraan yang jujur. Anda akan mendapatkan informasi yang jelas dan terbuka mengenai harga, material, dan proses produksi. Tidak ada biaya tersembunyi, hanya komitmen tulus untuk kesuksesan Anda.</p>
                    <div class="orange-grid">
                        <div class="orange-box">Harga Jujur Tanpa Biaya Tersembunyi</div>
                        <div class="orange-box">Pelacakan Proses Produksi</div>
                        <div class="orange-box">Spesifikasi Material Jelas</div>
                        <div class="orange-box">Komunikasi Proaktif</div>
                    </div>
                </div>

                <div class="domino-content" id="content-innovations">
                    <h3>Innovations</h3>
                    <p>Dunia terus berubah, begitu pula kami. Sikemas terus berinovasi dalam teknologi dan desain untuk memberikan Anda solusi kemasan yang tidak only fungsional tetapi juga modern dan terdepan di pasar.</p>
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
                    <p class="process-step-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis justo</p>
                </div>

                <div class="our-process-step">
                    <div class="process-image-wrapper">
                        <img src="{{ asset('assets/img/alur2.png') }}" alt="Pemilihan Material">
                    </div>
                    <div class="process-step-number">2</div>
                    <h3 class="process-step-title">Pemilihan Material</h3>
                    <p class="process-step-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis justo</p>
                </div>

                <div class="our-process-step">
                    <div class="process-image-wrapper">
                        <img src="{{ asset('assets/img/alur3.png') }}" alt="Purchase / Dealing">
                    </div>
                    <div class="process-step-number">3</div>
                    <h3 class="process-step-title">Purchase / Dealing</h3>
                    <p class="process-step-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis justo</p>
                </div>

                <div class="our-process-step">
                    <div class="process-image-wrapper">
                        <img src="{{ asset('assets/img/alur4.png') }}" alt="Produksi & Kontrol Kualitas">
                    </div>
                    <div class="process-step-number">4</div>
                    <h3 class="process-step-title">Produksi & Kontrol Kualitas</h3>
                    <p class="process-step-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis justo</p>
                </div>

                <div class="our-process-step">
                    <div class="process-image-wrapper">
                        <img src="{{ asset('assets/img/alur5.png') }}" alt="Pengiriman">
                    </div>
                    <div class="process-step-number">5</div>
                    <h3 class="process-step-title">Pengiriman</h3>
                    <p class="process-step-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis justo</p>
                </div>

            </div>
        </div>
    </section>

    <section class="custom-design-section" aria-labelledby="custom-design-title">
        <div class="custom-design-container">
            <h2 class="section-title-custom-design" id="custom-design-title">Custom Desain Anda Sendiri</h2>

            <div class="custom-design-image-grid">
                <img src="{{ asset('assets/img/custom1.png') }}" alt="Contoh Desain Box 1" class="custom-design-image-item">
                <img src="{{ asset('assets/img/custom2.png') }}" alt="Contoh Desain Box 2" class="custom-design-image-item">
                <img src="{{ asset('assets/img/custom3.png') }}" alt="Contoh Desain Box 3" class="custom-design-image-item">
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
            <p class="free-design-description">Kami siap membuat ide desainmu menjadi nyata. Konsultasikan sekarang juga secara gratis!</p>
            <a href="#" class="free-design-button">Konsultasi Gratis Sekarang</a>
        </div>
    </section>
    <section class="skm-articles" aria-labelledby="articles-title">
        <div class="skm-a-wrap">
            <h2 id="articles-title">Artikel &amp; Berita</h2>
            <div class="skm-a-grid">
                <article class="skm-a-card">
                    <div class="thumb">
                        <img src="{{ asset('assets/img/Article-image.png') }}" alt="Trend Kemasan Ramah Lingkungan">
                    </div>
                    <div class="body">
                        <h3 class="title">Trend Kemasan Ramah Lingkungan</h3>
                        <p class="excerpt">Membahas inovasi terbaru dalam industri kemasan karton yang berkelanjutan dan ramah lingkungan.</p>
                        <a class="more" href="#" aria-label="Baca selengkapnya Trend Kemasan Ramah Lingkungan">Baca Selengkapnya</a>
                    </div>
                </article>
                <article class="skm-a-card">
                    <div class="thumb">
                        <img src="{{ asset('assets/img/Article-image.png') }}" alt="Pentingnya Kemasan yang Tepat">
                    </div>
                    <div class="body">
                        <h3 class="title">Pentingnya Kemasan yang Tepat</h3>
                        <p class="excerpt">Bagaimana kemasan yang kuat dan menarik dapat meningkatkan nilai jual produk Anda.</p>
                        <a class="more" href="#" aria-label="Baca selengkapnya Pentingnya Kemasan yang Tepat">Baca Selengkapnya</a>
                    </div>
                </article>
                <article class="skm-a-card">
                    <div class="thumb">
                        <img src="{{ asset('assets/img/Article-image.png') }}" alt="Proses Produksi Kami">
                    </div>
                    <div class="body">
                        <h3 class="title">Proses Produksi Kami</h3>
                        <p class="excerpt">Mengintip proses di balik produksi kemasan karton berkualitas tinggi di pabrik Sikemas.</p>
                        <a class="more" href="#" aria-label="Baca selengkapnya Proses Produksi Kami">Baca Selengkapnya</a>
                    </div>
                </article>
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

            hamburgerButton.addEventListener('click', function () {
                mobileMenu.classList.toggle('active');
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
        });
    </script>
</body>
</html>