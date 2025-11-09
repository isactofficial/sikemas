<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Transaction - {{ $order->invoice_number }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --skm-teal: #1F6D72;
            --skm-blue: #074159;
            --skm-blue-2: #053244;
            --skm-accent: #ff5722;
            --skm-bg: #F4F7F6;
            --skm-border: #E5E7EB;
            --skm-text-label: #6B7280;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Besley', system-ui, sans-serif;
            background: var(--skm-bg);
            min-height: 100vh;
        }

        .skm-admin-main {
            margin-left: 240px;
            padding: 40px 24px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .skm-header {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
        }

        .skm-header h1 {
            color: var(--skm-blue);
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .skm-header p {
            color: #23C8B8;
            font-size: 14px;
        }

        .skm-form-container {
            background: #fff;
            border-radius: 12px;
            padding: 32px 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
            border: 1px solid var(--skm-border);
        }

        .form-section {
            margin-bottom: 32px;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            color: var(--skm-blue);
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--skm-border);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-grid.single {
            grid-template-columns: 1fr;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 700;
            color: var(--skm-blue);
        }

        .form-group label .required {
            color: var(--skm-accent);
        }

        .form-control {
            padding: 12px 16px;
            border: 1.5px solid var(--skm-border);
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Besley', serif;
            color: var(--skm-blue-2);
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--skm-teal);
            box-shadow: 0 0 0 3px rgba(31, 109, 114, 0.1);
        }

        .form-control::placeholder {
            color: #9CA3AF;
        }

        .form-control:disabled {
            background-color: #F3F4F6;
            cursor: not-allowed;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23074159' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 36px;
        }

        .info-box {
            background: #F0F9FF;
            border: 1px solid #BAE6FD;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .info-box-title {
            font-weight: 700;
            color: var(--skm-blue);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-box-content {
            font-size: 14px;
            color: var(--skm-blue-2);
        }

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
        }

        .alert-danger {
            background: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FDD2D2;
        }

        .alert i {
            font-size: 18px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding-top: 24px;
            border-top: 2px solid var(--skm-border);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
            border: none;
            font-family: 'Besley', serif;
        }

        .btn-primary {
            background: var(--skm-teal);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--skm-blue);
        }

        .btn-secondary {
            background: #E5E7EB;
            color: var(--skm-blue-2);
        }

        .btn-secondary:hover {
            background: #D1D5DB;
        }

        .help-text {
            font-size: 12px;
            color: var(--skm-text-label);
            margin-top: 4px;
        }

        @media (max-width: 1024px) {
            .skm-admin-main {
                margin-left: 0;
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar_admin')

    <main class="skm-admin-main">
        <div class="skm-header">
            <h1>Edit Transaksi</h1>
            <p>Invoice: {{ $order->invoice_number }}</p>
        </div>

        <form action="{{ route('admin.transactions.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="skm-form-container">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            <strong>Terjadi kesalahan:</strong>
                            <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Order Information -->
                <div class="info-box">
                    <div class="info-box-title">
                        <i class="fas fa-info-circle"></i>
                        Informasi Pesanan
                    </div>
                    <div class="info-box-content">
                        <strong>Invoice:</strong> {{ $order->invoice_number }} <br>
                        <strong>Tanggal Pesanan:</strong> {{ $order->order_date ? $order->order_date->format('d M Y, H:i') : 'N/A' }} <br>
                        <strong>Total:</strong> Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="form-section">
                    <h2 class="section-title">Informasi Customer</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="user_id">
                                Customer <span class="required">*</span>
                            </label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="">Pilih Customer</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" 
                                        {{ (old('user_id', $order->user_id) == $user->id) ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="shipping_address_id">
                                Alamat Pengiriman <span class="required">*</span>
                            </label>
                            <select name="shipping_address_id" id="shipping_address_id" class="form-control" required>
                                <option value="">Memuat alamat...</option>
                            </select>
                            <span class="help-text">Alamat akan dimuat setelah memilih customer</span>
                        </div>
                    </div>
                </div>

                <!-- Current Shipping Address -->
                @if($order->shippingAddress)
                <div class="info-box">
                    <div class="info-box-title">
                        <i class="fas fa-map-marker-alt"></i>
                        Alamat Pengiriman Saat Ini
                    </div>
                    <div class="info-box-content">
                        {{ $order->shippingAddress->full_address }}
                    </div>
                </div>
                @endif

                <!-- Status -->
                <div class="form-section">
                    <h2 class="section-title">Status Pesanan</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="payment_status">
                                Status Pembayaran <span class="required">*</span>
                            </label>
                            <select name="payment_status" id="payment_status" class="form-control" required>
                                <option value="Unpaid" {{ old('payment_status', $order->payment_status) == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="Paid" {{ old('payment_status', $order->payment_status) == 'Paid' ? 'selected' : '' }}>Paid</option>
                                <option value="Cancelled" {{ old('payment_status', $order->payment_status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="shipping_status">
                                Status Pengiriman <span class="required">*</span>
                            </label>
                            <select name="shipping_status" id="shipping_status" class="form-control" required>
                                <option value="Pending" {{ old('shipping_status', $order->shipping_status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Shipped" {{ old('shipping_status', $order->shipping_status) == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="Arrived" {{ old('shipping_status', $order->shipping_status) == 'Arrived' ? 'selected' : '' }}>Arrived</option>
                                <option value="Cancelled" {{ old('shipping_status', $order->shipping_status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="form-section">
                    <h2 class="section-title">Catatan</h2>
                    <div class="form-grid single">
                        <div class="form-group">
                            <label for="notes">
                                Catatan Tambahan
                            </label>
                            <textarea 
                                name="notes" 
                                id="notes" 
                                class="form-control" 
                                placeholder="Catatan atau instruksi khusus untuk pesanan ini..."
                            >{{ old('notes', $order->notes) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="skm-form-container">
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Transaksi
                    </button>
                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </div>
        </form>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const userSelect = document.getElementById('user_id');
        const addressSelect = document.getElementById('shipping_address_id');
        const currentUserId = {{ old('user_id', $order->user_id) }};
        const currentAddressId = {{ old('shipping_address_id', $order->shipping_address_id ?? 'null') }};

        // Fungsi untuk memuat alamat berdasarkan user ID
        function loadAddresses(userId, selectedAddressId = null) {
            if (!userId) {
                addressSelect.innerHTML = '<option value="">Pilih Customer Terlebih Dahulu</option>';
                addressSelect.disabled = true;
                return;
            }

            // Tampilkan loading
            addressSelect.innerHTML = '<option value="" disabled selected>Memuat alamat...</option>';
            addressSelect.disabled = true;

            // Fetch alamat dari server
            fetch(`/admin/users/${userId}/addresses`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data alamat');
                }
                return response.json();
            })
            .then(addresses => {
                // Clear loading message
                addressSelect.innerHTML = '';
                
                if (addresses && addresses.length > 0) {
                    // Enable select
                    addressSelect.disabled = false;

                    // Tambah option default
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'Pilih Alamat Pengiriman';
                    defaultOption.disabled = true;
                    addressSelect.appendChild(defaultOption);

                    // Tambahkan setiap alamat ke dropdown
                    addresses.forEach(address => {
                        const option = document.createElement('option');
                        option.value = address.id;
                        
                        // Gunakan full_address dari accessor
                        let addressText = address.full_address || buildAddressText(address);
                        
                        // Tambahkan label "(Utama)" jika alamat utama
                        if (address.is_primary) {
                            addressText += ' (Utama)';
                        }
                        
                        option.textContent = addressText;
                        
                        // Select alamat yang sesuai
                        if (selectedAddressId && address.id == selectedAddressId) {
                            option.selected = true;
                        } else if (!selectedAddressId && address.is_primary) {
                            // Jika tidak ada yang dipilih, pilih alamat utama
                            option.selected = true;
                        }
                        
                        addressSelect.appendChild(option);
                    });
                } else {
                    // Tidak ada alamat
                    addressSelect.innerHTML = '<option value="">User ini belum memiliki alamat</option>';
                    addressSelect.disabled = true;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                addressSelect.innerHTML = '<option value="">Gagal memuat alamat. Silakan coba lagi.</option>';
                addressSelect.disabled = true;
            });
        }

        // Fungsi helper untuk membangun teks alamat
        function buildAddressText(address) {
            const parts = [];
            
            if (address.address_line) parts.push(address.address_line);
            if (address.city) parts.push(address.city);
            if (address.province) parts.push(address.province);
            if (address.postal_code) parts.push(address.postal_code);
            if (address.country) parts.push(address.country);
            
            return parts.join(', ');
        }

        // Event listener untuk perubahan user
        userSelect.addEventListener('change', function() {
            loadAddresses(this.value);
        });

        // Load alamat untuk user yang sudah dipilih (saat halaman pertama kali dimuat)
        if (currentUserId) {
            loadAddresses(currentUserId, currentAddressId);
        }
    });
    </script>
</body>
</html>