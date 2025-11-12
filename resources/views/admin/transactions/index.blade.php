<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Transactions - Admin</title>

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
        }
        .skm-admin-main { box-sizing: border-box; margin: 0; padding: 0; }
        .skm-admin-main { font-family: 'Besley', system-ui, sans-serif; background: var(--skm-bg); min-height: 100vh; }

        .skm-admin-main { margin-left: 240px; padding: 24px; }

        .skm-content-wrapper {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
            overflow: hidden;
        }

        .skm-header {
            padding: 24px;
        }
        .skm-header h1 { color: var(--skm-blue); font-size: 28px; font-weight: 800; margin-bottom: 8px; }
        .skm-header p { color: #23C8B8; font-size: 14px; }

        .skm-actions { display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap; }
        .skm-btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 13px; text-decoration: none; cursor: pointer; border: none; transition: all .15s ease; }
        .skm-btn-primary { background: var(--skm-accent); color: #fff; box-shadow: 0 4px 12px rgba(255,87,34,.3); }
        .skm-btn-primary:hover { background: #e64a19; transform: translateY(-1px); }

        .skm-filters { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
        .skm-filters select, .skm-filters input { padding: 8px 12px; border: 1.5px solid #E5E7EB; border-radius: 8px; font-size: 13px; font-family: inherit; }
        .skm-filters input { min-width: 200px; }

        .skm-table-header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .skm-table-title {
            font-size: 20px;
            font-weight: 800;
            color: var(--skm-blue);
        }

        .skm-controls-card {
            padding: 0 24px 24px 24px;
        }

        .skm-controls-card .skm-actions {
            margin-bottom: 20px;
        }

        .skm-controls-card .skm-table-header-bar {
            margin-bottom: 0;
        }

        .skm-table-wrap { overflow-x: auto; }
        .skm-table { width: 100%; border-collapse: collapse; }
        .skm-table thead { background: #F9FAFB; color: #23C8B8; }
        .skm-table th { padding: 14px 16px; text-align: left; font-weight: 700; font-size: 12px;  letter-spacing: .5px; white-space: nowrap; }
        .skm-table td { padding: 14px 16px; border-bottom: 1px solid #E5E7EB; font-size: 13px; color: var(--skm-blue-2); }
        .skm-table tbody tr:last-child td { border-bottom: none; }
        .skm-table tbody tr:hover { background: #F9FAFB; }

        .skm-thumb { width: 80px; height: 60px; border-radius: 6px; overflow: hidden; }
        .skm-thumb img { width: 100%; height: 100%; object-fit: cover; }

        .skm-badge { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 800; text-transform: uppercase; }
        .skm-badge.is-published { background: #20C8B5; color: #fff; }
        .skm-badge.is-draft { background: #FFA726; color: #fff; }

        .status-badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 12px;
            text-transform: capitalize;
            border: 1px solid;
        }

        .status-badge.paid,
        .status-badge.arrived {
            background-color: #D4EDDA;
            color: #155724;
            border-color: #C3E6CB;
        }

        .status-badge.pending,
        .status-badge.in-delivery {
            background-color: #FEF3C7;
            color: #92400E;
            border-color: #FDE68A;
        }

        .status-badge.processed {
            background-color: #FEE2E2;
            color: #991B1B;
            border-color: #FDD2D2;
        }

        .status-badge.cancelled {
            background-color: #FEE2E2;
            color: #991B1B;
            border-color: #FDD2D2;
        }

        .skm-action-btns { display: flex; gap: 8px; }
        .skm-icon-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all .15s ease;
            background: transparent;
            text-decoration: none;
            font-size: 14px;
        }
        .skm-icon-btn:hover {
            background: #F9FAFB;
        }

        .skm-icon-btn.btn-view { background-color: #a8ebac; color: #006400; }
        .skm-icon-btn.btn-invoice { background-color: #a1def6; color: #006699; }
        .skm-icon-btn.btn-edit { background-color: #f4e7a9; color: #ee9322; }
        .skm-icon-btn.btn-delete { background-color: #f3b1b4; color: #c02d34; }

        .skm-icon-btn.btn-view:hover { background-color: #98d59b; }
        .skm-icon-btn.btn-invoice:hover { background-color: #91c9e0; }
        .skm-icon-btn.btn-edit:hover { background-color: #e0d398; }
        .skm-icon-btn.btn-delete:hover { background-color: #dc9fa2; }


        .skm-pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            padding: 20px 16px;
        }
        .skm-pagination .skm-page-summary {
            font-size: 13px;
            color: #23C8B8;
            font-weight: 700;
        }

        .skm-pagination .pagination {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            gap: 4px;
            align-items: center;
        }

        .skm-pagination .page-link {
            padding: 6px 10px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            min-width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid #E5E7EB;
            color: var(--skm-blue);
            background: #fff;
            transition: all .2s ease;
        }

        .skm-pagination .page-link:hover {
            background: #F9FAFB;
            border-color: #23C8B8;
            color: #23C8B8;
        }

        .skm-pagination .page-item.active .page-link {
            background: var(--skm-accent);
            border-color: var(--skm-accent);
            color: #fff;
            font-weight: 800;
        }

        .skm-pagination .page-item.disabled .page-link {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }

        .skm-pagination .page-link span {
            display: inline;
        }

        .skm-alert {
            padding: 14px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
            border: 1px solid;
        }

        .skm-alert.success {
            background: #D4EDDA;
            color: #155724;
            border-color: #C3E6CB;
        }

        /* DELETE MODAL STYLES */
        .delete-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .delete-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .delete-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.7);
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            z-index: 9999;
            width: 90%;
            max-width: 500px;
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .delete-modal.active {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }

        .delete-modal-header {
            padding: 32px 24px 20px;
            text-align: center;
            border-bottom: 2px solid #f0f0f0;
        }

        .delete-modal-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 16px;
            background: #074159;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: scaleIn 0.4s ease;
        }

        @keyframes scaleIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .delete-modal-icon i {
            font-size: 36px;
            color: #fff;
            animation: shake 0.5s ease 0.2s;
        }

        @keyframes shake {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg); }
            75% { transform: rotate(10deg); }
        }

        .delete-modal-title {
            font-size: 24px;
            font-weight: 800;
            color: #FF611A;
            margin-bottom: 8px;
        }

        .delete-modal-subtitle {
            font-size: 14px;
            color: #666;
            font-weight: 500;
        }

        .delete-modal-body {
            padding: 24px;
        }

        .delete-info-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
            border-left: 4px solid #FF611A;
        }

        .delete-info-label {
            font-size: 11px;
            color: #666;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .delete-info-value {
            font-size: 15px;
            color: var(--skm-blue);
            font-weight: 700;
        }

        .delete-modal-warning {
            background: #fff3cd;
            border: 2px solid #ffecb5;
            border-radius: 10px;
            padding: 14px;
            margin-bottom: 24px;
            display: flex;
            align-items: start;
            gap: 12px;
        }

        .delete-modal-warning i {
            color: #856404;
            font-size: 20px;
            margin-top: 2px;
        }

        .delete-modal-warning-text {
            flex: 1;
            font-size: 13px;
            color: #856404;
            font-weight: 600;
            line-height: 1.5;
        }

        .delete-modal-actions {
            display: flex;
            gap: 12px;
        }

        .delete-modal-btn {
            flex: 1;
            padding: 14px 20px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .delete-modal-btn-cancel {
            background: #e9ecef;
            color: #495057;
        }

        .delete-modal-btn-cancel:hover {
            background: #dee2e6;
            transform: translateY(-1px);
        }

        .delete-modal-btn-confirm {
            background: #FF611A;
            color: #fff;
            box-shadow: 0 4px 12px rgba(255, 97, 26, 0.3);
        }

        .delete-modal-btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 97, 26, 0.4);
        }

        @media (max-width: 768px) {
            .skm-admin-main{ margin-left:0; padding:16px; }

            .skm-table thead { display: none; }
            .skm-table, .skm-table tbody, .skm-table tr, .skm-table td {
                display: block;
                width: 100%;
            }

            .skm-table tr {
                margin-bottom: 16px;
                border: 1px solid #E5E7EB;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 4px rgba(0,0,0,.04);
            }

            .skm-table td {
                text-align: right;
                padding: 12px 16px;
                position: relative;
                border-bottom: 1px solid #E5E7EB !important;
            }

            .skm-table td:before {
                content: attr(data-label);
                position: absolute;
                left: 16px;
                font-weight: 700;
                color: #23C8B8;
                font-size: 12px;
                text-transform: uppercase;
                white-space: nowrap;
            }

            .skm-table td:last-child {
                padding: 16px;
                background: #F9FAFB;
                text-align: center;
            }
            .skm-table td:last-child:before { display: none; }
            .skm-action-btns { justify-content: center; gap: 20px; }
            .skm-icon-btn { width: 44px; height: 44px; }
            .skm-icon-btn i { font-size: 20px; }

            .skm-pagination { flex-direction: column; gap: 12px; padding: 16px; }
            .skm-pagination .skm-page-summary { font-size: 12px; text-align: center; }
            .skm-pagination .pagination { width: 100%; justify-content: center; flex-wrap: wrap; }

            .skm-pagination .page-link {
                font-size: 12px;
                padding: 6px 8px;
                min-width: 28px;
                height: 28px;
            }
            .skm-alert { font-size: 13px; padding: 10px 12px; }

            .delete-modal {
                width: 95%;
                max-width: none;
            }

            .delete-modal-header {
                padding: 24px 16px 16px;
            }

            .delete-modal-icon {
                width: 64px;
                height: 64px;
            }

            .delete-modal-icon i {
                font-size: 28px;
            }

            .delete-modal-title {
                font-size: 20px;
            }

            .delete-modal-body {
                padding: 16px;
            }

            .delete-modal-actions {
                flex-direction: column;
            }

            .delete-modal-btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .skm-admin-main { padding: 8px; }
            .skm-header { padding: 12px; }
            .skm-header h1 { font-size: 20px; }
            .skm-controls-card {
                padding: 12px;
                padding-top: 0;
            }
            .skm-action-btns { gap: 16px; }
            .skm-icon-btn { width: 40px; height: 40px; }
            .skm-icon-btn i { font-size: 18px; }
            .skm-pagination { padding: 12px; }
        }

        @media (max-width: 1024px){
            .skm-admin-main{ margin-left:0; padding:20px; }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar_admin')

    <main class="skm-admin-main">

        @if(session('success'))
            <div class="skm-alert success">
                {{ session('success') }}
            </div>
        @endif

        <div class="skm-content-wrapper">

            <div class="skm-header">
                <h1>Manage Customer Transactions</h1>
                <p>Manage every transactions made by the customers</p>
            </div>

            <div class="skm-controls-card">
                <div class="skm-actions">
                    <a href="{{ route('admin.transactions.create') }}" class="skm-btn skm-btn-primary">
                        <i class="fas fa-plus"></i>
                        Add New Transaction
                    </a>
                </div>

                <div class="skm-table-header-bar">
                    <h2 class="skm-table-title">All Transactions</h2>

                    <form method="GET" class="skm-filters">
                        <span style="font-size: 13px; color: #23C8B8; margin-right: 4px; font-weight: 700;">Sort by:</span>
                        <select id="sort" name="sort" onchange="this.form.submit()">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="skm-table-wrap">
                <table class="skm-table">
                    <thead>
                        <tr>
                            <th>No Invoice</th>
                            <th>Pemesan</th>
                            <th>Nama Barang</th>
                            <th>Harga Akhir</th>
                            <th>Pembayaran</th>
                            <th>Status Barang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td data-label="No Invoice">{{ $order->invoice_number }}</td>
                                <td data-label="Pemesan">{{ $order->user->name ?? 'User Dihapus' }}</td>
                                <td data-label="Nama Barang">
                                    @if($order->items->count() > 0)
                                        @foreach($order->items as $item)
                                            {{ $item->product_name }}@if(!$loop->last), @endif
                                        @endforeach
                                    @else
                                        <span style="color: #999;">-</span>
                                    @endif
                                </td>
                                <td data-label="Harga Akhir">Rp. {{ number_format($order->total_amount, 0, ',', '.') }}</td>

                                <td data-label="Pembayaran">
                                    @if($order->payment_status == 'Paid')
                                        <span class="status-badge paid">Paid</span>
                                    @elseif($order->payment_status == 'Unpaid')
                                        <span class="status-badge pending">Unpaid</span>
                                    @elseif($order->payment_status == 'Cancelled')
                                        <span class="status-badge cancelled">Cancelled</span>
                                    @else
                                        <span class="status-badge pending">{{ $order->payment_status }}</span>
                                    @endif
                                </td>

                                <td data-label="Status Barang">
                                    @if($order->shipping_status == 'Arrived')
                                        <span class="status-badge arrived">Arrived</span>
                                    @elseif($order->shipping_status == 'Shipped')
                                        <span class="status-badge in-delivery">Shipped</span>
                                    @elseif($order->shipping_status == 'Pending')
                                        <span class="status-badge pending">Pending</span>
                                    @elseif($order->shipping_status == 'Cancelled')
                                        <span class="status-badge cancelled">Cancelled</span>
                                    @else
                                        <span class="status-badge pending">{{ $order->shipping_status }}</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="skm-action-btns">
                                        <a href="{{ route('admin.transactions.show', $order->id) }}" class="skm-icon-btn btn-view" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('invoice.show', $order->id) }}" class="skm-icon-btn btn-invoice" title="View Invoice" target="_blank">
                                            <i class="fas fa-file-invoice"></i>
                                        </a>
                                        <a href="{{ route('admin.transactions.edit', $order->id) }}" class="skm-icon-btn btn-edit" title="Edit Status">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button type="button" class="skm-icon-btn btn-delete" title="Delete Transaction" 
                                            onclick="openDeleteModal('{{ $order->id }}', '{{ $order->invoice_number }}', '{{ $order->user->name ?? 'User Dihapus' }}')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 40px; color: #6B8791;">
                                    Belum ada data transaksi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($orders) && $orders->hasPages())
            <div class="skm-pagination">
                <span class="skm-page-summary">
                    Showing data {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} entries
                </span>

                {{ $orders->links('pagination::bootstrap-4') }}

                </div>
            @endif

        </div>
    </main>

    <!-- DELETE MODAL -->
    <div class="delete-modal-overlay" id="deleteModalOverlay" onclick="closeDeleteModal()"></div>
    <div class="delete-modal" id="deleteModal">
        <div class="delete-modal-header">
            <div class="delete-modal-icon">
                <i class="fas fa-trash-alt"></i>
            </div>
            <h3 class="delete-modal-title">Hapus Transaksi?</h3>
            <p class="delete-modal-subtitle">Tindakan ini tidak dapat dibatalkan</p>
        </div>
        <div class="delete-modal-body">
            <div class="delete-info-card">
                <div class="delete-info-label">Invoice Number</div>
                <div class="delete-info-value" id="modalInvoiceNumber">-</div>
            </div>
            <div class="delete-info-card">
                <div class="delete-info-label">Customer</div>
                <div class="delete-info-value" id="modalCustomerName">-</div>
            </div>
            <div class="delete-modal-warning">
                <i class="fas fa-exclamation-triangle"></i>
                <div class="delete-modal-warning-text">
                    Data transaksi akan dihapus permanen dari database. Pastikan Anda yakin sebelum melanjutkan.
                </div>
            </div>
            <div class="delete-modal-actions">
                <button type="button" class="delete-modal-btn delete-modal-btn-cancel" onclick="closeDeleteModal()">
                    <i class="fas fa-times"></i>
                    Batal
                </button>
                <form id="deleteForm" method="POST" style="flex: 1; margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-modal-btn delete-modal-btn-confirm" style="width: 100%;">
                        <i class="fas fa-trash-alt"></i>
                        Hapus Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteId = null;

        function openDeleteModal(orderId, invoiceNumber, customerName) {
            currentDeleteId = orderId;
            document.getElementById('modalInvoiceNumber').textContent = invoiceNumber;
            document.getElementById('modalCustomerName').textContent = customerName;
            document.getElementById('deleteForm').action = `/admin/transactions/${orderId}`;
            
            document.getElementById('deleteModalOverlay').classList.add('active');
            document.getElementById('deleteModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModalOverlay').classList.remove('active');
            document.getElementById('deleteModal').classList.remove('active');
            document.body.style.overflow = 'auto';
            currentDeleteId = null;
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && currentDeleteId !== null) {
                closeDeleteModal();
            }
        });
    </script>
</body>
</html>