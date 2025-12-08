<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($address) ? 'Edit' : 'Tambah' }} Alamat - SIKEMAS</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-sikemas-2-removebg.png') }}">
    <script src="{{ asset('js/dynamic-favicon.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- jQuery & Select2 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Besley', serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
        }

        .page-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .page-title {
            color: #074159;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #666;
            font-size: 0.95rem;
        }

        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #074159;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-label.required::after {
            content: ' *';
            color: #ff5722;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: 'Besley', serif;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #074159;
            box-shadow: 0 0 0 3px rgba(7, 65, 89, 0.1);
        }

        .form-input:disabled,
        .form-select:disabled {
            background-color: #f5f5f5;
            cursor: not-allowed;
        }

        .form-help {
            font-size: 0.8rem;
            color: #666;
            margin-top: 0.25rem;
        }

        .auto-info {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #e8f5e9;
            border-radius: 6px;
            font-size: 0.85rem;
            color: #2e7d32;
            margin-top: 0.5rem;
        }

        .auto-info::before {
            content: '✓';
            font-weight: bold;
            font-size: 1.1rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem;
            background: #f9f9f9;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .checkbox-group:hover {
            background: #f0f5f7;
        }

        .checkbox-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .checkbox-group label {
            cursor: pointer;
            user-select: none;
            font-weight: 500;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: none;
        }

        .alert.show {
            display: block;
        }

        .alert-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #f0f0f0;
        }

        .btn {
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Besley', serif;
        }

        .btn-secondary {
            background: #e0e0e0;
            color: #333;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-secondary:hover {
            background: #d0d0d0;
        }

        .btn-primary {
            background: #074159;
            color: white;
        }

        .btn-primary:hover {
            background: #053244;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 65, 89, 0.3);
        }

        .btn-primary:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .info-box {
            background: #e3f2fd;
            border-left: 4px solid #2196F3;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
        }

        .info-box p {
            margin: 0;
            color: #1565C0;
            font-size: 0.9rem;
        }

        /* Custom Select2 Styles */
        .select2-container--default .select2-selection--single {
            height: 45px;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 0.5rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px;
            padding-left: 0.5rem;
            font-family: 'Besley', serif;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 43px;
        }

        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #074159;
            box-shadow: 0 0 0 3px rgba(7, 65, 89, 0.1);
        }

        .select2-dropdown {
            border: 1px solid #074159;
            border-radius: 6px;
            font-family: 'Besley', serif;
        }

        .select2-results__option {
            padding: 0.75rem;
        }

        .loading-text {
            color: #074159;
            font-size: 0.9rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        .location-preview {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 1rem;
            margin-top: 1rem;
            display: none;
        }

        .location-preview.show {
            display: block;
        }

        .location-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .location-item:last-child {
            border-bottom: none;
        }

        .location-label {
            font-weight: 600;
            color: #495057;
        }

        .location-value {
            color: #074159;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">{{ isset($address) ? 'Edit' : 'Tambah' }} Alamat</h1>
            <p class="page-subtitle">
                {{ isset($address) ? 'Perbarui informasi alamat Anda' : 'Tambahkan alamat pengiriman baru' }}</p>
        </div>

        <div id="alertBox" class="alert"></div>

        <div class="form-card">
            @if (isset($address))
                <form action="{{ route('profile.address.update', $address->id) }}" method="POST" id="addressForm">
                    @method('PUT')
                @else
                    <form action="{{ route('profile.address.store') }}" method="POST" id="addressForm">
            @endif
            @csrf

            <div class="info-box">
                <p>💡 Cukup pilih Kabupaten/Kota, provinsi dan kode pos akan terisi otomatis dari API</p>
            </div>

            <!-- Tipe Alamat -->
            <div class="form-section">
                <h3 class="section-title">Informasi Alamat</h3>

                <div class="form-group">
                    <label for="address_type" class="form-label required">Tipe Alamat</label>
                    <select id="address_type" name="address_type" class="form-select" required>
                        <option value="">Pilih tipe alamat...</option>
                        <option value="Home"
                            {{ old('address_type', $address->address_type ?? '') == 'Home' ? 'selected' : '' }}>🏠 Home
                            (Rumah)</option>
                        <option value="Office"
                            {{ old('address_type', $address->address_type ?? '') == 'Office' ? 'selected' : '' }}>🏢
                            Office (Kantor)</option>
                    </select>
                    @error('address_type')
                        <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address_line" class="form-label required">Alamat Lengkap</label>
                    <textarea id="address_line" name="address_line" class="form-textarea"
                        placeholder="Jl. Contoh No. 123, RT/RW 01/02, Kelurahan/Desa" required>{{ old('address_line', $address->address_line ?? '') }}</textarea>
                    <p class="form-help">Masukkan alamat selengkap mungkin (nama jalan, nomor rumah, RT/RW, dll)</p>
                    @error('address_line')
                        <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Lokasi - HANYA 1 INPUT -->
            <div class="form-section">
                <h3 class="section-title">Detail Lokasi</h3>

                <!-- Input Utama: Kota/Kabupaten dengan Search -->
                <div class="form-group">
                    <label for="city_select" class="form-label required">Kota/Kabupaten</label>
                    <select id="city_select" name="city_select" class="form-select" required style="width: 100%;">
                        <option value="">Ketik untuk mencari kota/kabupaten...</option>
                        @if (isset($address) && $address->city)
                            <option value="{{ $address->city_id ?? '' }}" selected>{{ $address->city }}</option>
                        @endif
                    </select>
                    <p class="form-help">Ketik minimal 3 karakter (contoh: Jakarta, Surabaya, Bandung)</p>
                    <span class="auto-info">Provinsi dan Kode Pos akan terisi otomatis</span>
                    @error('city')
                        <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hidden Fields untuk menyimpan data -->
                <input type="hidden" id="city" name="city" value="{{ old('city', $address->city ?? '') }}">
                <input type="hidden" id="city_id" name="city_id"
                    value="{{ old('city_id', $address->city_id ?? '') }}">
                <input type="hidden" id="province" name="province"
                    value="{{ old('province', $address->province ?? '') }}">
                <input type="hidden" id="postal_code" name="postal_code"
                    value="{{ old('postal_code', $address->postal_code ?? '') }}">
                <input type="hidden" id="country" name="country"
                    value="{{ old('country', $address->country ?? 'Indonesia') }}">

                <!-- Loading Indicator -->
                <div id="loadingIndicator" style="display: none;">
                    <p class="loading-text">🔄 Memuat data dari API...</p>
                </div>

                <!-- Preview Lokasi Lengkap -->
                <div id="locationPreview" class="location-preview">
                    <div class="location-item">
                        <span class="location-label">📍 Kota/Kabupaten:</span>
                        <span class="location-value" id="preview_city">-</span>
                    </div>
                    <div class="location-item">
                        <span class="location-label">🗺️ Provinsi:</span>
                        <span class="location-value" id="preview_province">-</span>
                    </div>
                    <div class="location-item">
                        <span class="location-label">📮 Kode Pos:</span>
                        <span class="location-value" id="preview_postal">-</span>
                    </div>
                    <div class="location-item">
                        <span class="location-label">🌏 Negara:</span>
                        <span class="location-value">Indonesia</span>
                    </div>
                </div>
            </div>

            <!-- Set as Primary -->
            <div class="form-section">
                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" id="is_primary" name="is_primary" value="1"
                            {{ old('is_primary', $address->is_primary ?? false) ? 'checked' : '' }}>
                        <label for="is_primary">
                            <strong>Jadikan alamat utama</strong>
                            <span style="display: block; font-size: 0.85rem; color: #666; font-weight: normal;">
                                Alamat ini akan digunakan sebagai default untuk pengiriman
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('profile.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    {{ isset($address) ? 'Update Alamat' : 'Simpan Alamat' }}
                </button>
            </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            // ========================================
            // 1. FORMAT TAMPILAN DROPDOWN
            // ========================================
            function formatCityResult(repo) {
                if (repo.loading) return repo.text;

                // Karena controller sudah mengirim text lengkap ("GENTAN, BAKI..."),
                // Kita tinggal menampilkannya dengan rapi.

                // Kita bisa memecah stringnya sedikit untuk styling jika mau,
                // atau tampilkan langsung full text-nya agar jelas.

                var $container = $(`
                <div class='city-result-item' style="padding: 8px 10px; border-bottom: 1px solid #eee;">
                    <div style="font-weight: bold; color: #074159; font-size: 1rem; margin-bottom: 4px;">
                        ${repo.text}
                    </div>
                    <div style="font-size: 0.8rem; color: #666;">
                        <i class="icon-map">📍</i> Klik untuk memilih lokasi ini
                    </div>
                </div>
            `);
                return $container;
            }

            function formatCitySelection(repo) {
                // Tampilkan teks lengkap di dalam kotak input setelah dipilih
                return repo.text || repo.id;
            }

            // ========================================
            // 2. INISIALISASI SELECT2
            // ========================================
            $('#city_select').select2({
                placeholder: 'Ketik nama Desa, Kecamatan, atau Kota...',
                allowClear: true,
                minimumInputLength: 3,
                ajax: {
                    url: '{{ route('api.cities') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                templateResult: formatCityResult,
                templateSelection: formatCitySelection,
                language: {
                    inputTooShort: () => 'Ketik minimal 3 huruf (Desa/Kecamatan/Kota)...',
                    searching: () => '⏳ Mencari data lengkap...',
                    noResults: () => '❌ Data tidak ditemukan'
                }
            });

            // ========================================
            // 3. EVENT SAAT MEMILIH
            // ========================================
            $('#city_select').on('select2:select', function(e) {
                const data = e.params.data;
                console.log('✅ Lokasi Dipilih:', data);

                // Isi Input Hidden dengan data terpisah (untuk database)
                $('#city_id').val(data.id);
                $('#city').val(data.city_name);
                $('#province').val(data.province);
                $('#postal_code').val(data.postal_code);

                // Tampilkan Preview (Bisa pakai text lengkap juga)
                updatePreview(data.text);
            });

            $('#city_select').on('select2:clear', function(e) {
                $('#city_id, #city, #province, #postal_code').val('');
                $('#locationPreview').slideUp();
            });

            // ========================================
            // 4. LOGIKA EDIT MODE & OLD INPUT
            // ========================================
            var existingCityId = '{{ old('city_id', $address->city_id ?? '') }}';

            // Logic Edit Mode: Kita perlu menyusun label manual karena Select2 kosong saat load
            // Gunakan data yang ada di database untuk menyusun tampilan awal
            @if (isset($address) || old('city_id'))
                var defaultText = [
                    '{{ old('city', $address->city ?? '') }}',
                    '{{ old('province', $address->province ?? '') }}',
                    '{{ old('postal_code', $address->postal_code ?? '') }}'
                ].filter(Boolean).join(', '); // Gabung jadi string koma

                // Override jika user baru saja mencari tapi error validasi
                // (Opsional, sesuaikan kebutuhan)

                if (existingCityId) {
                    var option = new Option(defaultText, existingCityId, true, true);
                    $('#city_select').append(option).trigger('change');
                    updatePreview(defaultText);
                }
            @endif

            function updatePreview(fullText) {
                // Kita ubah previewnya agar menampilkan text full saja biar konsisten
                // Hapus elemen individual, ganti dengan satu blok text
                $('#locationPreview').html(`
                <div class="location-item" style="border:none;">
                    <div style="width:100%;">
                        <span class="location-label" style="display:block; margin-bottom:5px;">Lokasi Terpilih:</span>
                        <span class="location-value" style="font-size:1.1rem; line-height:1.4;">${fullText}</span>
                    </div>
                </div>
            `).addClass('show').slideDown();

                $('#alertBox').hide();
            }

            // ... Sisa kode submit handler tetap sama ...
            $('#addressForm').on('submit', function(e) {
                const cityId = $('#city_id').val();
                if (!cityId) {
                    e.preventDefault();
                    showAlert('❌ Harap pilih Kota/Kabupaten terlebih dahulu.', 'error');
                    return false;
                }

                const btn = document.getElementById('submitBtn');
                btn.disabled = true;
                btn.innerText = '⏳ Menyimpan...';
            });

            function showAlert(msg, type) {
                const alertBox = $('#alertBox');
                alertBox.text(msg).removeClass('alert-success alert-error').addClass(type === 'success' ?
                    'alert-success' : 'alert-error').addClass('show').show();
                $('html, body').animate({
                    scrollTop: 0
                }, 'fast');
            }
        });
    </script>
</body>

</html>
