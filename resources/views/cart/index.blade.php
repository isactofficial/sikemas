<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang Belanja - SIKEMAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
            --color-faktur: #FF611A;
            /* Oranye */
            --color-value: #001B24;
            /* Biru Tua (untuk label pengiriman) */
            --color-label: #555555;
            /* Abu-abu (untuk isi pengiriman) */
            --color-total-bg: #F4F7F6;
            /* Warna untuk tombol +/- */
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
            background: var(--color-total-bg);
            /* Warna F4F7F6 */
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
            border-bottom: 2px solid var(--color-faktur);
            /* Garis oranye */
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
            background: none;
            /* Latar belakang dihapus */
            padding: 0;
            /* Padding dihapus */
            border-radius: 8px;
            margin-top: 20px;
            /* Diubah dari margin-bottom */
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
            gap: 15px;
            /* Jarak label & isi */
        }
        .shipping-detail-label {
            color: var(--color-value);
            /* 001B24 */
            font-weight: 600;
            flex-shrink: 0;
            /* Mencegah label menyusut */
        }
        .shipping-detail-value {
            color: var(--color-label);
            /* 555555 */
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

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @auth
            @if ($cart && $cart->items->count() > 0)
                <div class="cart-content">
                    <div class="cart-items">
                        <h2 class="cart-items-title">Item Pesanan ({{ $cart->items->count() }})</h2>

                        @foreach ($cart->items as $item)
                            <div class="cart-item" data-item-id="{{ $item->id }}">
                                <img src="{{ $item->product_image ?? asset('assets/img/default-product.png') }}"
                                    alt="{{ $item->product_name }}" class="cart-item-image">

                                <div class="cart-item-details">
                                    <div>
                                        <h3 class="cart-item-name">{{ $item->product_name }}</h3>

                                        <div class="cart-item-specs">
                                            @if ($item->material)
                                                <div class="cart-item-spec">
                                                    @if (Str::contains($item->material, ['Karton', 'Bergelombang'], true))
                                                        <img src="{{ asset('assets/img/kar.svg') }}" alt="Bahan"
                                                            class="spec-icon">
                                                    @else
                                                        <img src="{{ asset('assets/img/kar.svg') }}" alt="Bahan"
                                                            class="spec-icon">
                                                    @endif
                                                    <span>Bahan: {{ $item->material }}</span>
                                                </div>
                                            @endif

                                            @if ($item->size)
                                                <div class="cart-item-spec">
                                                    <img src="{{ asset('assets/img/uk.svg') }}" alt="Ukuran"
                                                        class="spec-icon">
                                                    <span>Ukuran: {{ $item->size }}</span>
                                                </div>
                                            @endif

                                            @if ($item->design)
                                                <div class="cart-item-spec">
                                                    @if (Str::contains($item->design, 'Custom', true))
                                                        <img src="{{ asset('assets/img/de.svg') }}" alt="Desain"
                                                            class="spec-icon">
                                                    @elseif(Str::contains($item->design, 'Standar', true))
                                                        <img src="{{ asset('assets/img/sta.svg') }}" alt="Desain"
                                                            class="spec-icon">
                                                    @else
                                                        <img src="{{ asset('assets/img/de.svg') }}" alt="Desain"
                                                            class="spec-icon">
                                                    @endif
                                                    <span>Desain: {{ $item->design }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="cart-item-price">
                                            Harga: <span
                                                class="cart-item-price-value">{{ $item->formatted_unit_price }}</span>
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
                                        <input type="number" class="quantity-input" value="{{ $item->quantity }}"
                                            min="1" data-item-id="{{ $item->id }}" readonly>
                                        <button class="quantity-btn increase-qty" data-item-id="{{ $item->id }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Bagian yang diubah: Form Checkout di Summary Section -->
                    <div class="cart-summary">
                        <h2 class="summary-title">Ringkasan Belanja</h2>

                        <input type="hidden" id="total_weight"
                            value="{{ $cart ? ($cart->items->sum('weight') ?: 1000) : 1000 }}">

                        <form action="{{ route('cart.checkout') }}" method="POST" id="checkoutForm">
                            @csrf
                            <input type="hidden" name="shipping_cost" id="hidden_shipping_cost" value="0">
                            <input type="hidden" name="shipping_service" id="hidden_shipping_service" value="">
                            <input type="hidden" name="shipping_address_id" id="hidden_shipping_address_id" value="">

                            <!-- DIUBAH: Pilih Alamat User -->
                            <div class="summary-row"
                                style="flex-direction: column; gap: 8px; align-items: stretch; border-bottom: none; padding-top: 10px; padding-bottom: 0;">
                                <label class="summary-label" style="font-weight: 600;">Alamat Pengiriman</label>
                                <select class="form-control" name="user_address" id="user_address"
                                    style="padding: 10px; border: 1px solid var(--skm-border); border-radius: 6px; width: 100%;">
                                    <option value="">-- Pilih Alamat --</option>
                                    @foreach ($userAddresses as $address)
                                        <option value="{{ $address->id }}" data-city="{{ $address->city }}"
                                            data-province="{{ $address->province }}"
                                            data-postal="{{ $address->postal_code }}" {{-- Tambahkan kode pos jika ingin ditampilkan --}}
                                            {{ $address->is_primary ? 'selected' : '' }}>

                                            {{ $address->label ?? 'Alamat ' . $loop->iteration }}
                                            @if ($address->is_primary)
                                                ⭐
                                            @endif
                                            - {{ Str::limit($address->full_address, 50) }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($userAddresses->count() === 0)
                                    <small style="color: #ff5722; margin-top: 5px;">
                                        Belum ada alamat tersimpan. <a href="{{ route('profile.address.create') }}"
                                            style="color: var(--skm-blue); text-decoration: underline;">Tambah Alamat</a>
                                    </small>
                                @endif
                            </div>

                            <!-- Info Alamat Terpilih -->
                            <div id="selected-address-info"
                                style="display: none; margin-top: 10px; padding: 10px; background: var(--color-total-bg); border-radius: 6px; font-size: 0.9rem;">
                                <div style="margin-bottom: 5px;"><strong>Penerima:</strong> <span
                                        id="info-recipient"></span></div>
                                <div style="margin-bottom: 5px;"><strong>Kota:</strong> <span id="info-city"></span></div>
                                <div><strong>Alamat:</strong> <span id="info-address"></span></div>
                            </div>

                            <div class="summary-row"
                                style="flex-direction: column; gap: 8px; align-items: stretch; border-bottom: none; padding-top: 10px;">
                                <label class="summary-label" style="font-weight: 600;">Kurir Pengiriman</label>
                                <select class="form-control" name="courier" id="courier" disabled
                                    style="padding: 10px; border: 1px solid var(--skm-border); border-radius: 6px; width: 100%;">
                                    <option value="">-- Pilih Kurir --</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS Indonesia</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div>

                            <div class="summary-row" id="service-container"
                                style="display: none; flex-direction: column; gap: 8px; align-items: stretch; border: none; padding-top: 0;">
                                <select class="form-control" name="service" id="service"
                                    style="padding: 10px; border: 1px solid var(--skm-border); border-radius: 6px; width: 100%; margin-top: 10px;">
                                    <option value="">-- Pilih Layanan --</option>
                                </select>
                            </div>

                            <hr style="border: 0; border-top: 1px solid var(--skm-border); margin: 15px 0;">

                            <div class="summary-row">
                                <span class="summary-label">Subtotal</span>
                                <span class="summary-value" id="cart-subtotal"
                                    data-value="{{ $cart ? $cart->total : 0 }}">
                                    {{ $cart ? $cart->formatted_total : 'Rp 0' }}
                                </span>
                            </div>

                            <div class="summary-row">
                                <span class="summary-label">Biaya Pengiriman</span>
                                <span class="summary-value" id="shipping-cost-display">Rp 0</span>
                            </div>

                            <div class="summary-row summary-total">
                                <span class="summary-label">Total</span>
                                <span class="summary-value" id="cart-grand-total">
                                    {{ $cart ? $cart->formatted_total : 'Rp 0' }}
                                </span>
                            </div>

                            <button type="submit" class="checkout-btn"
                                {{ $userAddresses->count() === 0 ? 'disabled' : '' }} id="btn-checkout">
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
                    <a href="{{ route('login') }}" class="checkout-btn"
                        style="display:inline-block;text-align:center;">Login untuk Checkout</a>
                </div>
            </div>
            <div class="empty-cart" id="guestEmptyState" style="display:none;">
                <div class="empty-cart-icon"><i class="fas fa-shopping-cart"></i></div>
                <p class="empty-cart-text">Keranjang belanja Anda masih kosong</p>
                <a href="{{ route('produk') }}" class="shop-btn">Mulai Belanja</a>
            </div>
        @endauth
    </div>

    @include('layouts.footer')

    <script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    @auth
        // --- 1. LOGIKA UPDATE & HAPUS CART ITEM (TIDAK BERUBAH) ---
        document.querySelectorAll('.increase-qty, .decrease-qty').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.itemId;
                const input = document.querySelector(`.quantity-input[data-item-id="${id}"]`);
                let qty = parseInt(input.value);
                let newQty = this.classList.contains('increase-qty') ? qty + 1 : Math.max(1, qty - 1);
                if (qty !== newQty) updateCartItem(id, newQty, input);
            });
        });

        // Remove item (Versi SweetAlert)
        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.itemId;
                Swal.fire({
                    title: 'Hapus?', text: "Hapus produk ini?", icon: 'warning',
                    showCancelButton: true, confirmButtonColor: '#074159', cancelButtonColor: '#FF611A',
                    confirmButtonText: 'Ya', cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) removeCartItem(id);
                });
            });
        });

        function updateCartItem(id, qty, el) {
            fetch(`/cart/update/${id}`, {
                method: 'PUT', headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken},
                body: JSON.stringify({ quantity: qty })
            }).then(r => r.json()).then(d => {
                if (d.success) {
                    el.value = qty;
                    el.closest('.cart-item').querySelector('.cart-item-total').innerText = d.subtotal;
                    document.getElementById('cart-subtotal').innerText = d.cart_total;
                    const rawTotal = parseInt(d.cart_total.replace(/[^0-9]/g, ''));
                    document.getElementById('cart-subtotal').setAttribute('data-value', rawTotal);
                    recalcTotal();
                }
            });
        }

        function removeCartItem(id) {
            fetch(`/cart/remove/${id}`, {
                method: 'DELETE', headers: { 'X-CSRF-TOKEN': csrfToken }
            }).then(r => r.json()).then(d => {
                if (d.success) {
                    document.querySelector(`.cart-item[data-item-id="${id}"]`).remove();
                    document.getElementById('cart-subtotal').innerText = d.cart_total;
                    const rawTotal = parseInt(d.cart_total.replace(/[^0-9]/g, ''));
                    document.getElementById('cart-subtotal').setAttribute('data-value', rawTotal);
                    recalcTotal();
                    if (d.items_count === 0) location.reload();
                }
            });
        }

        function recalcTotal() {
            let subText = document.getElementById('cart-subtotal').innerText;
            let subRaw = subText.replace(/[^0-9]/g, '');
            let sub = parseInt(subRaw) || 0;
            let ship = parseInt(document.getElementById('hidden_shipping_cost').value) || 0;
            let total = sub + ship;
            document.getElementById('cart-grand-total').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        }

        // --- 2. INTEGRASI KOMERCE / RAJAONGKIR (LOGIKA BARU) ---
        $(document).ready(function() {

            // A. Saat User Memilih Alamat
            $('#user_address').on('change', function() {
                const selectedOption = $(this).find(':selected');
                const addressId = $(this).val();

                // PERUBAHAN: Ambil data-city (String Nama Kota), bukan ID
                const city = selectedOption.data('city');
                const province = selectedOption.data('province');
                const addressText = selectedOption.text().split(' - ')[1] || '';

                if (addressId) {
                    // Simpan ID alamat untuk checkout nanti
                    $('#hidden_shipping_address_id').val(addressId);

                    // Simpan Nama Kota di atribut elemen select agar bisa diambil oleh logika kurir
                    $(this).attr('data-selected-city-name', city);

                    // Tampilkan Info Alamat di UI
                    $('#info-recipient').text('{{ Auth::user()->name ?? "" }}');
                    $('#info-city').text(city + ', ' + province);
                    $('#info-address').text(addressText);
                    $('#selected-address-info').show();

                    // Reset Kurir & Layanan karena alamat berubah
                    $('#courier').prop('disabled', false).val('');
                    $('#service-container').hide();
                    $('#service').empty().append('<option value="">-- Pilih Layanan --</option>');
                    updateShippingUI(0, '');
                } else {
                    // Reset jika user memilih "-- Pilih Alamat --"
                    $('#hidden_shipping_address_id').val('');
                    $(this).removeAttr('data-selected-city-name'); // Hapus simpanan kota
                    $('#selected-address-info').hide();
                    $('#courier').prop('disabled', true).val('');
                    $('#service-container').hide();
                    updateShippingUI(0, '');
                }
            });

            // Trigger change otomatis jika sudah ada alamat terpilih (misal old input atau primary)
            if ($('#user_address').val()) {
                $('#user_address').trigger('change');
            }

            // B. Saat Kurir Dipilih - LANGSUNG CEK ONGKIR
            $('#courier').on('change', function() {
                const courier = $(this).val();

                // PERUBAHAN: Ambil Nama Kota dari atribut yang kita simpan tadi
                const cityName = $('#user_address').attr('data-selected-city-name');
                const weight = $('#total_weight').val() || 1000;

                if (!courier) {
                    $('#service-container').hide();
                    $('#service').empty().append('<option value="">-- Pilih Layanan --</option>');
                    updateShippingUI(0, '');
                    return;
                }

                // Pastikan Kurir dipilih DAN Nama Kota ada
                if (courier && cityName) {
                    $('#service-container').css('display', 'flex');
                    $('#service').html('<option value="">⏳ Mencari lokasi & cek ongkir...</option>').prop('disabled', true);

                    $.ajax({
                        url: '{{ route('api.checkOngkir') }}',
                        method: 'POST',
                        data: JSON.stringify({
                            destination_city: cityName, // PERUBAHAN: Kirim String Nama Kota
                            weight: weight,
                            courier: courier
                        }),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            $('#service').empty().append('<option value="">-- Pilih Layanan --</option>').prop('disabled', false);

                            console.log("✅ Data Ongkir:", response);

                            if (Array.isArray(response) && response.length > 0) {
                                response.forEach(item => {
                                    const serviceName = item.service;
                                    const description = item.description || '';
                                    const costValue = parseInt(item.cost);
                                    const etdRaw = item.etd || '';
                                    const courierName = courier.toUpperCase();

                                    const txtPrice = costValue === 0 ? '🎁 GRATIS' : 'Rp ' + new Intl.NumberFormat('id-ID').format(costValue);
                                    const etd = etdRaw ? ` (${etdRaw.replace('HARI', 'hari').replace('day', 'hari')})` : '';

                                    const label = `${serviceName} - ${description} : ${txtPrice}${etd}`;
                                    const fullName = `${courierName} - ${serviceName}`;

                                    $('#service').append(`<option value="${costValue}" data-name="${fullName}">${label}</option>`);
                                });
                            } else {
                                $('#service').html('<option value="">❌ Tidak ada layanan tersedia</option>');
                                console.warn('⚠️ Tidak ada data ongkir untuk kurir ini');
                            }
                        },
                        error: function(xhr) {
                            console.error("❌ Error API:", xhr);
                            let errorMsg = 'Gagal memuat ongkir';

                            // Tangkap pesan error spesifik dari controller (misal: Kota tidak ditemukan)
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorMsg = xhr.responseJSON.error;
                            }

                            $('#service').html(`<option value="">❌ ${errorMsg}</option>`).prop('disabled', false);

                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Cek Ongkir',
                                text: errorMsg,
                                confirmButtonColor: '#074159'
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Silakan pilih alamat dengan Kota yang valid terlebih dahulu!',
                        confirmButtonColor: '#074159'
                    });
                }
            });

            // C. Saat Layanan Dipilih
            $('#service').on('change', function() {
                const cost = parseInt($(this).val()) || 0;
                const name = $(this).find(':selected').data('name') || '';
                updateShippingUI(cost, name);
            });

            function updateShippingUI(cost, name) {
                const txt = cost === 0 ? 'Rp 0' : 'Rp ' + new Intl.NumberFormat('id-ID').format(cost);
                $('#shipping-cost-display').text(txt);
                $('#hidden_shipping_cost').val(cost);
                $('#hidden_shipping_service').val(name);
                recalcTotal();
            }
        });
    @else
        // --- 3. LOGIKA GUEST (TIDAK BERUBAH) ---
        function rp(n) { return 'Rp ' + (n || 0).toLocaleString('id-ID'); }
        function loadGuestItems() {
            try { return JSON.parse(localStorage.getItem('skm_guest_cart') || '[]'); }
            catch (e) { return []; }
        }
        function renderGuestCart() {
            const items = loadGuestItems();
            const content = document.getElementById('guestCartContent');
            const empty = document.getElementById('guestEmptyState');
            const list = document.getElementById('guest-items-list');
            const countEl = document.getElementById('guest-items-count');

            if (!items.length) {
                if (content) content.style.display = 'none';
                if (empty) empty.style.display = 'block';
                return;
            }
            if (content) content.style.display = 'grid';
            if (empty) empty.style.display = 'none';
            if (list) list.innerHTML = '';

            let total = 0;
            items.forEach(it => {
                total += it.quantity * it.unit_price;
                const div = document.createElement('div');
                div.className = 'cart-item';
                div.innerHTML = `<div class="cart-item-details"><h3>${it.product_name}</h3><div>Harga: ${rp(it.unit_price)} x ${it.quantity}</div></div>`;
                list.appendChild(div);
            });
            document.getElementById('guest-subtotal').innerText = rp(total);
            document.getElementById('guest-grand-total').innerText = rp(total);
            if (countEl) countEl.innerText = items.length;
        }
        document.addEventListener('DOMContentLoaded', renderGuestCart);
    @endauth
</script>
</body>

</html>
