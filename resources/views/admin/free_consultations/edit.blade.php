<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Konsultasi #{{ $consultation->id }} - Admin</title>

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

        /* Header baru di dalam card (dari transactions.blade.php) */
        .skm-header {
            padding: 24px;
        }
        .skm-header h1 { color: var(--skm-blue); font-size: 28px; font-weight: 800; margin-bottom: 8px; }
        .skm-header p { color: #23C8B8; font-size: 14px; margin: 0; }

        /* Card wrapper utama (dari transactions.blade.php) */
        .skm-content-wrapper {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
            overflow: hidden;
        }

        /* Wrapper untuk konten form (dari transactions.blade.php) */
        .skm-controls-card {
            padding: 0 24px 24px 24px;
        }

        /* Style form asli (tetap dipertahankan) */
        .skm-form-group {
            margin-bottom: 20px;
        }
        .skm-form-group label {
            display: block;
            font-weight: 700;
            color: var(--skm-blue);
            margin-bottom: 8px;
        }
        .skm-form-control {
            width: 100%;
            padding: 12px 16px;
            font-family: 'Besley', serif;
            font-size: 1rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.2s ease;
            box-sizing: border-box; /* Penting untuk width 100% */
        }
        .skm-form-control:focus {
            border-color: var(--skm-teal);
            outline: none;
        }
        textarea.skm-form-control {
            min-height: 120px;
            resize: vertical;
        }

        .skm-btn {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .btn-primary {
            background-color: var(--skm-blue);
            color: #ffffff;
        }
        .btn-primary:hover {
            background-color: var(--skm-blue-2);
        }
        .btn-secondary {
            background-color: #f0f0f0;
            color: #333;
            border: 1px solid #ddd;
        }
        .btn-secondary:hover {
            background-color: #e9e9e9;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        /* Menampilkan info user (tetap dipertahankan) */
        .user-info-box {
            background: #f9f9f9;
            border: 1px solid #eee;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }
         .user-info-box p {
            margin: 0;
            color: #333;
         }
         .user-info-box p strong {
            color: var(--skm-blue);
         }

        /* Media Queries dari transactions.blade.php */
        @media (max-width: 767px) {
            .skm-admin-main {
                margin-left: 0;
                /* margin-top: 72px; */ /* Dihilangkan */
                padding: 12px;
            }
            .skm-content-wrapper { border-radius: 8px; }
            .skm-header { padding: 16px; }
            .skm-header h1 { font-size: 22px; }
            .skm-header p { font-size: 13px; }
            .skm-controls-card {
                padding: 16px;
                padding-top: 0; /* Penting untuk padding setelah header */
            }
        }

        @media (max-width: 480px) {
            .skm-admin-main { padding: 8px; }
            .skm-header { padding: 12px; }
            .skm-header h1 { font-size: 20px; }
            .skm-controls-card {
                padding: 12px;
                padding-top: 0; /* Penting untuk padding setelah header */
            }
        }

        @media (max-width: 1024px){
            .skm-admin-main{ margin-left:0; padding:20px; }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar_admin')
    <main class="skm-admin-main">

        <div class="skm-content-wrapper">
            <div class="skm-header">
                <h1>Edit Konsultasi: #{{ $consultation->id }}</h1>
                <p>Update status, tanggal, dan catatan untuk konsultasi.</p>
            </div>

            <div class="skm-controls-card">
                <div class="user-info-box">
                    <p><strong>User:</strong> {{ $consultation->user->name ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $consultation->user->email ?? 'N/A' }}</p>
                    <p><strong>Tgl. Permintaan:</strong> {{ $consultation->created_at->format('d M Y, H:i') }}</p>
                </div>

                <form action="{{ route('admin.free-consultations.update', $consultation->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="skm-form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="skm-form-control">
                            <option value="pending" {{ $consultation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="scheduled" {{ $consultation->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="completed" {{ $consultation->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $consultation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="skm-form-group">
                        <label for="konfirmasi">Konfirmasi</label>
                        <select name="konfirmasi" id="konfirmasi" class="skm-form-control">
                            <option value="waiting" {{ $consultation->konfirmasi == 'waiting' ? 'selected' : '' }}>Waiting</option>
                            <option value="on-going" {{ $consultation->konfirmasi == 'on-going' ? 'selected' : '' }}>On-Going</option>
                            <option value="confirmed" {{ $consultation->konfirmasi == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        </select>
                    </div>

                    <div class="skm-form-group">
                        <label for="consultation_date">Tanggal Konsultasi (Opsional)</label>
                        <input type="datetime-local" name="consultation_date" id="consultation_date" class="skm-form-control"
                            value="{{ $consultation->consultation_date ? $consultation->consultation_date->format('Y-m-d\TH:i') : '' }}">
                    </div>

                    <div class="skm-form-group">
                        <label for="notes">Catatan Admin (Opsional)</label>
                        <textarea name="notes" id="notes" class="skm-form-control" rows="5">{{ old('notes', $consultation->notes) }}</textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="skm-btn btn-primary">Update Konsultasi</button>
                        <a href="{{ route('admin.free-consultations.index') }}" class="skm-btn btn-secondary">Batal</a>
                    </div>

                </form>
            </div>
        </div>
    </main>
</body>
</html>
