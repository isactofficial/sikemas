<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Profil - SIKEMAS</title>
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
        
        .avatar-section {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .avatar-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            overflow: hidden;
            border: 4px solid #074159;
            position: relative;
            background: #f0f0f0;
        }
        
        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .upload-btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: #074159;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .upload-btn:hover {
            background: #053244;
            transform: translateY(-2px);
        }
        
        .upload-input {
            display: none;
        }
        
        .file-info {
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: #666;
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
        .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: 'Besley', serif;
            font-size: 0.95rem;
            transition: all 0.3s;
        }
        
        .form-input:focus,
        .form-select:focus {
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
            <h1 class="page-title">Edit Profil</h1>
            <p class="page-subtitle">Perbarui informasi profil Anda</p>
        </div>
        
        <div id="alertBox" class="alert"></div>
        
        <div class="form-card">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="editProfileForm">
                @csrf
                
                <!-- Avatar Section -->
                <div class="avatar-section">
                    <div class="avatar-preview">
                        <img src="{{ $user->profile_photo_url }}" alt="Profile Photo" id="avatarPreview" crossorigin="anonymous">
                    </div>
                    
                    <label for="profilePhoto" class="upload-btn">
                        Ganti Foto Profil
                    </label>
                    <input type="file" id="profilePhoto" name="profile_photo" class="upload-input" accept="image/*" onchange="previewPhoto(event)">
                    
                    <div class="file-info">
                        <span id="fileName"></span>
                        <small style="display: block; margin-top: 0.25rem;">Format: JPG, PNG. Maksimal 2MB</small>
                    </div>
                </div>
                
                <!-- Informasi Dasar -->
                <div class="form-section">
                    <h3 class="section-title">Informasi Dasar</h3>
                    
                    <div class="form-group">
                        <label for="name" class="form-label required">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-input" 
                               value="{{ old('name', $user->name) }}" 
                               placeholder="Masukkan nama lengkap" required>
                        @error('name')
                            <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="form-label required">Email</label>
                        <input type="email" id="email" name="email" class="form-input" 
                               value="{{ old('email', $user->email) }}" 
                               placeholder="nama@email.com" required>
                        @error('email')
                            <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" class="form-input" 
                                   value="{{ old('phone', $user->phone) }}" 
                                   placeholder="08123456789">
                            @error('phone')
                                <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <select id="gender" name="gender" class="form-select">
                                <option value="">Pilih...</option>
                                <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="birth_date" class="form-label">Tanggal Lahir</label>
                        <input type="date" id="birth_date" name="birth_date" class="form-input" 
                               value="{{ old('birth_date', $user->birth_date ? $user->birth_date->format('Y-m-d') : '') }}">
                        @error('birth_date')
                            <p class="form-help" style="color: #ff5722;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('profile.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function previewPhoto(event) {
            const file = event.target.files[0];
            if (file) {
                // Check file size (2MB = 2 * 1024 * 1024 bytes)
                if (file.size > 2 * 1024 * 1024) {
                    alert('❌ Ukuran file terlalu besar! Maksimal 2MB');
                    event.target.value = '';
                    document.getElementById('fileName').textContent = '';
                    return;
                }
                
                // Check file type
                if (!file.type.match('image.*')) {
                    alert('❌ File harus berupa gambar!');
                    event.target.value = '';
                    document.getElementById('fileName').textContent = '';
                    return;
                }
                
                // Preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('avatarPreview');
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
                
                // Show file name
                document.getElementById('fileName').textContent = '📄 ' + file.name;
            }
        }
        
        // Force reload image if coming from profile update
        window.addEventListener('DOMContentLoaded', function() {
            const img = document.getElementById('avatarPreview');
            const currentSrc = img.src;
            
            // Add timestamp to force reload
            if (currentSrc && !currentSrc.includes('ui-avatars.com')) {
                const separator = currentSrc.includes('?') ? '&' : '?';
                img.src = currentSrc.split('?')[0] + separator + 't=' + new Date().getTime();
            }
        });
        
        // Show alert if there's a session message
        @if(session('success'))
            showAlert('{{ session('success') }}', 'success');
        @endif
        
        @if(session('error'))
            showAlert('{{ session('error') }}', 'error');
        @endif
        
        @if($errors->any())
            showAlert('❌ Terdapat kesalahan pada form. Silakan periksa kembali.', 'error');
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
        document.getElementById('editProfileForm').addEventListener('submit', function() {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Menyimpan...';
        });
    </script>
</body>
</html>