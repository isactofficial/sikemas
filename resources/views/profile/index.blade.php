<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile Pengguna - SIKEMAS</title>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Besley', serif; 
            background: #FFFFFF; /* === BACKGROUND DIUBAH JADI PUTIH === */
            min-height: 100vh;
        }
        
        /* Container mungkin perlu penyesuaian padding-top jika navbar.blade.php Anda 'fixed' */
        .container { 
            max-width: 800px; 
            margin: 0 auto; 
            padding: 2rem 1rem; /* Padding asli halaman */
        }
        
        .page-title {
            text-align: center;
            color: #074159;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 2rem;
        }
        
        .profile-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
            position: relative;
        }
        
        /* CSS UNTUK TOMBOL EDIT (IKON PENSIL #074159) */
        .edit-profile-btn {
            position: absolute;
            top: 0;
            right: 0;
            background: none; /* Tanpa background */
            color: #074159; /* Warna ikon */
            border: none;
            padding: 0; /* Hapus padding */
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .edit-profile-btn:hover {
            color: #053244; /* Warna hover lebih gelap */
            background: none;
            transform: none;
        }
        
        .avatar-wrapper {
            position: relative;
            width: 120px; 
            height: 120px; 
            margin-bottom: 1rem;
        }
        
        .avatar {
            width: 100%;
            height: 100%;
            border-radius: 0; /* Kotak */
            object-fit: cover;
            border: 4px solid #074159;
        }
        
        .user-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #074159;
            margin-bottom: 0.25rem;
        }
        
        .user-role {
            color: #666;
            font-size: 0.9rem;
        }
        
        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #074159;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 0.75rem 1rem;
            margin-bottom: 1.5rem;
        }
        
        .info-label {
            font-weight: 600;
            color: #333;
        }
        
        .info-value {
            color: #666;
        }
        
        .address-section {
            margin-top: 1.5rem;
        }
        
        .address-card {
            background: #F9F9F9; 
            border: 1px solid #e0e0e0; 
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            position: relative;
        }
        
        .address-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        
        .address-type {
            font-weight: 700;
            color: #074159;
            font-size: 1rem;
        }
        
        .address-actions {
            display: flex;
            gap: 1rem; 
        }
        
        /* CSS UNTUK TOMBOL AKSI ALAMAT (DENGAN TEKS) */
        .btn-icon {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.25rem;
            color: #666;
            transition: color 0.3s;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            gap: 0.35rem; 
            font-family: 'Besley', serif;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .btn-icon:hover { color: #074159; }
        .btn-icon.delete:hover { color: #FF611A; }
        
        .address-text {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
        }
        
        .add-address-btn {
            width: 100%;
            background: #074159; 
            border: none; 
            color: white; 
            padding: 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .add-address-btn:hover {
            background: #053244;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 65, 89, 0.3);
        }
        
        .add-address-btn img {
            width: 20px;
            height: 20px;
        }
        
        .order-card {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            border-left-width: 6px;
            transition: all 0.3s;
        }
        
        .order-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        .order-card.selesai { border-left-color: #074159; }
        .order-card.diproses { border-left-color: #23C8B8; }
        .order-card.dibatalkan { border-left-color: #FF611A; }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }
        
        .invoice-number {
            font-weight: 700;
            color: #074159;
            font-size: 1rem;
        }
        
        .order-status {
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .order-status img {
            width: 14px;
            height: 14px;
        }
        
        /* STATUS WARNA SOLID */
        .status-selesai { 
            background: #074159; 
            color: #FFFFFF;     
        }
        .status-diproses { 
            background: #23C8B8; 
            color: #FFFFFF;     
        }
        .status-dibatalkan { 
            background: #FF611A; 
            color: #FFFFFF;     
        }
        
        .order-date {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .order-date img {
            width: 16px;
            height: 16px;
        }
        
        .order-items {
            margin: 0.75rem 0;
            padding-left: 0;
            list-style: none;
        }
        
        .order-items li {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .order-items li img {
            width: 16px;
            height: 16px;
        }
        
        .order-total {
            text-align: right;
            font-size: 1.1rem;
            font-weight: 700;
            color: #ff5722;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid #f0f0f0;
        }
        
        /* ORDER ACTION BUTTONS */
        .order-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
            justify-content: flex-end;
        }
        
        .order-btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: #fff;
            color: #074159;
            border: 2px solid #074159;
        }
        
        .order-btn:hover {
            background: #074159;
            color: #fff;
        }
        
        .order-btn svg {
            width: 14px;
            height: 14px;
        }
        
        .back-button {
            display: inline-block;
            background: white;
            color: #074159;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            border: 2px solid #074159;
            transition: all 0.3s;
            margin-top: 1rem;
        }
        
        .back-button:hover {
            background: #074159;
            color: white;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
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
        
        /* === CSS UNTUK PAGINATION KUSTOM === */
        .pagination-custom {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        .pagination-text {
            color: #074159;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .pagination-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background-color: #074159;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.2rem;
            transition: background-color 0.3s;
        }
        .pagination-btn:hover {
            background-color: #053244;
        }
        .pagination-btn.disabled {
            background-color: #074159;  /* Latar belakang disamakan */
            color: #FFFFFF;            /* Teks tetap putih */
            /* opacity: 0.5; Dihapus */ 
            pointer-events: none;
        }
        
        
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
            
            .edit-profile-btn {
                position: static;
                margin-bottom: 1rem;
                justify-content: center;
                width: 100%;
            }
            
            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .order-actions {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .order-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    
    @include('layouts.navbar')

    <div class="container">
        <h1 class="page-title">Profile Pengguna</h1>
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
        @endif
        
        <div class="profile-card">
            <div class="profile-header">
                
                <a href="{{ route('profile.edit') }}" class="edit-profile-btn" title="Edit Profile">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 24px; height: 24px;">
                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                    </svg>
                </a>
                
                <div class="avatar-wrapper">
                    <img src="{{ $user->profile_photo_url }}" alt="Profile Photo" class="avatar">
                </div>
                
                <h2 class="user-name">{{ $user->name }}</h2>
                <p class="user-role">Pengguna</p>
            </div>
            
            <h3 class="section-title">Informasi Dasar</h3>
            <div class="info-grid">
                <div class="info-label">Nama</div>
                <div class="info-value">{{ $user->name }}</div>
                
                <div class="info-label">Tanggal Lahir</div>
                <div class="info-value">{{ $user->formatted_birth_date }}</div>
                
                <div class="info-label">Jenis Kelamin</div>
                <div class="info-value">{{ $user->gender_display }}</div>
                
                <div class="info-label">Email</div>
                <div class="info-value">{{ $user->email }}</div>
                
                <div class="info-label">Nomor Telepon</div>
                <div class="info-value">{{ $user->formatted_phone }}</div>
            </div>
        </div>
        
        <div class="profile-card">
            <h3 class="section-title">Alamat Pengiriman</h3>
            <div class="address-section">
                @forelse($addresses as $address)
                <div class="address-card">
                    <div class="address-header">
                        <span class="address-type">
                            {{ $address->address_type }}
                        </span>
                        <div class="address-actions">
                            <a href="{{ route('profile.address.edit', $address->id) }}" class="btn-icon" title="Edit">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"/>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('profile.address.delete', $address->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus alamat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon delete" title="Delete">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    <p class="address-text">{{ $address->full_address }}</p>
                </div>
                @empty
                <p style="color: #666; text-align: center; padding: 2rem 0;">Belum ada alamat tersimpan</p>
                @endforelse
            </div>
            
            <a href="{{ route('profile.address.create') }}" class="add-address-btn">
                <img src="{{ asset('assets/img/add.svg') }}" alt="Add Icon">
                Tambah Alamat
            </a>
        </div>
        
        <div class="profile-card">
            <h3 class="section-title">Riwayat Belanja</h3>
            <div>
                @forelse($orders as $order)
                <div class="order-card {{ strtolower($order->status) }}">
                    <div class="order-header">
                        <span class="invoice-number">{{ $order->invoice_number }}</span>
                        <span class="order-status status-{{ strtolower($order->status) }}">
                            @if($order->status === 'Selesai')
                                <img src="{{ asset('assets/img/centang.svg') }}" alt="Selesai">
                                Selesai
                            @elseif($order->status === 'Diproses')
                                <img src="{{ asset('assets/img/time.svg') }}" alt="Diproses">
                                Diproses
                            @else
                                <img src="{{ asset('assets/img/silang.svg') }}" alt="Dibatalkan">
                                Dibatalkan
                            @endif
                        </span>
                    </div>
                    <div class="order-date">
                        <img src="{{ asset('assets/img/date.svg') }}" alt="Date">
                        {{ $order->order_date->format('d M Y') }}
                    </div>
                    <ul class="order-items">
                        @foreach($order->items as $item)
                        <li>
                            <img src="{{ asset('assets/img/box.svg') }}" alt="Box">
                            {{ $item->product_name }}
                        </li>
                        @endforeach
                    </ul>
                    <div class="order-total">Total Pembayaran: {{ $order->formatted_total }}</div>
                    
                    <div class="order-actions">
                        <a href="{{ route('invoice.show', $order->id) }}" class="order-btn">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z"/>
                                <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd"/>
                            </svg>
                            Bayar Sekarang
                        </a>
                        
                        <a href="{{ route('invoice.show', $order->id) }}?download=true" class="order-btn" target="_blank">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z" clip-rule="evenodd"/>
                            </svg>
                            Download PDF
                        </a>
                        </div>
                </div>
                @empty
                <p style="color: #666; text-align: center; padding: 2rem 0;">Belum ada riwayat pesanan</p>
                @endforelse
            </div>
            
            @if($orders->hasPages())
            <div class="pagination-custom">
                @if ($orders->onFirstPage())
                    <span class="pagination-btn disabled" aria-disabled="true">&lt;</span>
                @else
                    <a href="{{ $orders->previousPageUrl() }}" class="pagination-btn" rel="prev">&lt;</a>
                @endif
            
                <span class="pagination-text">
                    Halaman {{ $orders->currentPage() }} dari {{ $orders->lastPage() }}
                </span>
            
                @if ($orders->hasMorePages())
                    <a href="{{ $orders->nextPageUrl() }}" class="pagination-btn" rel="next">&gt;</a>
                @else
                    <span class="pagination-btn disabled" aria-disabled="true">&gt;</span>
                @endif
            </div>
            @endif
        </div>
        
    </div> </body>
</html>