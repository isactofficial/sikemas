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
            --color-label: #555555; /* Warna label, tgl ttd, & info perusahaan */
            --color-value: #001B24; 
            --color-status-lunas: #23C8B8; /* Warna status */
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
        
        /* DIPERBARUI: Memastikan warna 555555 */
        .company-info {
            font-size: 0.9rem;
            line-height: 1.6;
            color: var(--color-label); /* 555555 */
        }
        .company-info strong {
            /* Style strong dihapus agar tidak beda warna */
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
        
        /* DIPERBARUI: Warna status selalu 23C8B8 */
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

        /* Garis biru di bawah tabel */
        .invoice-footer-line {
            height: 2px;
            background-color: var(--skm-blue);
            margin-top: 0; 
            margin-bottom: 30px; 
        }
        
        /* Kotak Terima Kasih */
        .invoice-footer {
            text-align: center;
            font-size: 0.9rem;
            color: var(--skm-gray);
            border: 1px dashed var(--skm-dashed-border); 
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 30px; 
        }
        
        /* Seksi Info Pembayaran & Catatan */
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
        
        /* 5. Tanda Tangan (DIPERBARUI) */
        .signatures {
            display: flex;
            justify-content: space-between; 
            margin-top: 50px;
            text-align: center;
        }
        .signature-box { 
            width: 250px; 
            /* BARU: Menggunakan flex column */
            display: flex;
            flex-direction: column;
        }
        
        .signature-label-wrapper {
            /* BARU: Kotak untuk tanggal (atau kosong) */
            min-height: 3em; /* Cukup untuk 2 baris tanggal */
            font-size: 0.9rem;
            color: var(--color-label); /* 555555 */
            margin-bottom: 5px; 
        }
        
        .signature-title {
            font-weight: 600;
            font-size: 1rem;
            color: var(--skm-blue); /* 074159 */
            /* BARU: Pastikan urutan */
            order: 2;
        }
        
        .signature-space {
            height: 70px; /* Jarak untuk tanda tangan */
            /* BARU: Pastikan urutan */
            order: 3;
        }
        
        .signature-line {
            border-top: 1px solid var(--skm-blue); /* Garis 074159 */
            /* BARU: Pastikan urutan */
            order: 4;
        }
        
        /* 7. Tombol Aksi (Jangan Dicetak) */
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

        @media print {
            body { padding: 0; background-color: white; }
            .invoice-container { box-shadow: none; border-radius: 0; max-width: 100%; padding: 10px; }
            .action-buttons { 
                display: none; 
            }
        }
        
        /* Style khusus untuk proses download PDF */
        .pdf-hiding .signatures,
        .pdf-hiding .payment-notes-section,
        .pdf-hiding .invoice-footer,
        .pdf-hiding .action-buttons {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

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
            // Algoritma Pajak:
            $subtotal = $order->items->sum('subtotal');
            $pajak = $subtotal * 0.11;
            $total_keseluruhan = $subtotal + $pajak;
        @endphp

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Deskripsi Barang</th>
                    <th class="text-right">Kuantitas</th>
                    <th class="text-right">Harga Satuan</th>
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
                <tr class="grand-total">
                    <td>Total Keseluruhan</td>
                    <td class="no-border"></td>
                    <td class="no-border"></td>
                    <td class="total-value">Rp {{ number_format($total_keseluruhan, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
        
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

    </div> <div class="action-buttons no-print">
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
            
            // Ambil elemen yang akan di-download
            const element = document.getElementById('invoice-to-download');
            
            // Ambil nomor invoice dari blade untuk nama file
            const invoiceNumber = '{{ $order->invoice_number }}'; 
            
            const opt = {
              margin:       [0.5, 0.5, 0.5, 0.5], // top, left, bottom, right (dalam inch)
              filename:     'Faktur-' + invoiceNumber + '.pdf',
              image:        { type: 'jpeg', quality: 0.98 },
              html2canvas:  { scale: 2, useCORS: true },
              jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
            };

            // Tambahkan class khusus ke body untuk menyembunyikan elemen
            document.body.classList.add('pdf-hiding');

            // Generate PDF
            html2pdf().from(element).set(opt).save().then(function() {
                // Hapus class setelah selesai
                document.body.classList.remove('pdf-hiding');
            });
        });
    </script>
    
    <script>
        // Jalankan skrip ini setelah semua elemen halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. Ambil parameter dari URL
            const urlParams = new URLSearchParams(window.location.search);
            
            // 2. Cek apakah parameter 'download' ada dan nilainya 'true'
            if (urlParams.get('download') === 'true') {
                
                // 3. Tampilkan pesan di console (opsional)
                console.log('Perintah download terdeteksi. Memulai download otomatis...');
                
                // 4. Cari tombol download yang sudah ada di halaman ini
                // Pastikan ID-nya 'btn-download-pdf'
                const downloadButton = document.getElementById('btn-download-pdf');
                
                if (downloadButton) {
                    // 5. "Klik" tombol itu secara otomatis
                    downloadButton.click();
                } else {
                    console.error('Tombol download (#btn-download-pdf) tidak ditemukan untuk auto-download.');
                }
            }
        });
    </script>
    </body>
</html>