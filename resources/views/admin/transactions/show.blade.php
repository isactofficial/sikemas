<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Detail - {{ $order->invoice_number }}</title>

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
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .btn-back {
            background: var(--skm-teal);
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background: var(--skm-blue);
        }

        .detail-card {
            background: #fff;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
            border: 1px solid var(--skm-border);
        }

        .section-title {
            color: var(--skm-blue);
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--skm-border);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .info-label {
            font-size: 13px;
            color: #6B7280;
            font-weight: 600;
        }

        .info-value {
            font-size: 15px;
            color: var(--skm-blue);
            font-weight: 700;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 12px;
            text-transform: capitalize;
        }

        .status-badge.paid,
        .status-badge.arrived {
            background-color: #D4EDDA;
            color: #155724;
            border: 1px solid #C3E6CB;
        }

        .status-badge.unpaid,
        .status-badge.pending {
            background-color: #FEF3C7;
            color: #92400E;
            border: 1px solid #FDE68A;
        }

        .status-badge.cancelled {
            background-color: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FDD2D2;
        }

        .status-badge.shipped {
            background-color: #DBEAFE;
            color: #1E40AF;
            border: 1px solid #BFDBFE;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .items-table th {
            background: #F9FAFB;
            padding: 12px;
            text-align: left;
            font-size: 13px;
            font-weight: 700;
            color: #23C8B8;
            border-bottom: 2px solid var(--skm-border);
        }

        .items-table td {
            padding: 16px 12px;
            border-bottom: 1px solid var(--skm-border);
            font-size: 14px;
            color: var(--skm-blue-2);
        }

        .items-table tbody tr:last-child td {
            border-bottom: none;
        }

        .items-table tbody tr:hover {
            background: #F9FAFB;
        }

        .product-name {
            font-weight: 700;
            color: var(--skm-blue);
        }

        .total-section {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 2px solid var(--skm-border);
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 12px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            min-width: 300px;
            font-size: 15px;
        }

        .total-row.grand-total {
            font-size: 18px;
            font-weight: 800;
            color: var(--skm-accent);
            padding-top: 12px;
            border-top: 2px solid var(--skm-border);
        }

        .design-file {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--skm-teal);
            font-size: 13px;
        }

        .design-file a {
            color: var(--skm-teal);
            text-decoration: underline;
        }

        @media (max-width: 1024px) {
            .skm-admin-main {
                margin-left: 0;
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .items-table {
                font-size: 12px;
            }

            .items-table th,
            .items-table td {
                padding: 10px 8px;
            }

            .total-row {
                min-width: 100%;
                font-size: 14px;
            }

            .total-row.grand-total {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar_admin')

    <main class="skm-admin-main">
        <div class="skm-header">
            <div>
                <h1>Transaction Detail</h1>
                <p>Invoice: {{ $order->invoice_number }}</p>
            </div>
            <a href="{{ route('admin.transactions.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>

        <!-- Customer Information -->
        <div class="detail-card">
            <h2 class="section-title">Customer Information</h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Customer Name</span>
                    <span class="info-value">{{ $order->user->name ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $order->user->email ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Phone</span>
                    <span class="info-value">{{ $order->user->phone ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Order Date</span>
                    <span class="info-value">{{ $order->order_date ? $order->order_date->format('d M Y') : 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Shipping Address -->
        @if($order->shippingAddress)
        <div class="detail-card">
            <h2 class="section-title">Shipping Address</h2>
            <div class="info-item">
                <span class="info-value">{{ $order->shippingAddress->full_address }}</span>
            </div>
        </div>
        @endif

        <!-- Order Details -->
        <div class="detail-card">
            <h2 class="section-title">Order Details</h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Payment Status</span>
                    <div>
                        @if($order->payment_status == 'Paid')
                            <span class="status-badge paid">Paid</span>
                        @elseif($order->payment_status == 'Unpaid')
                            <span class="status-badge unpaid">Unpaid</span>
                        @else
                            <span class="status-badge cancelled">Cancelled</span>
                        @endif
                    </div>
                </div>
                <div class="info-item">
                    <span class="info-label">Shipping Status</span>
                    <div>
                        @if($order->shipping_status == 'Arrived')
                            <span class="status-badge arrived">Arrived</span>
                        @elseif($order->shipping_status == 'Shipped')
                            <span class="status-badge shipped">Shipped</span>
                        @elseif($order->shipping_status == 'Pending')
                            <span class="status-badge pending">Pending</span>
                        @else
                            <span class="status-badge cancelled">Cancelled</span>
                        @endif
                    </div>
                </div>
                <div class="info-item">
                    <span class="info-label">Payment Method</span>
                    <span class="info-value">{{ $order->payment_method ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Shipping Cost</span>
                    <span class="info-value">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
            </div>

            @if($order->notes)
            <div class="info-item" style="margin-top: 16px;">
                <span class="info-label">Notes</span>
                <span class="info-value">{{ $order->notes }}</span>
            </div>
            @endif
        </div>

        <!-- Order Items -->
        <div class="detail-card">
            <h2 class="section-title">Order Items</h2>
            
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Design File</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach($order->items as $item)
                        @php
                            $subtotal += $item->subtotal;
                        @endphp
                        <tr>
                            <td class="product-name">{{ $item->product_name }}</td>
                            <td>Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            <td>
                                @if($item->custom_design_file)
                                    <span class="design-file">
                                        <i class="fas fa-file"></i>
                                        <a href="{{ asset('storage/' . $item->custom_design_file) }}" target="_blank">View File</a>
                                    </span>
                                @else
                                    <span style="color: #999;">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-section">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                @php
                    $pajak = $subtotal * 0.11;
                @endphp
                <div class="total-row">
                    <span>Pajak (11%):</span>
                    <span>Rp {{ number_format($pajak, 0, ',', '.') }}</span>
                </div>
                <div class="total-row">
                    <span>Shipping Cost:</span>
                    <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="total-row grand-total">
                    <span>Grand Total:</span>
                    <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </main>
</body>
</html>