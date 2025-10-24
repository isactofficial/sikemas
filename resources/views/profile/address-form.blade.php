<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($address) ? 'Edit' : 'Tambah' }} Alamat - SIKEMAS</title>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Besley', serif; 
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 2rem 1rem;
        }
        
        .container { max-width: 700px; margin: 0 auto; }
        
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
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
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
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        .form-help {
            font-size: 0.8rem;
            color: #666;
            margin-top: 0.25rem;
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
        
        .alert.show { display: block; }
        
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
            <p class="page-subtitle">{{ isset($address) ? 'Perbarui informasi alamat Anda' : 'Tambahkan alamat pengiriman baru' }}</p>
        </div>
        
        <div id="alertBox" class="alert"></div>
        
        <div class="form-card">
            @if(isset($address))
                <form action="{{ route('profile.address.update', $address->id) }}" method="POST" id="addressForm">
                    @method('PUT')
            @else
                <form action="{{ route('profile.address.store') }}" method="POST" id="addressForm">
            @endif
                @csrf
                
                <div class="info-box">
                    <p>💡 Isi formulir dengan lengkap agar pengiriman dapat berjalan lancar</p>
                </div>
                
                <!-- Tipe Alamat -->
                <div class="form-section">
                    <h3 class="section-title">Informasi Alamat</h3>
                    
                    <div class="form-group">
                        <label for="address_type" class="form-label required">Tipe Alamat</label>
                        <select id="address_type" name="address_type" class="form-select" required>
                            <option value="">Pilih tipe alamat...</option>
                            <option value="Home" {{ old('address_type', $address->address_type ?? '') == 'Home' ? 'selected' : '' }}>🏠 Home (Rumah)</option>
                            <option value="Office" {{ old('address_type', $address->address_type ?? '') == 'Office' ? 'selected' : '' }}>🏢 Office (Kantor)</option>
                        </select>
                        @error('address_type')
                            <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="address_line" class="form-label required">Alamat Lengkap</label>
                        <textarea id="address_line" name="address_line" class="form-textarea" 
                                  placeholder="Jl. Contoh No. 123, RT/RW 01/02, Kelurahan/Desa" 
                                  required>{{ old('address_line', $address->address_line ?? '') }}</textarea>
                        <p class="form-help">Masukkan alamat selengkap mungkin (nama jalan, nomor rumah, RT/RW, dll)</p>
                        @error('address_line')
                            <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Lokasi -->
                <div class="form-section">
                    <h3 class="section-title">Detail Lokasi</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="city" class="form-label required">Kota/Kabupaten</label>
                            <input type="text" id="city" name="city" class="form-input" 
                                   value="{{ old('city', $address->city ?? '') }}" 
                                   placeholder="Jakarta" required>
                            @error('city')
                                <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="province" class="form-label">Provinsi</label>
                            <input type="text" id="province" name="province" class="form-input" 
                                   value="{{ old('province', $address->province ?? '') }}" 
                                   placeholder="DKI Jakarta">
                            @error('province')
                                <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="postal_code" class="form-label">Kode Pos</label>
                            <input type="text" id="postal_code" name="postal_code" class="form-input" 
                                   value="{{ old('postal_code', $address->postal_code ?? '') }}" 
                                   placeholder="12345" maxlength="10">
                            @error('postal_code')
                                <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="country" class="form-label required">Negara</label>
                            <input type="text" id="country" name="country" class="form-input" 
                                   value="{{ old('country', $address->country ?? 'Indonesia') }}" required>
                            @error('country')
                                <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                            @enderror
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
        // Show alert if there's a session message
        @if(session('success'))
            showAlert('{{ session('success') }}', 'success');
        @endif
        
        @if(session('error'))
            showAlert('{{ session('error') }}', 'error');
        @endif
        
        function showAlert(message, type) {
            const alertBox = document.getElementById('alertBox');
            alertBox.textContent = message;
            alertBox.className = `alert alert-${type} show`;
            
            setTimeout(() => {
                alertBox.classList.remove('show');
            }, 5000);
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        
        // Disable submit button on form submit
        document.getElementById('addressForm').addEventListener('submit', function() {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Menyimpan...';
        });
        
        // Auto-format postal code (numbers only)
        document.getElementById('postal_code').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>
</html>