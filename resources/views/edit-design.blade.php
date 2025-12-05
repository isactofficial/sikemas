<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Desain Kemasan Kustom - Sikemas</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-sikemas-removebg.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>

    <style>
        :root {
            --primary-color: #FF611A;
            --dark-blue-main: #074159;
            --teal-main: #23C8B8;
            --dark-blue-text: #001B24;
            --light-gray: #f4f7f6;
            --text-color: var(--dark-blue-text);
            --secondary-text-color: #555;
            --white: #ffffff;
            --card-bg: #fff;
            --sidebar-bg: #f9f9f9;
            --border-color: #e0e0e0;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .customization-container {
            display: flex;
            width: 100%;
            height: 100vh;
            background-color: var(--card-bg);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* Sidebar Styling */
        .sidebar {
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 20px;
            background-color: var(--sidebar-bg);
            overflow-y: auto;
            transition: width 0.3s ease, min-width 0.3s ease;
        }

        .left-sidebar {
            width: 250px;
            min-width: 250px;
            border-right: 1px solid var(--border-color);
        }

        .right-sidebar {
            width: 300px;
            min-width: 300px;
            border-left: 1px solid var(--border-color);
            position: relative;
            transform: translateX(0);
            transition: transform 0.3s ease, width 0.3s ease, min-width 0.3s ease;
        }

        .right-sidebar.hidden {
            min-width: 0;
            width: 0;
            padding-left: 0;
            padding-right: 0;
            border-left: none;
            overflow: hidden;
            transform: translateX(100%);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .sidebar h3 {
            font-size: 1.2rem;
            color: var(--dark-blue-main);
        }

        .close-sidebar-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--dark-blue-text);
            display: none;
        }

        .sidebar-content {
            flex-grow: 1;
            overflow-y: auto;
            padding-right: 10px;
        }

        .sidebar-content::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar-content::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }

        .sidebar-content::-webkit-scrollbar-thumb:hover {
            background: #999;
        }

        .design-section {
            margin-bottom: 25px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 20px;
        }

        .design-section h4 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark-blue-text);
            margin-bottom: 15px;
        }

        .add-image-btn {
            width: 100%;
            padding: 10px;
            background-color: var(--teal-main);
            color: var(--white);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .add-image-btn:hover {
            background-color: var(--dark-blue-main);
        }

        .upload-info {
            font-size: 0.8rem;
            color: var(--secondary-text-color);
            margin-top: 5px;
            text-align: center;
        }

        .element-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .design-element-item {
            width: 100%;
            height: auto;
            border-radius: 5px;
            cursor: pointer;
            border: 1px solid transparent;
            transition: border-color 0.2s ease;
        }

        .design-element-item:hover {
            border-color: var(--teal-main);
        }

        .design-element-item.fa-solid,
        .design-element-item.fa-regular {
            font-size: 3rem;
            text-align: center;
            padding: 10px;
            border: 1px solid var(--border-color);
            color: var(--secondary-text-color);
        }

        .design-element-item.fa-solid:hover,
        .design-element-item.fa-regular:hover {
            border-color: var(--teal-main);
            color: var(--teal-main);
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 20px;
        }

        .storage-info {
            font-size: 0.8rem;
            color: #999;
            text-align: center;
            display: block;
        }

        /* Main Design Area */
        .main-design-area {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            padding: 20px;
            background-color: var(--light-gray);
            height: 100%;
            position: relative;
        }

        .design-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .back-btn {
            background-color: var(--dark-blue-main);
            color: var(--white);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1rem;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: var(--primary-color);
        }

        .design-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-blue-main);
        }

        .live-view-feature {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .live-view-text {
            font-size: 1rem;
            font-weight: 500;
            color: var(--secondary-text-color);
        }

        .canvas-container {
            flex-grow: 1;
            display: flex;
            gap: 20px;
            position: relative;
            height: 100%;
        }

        #open-right-sidebar {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            width: 30px;
            height: 60px;
            border-radius: 5px 0 0 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        #open-right-sidebar:hover {
            background-color: var(--dark-blue-main);
        }

        #open-right-sidebar.hidden {
            display: none;
        }

        .canvas-area {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--card-bg);
            border-radius: 8px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            height: 100%;
        }

        .canvas-area.single-3d-view {
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        #three-canvas {
            width: 100%;
            height: 100%;
            display: block;
        }

        .design-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            background-color: var(--card-bg);
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .control-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .control-btn {
            background-color: var(--light-gray);
            color: var(--dark-blue-text);
            border: 1px solid var(--border-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .control-btn:hover {
            background-color: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        .zoom-level {
            font-weight: 600;
        }

        .view-mode {
            font-weight: 600;
        }

        .properties-section {
            margin-bottom: 25px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 20px;
        }

        .properties-section h4 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark-blue-text);
            margin-bottom: 15px;
        }

        .box-type-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .size-inputs {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 80px;
        }

        .input-group label {
            font-size: 0.8rem;
            color: var(--secondary-text-color);
            margin-bottom: 5px;
        }

        .input-group input {
            padding: 8px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .material-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .material-item {
            text-align: center;
            cursor: pointer;
        }

        .material-icon-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto 5px;
            border: 3px solid transparent;
            transition: border-color 0.2s ease;
            object-fit: cover;
        }

        .material-item:hover .material-icon-img,
        .material-item.active .material-icon-img {
            border-color: var(--teal-main);
        }

        .material-item p {
            font-size: 0.85rem;
            margin: 0;
        }

        .color-options {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .color-item {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: 2px solid #ccc;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .color-item:hover {
            transform: scale(1.1);
        }

        .color-item.active {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 97, 26, 0.4);
        }

        .save-btn {
            width: 100%;
            padding: 15px;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            transition: background-color 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 97, 26, 0.3);
        }

        .save-btn:hover {
            background-color: #e64a19;
        }

        .side-selection {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
        }

        .side-btn {
            background-color: var(--light-gray);
            color: var(--dark-blue-text);
            border: 1px solid var(--border-color);
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.85rem;
        }

        .side-btn.active {
            background-color: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        .side-btn:hover {
            background-color: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        /* Mobile Menu Toggle Buttons */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            bottom: 20px;
            z-index: 1000;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease;
        }

        .mobile-menu-toggle:hover {
            background-color: var(--dark-blue-main);
        }

        #mobile-left-menu {
            left: 20px;
        }

        #mobile-right-menu {
            right: 20px;
        }

        /* Mobile Overlay */
        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 998;
        }

        .mobile-overlay.active {
            display: block;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .customization-container {
                flex-direction: column;
                overflow: hidden;
            }

            /* Hide sidebars by default on mobile */
            .left-sidebar,
            .right-sidebar {
                position: fixed;
                top: 0;
                height: 100vh;
                width: 80%;
                max-width: 320px;
                z-index: 999;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                border: none;
                box-shadow: 4px 0 12px rgba(0, 0, 0, 0.2);
            }

            .left-sidebar {
                left: 0;
            }

            .right-sidebar {
                right: 0;
                left: auto;
                transform: translateX(100%);
                box-shadow: -4px 0 12px rgba(0, 0, 0, 0.2);
            }

            .left-sidebar.mobile-open {
                transform: translateX(0);
            }

            .right-sidebar.mobile-open {
                transform: translateX(0);
            }

            .right-sidebar.hidden {
                transform: translateX(100%);
            }

            /* Show mobile menu toggles */
            .mobile-menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Show close button on mobile */
            .close-sidebar-btn {
                display: block;
            }

            /* Main area takes full space */
            .main-design-area {
                width: 100%;
                height: 100vh;
                padding: 10px;
            }

            .design-header {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 10px;
                margin-bottom: 10px;
            }

            .header-left {
                flex: 1;
                min-width: 200px;
            }

            .design-title {
                font-size: 1.1rem;
            }

            .back-btn {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }

            .live-view-feature {
                gap: 8px;
            }

            .live-view-text {
                font-size: 0.85rem;
            }

            .canvas-container {
                margin-bottom: 10px;
            }

            .canvas-area {
                min-height: 300px;
            }

            .design-footer {
                flex-wrap: wrap;
                gap: 10px;
                padding: 8px 10px;
                justify-content: center;
            }

            .control-group {
                gap: 6px;
            }

            .control-btn {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }

            .zoom-level,
            .view-mode {
                font-size: 0.85rem;
            }

            /* Hide desktop sidebar toggle */
            #open-right-sidebar {
                display: none !important;
            }

            /* Adjust sidebar content for mobile */
            .sidebar-content {
                padding-right: 5px;
            }

            .design-section {
                margin-bottom: 20px;
                padding-bottom: 15px;
            }

            .element-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
            }

            .design-element-item.fa-solid,
            .design-element-item.fa-regular {
                font-size: 2rem;
                padding: 8px;
            }

            .properties-section {
                margin-bottom: 20px;
                padding-bottom: 15px;
            }

            .box-type-options,
            .material-options {
                gap: 10px;
            }

            .material-icon-img {
                width: 50px;
                height: 50px;
            }

            .material-item p {
                font-size: 0.75rem;
            }

            .size-inputs {
                gap: 10px;
            }

            .input-group {
                min-width: 70px;
            }

            .input-group input {
                padding: 6px;
                font-size: 0.85rem;
            }

            .side-selection {
                gap: 6px;
            }

            .side-btn {
                padding: 6px 10px;
                font-size: 0.8rem;
            }

            .color-options {
                gap: 10px;
            }

            .color-item {
                width: 30px;
                height: 30px;
            }

            .save-btn {
                padding: 12px;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 480px) {
            .design-title {
                font-size: 0.95rem;
            }

            .header-left {
                gap: 8px;
            }

            .live-view-text {
                display: none;
            }

            .mobile-menu-toggle {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }

            #mobile-left-menu,
            #mobile-right-menu {
                bottom: 15px;
            }

            #mobile-left-menu {
                left: 15px;
            }

            #mobile-right-menu {
                right: 15px;
            }

            .left-sidebar,
            .right-sidebar {
                width: 85%;
                max-width: 280px;
            }

            .element-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 6px;
            }

            .box-type-options,
            .material-options {
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
            }

            .material-icon-img {
                width: 45px;
                height: 45px;
            }

            .control-btn {
                width: 32px;
                height: 32px;
                font-size: 0.85rem;
            }

            .zoom-level,
            .view-mode {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>

    <div class="customization-container">

        <div class="sidebar left-sidebar" id="left-sidebar">
            <div class="sidebar-header">
                <h3>Unggah & Desain</h3>
                <button class="close-sidebar-btn" id="close-left-sidebar">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="sidebar-content">
                <div class="design-section">
                    <button class="add-image-btn"><i class="fas fa-plus-square"></i> Tambah Gambar</button>
                    <p class="upload-info">Mendukung JPG, PNG, SVG.</p>
                    <input type="file" id="upload-custom-image" accept="image/*" style="display: none;">
                </div>

                <div class="design-section">
                    <h4>Elemen</h4>
                    <div class="element-grid">
                        <img src="assets/img/product1.png" alt="Kotak Kemasan Khusus" class="design-element-item"
                            data-type="box-special">
                        <img src="assets/img/product2.png" alt="Karton Bergelombang" class="design-element-item"
                            data-type="box-corrugated">
                        <img src="assets/img/product3.png" alt="Kemasan Ramah Lingkungan" class="design-element-item"
                            data-type="box-eco">
                        <img src="assets/img/product4.png" alt="Display & Promosi" class="design-element-item"
                            data-type="box-display">
                        <img src="assets/img/product5.png" alt="Kemasan Makanan" class="design-element-item"
                            data-type="box-food">
                        <img src="assets/img/product6.png" alt="Kemasan Kosmetik" class="design-element-item"
                            data-type="box-cosmetic">
                        <i class="fas fa-th design-element-item" data-type="pattern"></i>
                        <i class="fas fa-tags design-element-item" data-type="sticker"></i>
                    </div>
                </div>

                <div class="sidebar-footer">
                    <span class="storage-info">1.5 / 100MB digunakan</span>
                </div>
            </div>
        </div>

        <div class="main-design-area">
            <div class="design-header">
                <div class="header-left">
                    <a href="{{ route('home') }}" class="back-btn" title="Kembali ke Homepage">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h2 class="design-title">Desain Kotak Kemasan Khusus</h2>
                </div>
                <div class="live-view-feature">
                    <span class="live-view-text">3D Live View</span>
                </div>
            </div>
            <div class="canvas-container">
                <div class="canvas-area single-3d-view">
                    <canvas id="three-canvas"></canvas>
                </div>
                <button id="open-right-sidebar" class="hidden" title="Buka Properti">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
            <div class="design-footer">
                <div class="control-group">
                    <button class="control-btn" id="undo-btn"><i class="fas fa-undo"></i></button>
                    <button class="control-btn" id="redo-btn"><i class="fas fa-redo"></i></button>
                </div>
                <div class="control-group zoom-control">
                    <button class="control-btn" id="zoom-out-btn"><i class="fas fa-search-minus"></i></button>
                    <span class="zoom-level" id="zoom-level">100%</span>
                    <button class="control-btn" id="zoom-in-btn"><i class="fas fa-search-plus"></i></button>
                </div>
                <div class="control-group">
                    <span class="view-mode">Luar</span>
                    <button class="control-btn" id="toggle-view-mode"><i class="fas fa-sync-alt"></i></button>
                </div>
            </div>
        </div>

        <div class="sidebar right-sidebar" id="right-sidebar">
            <div class="sidebar-header">
                <h3>Properti</h3>
                <button class="close-sidebar-btn" id="close-right-sidebar" title="Tutup Properti">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="sidebar-content">

                <div class="properties-section">
                    <h4>Jenis Box</h4>
                    <div class="box-type-options">
                        <div class="material-item active" data-box-type="tall-box">
                            <img src="assets/img/tinggi.png" alt="Ikon Box Tinggi" class="material-icon-img">
                            <p>Tinggi</p>
                        </div>
                        <div class="material-item" data-box-type="wide-box">
                            <img src="assets/img/lebar.png" alt="Ikon Box Lebar" class="material-icon-img">
                            <p>Lebar</p>
                        </div>
                        <div class="material-item" data-box-type="cube-box">
                            <img src="assets/img/kubus.png" alt="Ikon Box Kubus" class="material-icon-img">
                            <p>Kubus</p>
                        </div>
                    </div>
                </div>

                <div class="properties-section">
                    <h4>Pilih Sisi</h4>
                    <div class="side-selection">
                        <button class="side-btn active" data-side="front">Depan</button>
                        <button class="side-btn" data-side="back">Belakang</button>
                        <button class="side-btn" data-side="left">Kiri</button>
                        <button class="side-btn" data-side="right">Kanan</button>
                        <button class="side-btn" data-side="top">Atas</button>
                        <button class="side-btn" data-side="bottom">Bawah</button>
                    </div>
                </div>

                <div class="properties-section">
                    <h4>Ukuran</h4>
                    <div class="size-inputs">
                        <div class="input-group">
                            <label>Panjang</label>
                            <input type="number" value="120" id="prop-length">
                        </div>
                        <div class="input-group">
                            <label>Lebar</label>
                            <input type="number" value="60" id="prop-width">
                        </div>
                        <div class="input-group">
                            <label>Tinggi</label>
                            <input type="number" value="160" id="prop-height">
                        </div>
                    </div>
                </div>

                <div class="properties-section">
                    <h4>Material</h4>
                    <div class="material-options">
                        <div class="material-item active" data-material="cardboard">
                            <img src="assets/img/product1.png" alt="Ikon Karton" class="material-icon-img">
                            <p>Karton</p>
                        </div>
                        <div class="material-item" data-material="recycled">
                            <img src="assets/img/product2.png" alt="Ikon Daur Ulang" class="material-icon-img">
                            <p>Daur Ulang</p>
                        </div>
                        <div class="material-item" data-material="kraft">
                            <img src="assets/img/product3.png" alt="Ikon Kraft" class="material-icon-img">
                            <p>Kraft</p>
                        </div>
                    </div>
                </div>

                <div class="properties-section">
                    <h4>Warna Kemasan</h4>
                    <div class="color-options">
                        <div class="color-item active" style="background-color: #f0e68c;" data-color="#f0e68c"></div>
                        <div class="color-item" style="background-color: #e6e6fa;" data-color="#e6e6fa"></div>
                        <div class="color-item" style="background-color: #d3d3d3;" data-color="#d3d3d3"></div>
                        <div class="color-item" style="background-color: #add8e6;" data-color="#add8e6"></div>
                        <div class="color-item" style="background-color: #ffb6c1;" data-color="#ffb6c1"></div>
                        <div class="color-item" style="background-color: #90ee90;" data-color="#90ee90"></div>
                    </div>
                </div>
            </div>

            <div class="sidebar-footer">
                <button class="save-btn"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Toggles -->
    <button class="mobile-menu-toggle" id="mobile-left-menu">
        <i class="fas fa-palette"></i>
    </button>
    <button class="mobile-menu-toggle" id="mobile-right-menu">
        <i class="fas fa-cog"></i>
    </button>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobile-overlay"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // === Mobile Menu Logic ===
            const leftSidebar = document.getElementById('left-sidebar');
            const rightSidebar = document.getElementById('right-sidebar');
            const mobileLeftBtn = document.getElementById('mobile-left-menu');
            const mobileRightBtn = document.getElementById('mobile-right-menu');
            const closeLeftBtn = document.getElementById('close-left-sidebar');
            const closeRightBtn = document.getElementById('close-right-sidebar');
            const mobileOverlay = document.getElementById('mobile-overlay');
            const openRightSidebarBtn = document.getElementById('open-right-sidebar');

            function closeSidebars() {
                leftSidebar.classList.remove('mobile-open');
                rightSidebar.classList.remove('mobile-open');
                mobileOverlay.classList.remove('active');
            }

            mobileLeftBtn.addEventListener('click', () => {
                closeSidebars();
                leftSidebar.classList.add('mobile-open');
                mobileOverlay.classList.add('active');
            });

            mobileRightBtn.addEventListener('click', () => {
                closeSidebars();
                rightSidebar.classList.remove('hidden');
                rightSidebar.classList.add('mobile-open');
                mobileOverlay.classList.add('active');
            });

            closeLeftBtn.addEventListener('click', closeSidebars);
            closeRightBtn.addEventListener('click', closeSidebars);
            mobileOverlay.addEventListener('click', closeSidebars);

            // Desktop sidebar toggle
            openRightSidebarBtn.addEventListener('click', () => {
                rightSidebar.classList.remove('hidden');
                openRightSidebarBtn.classList.add('hidden');
            });

            // === Three.js 3D Scene ===
            const canvasArea3d = document.getElementById('three-canvas');
            if (!canvasArea3d) {
                console.error("Canvas element not found");
                return;
            }

            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(75, canvasArea3d.offsetWidth / canvasArea3d.offsetHeight,
                0.1, 1000);
            const renderer = new THREE.WebGLRenderer({
                canvas: canvasArea3d,
                alpha: true
            });

            function resizeRenderer() {
                const width = canvasArea3d.offsetWidth;
                const height = canvasArea3d.offsetHeight;
                renderer.setSize(width, height);
                camera.aspect = width / height;
                camera.updateProjectionMatrix();
            }
            resizeRenderer();
            window.addEventListener('resize', resizeRenderer);

            const observer = new ResizeObserver(entries => {
                for (let entry of entries) {
                    if (entry.target === canvasArea3d.parentElement) {
                        resizeRenderer();
                    }
                }
            });
            observer.observe(canvasArea3d.parentElement);

            const controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.enableDamping = true;

            const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
            scene.add(ambientLight);
            const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
            directionalLight.position.set(5, 5, 5);
            scene.add(directionalLight);

            // === 3D Box Models ===
            let box;
            const boxModels = {
                'tall-box': {
                    length: 120,
                    width: 60,
                    height: 160
                },
                'wide-box': {
                    length: 160,
                    width: 120,
                    height: 60
                },
                'cube-box': {
                    length: 100,
                    width: 100,
                    height: 100
                }
            };
            const defaultColor = '#f0e68c';
            const textureLoader = new THREE.TextureLoader();
            let currentMaterialColor = defaultColor;
            let activeSide = 'front';

            const sideMap = {
                'right': 0,
                'left': 1,
                'top': 2,
                'bottom': 3,
                'front': 4,
                'back': 5
            };
            const materials = [];

            function createBox(length, width, height) {
                if (box) {
                    scene.remove(box);
                    box.geometry.dispose();
                    if (Array.isArray(box.material)) {
                        box.material.forEach(mat => mat.dispose());
                    } else if (box.material) {
                        box.material.dispose();
                    }
                }

                const geometry = new THREE.BoxGeometry(length, height, width);

                materials.length = 0;
                for (let i = 0; i < 6; i++) {
                    materials.push(new THREE.MeshLambertMaterial({
                        color: currentMaterialColor
                    }));
                }

                box = new THREE.Mesh(geometry, materials);
                scene.add(box);
            }

            function updateBoxColor(color) {
                currentMaterialColor = color;
                if (box) {
                    materials.forEach(mat => {
                        if (!mat.map) {
                            mat.color.set(color);
                        }
                    });
                }
            }

            function applyTextureToActiveSide(imageSrc) {
                const sideIndex = sideMap[activeSide];
                if (box && materials[sideIndex]) {
                    textureLoader.load(imageSrc, (texture) => {
                        materials[sideIndex].map = texture;
                        materials[sideIndex].color.set(
                            0xffffff); // Set warna putih agar tekstur terlihat jelas
                        materials[sideIndex].needsUpdate = true;
                    }, undefined, (err) => {
                        console.error('Error loading texture:', err);
                    });
                }
            }

            function highlightActiveSide() {
                if (!box) return;

                materials.forEach((mat) => {
                    if (mat.originalColor) {
                        mat.color.set(mat.originalColor);
                        delete mat.originalColor;
                    }
                    if (mat.originalMap !== undefined) {
                        mat.map = mat.originalMap;
                        delete mat.originalMap;
                    }
                    mat.needsUpdate = true;
                });

                const sideIndex = sideMap[activeSide];
                if (materials[sideIndex]) {
                    materials[sideIndex].originalColor = materials[sideIndex].color.clone();
                    materials[sideIndex].originalMap = materials[sideIndex].map;
                    materials[sideIndex].color.set(0x00ff00);
                    materials[sideIndex].map = null;
                    materials[sideIndex].needsUpdate = true;
                }
            }

            createBox(120, 60, 160);
            camera.position.z = 300;

            function animate() {
                requestAnimationFrame(animate);
                controls.update();
                renderer.render(scene, camera);
            }
            animate();

            // === Property Controls ===
            const propLengthInput = document.getElementById('prop-length');
            const propWidthInput = document.getElementById('prop-width');
            const propHeightInput = document.getElementById('prop-height');
            const boxTypeOptions = document.querySelectorAll('.box-type-options .material-item');
            const sideButtons = document.querySelectorAll('.side-selection .side-btn');
            const materialOptions = document.querySelectorAll('.material-options .material-item');
            const colorOptions = document.querySelectorAll('.color-options .color-item');

            // Box Type Selection
            boxTypeOptions.forEach(item => {
                item.addEventListener('click', function() {
                    boxTypeOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                    const boxType = this.dataset.boxType;
                    const model = boxModels[boxType];
                    propLengthInput.value = model.length;
                    propWidthInput.value = model.width;
                    propHeightInput.value = model.height;
                    createBox(model.length, model.width, model.height);
                    highlightActiveSide();
                });
            });

            // Size Inputs
            [propLengthInput, propWidthInput, propHeightInput].forEach(input => {
                input.addEventListener('change', function() {
                    const length = parseFloat(propLengthInput.value);
                    const width = parseFloat(propWidthInput.value);
                    const height = parseFloat(propHeightInput.value);
                    createBox(length, width, height);
                    highlightActiveSide();
                });
            });

            // 3. Tombol Material
            const materialImageSources = {
                'cardboard': "assets/img/product1.png",
                'recycled': "assets/img/product2.png",
                'kraft': "assets/img/product3.png"
            };

            materialOptions.forEach(item => {
                item.addEventListener('click', function() {
                    materialOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                    const materialType = this.dataset.material;

                    const imageSrc = materialImageSources[materialType];
                    if (imageSrc) {
                        textureLoader.load(imageSrc, (texture) => {
                            materials.forEach(mat => {
                                mat.map = texture;
                                mat.color.set(0xffffff);
                                mat.needsUpdate = true;
                            });
                        }, undefined, (err) => {
                            console.error('Error loading texture:', err);
                        });
                    }
                });
            });

            // 4. Pilihan Warna
            colorOptions.forEach(item => {
                item.addEventListener('click', function() {
                    colorOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                    const color = this.dataset.color;
                    updateBoxColor(color);
                });
            });

            // 5. Tombol Pilih Sisi
            sideButtons.forEach(button => {
                button.addEventListener('click', function() {
                    sideButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    activeSide = this.dataset.side;
                    highlightActiveSide();
                });
            });

            // Fungsi untuk memberikan highlight pada sisi yang aktif
            function highlightActiveSide() {
                if (!box) return;

                // Reset semua material
                materials.forEach((mat) => {
                    if (mat.originalColor) {
                        mat.color.set(mat.originalColor);
                        delete mat.originalColor;
                    }
                    if (mat.originalMap) {
                        mat.map = mat.originalMap;
                        delete mat.originalMap;
                    }
                    mat.needsUpdate = true;
                });

                const sideIndex = sideMap[activeSide];
                if (materials[sideIndex]) {
                    // Simpan kondisi asli dan beri highlight hijau
                    materials[sideIndex].originalColor = materials[sideIndex].color.clone();
                    materials[sideIndex].originalMap = materials[sideIndex].map;
                    materials[sideIndex].color.set(0x00ff00);
                    materials[sideIndex].map = null;
                    materials[sideIndex].needsUpdate = true;
                }
            }


            // === Kontrol Sidebar Kiri (Desain) ===
            // 1. Tambah Gambar
            const addImageBtn = document.querySelector('.add-image-btn');
            const uploadInput = document.getElementById('upload-custom-image');
            addImageBtn.addEventListener('click', () => {
                uploadInput.click();
            });

            uploadInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (f) => {
                        applyTextureToActiveSide(f.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });


            // Design Elements
            const designElements = document.querySelectorAll('.design-element-item');
            designElements.forEach(item => {
                item.addEventListener('click', function() {
                    let imgSrc;
                    if (this.tagName === 'IMG') {
                        imgSrc = this.src;
                    } else if (this.tagName === 'I') {
                        const dataType = this.dataset.type;
                        if (dataType === 'pattern') {
                            imgSrc =
                                'https://via.placeholder.com/600x600/FF6B6B/ffffff?text=Pattern';
                        } else if (dataType === 'sticker') {
                            imgSrc =
                                'https://via.placeholder.com/600x600/4ECDC4/ffffff?text=Sticker';
                        }
                    }

                    if (imgSrc) {
                        applyTextureToActiveSide(imgSrc);
                    }
                });
            });

            // === Zoom Controls ===
            const zoomInBtn = document.getElementById('zoom-in-btn');
            const zoomOutBtn = document.getElementById('zoom-out-btn');
            const zoomLevelSpan = document.getElementById('zoom-level');
            let currentZoom = 1;

            function updateCameraZoom() {
                const newZ = 300 / currentZoom;
                camera.position.z = newZ;
                controls.update();
                zoomLevelSpan.textContent = `${Math.round(currentZoom * 100)}%`;
            }

            zoomInBtn.addEventListener('click', () => {
                currentZoom = Math.min(2, currentZoom + 0.1);
                updateCameraZoom();
            });

            zoomOutBtn.addEventListener('click', () => {
                currentZoom = Math.max(0.5, currentZoom - 0.1);
                updateCameraZoom();
            });

            // FUNGSI SIMPAN/UNDUH PNG 3D
            document.querySelector('.save-btn').addEventListener('click', () => {
                renderer.render(scene, camera);
                const dataURL = renderer.domElement.toDataURL("image/png");
                const link = document.createElement('a');
                link.download = 'desain_kemasan_3D.png';
                link.href = dataURL;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                alert('Tampilan 3D kemasan disimpan sebagai file PNG!');
            });

            highlightActiveSide();
        });
    </script>

</body>

</html>
