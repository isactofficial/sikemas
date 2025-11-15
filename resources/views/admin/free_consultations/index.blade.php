<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Konsultasi Gratis - Admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;700;800&display.swap" rel="stylesheet">

    <style>
        :root {
            --skm-teal: #1F6D72;
            --skm-blue: #074159;
            --skm-blue-2: #053244;
            --skm-accent: #ff5722;
            --skm-bg: #F4F7F6;
        }

        main { box-sizing: border-box; margin: 0; padding: 0; }
        main { font-family: 'Besley', system-ui, sans-serif; background: var(--skm-bg); min-height: 100vh; }

        .skm-admin-main { margin-left: 240px; padding: 24px; }

        /* Mengganti skm-admin-card dengan skm-content-wrapper */
        .skm-content-wrapper {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
            overflow: hidden;
        }

        /* Style header baru di dalam card (dari transactions.blade.php) */
        .skm-header {
            padding: 24px;
        }
        .skm-header h1 { color: var(--skm-blue); font-size: 28px; font-weight: 800; margin-bottom: 8px; }
        .skm-header p { color: #23C8B8; font-size: 14px; margin:0; } /* Menambahkan margin:0 */

        /* Mengganti skm-table-responsive dengan skm-table-wrap */
        .skm-table-wrap {
            width: 100%;
            overflow-x: auto;
        }
        .skm-table {
            width: 100%;
            border-collapse: collapse;
            color: #333;
        }
        .skm-table th, .skm-table td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #eef0f2;
            vertical-align: middle;
        }
        .skm-table th {
            font-size: 0.9rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--skm-teal);
            background: #fdfdfd;
            white-space: nowrap; /* Tambahan dari transactions */
        }
        .skm-table tbody tr:last-child td { border-bottom: none; } /* Modifikasi dari transactions */
        .skm-table tbody tr:hover { background-color: #f9fafb; }

        .skm-user-info { display: flex; flex-direction: column; }
        .skm-user-info span:first-child { font-weight: 700; color: var(--skm-blue-2); }
        .skm-user-info span:last-child { font-size: 0.9rem; color: #666; }

        .skm-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.95rem;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-edit { background-color: #f39c12; } /* Kuning */
        .btn-edit:hover { background-color: #d68910; }

        .btn-delete { background-color: #e74c3c; } /* Merah */
        .btn-delete:hover { background-color: #c0392b; }

        /* Status & Konfirmasi Badges (Spesifik untuk file ini) */
        .skm-badge {
            padding: 5px 12px;
            border-radius: 16px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: capitalize;
            color: #fff;
        }
        .badge-pending { background-color: #e67e22; } /* Orange */
        .badge-scheduled { background-color: #3498db; } /* Biru */
        .badge-completed { background-color: #2ecc71; } /* Hijau */
        .badge-cancelled { background-color: #e74c3c; } /* Merah */
        .badge-waiting { background-color: #95a5a6; } /* Abu-abu */
        .badge-on-going { background-color: #3498db; } /* Biru */
        .badge-confirmed { background-color: #2ecc71; } /* Hijau */

        /* Style Pagination baru (dari transactions.blade.php) */
        .skm-pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            padding: 20px 24px; /* Disesuaikan dengan padding header */
            background: #fdfdfd;
            border-top: 1px solid #eef0f2;
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
            transition: all 0.2s ease;
            line-height: 1;
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            color: var(--skm-blue-2, #6B7280);
        }
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

        /* Alert Sukses & Error */
        .skm-alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            color: #fff;
        }
        .skm-alert-success { background-color: #2ecc71; } /* Hijau */
        .skm-alert-error { background-color: #e74c3c; } /* Merah */

        /* Media Queries dari transactions.blade.php */
        @media (max-width: 767px) {
            .skm-admin-main {
                margin-left: 0;
                /* margin-top: 72px; */ /* Dihilangkan karena sidebar tidak di-include di sini */
                padding: 12px;
            }
            .skm-content-wrapper { border-radius: 8px; }
            .skm-header { padding: 16px; }
            .skm-header h1 { font-size: 22px; }
            .skm-header p { font-size: 13px; }

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

            /* Penyesuaian untuk tombol aksi di file ini */
            .skm-table td:last-child div {
                justify-content: center;
                gap: 20px;
            }
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
            .skm-table td:last-child div { gap: 16px; }
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
            <div class="skm-alert skm-alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="skm-alert skm-alert-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="skm-content-wrapper">
            <div class="skm-header">
                <h1>Manajemen Konsultasi Gratis</h1>
                <p>Ringkasan semua permintaan konsultasi gratis dari user.</p>
            </div>

            <div class="skm-table-wrap">
                <table class="skm-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Tgl. Permintaan</th>
                            <th>Status</th>
                            <th>Konfirmasi</th>
                            <th>Tgl. Konsultasi</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($consultations as $consultation)
                            <tr>
                                <td data-label="User">
                                    <div class="skm-user-info">
                                        <span>{{ $consultation->user->name ?? 'N/A' }}</span>
                                        <span>{{ $consultation->user->email ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td data-label="Tgl. Permintaan">{{ $consultation->created_at->format('d M Y, H:i') }}</td>
                                <td data-label="Status">
                                    <span class="skm-badge badge-{{ $consultation->status }}">
                                        {{ $consultation->status }}
                                    </span>
                                </td>
                                <td data-label="Konfirmasi">
                                    <span class="skm-badge badge-{{ $consultation->konfirmasi }}">
                                        {{ str_replace('-', ' ', $consultation->konfirmasi) }}
                                    </span>
                                </td>
                                <td data-label="Tgl. Konsultasi">
                                    {{ $consultation->consultation_date ? $consultation->consultation_date->format('d M Y, H:i') : '-' }}
                                </td>
                                <td data-label="Catatan">
                                    {{ Str::limit($consultation->notes, 50, '...') ?? '-' }}
                                </td>
                                <td> <div style="display: flex; gap: 8px;">
                                        <a href="{{ route('admin.free-consultations.edit', $consultation->id) }}" class="skm-icon-btn btn-edit" title="Edit Konsultasi">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <form action="{{ route('admin.free-consultations.destroy', $consultation->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data konsultasi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="skm-icon-btn btn-delete" title="Hapus Konsultasi">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 40px; color: #6B8791;">
                                    Belum ada data konsultasi gratis.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($consultations->hasPages())
            <div class="skm-pagination">
                <span class="skm-page-summary">
                    Showing data {{ $consultations->firstItem() }} to {{ $consultations->lastItem() }} of {{ $consultations->total() }} entries
                </span>
                {{ $consultations->links('pagination::bootstrap-4') }}
            </div>
            @endif

        </div>
    </main>
</body>
</html>