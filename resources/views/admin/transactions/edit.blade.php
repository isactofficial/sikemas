<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaction - Admin (Order: #{{ $order->invoice_number }})</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;700;800&display=swap" rel="stylesheet">

    <style>
        /* === CSS DASAR === */
        :root {
            --skm-teal: #1F6D72;
            --skm-blue: #074159;
            --skm-blue-2: #053244;
            --skm-accent: #ff5722;
            --skm-bg: #F4F7F6;

            --skm-teal-dark: #074159;
            --skm-teal-light: #1F6D72;
            --skm-text-label: #6B7280;
            --skm-border: #E5E7EB;
            --skm-arrow-box-border: #ced4da;
            --skm-arrow-box-bg: #f3f4f6;
        }
        .skm-admin-main { box-sizing: border-box; margin: 0; padding: 0; }
        .skm-admin-main { font-family: 'Besley', system-ui, sans-serif; background: var(--skm-bg); min-height: 100vh; }

        /* Layout */
        .skm-admin-main {
            margin-left: 240px;
            padding: 40px 24px;
            box-sizing: border-box;
            width: calc(100% - 240px);
            display: flex;
            flex-direction: column;
            gap: 24px;
            min-height: 100vh;
        }

        /* Kartu */
        .skm-figma-container {
            background: #ffffff;
            border-radius: 24px;
            padding: 32px 40px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--skm-border);
            box-sizing: border-box;
        }

        /* Judul Bagian */
        .section-title {
            color: var(--skm-teal-dark);
            font-size: 24px;
            font-weight: 800;
            margin: 24px 0 16px 0;
            padding-bottom: 8px;
            text-align: left;
        }
        .skm-figma-container .section-title:first-child {
            margin-top: 0;
        }


        .profile-section-wrapper { position: relative; padding-bottom: 24px; border-bottom: 1px solid var(--skm-border); }
        .new-profile-edit-icon { position: absolute; top: 0; right: 0; font-size: 16px; color: var(--skm-teal-light); text-decoration: none; }
        .new-profile-header { display: flex; flex-direction: column; align-items: center; margin-bottom: 24px; }
        .new-profile-avatar { width: 80px; height: 80px; border-radius: 12px; border: 3px solid var(--skm-teal-light); display: flex; align-items: center; justify-content: center; overflow: hidden; margin-bottom: 12px; background-color: #f0f0f0; }
        .new-profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .new-profile-name { font-size: 22px; font-weight: 800; color: var(--skm-teal-dark); margin-bottom: 4px; }
        .new-profile-role { font-size: 15px; color: var(--skm-text-label); }
        .new-profile-info-list { display: flex; flex-direction: column; gap: 8px; }
        .new-profile-info-item { display: flex; justify-content: space-between; align-items: flex-start; padding: 14px 0; border-bottom: 1px solid var(--skm-border); font-size: 14px; line-height: 1.4; }
        .new-profile-info-item:last-child { border-bottom: none; padding-bottom: 0; }
        .new-profile-info-item .label { color: var(--skm-text-label); font-weight: 400; flex-shrink: 0; margin-right: 16px; }
        .new-profile-info-item .value { color: var(--skm-teal-dark); font-weight: 700; text-align: right; max-width: 60%; }
        .profile-section-wrapper .section-title { text-align: center; border-bottom: 1px solid var(--skm-border); }


        .order-items-section { background: #ffffff; border-radius: 24px; padding: 32px 40px; border: 1px solid var(--skm-border); width: 100%; box-sizing: border-box; display: flex; flex-direction: column; gap: 16px; }
        .order-item { display: flex; gap: 16px; align-items: flex-start; padding-bottom: 16px; border-bottom: 1px solid var(--skm-border); position: relative; }
        .order-item:last-child { border-bottom: none; }
        .order-item .item-image { width: 80px; height: 80px; border-radius: 8px; object-fit: cover; border: 1px solid var(--skm-border); flex-shrink: 0; }
        .order-item .item-details { flex-grow: 1; display: flex; flex-direction: column; gap: 8px; }
        .order-item .item-name { font-size: 17px; font-weight: 700; color: var(--skm-teal-dark); display: block; }
        .item-attributes { display: flex; flex-wrap: wrap; gap: 12px; font-size: 13px; color: var(--skm-text-label); }
        .item-attributes span { display: flex; align-items: center; gap: 4px; }
        .item-attributes i { color: var(--skm-teal-light); }
        .order-item .item-price-label { font-size: 14px; color: var(--skm-accent); font-weight: 700; }
        .item-quantity-stepper { display: flex; align-items: center; border: 1px solid var(--skm-border); border-radius: 6px; width: min-content; }
        .stepper-btn, .stepper-input { border: none; background: none; font-family: 'Besley', serif; font-weight: 700; text-align: center; color: var(--skm-teal-dark); }
        .stepper-btn { padding: 4px 10px; font-size: 16px; color: var(--skm-text-label); cursor: not-allowed; }
        .stepper-input { width: 30px; padding: 4px 0; font-size: 15px; -moz-appearance: textfield; }
        .stepper-input::-webkit-outer-spin-button, .stepper-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        .item-price-info { display: flex; flex-direction: column; align-items: flex-end; justify-content: space-between; flex-shrink: 0; margin-left: auto; align-self: stretch; }
        .item-price-info .item-delete-icon { font-size: 16px; color: var(--skm-text-label); text-decoration: none; }
        .item-price-info .item-delete-icon:hover { color: var(--skm-accent); }
        .item-price-info .item-total-price { font-size: 16px; font-weight: 800; color: var(--skm-teal-dark); margin-top: auto; }

        .summary-grid {
            display: grid;
            grid-template-columns: auto auto;
            justify-content: space-between;
            row-gap: 8px;
            font-size: 15px;
            border-bottom: 2px solid var(--skm-accent);
            padding-bottom: 16px;
            margin-bottom: 16px;
        }
        .summary-grid .label { color: var(--skm-text-label); }
        .summary-grid .value { color: var(--skm-text-label); font-weight: 400; text-align: right; }
        .summary-grid .total-label { font-weight: 400; font-size: 17px; color: var(--skm-text-label); padding-top: 8px; }
        .summary-grid .total-value { font-weight: 800; font-size: 17px; color: var(--skm-accent); padding-top: 8px; }


        /* ===  CSS Status Barang  === */
        .status-grid {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 16px;
            align-items: center;
        }
        .status-grid .row {
            display: contents;
        }
        .status-grid .label {
            font-size: 16px;
            font-weight: 400;
            color: var(--skm-text-label);
        }

        .status-select-wrapper {

            border: 2px solid;
            border-radius: 8px;
            overflow: hidden;
            vertical-align: middle;
        }

        #payment-wrapper {
            width: 130px;
        }
        #shipping-wrapper {
            width: 130px;
        }

        .status-select {
            padding: 4px 8px;
            font-weight: 700;
            font-size: 13px;
            font-family: 'Besley', serif;
            border: none;
            border-radius: 0;
            background-color: transparent;
            text-transform: capitalize;
            color: inherit;
            width: 100%;
        }
        .status-select:focus {
            outline: none;
            box-shadow: none;
        }

        .status-grid .row:not(:last-of-type) .label,
        .status-grid .row:not(:last-of-type) .status-select-wrapper {
            padding-bottom: 9px;
            margin-bottom: 14px;
            border-bottom: 1px solid var(--skm-border);
        }

        .status-select-wrapper.status-paid,
        .status-select-wrapper.status-arrived {
            background-color: #D4EDDA;
            border-color: #C3E6CB;
        }
        .status-select-wrapper.status-paid .status-select,
        .status-select-wrapper.status-arrived .status-select {
            color: #155724;
        }

        .status-select-wrapper.status-unpaid,
        .status-select-wrapper.status-pending,
        .status-select-wrapper.status-shipped {
            background-color: #FEF3C7;
            border-color: #FDE68A;
        }
        .status-select-wrapper.status-unpaid .status-select,
        .status-select-wrapper.status-pending .status-select,
        .status-select-wrapper.status-shipped .status-select {
            color: #92400E;
        }

        .status-select-wrapper.status-cancelled {
            background-color: #FEE2E2;
            border-color: #FDD2D2;
        }
        .status-select-wrapper.status-cancelled .status-select {
            color: #991B1B;
        }

        .submit-section {
            margin-top: 12px;
            text-align: right;
        }
        .submit-btn {
            width: auto;
            padding: 14px 80px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 18px;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            cursor: pointer;
            border: none;
            transition: all .15s ease;
            background: var(--skm-accent);
            color: #fff;
            box-shadow: 0 4px 12px rgba(255,87,34,.3);
        }
        .submit-btn:hover {
            background: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255,87,34,.4);
        }

        /* === Responsif === */
        @media (max-width: 1024px) {
            .skm-admin-main { margin-left: 0; width: 100%; padding: 10px; gap: 16px; }
        }
        @media (max-width: 767px) {
            .skm-figma-container { padding: 16px; }
            .order-items-section { padding: 16px; }

            .new-profile-info-item { flex-direction: column; align-items: flex-start; gap: 4px; }
            .new-profile-info-item .value { text-align: left; max-width: 100%; }
            .order-item { flex-direction: column; align-items: stretch; gap: 10px; }
            .order-item .item-image { width: 100%; height: 150px; }
            .item-price-info { flex-direction: row; justify-content: space-between; align-items: center; margin-top: 10px; margin-left: 0; }
            .item-price-info .item-total-price { margin-top: 0; }

            .status-grid { grid-template-columns: 1fr auto; gap: 8px; }
            .submit-section { text-align: center; }
            .submit-btn { width: 100%; }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar_admin')

    <main class="skm-admin-main">

        <div class="skm-figma-container">
            <div class="profile-section-wrapper">
                <a href="#" class="new-profile-edit-icon">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <div class="new-profile-header">
                    <div class="new-profile-avatar">
                        <img src="{{ $order->user->avatar_url ?? 'https://i.imgur.com/83mBv22.png' }}"
                             alt="Avatar"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="new-profile-name">{{ $order->user->name ?? 'Admin Utama' }}</div>
                    <div class="new-profile-role">Pengguna</div>
                </div>

                <h2 class="section-title" style="margin-top: 0;">Informasi Dasar</h2>

                <div class="new-profile-info-list">
                    <div class="new-profile-info-item">
                        <span class="label">Nama</span>
                        <span class="value">{{ $order->user->name ?? 'N/A' }}</span>
                    </div>
                    <div class="new-profile-info-item">
                        <span class="label">Tanggal Lahir</span>
                        <span class="value">{{ $order->user->date_of_birth ?? 'N/A' }}</span>
                    </div>
                    <div class="new-profile-info-item">
                        <span class="label">Alamat Pengiriman</span>
                        <span class="value">{{ $order->shippingAddress->full_address ?? 'N/A' }}</span>
                    </div>
                    <div class="new-profile-info-item">
                        <span class="label">Email</span>
                        <span class="value">{{ $order->user->email ?? 'N/A' }}</span>
                    </div>
                    <div class="new-profile-info-item">
                        <span class="label">Nomor Telepon</span>
                        <span class="value">{{ $order->shippingAddress->phone_number ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="order-items-section">
            @forelse($order->items as $item)
            <div class="order-item">
                <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/80' }}"
                     alt="{{ $item->product->name ?? 'Produk' }}"
                     class="item-image"
                     onerror="this.src='https://via.placeholder.com/80';">

                <div class="item-details">
                    <span class="item-name">{{ $item->product->name ?? 'Produk Dihapus' }}</span>
                    <div class="item-attributes">
                        <span><i class="fas fa-box-open"></i> Bahan: {{ $item->product->material ?? 'Karton' }}</span>
                        <span><i class="fas fa-ruler-combined"></i> Ukuran: {{ $item->product->size ?? 'N/A' }}</span>
                        <span><i class="fas fa-paint-brush"></i> {{ $item->product->design_type ?? 'Desain Kustom' }}</span>
                    </div>
                    <span class="item-price-label">
                        Harga: Rp {{ number_format($item->product->price ?? 0, 0, ',', '.') }}
                    </span>
                    <div class="item-quantity-stepper">
                        <button type="button" class="stepper-btn" disabled>-</button>
                        <input type="text" class="stepper-input" value="{{ $item->quantity }}" readonly>
                        <button type="button" class="stepper-btn" disabled>+</button>
                    </div>
                </div>

                <div class="item-price-info">
                    <a href="#" class="item-delete-icon">
                        <i class="fas fa-trash"></i>
                    </a>
                    <span class="item-total-price">Rp {{ number_format(($item->product->price ?? 0) * $item->quantity, 0, ',', '.') }}</span>
                </div>
            </div>
            @empty
            <p style="text-align: center; color: var(--skm-text-label);">Tidak ada item dalam pesanan ini.</p>
            @endforelse
        </div>

        <form method="POST" action="{{ route('admin.transactions.update', $order->id) }}">
            @csrf
            @method('PUT')

            <div class="skm-figma-container">
                <h2 class="section-title">Ringkasan Belanja</h2>

                <div class="summary-grid">
                    <span class="label">Subtotal</span>
                    <span class="value">Rp {{ number_format($order->subtotal ?? ($order->total_amount - ($order->shipping_cost ?? 0)), 0, ',', '.') }}</span>

                    <span class="label">Biaya Pengiriman</span>
                    <span class="value">Rp {{ number_format($order->shipping_cost ?? 0, 0, ',', '.') }}</span>

                    <span class="label total-label">Total</span>
                    <span class="value total-value">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>

                <h2 class="section-title">Status Barang</h2>

                <div class="status-grid">
                    <div class="row">
                        <label for="payment_status" class="label">Pembayaran</label>
                        <div class="status-select-wrapper" id="payment-wrapper">
                            <select name="payment_status" id="payment_status" class="status-select">
                                <option value="Paid" {{ ($order->payment_status == 'Paid') ? 'selected' : '' }}>Paid</option>
                                <option value="Unpaid" {{ ($order->payment_status == 'Unpaid') ? 'selected' : '' }}>Unpaid</option>
                                <option value="Cancelled" {{ ($order->payment_status == 'Cancelled') ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            </div>
                    </div>

                    <div class="row">
                        <label for="shipping_status" class="label">Status Barang</label>
                        <div class="status-select-wrapper" id="shipping-wrapper">
                            <select name="shipping_status" id="shipping_status" class="status-select">
                                <option value="Pending" {{ ($order->shipping_status == 'Pending') ? 'selected' : '' }}>Pending</option>
                                <option value="Shipped" {{ ($order->shipping_status == 'Shipped') ? 'selected' : '' }}>Shipped</option>
                                <option value="Arrived" {{ ($order->shipping_status == 'Arrived') ? 'selected' : '' }}>Arrived</option>
                                <option value="Cancelled" {{ ($order->shipping_status == 'Cancelled') ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            </div>
                    </div>
                </div>

            </div>

            <div class="submit-section">
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function setupStatusSelect(selectName) {
                var select = document.querySelector('select[name="' + selectName + '"]');
                if (select) {
                    var wrapper = select.closest('.status-select-wrapper');
                    if (wrapper) {
                        function updateWrapperClass() {
                            wrapper.classList.remove('status-paid', 'status-unpaid', 'status-cancelled', 'status-pending', 'status-shipped', 'status-arrived');
                            wrapper.classList.add('status-' + select.value.toLowerCase());
                        }
                        updateWrapperClass();
                        select.onchange = updateWrapperClass;
                    }
                }
            }
            setupStatusSelect('payment_status');
            setupStatusSelect('shipping_status');
        });
    </script>

</body>
</html>
