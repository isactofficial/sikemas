@php
    // Set locale ke Bahasa Indonesia
    config(['app.locale' => 'id']);
    \Carbon\Carbon::setLocale('id');
    
    // Hitung Jatuh Tempo (Contoh: 7 hari setelah pesanan dibuat)
    $dueDate = $order->order_date->addDays(7);
    
    // Ambil tanggal hari ini untuk tanda tangan
    $todayDate = \Carbon\Carbon::now()->translatedFormat('l, d F Y');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur - {{ $order->invoice_number }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --skm-teal: #1F6D72;
            --skm-blue: #074159; 
            --skm-orange: #ff5722;
            --skm-gray: #666; 
            --skm-light-gray: #f5f5ff; 
            --skm-border: #E6EEF0; 
            --skm-dashed-border: #BBBBBB; 
            
            /* Warna Kustom Sesuai Permintaan */
            --color-faktur: #FF611A; 
            --color-label: #555555;
            --color-value: #001B24; 
            --color-status-lunas: #23C8B8;
            --color-total-bg: #F4F7F6; 
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--skm-light-gray);
            padding: 20px;
            color: #333;
        }

        /* Tombol Back */
        .back-button-wrapper {
            max-width: 900px;
            margin: 0 auto 20px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background-color: var(--skm-blue);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: var(--skm-teal);
            color: white;
        }

        .btn-back i {
            font-size: 1rem;
        }

        .invoice-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 40px 50px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
        }

        /* 1. Header */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid var(--skm-blue);
            padding-bottom: 30px; 
        }
        .header-left { display: block; }
        .logo-img { height: 50px; margin-bottom: 15px; }
        
        .company-info {
            font-size: 0.9rem;
            line-height: 1.6;
            color: var(--color-label);
        }
        .company-info strong {
            color: inherit;
            font-weight: 600; 
        }
        
        .header-right { text-align: right; }
        .invoice-title {
            font-size: 2.5rem;
            font-weight: 700; 
            color: var(--color-faktur);
            margin-bottom: 15px;
        }
        .invoice-details-list { font-size: 0.9rem; }
        .detail-item { margin-bottom: 8px; }
        .detail-label {
            color: var(--color-label);
            margin-right: 10px;
            font-weight: 500;
        }
        .detail-value {
            color: var(--color-value);
            font-weight: 600;
        }
        
        .status-value {
            color: var(--color-status-lunas) !important; 
            font-weight: 700 !important;
        }
        
        /* 2. Info: Ditagih Kepada & Dikirim Kepada */
        .invoice-info {
            display: flex;
            justify-content: space-between;
            align-items: stretch; 
            margin-top: 30px; 
            margin-bottom: 40px;
            font-size: 0.9rem;
            line-height: 1.6;
            gap: 20px;
        }
        .info-box {
            flex-basis: 48%; 
            background-color: #FFFFFF; 
            border: 1px solid var(--skm-border); 
            border-left: 4px solid var(--skm-blue); 
            padding: 15px 15px 15px 20px; 
            border-radius: 4px; 
        }
        .info-box strong {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--skm-blue); 
            font-size: 1.1rem;
        }
        .info-box strong.with-underline {
            position: relative;
            padding-bottom: 4px; 
        }
        .info-box strong.with-underline::after {
            content: '';
            display: block;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px; 
            height: 3px;
            background-color: var(--color-faktur); 
        }
        .info-box p { color: var(--skm-gray); }
        .info-box p .address-type,
        .info-box p .customer-name {
            font-weight: 600;
            color: var(--color-value); 
            font-size: 0.95rem; 
        }

        /* 3. Tabel Item Pesanan */
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            padding: 15px;
            border-bottom: 1px solid var(--skm-border);
        }
        .invoice-table th {
            background-color: var(--skm-blue);
            color: white;
            text-align: left;
            font-weight: 600;
        }
        .invoice-table th.text-right, .invoice-table td.text-right {
            text-align: right;
        }
        .invoice-table .item-description {
            font-weight: 500;
        }
        
        /* 4. Ringkasan Total (tfoot) */
        .invoice-table tfoot td {
            padding: 12px 15px; 
            font-size: 1rem;
            border-bottom: 1px solid var(--skm-border);
            color: var(--color-label); 
            font-weight: 500;
            text-align: left; 
            background: #fff; 
        }
        .invoice-table tfoot td.total-value {
            text-align: right; 
            color: var(--color-label); 
            font-weight: 600;
        }
        .invoice-table tfoot td.no-border {
            border-bottom: 1px solid var(--skm-border);
            background: #fff;
        }
        .invoice-table tfoot tr:last-child td {
            border-bottom: none; 
        }
        .invoice-table tfoot tr.grand-total td {
            color: var(--skm-blue); 
            background-color: var(--color-total-bg); 
            font-weight: 600;
        }
        .invoice-table tfoot tr.grand-total td.total-value {
            color: var(--skm-blue); 
            font-weight: 700;
        }

        .invoice-footer-line {
            height: 2px;
            background-color: var(--skm-blue);
            margin-top: 0; 
            margin-bottom: 30px; 
        }
        
        .invoice-footer {
            text-align: center;
            font-size: 0.9rem;
            color: var(--skm-gray);
            border: 1px dashed var(--skm-dashed-border); 
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 30px; 
        }
        
        .payment-notes-section {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            margin-bottom: 40px;
            gap: 20px; 
        }
        
        .info-box-new {
            flex-basis: 48%;
            background-color: #FFFFFF;
            border: 1px solid var(--skm-border); 
            border-radius: 4px;
            padding: 20px;
        }
        
        .info-box-new strong.with-underline {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--skm-blue); 
            font-size: 1.1rem;
            position: relative;
            padding-bottom: 4px; 
        }
        
        .info-box-new strong.with-underline::after {
            content: '';
            display: block;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px; 
            height: 3px;
            background-color: var(--color-faktur); 
        }
        
        .info-box-new p {
            font-size: 0.9rem;
            color: var(--skm-gray);
            line-height: 1.7;
            white-space: pre-line;
        }
        
        /* 5. Tanda Tangan */
        .signatures {
            display: flex;
            justify-content: space-between; 
            margin-top: 50px;
            text-align: center;
        }
        .signature-box { 
            width: 250px; 
            display: flex;
            flex-direction: column;
        }
        
        .signature-label-wrapper {
            min-height: 3em;
            font-size: 0.9rem;
            color: var(--color-label);
            margin-bottom: 5px; 
        }
        
        .signature-title {
            font-weight: 600;
            font-size: 1rem;
            color: var(--skm-blue);
            order: 2;
        }
        
        .signature-space {
            height: 70px;
            order: 3;
        }
        
        .signature-line {
            border-top: 1px solid var(--skm-blue);
            order: 4;
        }
        
        /* 7. Tombol Aksi */
        .action-buttons { margin-top: 30px; text-align: center; }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            margin: 5px;
            border-radius: 5px;
            text-decoration: none;
            font-family: 'Poppins', sans-serif; 
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary { background-color: var(--skm-teal); color: white; }
        .btn-primary:hover { background-color: var(--skm-blue); }
        .btn-secondary { background-color: #f0f0f0; color: #555; border: 1px solid #ddd; }
        .btn-secondary:hover { background-color: #e0e0e0; }
        .btn i { margin-right: 8px; }

        /* ========================================
           RESPONSIVE MOBILE STYLES
        ======================================== */
        @media screen and (max-width: 768px) {
            body {
                padding: 10px;
            }

            .back-button-wrapper {
                padding: 0 10px;
            }

            .btn-back {
                font-size: 0.85rem;
                padding: 8px 16px;
            }

            .invoice-container {
                padding: 20px 15px;
            }

            /* Header - Stack Vertical */
            .invoice-header {
                flex-direction: column;
                gap: 20px;
            }

            .header-left, .header-right {
                width: 100%;
                text-align: left;
            }

            .logo-img {
                height: 40px;
            }

            .company-info {
                font-size: 0.8rem;
            }

            .invoice-title {
                font-size: 1.8rem;
                margin-bottom: 10px;
            }

            .invoice-details-list {
                font-size: 0.85rem;
            }

            /* Info Boxes - Stack Vertical */
            .invoice-info {
                flex-direction: column;
                gap: 15px;
                margin-top: 20px;
                margin-bottom: 30px;
            }

            .info-box {
                flex-basis: 100%;
                padding: 12px 15px;
            }

            .info-box strong {
                font-size: 1rem;
            }

            /* Table Responsive - Horizontal Scroll */
            .invoice-table-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .invoice-table {
                min-width: 600px; /* Prevent table from becoming too small */
            }

            .invoice-table th, .invoice-table td {
                padding: 10px 8px;
                font-size: 0.85rem;
            }

            .invoice-table tfoot td {
                font-size: 0.9rem;
                padding: 10px 8px;
            }

            /* Payment & Notes - Stack Vertical */
            .payment-notes-section {
                flex-direction: column;
                gap: 15px;
                margin-bottom: 30px;
            }

            .info-box-new {
                flex-basis: 100%;
                padding: 15px;
            }

            .info-box-new strong.with-underline {
                font-size: 1rem;
            }

            .info-box-new p {
                font-size: 0.85rem;
            }

            /* Signatures - Stack Vertical or Reduce Size */
            .signatures {
                flex-direction: column;
                gap: 30px;
                margin-top: 30px;
            }

            .signature-box {
                width: 100%;
            }

            .signature-label-wrapper {
                font-size: 0.85rem;
            }

            .signature-title {
                font-size: 0.95rem;
            }

            .signature-space {
                height: 50px;
            }

            /* Action Buttons - Stack Vertical */
            .action-buttons {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                width: 100%;
                padding: 12px 20px;
                font-size: 0.9rem;
            }
        }

        /* Extra Small Devices (< 480px) */
        @media screen and (max-width: 480px) {
            .invoice-title {
                font-size: 1.5rem;
            }

            .invoice-details-list {
                font-size: 0.8rem;
            }

            .detail-label {
                display: block;
                margin-bottom: 2px;
            }

            .invoice-table {
                min-width: 500px;
            }

            .invoice-table th, .invoice-table td {
                padding: 8px 5px;
                font-size: 0.75rem;
            }

            .invoice-table tfoot td {
                font-size: 0.8rem;
            }

            .btn {
                padding: 10px 15px;
                font-size: 0.85rem;
            }
        }

        @media print {
            body { padding: 0; background-color: white; }
            .invoice-container { box-shadow: none; border-radius: 0; max-width: 100%; padding: 10px; }
            .action-buttons, .back-button-wrapper { 
                display: none; 
            }
        }
        
        .pdf-hiding .signatures,
        .pdf-hiding .payment-notes-section,
        .pdf-hiding .invoice-footer,
        .pdf-hiding .action-buttons,
        .pdf-hiding .back-button-wrapper {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    {{-- Tombol Back --}}
    <div class="back-button-wrapper no-print">
        <a href="{{ route('cart.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Keranjang
        </a>
    </div>

    <div class="invoice-container" id="invoice-to-download">
        
        <div class="invoice-header">
            
            <div class="header-left">
                <img src="{{ asset('assets/img/Rectangle.png') }}" alt="SIKEMAS Logo" class="logo-img">
                <div class="company-info">
                    Jalan Karton No. 45, Yogyakarta, Indonesia<br>
                    Email: info@sikemas.com<br>
                    Phone: 0812-3456-7890
                </div>
            </div>

            <div class="header-right">
                <h1 class="invoice-title">FAKTUR</h1>
                <div class="invoice-details-list">
                    <div class="detail-item">
                        <span class="detail-label">Nomor Faktur:</span>
                        <span class="detail-value">{{ $order->invoice_number }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Faktur:</span>
                        <span class="detail-value">{{ $order->order_date->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Jatuh Tempo:</span>
                        <span class="detail-value">{{ $dueDate->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status:</span>
                        @php
                            $statusClass = '';
                            if ($order->status == 'Selesai') $statusClass = 'status-lunas';
                            elseif ($order->status == 'Diproses') $statusClass = 'status-diproses';
                            elseif ($order->status == 'Dibatalkan') $statusClass = 'status-dibatalkan';
                        @endphp
                        <span class="detail-value status-value {{ $statusClass }}">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="invoice-info">
            
            <div class="info-box billed-to">
                <strong class="with-underline">Kepada Yth.</strong>
                <p>
                    <span class="customer-name">{{ $order->user->name }}</span><br>
                    {{ $order->shippingAddress->full_address }}
                </p>
            </div>
            
            <div class="info-box shipped-to">
                <strong class="with-underline">Dikirim ke</strong>
                <p>
                    <span class="address-type">{{ $order->shippingAddress->address_type }}</span><br>
                    {{ $order->shippingAddress->full_address }}
                </p>
            </div>

        </div>

        @php
            $subtotal = $order->items->sum('subtotal');
            $pajak = $subtotal * 0.11;
            $biaya_pengiriman = $order->shipping_cost ?? 20000;
            $total_keseluruhan = $subtotal + $pajak + $biaya_pengiriman;
        @endphp

        <div class="invoice-table-wrapper">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Deskripsi Barang</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                    <tr>
                        <td class="item-description">{{ $item->product_name }}</td>
                        <td class="text-right">{{ $item->quantity }}</td>
                        <td class="text-right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>Subtotal</td> 
                        <td class="no-border"></td> 
                        <td class="no-border"></td> 
                        <td class="total-value">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Pajak (11%)</td>
                        <td class="no-border"></td>
                        <td class="no-border"></td>
                        <td class="total-value">Rp {{ number_format($pajak, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Biaya Pengiriman</td>
                        <td class="no-border"></td>
                        <td class="no-border"></td>
                        <td class="total-value">Rp {{ number_format($biaya_pengiriman, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="grand-total">
                        <td>Total Keseluruhan</td>
                        <td class="no-border"></td>
                        <td class="no-border"></td>
                        <td class="total-value">Rp {{ number_format($total_keseluruhan, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="invoice-footer-line"></div>
        
        <div class="invoice-footer">
            <div class="thank-you">
                Terima kasih telah menggunakan layanan Sikemas. Kami berharap dapat bekerja sama lagi dengan Anda di masa mendatang.
            </div>
        </div>
        
        <div class="payment-notes-section">
            
            <div class="info-box-new payment-info">
                <strong class="with-underline">Informasi Pembayaran</strong>
                <p>Bank Sikemas
Nomor Rekening: 901100022188
Atas Nama: PT. Sinergi Kemasan Abadi</p>
            </div>
            
            <div class="info-box-new notes-info">
                <strong class="with-underline">Catatan</strong>
                <p>Mohon lakukan pembayaran sebelum tanggal jatuh tempo.
Setelah pembayaran, harap konfirmasi ke nomor berikut: 0812-3456-7890</p>
            </div>
            
        </div>

        <div class="signatures">
            <div class="signature-box">
                <div class="signature-label-wrapper">&nbsp;</div>
                <div class="signature-title">Customer</div>
                <div class="signature-space"></div> 
                <div class="signature-line"></div>
            </div>
            
            <div class="signature-box">
                <div class="signature-label-wrapper">Jakarta, {{ $todayDate }}</div>
                <div class="signature-title">Perusahaan</div>
                <div class="signature-space"></div>
                <div class="signature-line"></div>
            </div>
        </div>

    </div>

    <div class="action-buttons no-print">
        <button id="btn-download-pdf" class="btn btn-primary">
            <i class="fas fa-file-pdf"></i> Download PDF
        </button>
        <a href="{{ route('profile.index') }}" class="btn btn-secondary">
            <i class="fas fa-list"></i> Lihat Riwayat Pesanan
        </a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('btn-download-pdf').addEventListener('click', function () {
            const element = document.getElementById('invoice-to-download');
            const invoiceNumber = '{{ $order->invoice_number }}'; 
            
            const opt = {
              margin:       [0.5, 0.5, 0.5, 0.5],
              filename:     'Faktur-' + invoiceNumber + '.pdf',
              image:        { type: 'jpeg', quality: 0.98 },
              html2canvas:  { scale: 2, useCORS: true },
              jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
            };

            document.body.classList.add('pdf-hiding');

            html2pdf().from(element).set(opt).save().then(function() {
                document.body.classList.remove('pdf-hiding');
            });
        });
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            
            if (urlParams.get('download') === 'true') {
                console.log('Perintah download terdeteksi. Memulai download otomatis...');
                
                const downloadButton = document.getElementById('btn-download-pdf');
                
                if (downloadButton) {
                    downloadButton.click();
                } else {
                    console.error('Tombol download (#btn-download-pdf) tidak ditemukan untuk auto-download.');
                }
            }
        });
    </script>
</body>
</html>