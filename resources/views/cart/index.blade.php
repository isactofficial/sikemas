<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang Belanja - SIKEMAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --skm-teal: #1F6D72;
            --skm-teal-dark: #15565A;
            --skm-blue: #074159;
            --skm-blue-dark: #053244;
            --skm-gray: #666;
            --skm-light-gray: #f5f5f5;
            --skm-border: #E6EEF0;
            
            /* Warna Kustom Sesuai Invoice */
            --color-faktur: #FF611A; /* Oranye */
            --color-value: #001B24;  /* Biru Tua (untuk label pengiriman) */
            --color-label: #555555;  /* Abu-abu (untuk isi pengiriman) */
            --color-total-bg: #F4F7F6; /* Warna untuk tombol +/- */
        }

        /* ... CSS Anda (tidak diubah) ... */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Besley', serif;
            background-color: #fff;
            color: #333;
        }

        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .cart-title {
            font-size: 2.5rem;
            color: var(--skm-blue);
            margin-bottom: 40px;
            text-align: center;
            font-weight: 700;
        }

        .cart-content {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        /* Cart Items Section */
        .cart-items {
            background: #fff;
        }

        .cart-items-title {
            font-size: 1.5rem;
            color: var(--skm-blue);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 100px 1fr auto;
            gap: 20px;
            padding: 20px;
            border: 1px solid var(--skm-border);
            border-radius: 8px;
            margin-bottom: 15px;
            background: #fff;
        }

        .cart-item-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            background: var(--skm-light-gray);
        }

        .cart-item-details {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cart-item-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--skm-blue);
            margin-bottom: 8px;
        }

        .cart-item-specs {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .cart-item-spec {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            color: var(--skm-gray);
        }
        
        .cart-item-spec img.spec-icon {
            width: 16px;
            height: 16px;
        }

        .cart-item-price {
            font-size: 0.95rem;
            color: var(--skm-gray);
        }

        .cart-item-price-value {
            font-weight: 700;
            color: #ff5722;
        }

        .cart-item-actions {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
        }

        .cart-item-total {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--skm-blue);
            margin-bottom: 10px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border: 1px solid var(--skm-border);
            background: var(--color-total-bg); /* Warna F4F7F6 */
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .quantity-btn:hover {
            background: var(--skm-border);
            border-color: var(--skm-teal);
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid var(--skm-border);
            border-radius: 4px;
            padding: 5px;
            font-size: 1rem;
        }
        
        .remove-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin-bottom: 10px; 
            opacity: 0.7;
            transition: opacity 0.2s;
        }
        
        .remove-btn img {
            width: 20px;
            height: 20px;
        }

        .remove-btn:hover {
            opacity: 1;
        }

        /* Summary Section */
        .cart-summary {
            background: #fff;
            border: 2px solid var(--skm-border);
            border-radius: 12px;
            padding: 25px;
            height: fit-content;
            position: sticky;
            top: 90px;
        }

        .summary-title {
            font-size: 1.4rem;
            color: var(--skm-blue);
            margin-bottom: 20px;
            font-weight: 700;
            text-align: center;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--skm-border);
        }

        .summary-row:last-of-type {
            border-bottom: none;
        }

        .summary-label {
            color: var(--skm-gray);
            font-size: 1rem;
        }

        .summary-value {
            font-weight: 600;
            color: var(--skm-blue);
            font-size: 1rem;
        }

        /* DIPERBARUI: Garis oranye ditambahkan */
        .summary-total {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid var(--skm-border);
            
            padding-bottom: 15px;
            border-bottom: 2px solid var(--color-faktur); /* Garis oranye */
        }

        .summary-total .summary-label {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--skm-blue);
        }

        .summary-total .summary-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #ff5722;
        }

        .checkout-btn {
            width: 100%;
            padding: 15px;
            background: var(--skm-blue); 
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.3s;
        }

        .checkout-btn:hover {
            background: var(--skm-blue-dark); 
        }

        /* Shipping Info (DIPERBARUI) */
        .shipping-info {
            background: none; /* Latar belakang dihapus */
            padding: 0; /* Padding dihapus */
            border-radius: 8px;
            margin-top: 20px; /* Diubah dari margin-bottom */
            margin-bottom: 20px;
        }

        .shipping-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--skm-blue);
            margin-bottom: 15px; /* Jarak ditambah */
        }
        
        /* BARU: Style untuk baris detail pengiriman */
        .shipping-detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 0.95rem;
            line-height: 1.5;
            gap: 15px; /* Jarak label & isi */
        }
        .shipping-detail-label {
            color: var(--color-value); /* 001B24 */
            font-weight: 600;
            flex-shrink: 0; /* Mencegah label menyusut */
        }
        .shipping-detail-value {
            color: var(--color-label); /* 555555 */
            text-align: right;
        }


        /* Empty Cart */
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-cart-icon {
            font-size: 5rem;
            color: var(--skm-border);
            margin-bottom: 20px;
        }

        .empty-cart-text {
            font-size: 1.2rem;
            color: var(--skm-gray);
            margin-bottom: 30px;
        }
        
        .shop-btn {
            display: inline-block;
            padding: 12px 30px;
            background: var(--skm-blue); 
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.3s;
        }

        .shop-btn:hover {
            background: var(--skm-blue-dark); 
        }

        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
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

        /* Responsive */
        @media (max-width: 968px) {
            .cart-content {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
            }

            .cart-item {
                grid-template-columns: 80px 1fr;
                gap: 15px;
            }

            .cart-item-actions {
                grid-column: 1 / -1;
                flex-direction: row-reverse; 
                justify-content: space-between;
                align-items: center;
                margin-top: 10px;
            }
            
            .remove-btn {
                margin-bottom: 0;
            }
            .cart-item-total {
                margin-bottom: 0;
            }
        }

        @media (max-width: 576px) {
            .cart-title {
                font-size: 2rem;
            }

            .cart-item {
                padding: 15px;
            }

            .cart-item-image {
                width: 70px;
                height: 70px;
            }

            .cart-item-name {
                font-size: 1rem;
            }

            .cart-item-specs {
                flex-direction: column;
                gap: 5px;
            }
            
            /* Agar label dan isi muat di mobile */
            .shipping-detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 2px;
            }
            .shipping-detail-value {
                text-align: left;
            }
        }
    </style>
</head>
<body>
@include('layouts.navbar')

    <div class="cart-container">
        <h1 class="cart-title">Keranjang Belanja Anda</h1>

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

        @auth
        @if($cart && $cart->items->count() > 0)
        <div class="cart-content">
            <div class="cart-items">
                <h2 class="cart-items-title">Item Pesanan ({{ $cart->items->count() }})</h2>
                
                @foreach($cart->items as $item)
                <div class="cart-item" data-item-id="{{ $item->id }}">
                    <img src="{{ $item->product_image ?? asset('assets/img/default-product.png') }}" 
                         alt="{{ $item->product_name }}" 
                         class="cart-item-image">
                    
                    <div class="cart-item-details">
                        <div>
                            <h3 class="cart-item-name">{{ $item->product_name }}</h3>
                            
                            <div class="cart-item-specs">
                                @if($item->material)
                                <div class="cart-item-spec">
                                    @if(Str::contains($item->material, ['Karton', 'Bergelombang'], true))
                                        <img src="{{ asset('assets/img/kar.svg') }}" alt="Bahan" class="spec-icon">
                                    @else
                                        <img src="{{ asset('assets/img/kar.svg') }}" alt="Bahan" class="spec-icon">
                                    @endif
                                    <span>Bahan: {{ $item->material }}</span>
                                </div>
                                @endif
                                
                                @if($item->size)
                                <div class="cart-item-spec">
                                    <img src="{{ asset('assets/img/uk.svg') }}" alt="Ukuran" class="spec-icon">
                                    <span>Ukuran: {{ $item->size }}</span>
                                </div>
                                @endif
                                
                                @if($item->design)
                                <div class="cart-item-spec">
                                    @if(Str::contains($item->design, 'Custom', true))
                                        <img src="{{ asset('assets/img/de.svg') }}" alt="Desain" class="spec-icon">
                                    @elseif(Str::contains($item->design, 'Standar', true))
                                        <img src="{{ asset('assets/img/sta.svg') }}" alt="Desain" class="spec-icon">
                                    @else
                                        <img src="{{ asset('assets/img/de.svg') }}" alt="Desain" class="spec-icon">
                                    @endif
                                    <span>Desain: {{ $item->design }}</span>
                                </div>
                                @endif
                            </div>
                            
                            <div class="cart-item-price">
                                Harga: <span class="cart-item-price-value">{{ $item->formatted_unit_price }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="cart-item-actions">
                        
                        <button class="remove-btn" data-item-id="{{ $item->id }}">
                            <img src="{{ asset('assets/img/ha.svg') }}" alt="Hapus">
                        </button>
                        
                        <div class="cart-item-total" data-subtotal="{{ $item->subtotal }}">
                            {{ $item->formatted_subtotal }}
                        </div>
                        
                        <div class="quantity-controls">
                            <button class="quantity-btn decrease-qty" data-item-id="{{ $item->id }}">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" 
                                   class="quantity-input" 
                                   value="{{ $item->quantity }}" 
                                   min="1" 
                                   data-item-id="{{ $item->id }}"
                                   readonly>
                            <button class="quantity-btn increase-qty" data-item-id="{{ $item->id }}">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="cart-summary">
                <h2 class="summary-title">Ringkasan Belanja</h2>
                
                <div class="summary-row">
                    <span class="summary-label">Subtotal</span>
                    <span class="summary-value" id="cart-subtotal">{{ $cart->formatted_total }}</span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Biaya Pengiriman</span>
                    <span class="summary-value">{{ $cart->formatted_shipping_cost }}</span>
                </div>
                
                <div class="summary-row summary-total">
                    <span class="summary-label">Total</span>
                    <span class="summary-value" id="cart-grand-total">{{ $cart->formatted_grand_total }}</span>
                </div>

                @if($primaryAddress)
                <div class="shipping-info">
                    <div class="shipping-title">Data Pengiriman</div>
                    
                    <div class="shipping-detail-row">
                        <span class="shipping-detail-label">Nama Lengkap</span>
                        <span class="shipping-detail-value">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="shipping-detail-row">
                        <span class="shipping-detail-label">Alamat Lengkap</span>
                        <span class="shipping-detail-value">{{ $primaryAddress->full_address }}</span>
                    </div>
                    <div class="shipping-detail-row">
                        <span class="shipping-detail-label">Nomor Telepon</span>
                        <span class="shipping-detail-value">{{ Auth::user()->phone ?? '-' }}</span>
                    </div>
                </div>
                @else
                <div class="alert alert-error">
                    Silakan tambahkan alamat pengiriman di profil Anda
                </div>
                @endif

                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="checkout-btn" {{ !$primaryAddress ? 'disabled' : '' }}>
                        Checkout
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="empty-cart">
            <div class="empty-cart-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <p class="empty-cart-text">Keranjang belanja Anda masih kosong</p>
            <a href="{{ route('produk') }}" class="shop-btn">Mulai Belanja</a>
        </div>
        @endif
        @else
        <!-- Guest mode: same layout populated from localStorage -->
        <div class="cart-content" id="guestCartContent" style="display:none;">
            <div class="cart-items">
                <h2 class="cart-items-title">Item Pesanan (<span id="guest-items-count">0</span>)</h2>
                <div id="guest-items-list"></div>
            </div>

            <div class="cart-summary">
                <h2 class="summary-title">Ringkasan Belanja</h2>
                <div class="summary-row">
                    <span class="summary-label">Subtotal</span>
                    <span class="summary-value" id="guest-subtotal">Rp 0</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Biaya Pengiriman</span>
                    <span class="summary-value">Rp 0</span>
                </div>
                <div class="summary-row summary-total">
                    <span class="summary-label">Total</span>
                    <span class="summary-value" id="guest-grand-total">Rp 0</span>
                </div>
                <div class="alert alert-error" style="margin-top:12px;">
                    Login untuk menyimpan keranjang di akun dan melanjutkan checkout.
                </div>
                <a href="{{ route('login') }}" class="checkout-btn" style="display:inline-block;text-align:center;">Login untuk Checkout</a>
            </div>
        </div>

        <div class="empty-cart" id="guestEmptyState" style="display:none;">
            <div class="empty-cart-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <p class="empty-cart-text">Keranjang belanja Anda masih kosong</p>
            <a href="{{ route('produk') }}" class="shop-btn">Mulai Belanja</a>
        </div>
        @endauth
    </div>

    @include('layouts.footer')

    <script>
        // Setup CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        @auth
        // Update quantity
        document.querySelectorAll('.increase-qty, .decrease-qty').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.dataset.itemId;
                const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
                const isIncrease = this.classList.contains('increase-qty');
                
                let currentQty = parseInt(input.value);
                let newQty = isIncrease ? currentQty + 1 : Math.max(1, currentQty - 1);
                
                if (newQty !== currentQty) {
                    updateCartItem(itemId, newQty, input);
                }
            });
        });

        // === LANGKAH 2: UBAH BAGIAN INI ===
        // Remove item (Versi SweetAlert)
        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.dataset.itemId; // Ambil itemId

                Swal.fire({
                    title: 'Hapus Produk?',
                    text: "Anda yakin ingin menghapus produk ini dari keranjang?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#074159', // Warna biru (sesuai tema)
                    cancelButtonColor: '#FF611A',  // Warna oranye (sesuai tema)
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika dikonfirmasi, panggil fungsi removeCartItem
                        removeCartItem(itemId);
                    }
                });
            });
        });
        // === AKHIR BAGIAN YANG DIUBAH ===

        // Update cart item function
        function updateCartItem(itemId, quantity, inputElement) {
            fetch(`/cart/update/${itemId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    inputElement.value = quantity;
                    
                    // Update subtotal for this item
                    const itemElement = inputElement.closest('.cart-item');
                    const subtotalElement = itemElement.querySelector('.cart-item-total');
                    subtotalElement.textContent = data.subtotal;
                    
                    // Update cart totals
                    document.getElementById('cart-subtotal').textContent = data.cart_total;
                    document.getElementById('cart-grand-total').textContent = data.grand_total;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui keranjang');
            });
        }

        // Remove cart item function
        function removeCartItem(itemId) {
            fetch(`/cart/remove/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove item element from DOM
                    const itemElement = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);
                    itemElement.remove();
                    
                    // Update totals
                    document.getElementById('cart-subtotal').textContent = data.cart_total;
                    document.getElementById('cart-grand-total').textContent = data.grand_total;
                    
                    // Reload page if cart is empty
                    if (data.items_count === 0) {
                        window.location.reload();
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus produk');
            });
        }
        @else
        // Guest mode logic: render and manage localStorage cart with same UI
        function rp(n){return 'Rp ' + (n||0).toLocaleString('id-ID');}
        function loadGuestItems(){
            try { return JSON.parse(localStorage.getItem('skm_guest_cart')||'[]'); } catch(e){ return []; }
        }
        function saveGuestItems(items){ localStorage.setItem('skm_guest_cart', JSON.stringify(items)); }
        function renderGuestCart(){
            const items = loadGuestItems();
            const content = document.getElementById('guestCartContent');
            const empty = document.getElementById('guestEmptyState');
            const list = document.getElementById('guest-items-list');
            const countEl = document.getElementById('guest-items-count');
            if(!items.length){ content.style.display='none'; empty.style.display='block'; updateCartBadge?.(0); return; }
            content.style.display='grid'; empty.style.display='none';
            list.innerHTML = '';
            let totalQty=0, subtotal=0;
            items.forEach((it, idx)=>{
                const qty = parseInt(it.quantity)||0; const price = parseFloat(it.unit_price)||0; const sub = qty*price; totalQty+=qty; subtotal+=sub;
                const div = document.createElement('div');
                div.className='cart-item';
                div.innerHTML = `
                    <img src="${it.product_image || '{{ asset('assets/img/default-product.png') }}'}" alt="${it.product_name||'Produk'}" class="cart-item-image">
                    <div class="cart-item-details">
                        <div>
                            <h3 class="cart-item-name">${it.product_name||'Produk'}</h3>
                            <div class="cart-item-specs">
                                ${it.material?`<div class='cart-item-spec'><img src='{{ asset('assets/img/kar.svg') }}' class='spec-icon' alt='Bahan'><span>Bahan: ${it.material}</span></div>`:''}
                                ${it.size?`<div class='cart-item-spec'><img src='{{ asset('assets/img/uk.svg') }}' class='spec-icon' alt='Ukuran'><span>Ukuran: ${it.size}</span></div>`:''}
                                ${it.design?`<div class='cart-item-spec'><img src='{{ asset('assets/img/de.svg') }}' class='spec-icon' alt='Desain'><span>Desain: ${it.design}</span></div>`:''}
                            </div>
                            <div class="cart-item-price">Harga: <span class="cart-item-price-value">${rp(price)}</span></div>
                        </div>
                    </div>
                    <div class="cart-item-actions">
                        <button class="remove-btn" data-idx="${idx}"><img src="{{ asset('assets/img/ha.svg') }}" alt="Hapus"></button>
                        <div class="cart-item-total">${rp(sub)}</div>
                        <div class="quantity-controls">
                            <button class="quantity-btn decrease-qty" data-idx="${idx}"><i class="fas fa-minus"></i></button>
                            <input type="number" class="quantity-input" value="${qty}" min="1" data-idx="${idx}" readonly>
                            <button class="quantity-btn increase-qty" data-idx="${idx}"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>`;
                list.appendChild(div);
            });
            countEl.textContent = items.length;
            document.getElementById('guest-subtotal').textContent = rp(subtotal);
            document.getElementById('guest-grand-total').textContent = rp(subtotal);
            updateCartBadge?.(totalQty);

            // bind events
            list.querySelectorAll('.increase-qty, .decrease-qty').forEach(btn=>{
                btn.addEventListener('click',()=>{
                    const idx = parseInt(btn.dataset.idx);
                    const arr = loadGuestItems();
                    if(!arr[idx]) return;
                    const inc = btn.classList.contains('increase-qty');
                    const q = Math.max(1, (parseInt(arr[idx].quantity)||0) + (inc?1:-1));
                    arr[idx].quantity = q; saveGuestItems(arr); renderGuestCart();
                });
            });
            list.querySelectorAll('.remove-btn').forEach(btn=>{
                btn.addEventListener('click',()=>{
                    const idx = parseInt(btn.dataset.idx);
                    const arr = loadGuestItems();
                    arr.splice(idx,1); saveGuestItems(arr); renderGuestCart();
                });
            });
        }
        document.addEventListener('DOMContentLoaded', renderGuestCart);
        @endauth
    </script>
</body>
</html>