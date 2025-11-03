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

        /* Kustomisasi untuk pagination default Laravel (Bootstrap 4) */
        .skm-pagination .pagination {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            gap: 4px;
            align-items: center;
        }

        /* Style dasar .page-link (Ini adalah state default) */
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
            transition: all 0.2s ease;
            line-height: 1;
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            color: var(--skm-blue-2, #6B7280);
        }

        /* State Hover (Hanya untuk yang tidak aktif/disabled) */
        .skm-pagination .page-item:not(.active):not(.disabled) .page-link:hover {
            background: #F3F4F6;
            border-color: #D1D5DB;
            color: var(--skm-blue, #074159);
        }

        .skm-pagination .page-item.active .page-link {
            background: #23C8B8;
            color: #fff;
            border-color: #23C8B8;
            font-weight: 700;
        }

        .skm-pagination .page-item.disabled .page-link {
            color: #9CA3AF;
            background: #F9FAFB;
            border-color: #E5E7EB;
            opacity: 1;
        }


        /* Alert */
        .skm-alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
        .skm-alert.success { background: #D4EDDA; color: #155724; border: 1px solid #C3E6CB; }

        @media (max-width: 767px) {
            .skm-admin-main {
                margin-left: 0;
                margin-top: 72px;
                padding: 12px;
            }
            .skm-content-wrapper { border-radius: 8px; }
            .skm-header { padding: 16px; }
            .skm-header h1 { font-size: 22px; }
            .skm-header p { font-size: 13px; }
            .skm-controls-card {
                padding: 16px;
                padding-top: 0; /* Terapkan juga di mobile */
            }
            .skm-actions { flex-direction: column; align-items: stretch; margin-bottom: 16px; }
            .skm-btn { width: 100%; justify-content: center; padding: 12px 16px; }
            .skm-table-header-bar { flex-direction: column; align-items: stretch; gap: 12px; }
            .skm-table-title { font-size: 18px; }
            .skm-filters { flex-direction: column; align-items: stretch; width: 100%; }
            .skm-filters select { width: 100%; }

            .skm-table-wrap { overflow: visible; }
            .skm-table thead { display: none; }
            .skm-table, .skm-table tbody, .skm-table tr {
                display: block;
                width: 100%;
            }
            .skm-table tr {
                margin-bottom: 16px;
                border: 1px solid #E5E7EB;
                border-radius: 12px;
                overflow: hidden;
                background: white;
                box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            }
            .skm-table td {
                display: block;
                width: 100%;
                border-bottom: 1px solid #E5E7EB;
                padding: 12px 16px;
                text-align: right;
                position: relative;
            }
            .skm-table td:last-child { border-bottom: none; }
            .skm-table td:before {
                content: attr(data-label);
                position: absolute;
                left: 16px;
                width: 50%;
                padding-right: 10px;
                font-weight: 700;
                text-align: left;
                color: var(--skm-blue);
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
        }

        @media (max-width: 480px) {
            .skm-admin-main { padding: 8px; }
            .skm-header { padding: 12px; }
            .skm-header h1 { font-size: 20px; }
            .skm-controls-card {
                padding: 12px;
                padding-top: 0; /* Terapkan juga di mobile */
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
                                <td data-label="Harga Akhir">Rp. {{ number_format($order->total_amount, 0, ',', '.') }}</td>

                                <td data-label="Pembayaran">
                                    @if($order->payment_status == 'Paid')
                                        <span class="status-badge paid">Paid</span>
                                    @elseif($order->payment_status == 'Unpaid')
                                        <span class="status-badge pending">Unpaid</span>
                                    @elseif($order->payment_status == 'Cancelled')
                                        <span class="status-badge cancelled">Cancelled</span>
                                    @else
                                        {{-- Fallback jika ada status lain --}}
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
                                        <form action="{{ route('admin.transactions.destroy', $order->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="skm-icon-btn btn-delete" title="Delete Transaction">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 40px; color: #6B8791;">
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
</body>
</html>
