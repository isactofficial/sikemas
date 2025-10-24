<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - SIKEMAS</title>
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



        /* Portfolio Section - SESUAI GAMBAR */
        .portfolio-section {
            min-height: 100vh;
            background-image: url('{{ asset('assets/img/section6.png') }}');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            padding: 80px 20px;
        }

        .portfolio-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 60px;
            align-items: center;
        }

        /* Left Side - Text Content */
        .portfolio-text {
            padding-right: 40px;
        }

        .portfolio-text h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: #074159;
            margin-bottom: 2rem;
            line-height: 1.2;
        }

        .portfolio-text p {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #425B66;
            text-align: justify;
        }

        /* Right Side - Image */
        .portfolio-image-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .portfolio-image {
            width: 100%;
            max-width: 650px;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        /* Profile Section (NEW) - Sesuai Gambar Baru */
        .profile-section {
            background-color: #ffffff; /* Sesuai permintaan background putih */
            display: flex;
            align-items: center;
            padding: 80px 20px;
            min-height: 90vh; /* Agar ada jarak dan tidak terlalu nempel */
        }

        .profile-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            /* Layout: Gambar (kiri) 1fr | Teks (kanan) 1.2fr */
            grid-template-columns: 1fr 1.2fr; 
            gap: 60px;
            align-items: center;
        }

        /* Left Side - Image (NEW) */
        .profile-image-container {
            display: flex;
            justify-content: flex-start; /* Gambar di kiri */
            align-items: center;
        }

        .profile-image {
            width: 100%;
            max-width: 650px; /* Samakan dengan style .portfolio-image */
            height: auto;
            border-radius: 20px; /* Samakan dengan style .portfolio-image */
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15); /* Samakan dengan style .portfolio-image */
        }

        /* Right Side - Text Content (NEW) */
        .profile-text {
            padding-left: 40px; /* Teks di kanan, beri padding kiri */
        }

        .profile-text h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: #074159;
            margin-bottom: 2rem;
            line-height: 1.2;
        }

        .profile-text p {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #425B66;
            text-align: justify;
        }
        
        /* History Section (NEW) - Sesuai Gambar Timeline */
        .history-section {
            background-color: #F4F7F6; /* Sesuai permintaan */
            padding: 80px 20px;
        }

        .history-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .history-section-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #074159;
            text-align: center;
            margin-bottom: 80px;
            position: relative; /* Ditambahkan */
            padding-bottom: 20px; /* Ditambahkan */
        }

        /* Garis Oranye di bawah Judul - SESUAI PERMINTAAN */
        .history-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px; /* Lebar garis */
            height: 4px;
            background-color: #FF6600; /* Warna oranye */
        }


        .history-timeline {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 60px;
        }

        /* Garis tengah vertikal */
        .history-timeline::before {
            content: '';
            position: absolute;
            top: 20px;
            bottom: 20px;
            left: 50%;
            width: 3px;
            background-color: #074159; /* Warna garis */
            transform: translateX(-50%);
            z-index: 1;
        }

        .history-item {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 2; /* Di atas garis */
        }
        
        /* Titik oranye di tengah */
        .history-dot {
            width: 22px;
            height: 22px;
            background-color: #FF6600; /* Warna oranye */
            border-radius: 50%;
            border: 4px solid #F4F7F6; /* Border warna bg untuk 'memotong' garis */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 3; /* Di atas segalanya */
        }

        /* Garis Horizontal - SESUAI PERMINTAAN */
        .history-dot::before {
            content: '';
            position: absolute;
            top: 50%;
            height: 3px; /* Samakan dengan tebal garis vertikal */
            background-color: #074159; /* Warna garis */
            transform: translateY(-50%);
            width: 30px; /* Lebar = setengah dari 'gap' (60px / 2) */
            z-index: 2; /* Di bawah titik, di atas garis vertikal */
        }

        /* Item Ganjil (Teks Kiri): Garis ke Kiri */
        .history-item:nth-child(odd) .history-dot::before {
            right: 100%; /* Mulai dari tepi kiri titik */
            margin-right: 4px; /* Jarak kecil (sesuai border titik) */
        }

        /* Item Genap (Teks Kanan): Garis ke Kanan */
        .history-item:nth-child(even) .history-dot::before {
            left: 100%; /* Mulai dari tepi kanan titik */
            margin-left: 4px; /* Jarak kecil (sesuai border titik) */
        }


        .history-text h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #074159;
            margin-bottom: 1rem;
        }

        .history-text p {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #425B66;
            text-align: justify;
        }

        .history-image-container img {
            width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        }

        /* Layout Berselang-seling */
        /* Item 1 & 3 (Teks Kiri, Gambar Kanan) */
        .history-item:nth-child(odd) .history-text {
            grid-column: 1;
            text-align: right;
        }
        .history-item:nth-child(odd) .history-image-container {
            grid-column: 2;
        }
        .history-item:nth-child(odd) .history-text h3 {
            text-align: right;
        }

        /* Item 2 (Gambar Kiri, Teks Kanan) */
        .history-item:nth-child(even) .history-image-container {
            grid-column: 1;
        }
        .history-item:nth-child(even) .history-text {
            grid-column: 2;
            text-align: left;
        }
        .history-item:nth-child(even) .history-text h3 {
            text-align: left;
        }

        /* === Business Line Section === */
        .business-line-section {
            background-color: #074159; /* Sesuai permintaan */
            padding: 80px 20px;
        }

        .business-line-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .business-line-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #ffffff; /* Teks putih */
            text-align: center;
            margin-bottom: 80px;
            position: relative;
            padding-bottom: 20px;
        }

        /* Garis Oranye di bawah Judul */
        .business-line-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background-color: #FF6600; /* Warna oranye */
        }

        .business-line-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }

        .business-line-card {
            background-color: #2A6179; /* Warna kotak lebih terang, sesuai gambar */
            padding: 30px;
            border-radius: 15px;
            color: #ffffff;
            display: flex; 
            flex-direction: column;
        }

        .business-line-card h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .business-line-card .card-content {
            display: flex;
            justify-content: space-between;
            align-items: center; /* Vertikal center */
            gap: 20px;
            flex-grow: 1; 
        }

        .business-line-card p {
            font-size: 1.0rem;
            line-height: 1.7;
            color: #C0C0C0; /* Warna abu-abu */
            flex: 1; /* Teks mengambil sisa ruang */
        }

        .business-line-card .card-icon {
            width: 80px; /* Ukuran ikon */
            height: 80px;
            object-fit: contain; /* Pastikan SVG pas */
        }

        /* === Values & FAQ Section (NEW) === */
        .values-faq-section {
            background-color: #F4F7F6; /* Sesuai permintaan */
            padding: 80px 20px;
        }

        .values-faq-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        /* Values Part */
        .values-container {
            margin-bottom: 100px; /* Jarak ke FAQ */
        }

        .values-section-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #074159; /* Teks gelap */
            text-align: center;
            margin-bottom: 80px;
            position: relative;
            padding-bottom: 20px;
        }

        .values-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background-color: #FF6600; /* Warna oranye */
        }

        .values-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }

        .value-card {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.07);
            text-align: center;
        }

        .value-icon {
            height: 50px; /* Ukuran ikon */
            object-fit: contain;
            margin-bottom: 1.5rem;
        }

        .value-card h3 {
            font-size: 1.5rem;
            color: #074159;
            font-weight: 600;
        }

        /* FAQ Part */
        .faq-section-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #074159; /* Teks gelap */
            text-align: center;
            margin-bottom: 80px;
            position: relative;
            padding-bottom: 20px;
        }

        .faq-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background-color: #FF6600; /* Warna oranye */
        }

        .faq-list {
            max-width: 900px; /* FAQ list lebih sempit */
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .faq-item {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 2px solid transparent; /* Border transparan */
        }
        
        /* State Aktif (sesuai gambar) */
        .faq-item.active {
            border-color: #FF6600; /* Border oranye */
        }
        
        .faq-item.active .faq-question {
            color: #FF6600; /* Teks pertanyaan jadi oranye */
        }

        .faq-question {
            width: 100%;
            background: transparent;
            border: none;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-family: 'Besley', serif;
            font-size: 1.1rem;
            color: #074159;
            font-weight: 600;
            text-align: left;
            transition: color 0.3s ease;
        }

        .faq-toggle {
            font-size: 1.5rem;
            font-weight: 700;
            color: #FF6600;
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-toggle {
            transform: rotate(45deg); /* Opsi 1: rotate */
            /* content: '−'; Opsi 2: ganti teks (diurus JS) */
        }

        .faq-answer {
            padding: 0 25px 25px 25px;
            color: #425B66;
            line-height: 1.7;
            font-size: 0.95rem;
            display: none; /* Default tersembunyi */
        }
        
        /* State Aktif (tampilkan jawaban) */
        .faq-item.active .faq-answer {
            display: block;
        }
        
        /* === Contact Section (NEW) === */
        .contact-section {
            background-color: #ffffff; /* Diubah menjadi putih sesuai permintaan */
            padding: 80px 20px;
        }

        .contact-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .contact-section-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #074159;
            margin-bottom: 1.5rem;
        }

        .contact-header p {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #425B66;
            max-width: 650px;
            margin: 0 auto;
        }

        .contact-card {
            background-color: #ffffff; /* Kartu putih sesuai gambar */
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1); 
            padding: 50px 60px;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 60px;
            align-items: flex-start;
        }

        .contact-form h2,
        .contact-info h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #074159;
            margin-bottom: 30px;
        }
        
        .contact-info .info-title-secondary {
            margin-top: 40px; /* Jarak antara "Lokasi" dan "Terhubung" */
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.95rem;
            font-weight: 600;
            color: #074159;
            margin-bottom: 8px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid #DDE2E5;
            border-radius: 8px;
            font-family: 'Besley', serif;
            font-size: 1rem;
            color: #425B66;
        }
        
        .form-group input[type="text"]::placeholder,
        .form-group input[type="email"]::placeholder,
        .form-group textarea::placeholder {
            color: #9DB0B9;
        }

        .form-group textarea {
            min-height: 140px;
            resize: vertical;
        }

        .submit-btn {
            background-color: #074159;
            color: #ffffff;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-family: 'Besley', serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex; /* Diubah dari inline-flex */
            width: 100%; /* Ditambahkan agar full-width */
            justify-content: center; /* Ditambahkan untuk menengahkan konten tombol */
            align-items: center;
            gap: 10px;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #053346;
        }

        .submit-btn .btn-icon {
            width: 18px;
            height: 18px;
            object-fit: contain;
        }
        
        /* Contact Info Side */
        .info-list {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 18px;
        }

        .info-icon {
            width: 24px;
            height: 24px;
            object-fit: contain;
            margin-top: 5px; /* Align icon with first line of text */
            flex-shrink: 0;
        }

        .info-text h3 {
            font-size: 1.15rem; 
            font-weight: 700;
            color: #074159;
            margin-bottom: 5px;
        }

        .info-text p {
            font-size: 1rem;
            line-height: 1.6;
            color: #425B66;
            margin: 0;
        }

        /* === Maps Section (NEW) === */
        .maps-section {
            background-color: #F4F7F6; /* Sesuai permintaan */
            padding: 80px 20px;
        }

        .maps-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .maps-section-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #074159; /* Teks gelap */
            text-align: center;
            margin-bottom: 80px; /* Jarak dari judul ke map */
            position: relative;
            padding-bottom: 20px;
        }

        .maps-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background-color: #FF6600; /* Warna oranye */
        }
        
        .maps-container {
            width: 100%;
            border-radius: 15px; /* Samakan dengan gambar-gambar lain */
            overflow: hidden; /* Penting untuk border-radius di iframe */
            box-shadow: 0 15px 40px rgba(0,0,0,0.12); /* Samakan dengan history image */
        }
        
        .maps-container iframe {
            width: 100%;
            height: 500px; /* Ketinggian default */
            border: 0;
        }


        /* Responsive Design */
        @media (max-width: 1024px) {
            .portfolio-wrapper {
                grid-template-columns: 1fr;
                gap: 40px;
                padding: 40px 20px;
            }

            .portfolio-text {
                padding-right: 0;
                text-align: center;
            }

            .portfolio-text h1 {
                font-size: 2.5rem;
            }

            .portfolio-text p {
                text-align: center;
            }

            .portfolio-image-container {
                justify-content: center;
            }

            .portfolio-image {
                max-width: 100%;
            }

            /* Responsive for New Profile Section */
            .profile-wrapper {
                grid-template-columns: 1fr; /* Stack di mobile */
                gap: 40px;
                padding: 40px 20px;
            }

            .profile-text {
                padding-left: 0;
                text-align: center;
            }

            .profile-text h1 {
                font-size: 2.5rem;
            }

            .profile-text p {
                text-align: center;
            }

            .profile-image-container {
                justify-content: center; /* Gambar di tengah */
            }

            .profile-image {
                max-width: 100%;
            }

            /* Responsive for History Section */
            .history-section-title {
                font-size: 2.5rem;
            }

            /* Responsive for Business Line Section */
            .business-line-title {
                font-size: 2.5rem;
            }
            .business-line-cards {
                grid-template-columns: 1fr; /* Stack di tablet */
                gap: 30px;
            }

            /* Responsive for Values/FAQ Section */
            .values-section-title,
            .faq-section-title {
                font-size: 2.5rem;
            }
            .values-cards {
                grid-template-columns: 1fr; /* Stack di tablet */
                gap: 30px;
            }

            /* Responsive for Contact Section */
            .contact-section-title {
                font-size: 2.5rem;
            }
            .contact-card {
                grid-template-columns: 1fr;
                gap: 50px;
            }

            /* Responsive for Maps Section */
            .maps-section-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .portfolio-section {
                padding: 60px 20px;
            }

            .portfolio-text h1 {
                font-size: 2rem;
                margin-bottom: 1.5rem;
            }

            .portfolio-text p {
                font-size: 0.95rem;
            }

            .portfolio-image {
                border-radius: 12px;
            }

            /* Responsive for New Profile Section */
            .profile-section {
                padding: 60px 20px;
            }

            .profile-text h1 {
                font-size: 2rem;
                margin-bottom: 1.5rem;
            }

            .profile-text p {
                font-size: 0.95rem;
            }

            .profile-image {
                border-radius: 12px;
            }

            /* Responsive for History Section */
            .history-timeline::before {
                display: none; /* Sembunyikan garis tengah di mobile */
            }
            .history-dot {
                display: none; /* Sembunyikan titik di mobile */
            }
            .history-dot::before {
                display: none; /* Sembunyikan garis horizontal di mobile */
            }

            .history-item {
                grid-template-columns: 1fr; /* Stack */
                gap: 30px;
            }

            /* Atur ulang urutan agar selalu: Gambar (atas), Teks (bawah) */
            .history-item:nth-child(odd) .history-image-container,
            .history-item:nth-child(even) .history-image-container {
                grid-column: 1;
                grid-row: 1; /* Gambar di baris 1 */
            }

            .history-item:nth-child(odd) .history-text,
            .history-item:nth-child(even) .history-text {
                grid-column: 1;
                grid-row: 2; /* Teks di baris 2 */
                text-align: left; /* Ratakan kiri semua */
            }

            .history-item:nth-child(odd) .history-text h3,
            .history-item:nth-child(even) .history-text h3 {
                text-align: left; /* Ratakan kiri semua */
                font-size: 1.5rem;
            }

             .history-text p {
                text-align: justify; /* Teks paragraf tetap justify */
            }

            /* Responsive for Business Line Section */
            .business-line-title {
                font-size: 2rem;
            }
            .business-line-card h3 {
                font-size: 1.5rem;
            }

            /* Responsive for Values/FAQ Section */
            .values-section-title,
            .faq-section-title {
                font-size: 2rem;
            }
            .value-card h3 {
                font-size: 1.3rem;
            }

            /* Responsive for Contact Section */
            .contact-section {
                padding: 60px 20px;
            }
            .contact-section-title {
                font-size: 2rem;
            }
            .contact-header p {
                font-size: 0.95rem;
            }
            .contact-card {
                padding: 30px;
            }
            .contact-form h2,
            .contact-info h2 {
                font-size: 2rem;
            }
            .form-row {
                grid-template-columns: 1fr;
                gap: 0; /* Biarkan margin-bottom .form-group yg bekerja */
            }

            /* Responsive for Maps Section */
            .maps-section {
                padding: 60px 20px;
            }
            .maps-section-title {
                font-size: 2rem;
            }
            .maps-container iframe {
                height: 400px; /* Kurangi tinggi di mobile */
            }
        }

        @media (max-width: 480px) {
            .portfolio-text h1 {
                font-size: 1.75rem;
            }

            .portfolio-text p {
                font-size: 0.9rem;
                line-height: 1.6;
            }

            /* Responsive for New Profile Section */
            .profile-text h1 {
                font-size: 1.75rem;
            }

            .profile-text p {
                font-size: 0.9rem;
                line-height: 1.6;
            }

            /* Responsive for History Section */
            .history-section-title {
                font-size: 2rem;
            }

            /* Responsive for Business Line Section */
            .business-line-title {
                font-size: 1.75rem;
            }

            /* Responsive for Values/FAQ Section */
            .values-section-title,
            .faq-section-title {
                font-size: 1.75rem;
            }

            /* Responsive for Contact Section */
            .contact-section-title {
                font-size: 1.75rem;
            }
            .contact-header p {
                font-size: 0.9rem;
            }
            .contact-card {
                padding: 25px 20px;
            }
            .contact-form h2,
            .contact-info h2 {
                font-size: 1.75rem;
            }

            /* Responsive for Maps Section */
            .maps-section-title {
                font-size: 1.75rem;
            }
            .maps-container iframe {
                height: 350px;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <section class="portfolio-section">
        <div class="portfolio-wrapper">
            <div class="portfolio-text">
                <h1>Tentang Kami</h1>
                <p>
                    Pellentesque a imperdiet leo. Vivamus non augue vel justo commodo ornare. 
                    Ut a enim maximus, congue lectus ut, tincidunt est. In laoreet vehicula 
                    tincidunt. Curabitur non facilisis quam. Aliquam gravida purus sed tellus 
                    pulvinar, eu accumsan orci tincidunt. Duis sagittis, diam ultricies semper 
                    pharetra, metus sem mattis nulla, nec vestibulum leo lorem ut leo. Maecenas 
                    venenatis, ipsum eget fringilla sodales, est lectus commodo purus, eget 
                    sollicitudin magna turpis vitae nunc. Suspendisse mattis, dui sed condimentum 
                    pretium, sapien mauris efficitu
                </p>
            </div>

            <div class="portfolio-image-container">
                <img src="{{ asset('assets/img/ kardus.png') }}" alt="Produksi Kemasan Karton SIKEMAS" class="portfolio-image" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
            </div>
        </div>
    </section>

    <section class="profile-section">
        <div class="profile-wrapper">
            <div class="profile-image-container">
                <img src="{{ asset('assets/img/ pabrik.png') }}" alt="Profil Perusahaan SIKEMAS" class="profile-image" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
            </div>
            
            <div class="profile-text">
                <h1>Profil Perusahaan</h1>
                <p>
                    Pellentesque a imperdiet leo. Vivamus non augue vel justo commodo ornare. 
                    Ut a enim maximus, congue lectus ut, tincidunt est. In laoreet vehicula 
                    tincidunt. Curabitur non facilisis quam. Aliquam gravida purus sed tellus 
                    pulvinar, eu accumsan orci tincidunt. Duis sagittis, diam ultricies semper 
                    pharetra, metus sem mattis nulla, nec vestibulum leo lorem ut leo. Maecenas 
                    venenatis, ipsum eget fringilla sodales, est lectus commodo purus, eget 
                    sollicitudin magna turpis vitae nunc. Suspendisse mattis, dui sed condimentum 
                    pretium, sapien mauris efficitu
                </p>
            </div>
        </div>
    </section>

    <section class="history-section">
        <div class="history-wrapper">
            <h1 class="history-section-title">Sejarah Kami</h1>

            <div class="history-timeline">
                
                <div class="history-item">
                    <div class="history-text">
                        <h3>2xxx - Awal Mula</h3>
                        <p>
                            Pellentesque a imperdiet leo. Vivamus non augue vel justo commodo ornare. 
                            Ut a enim maximus, congue lectus ut, tincidunt est. In laoreet vehicula 
                            tincidunt. Curabitur non facilisis quam. Aliquam gravida purus sed tellus 
                            pulvinar, eu accumsan orci tincidunt. Duis sagittis, diam ultricies semper 
                            pharetra, metus sem mattis nulla, nec vestibulum leo lorem ut leo. Maecenas 
                            venenatis, ipsum eget fringilla sodales, est lectus commodo purus...
                        </p>
                    </div>
                    <div class="history-dot"></div>
                    <div class="history-image-container">
                        <img src="{{ asset('assets/img/ awalperusahaan.png') }}" alt="Awal Mula Perusahaan SIKEMAS" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-image-container">
                        <img src="{{ asset('assets/img/ekspansibisnis.png') }}" alt="Ekspansi Bisnis SIKEMAS" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                    </div>
                    <div class="history-dot"></div>
                    <div class="history-text">
                        <h3>2xxx - Ekspansi Bisnis</h3>
                        <p>
                            Pellentesque a imperdiet leo. Vivamus non augue vel justo commodo ornare. 
                            Ut a enim maximus, congue lectus ut, tincidunt est. In laoreet vehicula 
                            tincidunt. Curabitur non facilisis quam. Aliquam gravida purus sed tellus 
                            pulvinar, eu accumsan orci tincidunt. Duis sagittis, diam ultricies semper 
                            pharetra, metus sem mattis nulla, nec vestibulum leo lorem ut leo. Maecenas 
                            venenatis, ipsum eget fringilla sodales, est lectus commodo purus...
                        </p>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-text">
                        <h3>2xxx - Inovasi Berkelanjutan</h3>
                        <p>
                            Pellentesque a imperdiet leo. Vivamus non augue vel justo commodo ornare. 
                            Ut a enim maximus, congue lectus ut, tincidunt est. In laoreet vehicula 
                            tincidunt. Curabitur non facilisis quam. Aliquam gravida purus sed tellus 
                            pulvinar, eu accumsan orci tincidunt. Duis sagittis, diam ultricies semper 
                            pharetra, metus sem mattis nulla, nec vestibulum leo lorem ut leo. Maecenas 
                            venenatis, ipsum eget fringilla sodales, est lectus commodo purus...
                        </p>
                    </div>
                    <div class="history-dot"></div>
                    <div class="history-image-container">
                        <img src="{{ asset('assets/img/inovasi.png') }}" alt="Inovasi Berkelanjutan SIKEMAS" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="business-line-section">
        <div class="business-line-wrapper">
            <h1 class="business-line-title">Lini Bisnis</h1>

            <div class="business-line-cards">
                
                <div class="business-line-card">
                    <h3>Solusi Produk Khusus</h3>
                    <div class="card-content">
                        <p>Kami menyediakan kemasan yang dirancang secara unik untuk menonjolkan keunggulan produk Anda.</p>
                        <img src="{{ asset('assets/img/produk.svg') }}" alt="Solusi Produk Khusus" class="card-icon" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                    </div>
                </div>

                <div class="business-line-card">
                    <h3>Karton Bergelombang</h3>
                    <div class="card-content">
                        <p>Produksi karton bergelombang dengan kekuatan dan ketahanan optimal untuk pengiriman aman.</p>
                        <img src="{{ asset('assets/img/karton.svg') }}" alt="Karton Bergelombang" class="card-icon" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                    </div>
                </div>

                <div class="business-line-card">
                    <h3>Kemasan Ramah Lingkungan</h3>
                    <div class="card-content">
                        <p>Komitmen kami pada keberlanjutan dengan menyediakan kemasan dari bahan daur ulang.</p>
                        <img src="{{ asset('assets/img/lingkungan.svg') }}" alt="Kemasan Ramah Lingkungan" class="card-icon" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="values-faq-section">
        <div class="values-faq-wrapper">

            <div class="values-container">
                <h1 class="values-section-title">Nilai Perusahaan</h1>
                <div class="values-cards">
                    
                    <div class="value-card">
                        <img src="{{ asset('assets/img/symbol13.svg') }}" alt="Mengutamakan Pelanggan" class="value-icon" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                        <h3>Mengutamakan Pelanggan</h3>
                    </div>

                    <div class="value-card">
                        <img src="{{ asset('assets/img/symbol14.svg') }}" alt="Keselamatan dan Lingkungan" class="value-icon" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                        <h3>Keselamatan dan Lingkungan</h3>
                    </div>

                    <div class="value-card">
                        <img src="{{ asset('assets/img/container5.svg') }}" alt="Sigap, bersemangat, dan dinamis" class="value-icon" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                        <h3>Sigap, bersemangat, dan dinamis</h3>
                    </div>

                </div>
            </div>

            <div class="faq-container">
                <h1 class="faq-section-title">Pertanyaan yang Sering Diajukan</h1>
                <div class="faq-list">

                    <div class="faq-item active">
                        <button class="faq-question">
                            <span>Bagaimana cara memesan kemasan kustom?</span>
                            <span class="faq-toggle">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>laoreet dolor bibendum. Vestibulum turpis mi, vulputate a est ut, facilisis tincidunt sapien. Curabitur quis ultrices dolor. Nam pellentesque, neque sit amet dapibus viverra</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Apakah ada minimum order?</span>
                            <span class="faq-toggle">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>Jawaban untuk pertanyaan minimum order akan muncul di sini saat diklik.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Berapa lama waktu produksi?</span>
                            <span class="faq-toggle">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>Jawaban untuk pertanyaan lama waktu produksi akan muncul di sini saat diklik.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Apakah produk Anda ramah lingkungan?</span>
                            <span class="faq-toggle">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>Jawaban untuk pertanyaan ramah lingkungan akan muncul di sini saat diklik.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <section class="contact-section">
        <div class="contact-wrapper">
            <div class="contact-header">
                <h1 class="contact-section-title">Mari Terhubung dengan Sikemas</h1>
                <p>Punya pertanyaan, ide kolaborasi, atau ingin berbagi cerita? Tim profesional kami siap melayani Anda.</p>
            </div>

            <div class="contact-card">
                <div class="contact-form">
                    <h2>Kirim Pesan Kepada Kami</h2>
                    <form action="#" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nama">Nama Anda</label>
                                <input type="text" id="nama" name="nama" placeholder="Nama Anda">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="email@contoh.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subjek">Subjek</label>
                            <input type="text" id="subjek" name="subjek" placeholder="Subjek Pesan">
                        </div>
                        <div class="form-group">
                            <label for="pesan">Pesan Anda</label>
                            <textarea id="pesan" name="pesan" rows="6" placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>
                        <button type="submit" class="submit-btn">
                            <span>Kirim Pesan</span>
                            <img src="{{ asset('assets/img/pesan.svg') }}" alt="Kirim" class="btn-icon" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                        </button>
                    </form>
                </div>

                <div class="contact-info">
                    <h2>Lokasi Kami</h2>
                    <div class="info-list">
                        <div class="info-item">
                            <img src="{{ asset('assets/img/kantor.svg') }}" alt="Lokasi" class="info-icon" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                            <div class="info-text">
                                <h3>Kantor Pusat Sikemas</h3>
                                <p>Jl. Kartini, Rempoa, No. 121, Jakarta, Indonesia 12345</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <img src="{{ asset('assets/img/telp.svg') }}" alt="Telepon" class="info-icon" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                            <div class="info-text">
                                <h3>Telepon</h3>
                                <p>+62 21 8765 4321</p>
                            </div>
                        </div>
                    </div>

                    <h2 class="info-title-secondary">Terhubung dengan Kami</h2>
                    <div class="info-list">
                         <div class="info-item">
                            <img src="{{ asset('assets/img/ig.svg') }}" alt="Instagram" class="info-icon" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                            <div class="info-text">
                                <h3>Instagram</h3>
                                <p>@sikemas_official</p>
                            </div>
                        </div>
                         <div class="info-item">
                            <img src="{{ asset('assets/img/link.svg') }}" alt="LinkedIn" class="info-icon" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                            <div class="info-text">
                                <h3>LinkedIn</h3>
                                <p>Sikemas Official</p>
                            </div>
                        </div>
                         <div class="info-item">
                            <img src="{{ asset('assets/img/email.svg') }}" alt="Email" class="info-icon" onerror="console.error('Gambar tidak ditemukan:', this.src); this.style.border='2px dashed red';">
                            <div class="info-text">
                                <h3>Email</h3>
                                <p>info@sikemas.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="maps-section">
        <div class="maps-wrapper">
            <h1 class="maps-section-title">Temukan Kami di Google Maps</h1>
            
            <div class="maps-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.8649581816!2d106.7628853!3d-6.281135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f0f9b6113b9b%3A0x66f03d8d3e110430!2sJl.%20Kartini%20No.121%2C%20Rempoa%2C%20Kec.%20Ciputat%20Tim.%2C%20Kota%20Tangerang%20Selatan%2C%20Banten%2015412!5e0!3m2!1sen!2sid!4v1678888888888!5m2!1sen!2sid" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const faqQuestions = document.querySelectorAll('.faq-question');

            faqQuestions.forEach(button => {
                button.addEventListener('click', () => {
                    const item = button.closest('.faq-item');
                    const toggle = button.querySelector('.faq-toggle');

                    // Cek apakah item ini sudah aktif
                    const isActive = item.classList.contains('active');

                    // 1. Tutup semua item lain
                    document.querySelectorAll('.faq-item').forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('active');
                            otherItem.querySelector('.faq-toggle').textContent = '+';
                        }
                    });

                    // 2. Buka atau tutup item yang diklik
                    if (isActive) {
                        // Jika sudah aktif, tutup
                        item.classList.remove('active');
                        toggle.textContent = '+';
                    } else {
                        // Jika tidak aktif, buka
                        item.classList.add('active');
                        toggle.textContent = '−'; // Ganti jadi minus (atau biarkan CSS 'transform: rotate' bekerja)
                    }
                });
            });

            // Set item pertama agar sesuai dengan gambar (tanda 'minus' jika 'active')
            // CSS sudah menangani 'display: block', kita hanya perlu atur icon toggle
            document.querySelectorAll('.faq-item.active .faq-toggle').forEach(toggle => {
                 toggle.textContent = '−';
                 // Jika Anda lebih suka icon '+' berputar, hapus baris ini dan baris 1122, 
                 // lalu uncomment 'transform: rotate(45deg);' di CSS
            });
        });
    </script>

</body>
</html>