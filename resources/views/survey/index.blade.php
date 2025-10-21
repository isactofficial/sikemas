<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey - Profil Produk Anda</title>
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: auto;
            padding: 2rem 1rem;
        }

        .survey-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .survey-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 2rem 2rem;
            max-width: 450px;
            width: 90%;
            margin: auto;
        }

        .progress-bar-container {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .progress-bar {
            flex: 1;
            height: 4px;
            background-color: #ddd;
            border-radius: 2px;
            transition: background-color 0.3s ease;
        }

        .progress-bar.active {
            background-color: #ff5722;
        }

        .survey-title {
            color: #074159;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .survey-subtitle {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            line-height: 1.5;
            text-align: center;
        }

        .survey-step {
            display: none;
        }

        .survey-step.active {
            display: block;
        }

        .form-section {
            margin-bottom: 1.5rem;
        }

        .section-title {
            color: #333;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .radio-group, .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .radio-option, .checkbox-option {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
        }

        /* --- PERUBAHAN ACCENT COLOR KE ORANGE --- */
        .radio-option input[type="radio"],
        .checkbox-option input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #ff5722; /* Diubah ke orange */
        }

        .radio-option label,
        .checkbox-option label {
            font-size: 0.95rem;
            color: #333;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.2s ease, font-weight 0.2s ease;
        }

        /* --- LABEL YANG DICEKLIS TETAP HITAM --- */
        .radio-option input[type="radio"]:checked + label,
        .checkbox-option input[type="checkbox"]:checked + label {
            color: #333; /* Tetap hitam */
            font-weight: 700;
        }
        /* --- AKHIR PERUBAHAN --- */

        .option-icon {
            width: 1.1rem;
            height: 1.1rem;
            object-fit: contain;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: #333;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: 'Besley', serif;
            font-size: 0.9rem;
            resize: vertical;
            min-height: 100px;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #074159;
            box-shadow: 0 0 0 3px rgba(7, 65, 89, 0.1);
        }

        .file-upload {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .file-upload-btn {
            background-color: #074159;
            color: white;
            padding: 0.65rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-family: 'Besley', serif;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .file-upload-btn:hover {
            background-color: #053244;
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .file-name {
            font-size: 0.85rem;
            color: #666;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-secondary {
            flex: 1;
            background-color: white;
            color: #074159;
            padding: 0.75rem;
            border: 1px solid #074159;
            border-radius: 6px;
            font-family: 'Besley', serif;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #f0f0f0;
        }

        .btn-primary {
            flex: 1;
            background-color: #074159;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            font-family: 'Besley', serif;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #053244;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 65, 89, 0.3);
        }

        @media (max-width: 480px) {
            .survey-container {
                padding: 1.5rem;
            }

            .survey-title {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <img src="{{ asset('assets/img/Login_Page.png') }}" alt="Background" class="survey-background">
    
    <div class="survey-container">
        <div class="progress-bar-container">
            <div class="progress-bar" id="progress1"></div>
            <div class="progress-bar" id="progress2"></div>
            <div class="progress-bar" id="progress3"></div>
        </div>

        <h1 class="survey-title">Profil Produk Anda</h1>
        <p class="survey-subtitle">Mohon lengkapi data berikut agar kami dapat memberikan solusi kemasan yang paling tepat untuk Anda.</p>

        <form action="{{ url('/survey/submit') }}" method="POST" enctype="multipart/form-data" id="surveyForm">
            @csrf

            <div class="survey-step active" id="step1">
                <div class="form-section">
                    <h3 class="section-title">Jenis Produk</h3>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="makanan" name="jenis_produk" value="makanan" required>
                            <label for="makanan">
                                <img src="{{ asset('assets/img/symbol.svg') }}" alt="Makanan" class="option-icon">
                                Makanan
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="non_makanan" name="jenis_produk" value="non_makanan">
                            <label for="non_makanan">
                                <img src="{{ asset('assets/img/container.svg') }}" alt="Non-Makanan" class="option-icon">
                                Non-Makanan
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="section-title">Wujud Produk</h3>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="padat" name="wujud_produk" value="padat" required>
                            <label for="padat">
                                <img src="{{ asset('assets/img/container1.svg') }}" alt="Padat" class="option-icon">
                                Padat
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="cair" name="wujud_produk" value="cair">
                            <label for="cair">
                                <img src="{{ asset('assets/img/container2.svg') }}" alt="Cair" class="option-icon">
                                Cair
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="section-title">Kondisi Produk</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" id="rawan_rusak" name="kondisi_produk[]" value="rawan_rusak">
                            <label for="rawan_rusak">
                                <img src="{{ asset('assets/img/container3.svg') }}" alt="Rawan Rusak" class="option-icon">
                                Rawan Rusak
                            </label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="rawan_pecah" name="kondisi_produk[]" value="rawan_pecah">
                            <label for="rawan_pecah">
                                <img src="{{ asset('assets/img/container4.svg') }}" alt="Rawan Pecah" class="option-icon">
                                Rawan Pecah
                            </label>
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="button" class="btn-primary" onclick="nextStep(2)">Lanjut</button>
                </div>
            </div>

            <div class="survey-step" id="step2">
                <div class="form-section">
                    <h3 class="section-title">Material Produk</h3>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="kertas" name="material_produk" value="kertas" required>
                            <label for="kertas">
                                <img src="{{ asset('assets/img/Symbol1.svg') }}" alt="Kertas" class="option-icon">
                                Kertas
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="plastik" name="material_produk" value="plastik">
                            <label for="plastik">
                                <img src="{{ asset('assets/img/symbol2.svg') }}" alt="Plastik" class="option-icon">
                                Plastik
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="alumunium" name="material_produk" value="alumunium">
                            <label for="alumunium">
                                <img src="{{ asset('assets/img/symbol3.svg') }}" alt="Alumunium" class="option-icon">
                                Alumunium
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="styrofoam" name="material_produk" value="styrofoam">
                            <label for="styrofoam">
                                <img src="{{ asset('assets/img/symbol4.svg') }}" alt="Styrofoam" class="option-icon">
                                Styrofoam
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="natural" name="material_produk" value="natural">
                            <label for="natural">
                                <img src="{{ asset('assets/img/symbol5.svg') }}" alt="Natural" class="option-icon">
                                Natural
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="section-title">Jarak Distribusi</h3>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="jarak_500km" name="jarak_distribusi" value="<500km" required>
                            <label for="jarak_500km">
                                <img src="{{ asset('assets/img/symbol6.svg') }}" alt="<500km" class="option-icon">
                                &lt;500km
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="jarak_500_750km" name="jarak_distribusi" value="500-750km">
                            <label for="jarak_500_750km">
                                <img src="{{ asset('assets/img/symbol7.svg') }}" alt="500-750km" class="option-icon">
                                500-750km
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="jarak_750km" name="jarak_distribusi" value=">750km">
                            <label for="jarak_750km">
                                <img src="{{ asset('assets/img/symbol8.svg') }}" alt=">750km" class="option-icon">
                                &gt;750km
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="international" name="jarak_distribusi" value="international">
                            <label for="international">
                                <img src="{{ asset('assets/img/symbol9.svg') }}" alt="International" class="option-icon">
                                International
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="section-title">Cara Pengiriman</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" id="darat" name="cara_pengiriman[]" value="darat">
                            <label for="darat">
                                <img src="{{ asset('assets/img/symbol10.svg') }}" alt="Darat" class="option-icon">
                                Darat
                            </label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="udara" name="cara_pengiriman[]" value="udara">
                            <label for="udara">
                                <img src="{{ asset('assets/img/symbol11.svg') }}" alt="Udara" class="option-icon">
                                Udara
                            </label>
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="button" class="btn-secondary" onclick="prevStep(1)">Kembali</button>
                    <button type="button" class="btn-primary" onclick="nextStep(3)">Lanjut</button>
                </div>
            </div>

            <div class="survey-step" id="step3">
                <div class="form-group">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea 
                        id="catatan" 
                        name="catatan" 
                        class="form-textarea" 
                        placeholder="Catatan lain yang ingin disampaikan mengenai produk atau merek Anda..."
                    ></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Foto Produk</label>
                    <div class="file-upload">
                        <label for="foto_produk" class="file-upload-btn">
                            <img src="{{ asset('assets/img/symbol12.svg') }}" alt="Camera" style="width: 1.1rem; height: 1.1rem; object-fit: contain;">
                            Pilih Gambar
                        </label>
                        <input type="file" id="foto_produk" name="foto_produk" accept="image/*" onchange="displayFileName()">
                        <span class="file-name" id="fileName">Tidak ada file dipilih</span>
                    </div>
                </div>

                <div class="button-group">
                    <button type="button" class="btn-secondary" onclick="prevStep(2)">Kembali</button>
                    <button type="submit" class="btn-primary">Selesai & Kirim</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let currentStep = 1;

        function nextStep(step) {
            // Validasi step saat ini sebelum pindah
            const currentStepElement = document.getElementById(`step${currentStep}`);
            const requiredInputs = currentStepElement.querySelectorAll('[required]');
            let isValid = true;

            requiredInputs.forEach(input => {
                if (input.type === 'radio') {
                    const radioGroup = currentStepElement.querySelectorAll(`[name="${input.name}"]`);
                    const isChecked = Array.from(radioGroup).some(radio => radio.checked);
                    if (!isChecked) {
                        isValid = false;
                    }
                } else if (!input.value) {
                    isValid = false;
                }
            });

            if (!isValid) {
                alert('Mohon lengkapi semua field yang wajib diisi');
                return;
            }

            // Sembunyikan step saat ini
            document.getElementById(`step${currentStep}`).classList.remove('active');
            document.getElementById(`progress${currentStep}`).classList.remove('active');

            // Tampilkan step baru
            currentStep = step;
            document.getElementById(`step${currentStep}`).classList.add('active');
            document.getElementById(`progress${currentStep}`).classList.add('active');

            // Scroll ke atas
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function prevStep(step) {
            // Sembunyikan step saat ini
            document.getElementById(`step${currentStep}`).classList.remove('active');
            document.getElementById(`progress${currentStep}`).classList.remove('active');

            // Tampilkan step sebelumnya
            currentStep = step;
            document.getElementById(`step${currentStep}`).classList.add('active');
            document.getElementById(`progress${currentStep}`).classList.add('active');

            // Scroll ke atas
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function displayFileName() {
            const input = document.getElementById('foto_produk');
            const fileName = document.getElementById('fileName');
            if (input.files.length > 0) {
                fileName.textContent = input.files[0].name;
            } else {
                fileName.textContent = 'Tidak ada file dipilih';
            }
        }

        // Set progress bar pertama sebagai active
        document.getElementById('progress1').classList.add('active');
    </script>
</body>
</html>