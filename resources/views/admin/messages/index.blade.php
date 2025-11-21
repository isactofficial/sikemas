<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesan - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root{ --skm-teal:#1F6D72; --skm-blue:#074159; --skm-blue-2:#053244; --skm-accent:#ff5722; --skm-bg:#F4F7F6; }
        * , *::before, *::after{ box-sizing:border-box; }
        body{ font-family:'Besley',system-ui,sans-serif; background:var(--skm-bg); min-height:100vh; margin:0; padding:0; }

        .skm-admin-main{ margin-left:240px; padding:24px; transition: all 0.3s ease; }

        /* Container Styles */
        .skm-content-wrapper{ background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,.04); overflow:hidden; }
        .skm-header{ padding:24px; }
        .skm-header h1{ color:var(--skm-blue); font-weight:800; font-size:28px; margin:0 0 8px; }
        .skm-header p{ color:#23C8B8; font-size:14px; margin:0; }

        .skm-controls-card{ padding:24px; border-bottom: 1px solid #eee; }
        .skm-table-header-bar { display:flex; justify-content: space-between; align-items: center; }
        .skm-table-title { font-size: 20px; font-weight: 800; color: var(--skm-blue); margin: 0; }

        /* Table Styles */
        .skm-table-wrap{ overflow:hidden; }
        .skm-table{ width:100%; border-collapse:collapse; table-layout: fixed; }
        .skm-table thead{ background:#F9FAFB; color:#23C8B8; }
        .skm-table th{ padding:14px 16px; text-align:left; font-weight:700; font-size:12px; text-transform:uppercase; letter-spacing:.5px; }
        .skm-table td{ padding:14px 16px; border-bottom:1px solid #E5E7EB; font-size:13px; vertical-align: top; word-wrap: break-word; }
        .skm-table tbody tr:last-child td{ border-bottom:none; }
        .skm-table tbody tr:hover{ background:#F9FAFB; }

        /* --- STATUS PESAN --- */
        .skm-row-unread { background-color: #fffaf0; }
        .skm-row-unread td { font-weight: 600; color: #000; }
        .skm-row-unread .skm-sender-name { color: var(--skm-accent); }

        .skm-status-badge { font-size: 10px; padding: 2px 8px; border-radius: 10px; font-weight: 700; display: inline-block; margin-bottom: 4px; }
        .skm-status-badge.unread { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; }

        .skm-sender-name { font-weight: 800; color: var(--skm-blue); display: block; }
        .skm-sender-email { color: #7aa4b9; font-size: 12px; word-break: break-all; font-weight: 400; }
        .skm-subject { font-weight: 700; color: #333; margin-bottom: 4px; display: block; }

        .skm-message-preview { color: #666; line-height: 1.5; font-size: 12px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: max-height 0.3s ease; font-weight: 400; }
        .skm-message-preview.expanded { -webkit-line-clamp: unset; display: block; overflow: visible; }

        .skm-read-more-btn { background: none; border: none; color: var(--skm-teal); font-size: 11px; font-weight: 700; cursor: pointer; padding: 0; margin-top: 6px; text-decoration: underline; font-family: inherit; }
        .skm-read-more-btn:hover { color: var(--skm-accent); }

        /* Action Buttons */
        .skm-action-btns{ display:flex; gap:8px; }
        .skm-icon-btn{ width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px; border:none; cursor:pointer; transition:all .15s ease; background:transparent; color: #666; }
        .skm-icon-btn:hover{ background:#F0F5FF; color: var(--skm-blue); }
        .skm-icon-btn.delete:hover { background: #FFF0F0; color: #d32f2f; }
        .skm-icon-btn.toggle:hover { background: #e0f2f1; color: var(--skm-teal); }

        /* Footer & Pagination */
        .skm-foot{ margin-top:18px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; padding:12px 16px; }
        .skm-foot .info{ color:#23C8B8; font-size:13px; font-weight:700; }
        .skm-pager{ list-style:none; display:flex; align-items:center; gap:8px; margin:0; padding:0; }

        /* Alert Styles */
        .skm-alert { padding: 14px 18px; border-radius: 8px; font-size: 14px; font-weight: 600; margin-bottom: 20px; border: 1px solid; display: flex; align-items: center; gap: 12px; }
        .skm-alert.success { background: #D4EDDA; color: #155724; border-color: #C3E6CB; }

        /* RESPONSIVE & MOBILE */
        .skm-mobile-toggle-btn { display: none; position: fixed; top: 15px; left: 15px; z-index: 1100; background: var(--skm-blue); color: #fff; border: none; width: 40px; height: 40px; border-radius: 8px; align-items: center; justify-content: center; font-size: 18px; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
        .skm-sidebar-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 998; opacity: 0; transition: opacity 0.3s ease; }
        .skm-sidebar-overlay.active { display: block; opacity: 1; }

        @media(max-width:1024px){ .skm-admin-main{ margin-left:0; padding:20px; } .skm-header, .skm-controls-card{ padding:20px; } }
        @media(max-width:767px){
            .skm-mobile-toggle-btn { display: flex; }
            .skm-admin-main{ margin-left: 0; margin-top: 60px; padding: 12px; }
            #skmSidebarWrapper { position: fixed; top: 0; left: -280px; height: 100vh; width: 260px; z-index: 1200; background: #fff; transition: left 0.3s ease; box-shadow: 4px 0 15px rgba(0,0,0,0.1); overflow-y: auto; }
            #skmSidebarWrapper.is-open { left: 0; }
            .skm-table thead { display: none; }
            .skm-table, .skm-table tbody, .skm-table tr { display: block; width: 100%; }
            .skm-table tr { margin-bottom: 16px; border: 1px solid #E5E7EB; border-radius: 12px; overflow: hidden; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05); position: relative; }
            .skm-table tr.skm-row-unread { background: #fffaf0; border: 1px solid #ffe0b2; }
            .skm-table td { display: block; width: 100% !important; border-bottom: none; padding: 0; }
            .skm-table td:nth-child(2) { padding: 16px 16px 8px 16px; border-bottom: 1px dashed #f0f0f0; }
            .skm-table td:nth-child(5) { position: absolute; top: 16px; right: 16px; width: auto !important; padding: 0; font-size: 11px; color: #999; background: transparent; }
            .skm-table td:nth-child(3), .skm-table td:nth-child(4) { padding: 8px 16px; }
            .skm-table td:first-child { display: none; }
            .skm-table td:last-child { padding: 12px 16px; background: rgba(0,0,0,0.02); border-top: 1px solid #E5E7EB; margin-top: 8px; }
            .skm-action-btns { display: flex; justify-content: flex-end; gap: 16px; width: 100%; }
            .skm-icon-btn { width: 36px; height: 36px; background: #fff; border: 1px solid #eee; border-radius: 8px; }
        }
    </style>
</head>
<body>

    <div class="skm-sidebar-overlay" id="skmOverlay"></div>
    <button class="skm-mobile-toggle-btn" id="skmMobileToggle"><i class="fas fa-bars"></i></button>

    <div id="skmSidebarWrapper">
        @include('layouts.sidebar_admin')
    </div>

    <main class="skm-admin-main">
        @if(session('success'))
            <div class="skm-alert success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="skm-content-wrapper">
            <div class="skm-header">
                <h1>Manajemen Pesan Masuk</h1>
                <p>Daftar kritik, saran, dan pertanyaan masuk.</p>
            </div>

            <div class="skm-controls-card">
                <div class="skm-table-header-bar">
                    <h2 class="skm-table-title">Daftar Pesan</h2>
                </div>
            </div>

            <div class="skm-table-wrap">
                <table class="skm-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 25%">Pengirim</th> <th style="width: 25%">Subjek</th>   <th style="width: 30%">Pesan</th>    <th style="width: 15%">Tanggal</th>
                            <th style="width: 120px; text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $index => $msg)
                            {{-- Jika belum dibaca (is_read == 0), tambahkan class unread --}}
                            <tr class="{{ isset($msg->is_read) && !$msg->is_read ? 'skm-row-unread' : '' }}">
                                <td>{{ $messages->firstItem() + $index }}</td>
                                <td>
                                    {{-- Badge Status jika belum dibaca --}}
                                    @if(isset($msg->is_read) && !$msg->is_read)
                                        <span class="skm-status-badge unread">Belum Dibaca</span>
                                    @endif

                                    <span class="skm-sender-name">{{ $msg->nama }}</span>
                                    <span class="skm-sender-email">{{ $msg->email }}</span>
                                    @if($msg->user_id)
                                        <div style="margin-top:4px;"><span style="background:#e0f2f1; color:#00695c; padding:2px 6px; border-radius:4px; font-size:10px; font-weight:700;">User Login</span></div>
                                    @endif
                                </td>
                                <td><span class="skm-subject">{{ $msg->subjek }}</span></td>
                                <td>
                                    <div class="skm-message-preview" id="msg-preview-{{ $msg->id }}">
                                        {{ $msg->pesan }}
                                    </div>
                                    @if(strlen($msg->pesan) > 100)
                                        <button type="button" class="skm-read-more-btn" onclick="toggleMessage({{ $msg->id }}, this)">Baca Selengkapnya</button>
                                    @endif
                                </td>
                                <td>
                                    {{ $msg->created_at->format('d M Y') }}
                                    <div style="font-size:11px; color:#aaa; font-weight:400;">{{ $msg->created_at->format('H:i') }}</div>
                                </td>
                                <td>
                                    <div class="skm-action-btns" style="justify-content: flex-end;">

                                        {{-- ACTION TOGGLE READ/UNREAD --}}
                                        <form action="{{ route('admin.messages.toggleRead', $msg->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="skm-icon-btn toggle"
                                                title="{{ (isset($msg->is_read) && $msg->is_read) ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}">

                                                @if(isset($msg->is_read) && $msg->is_read)
                                                    <i class="far fa-envelope-open"></i>
                                                @else
                                                    <i class="fas fa-envelope"></i>
                                                @endif

                                            </button>
                                        </form>

                                        <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan dari {{ $msg->nama }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="skm-icon-btn delete" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 40px; color: #999;">
                                    <i class="far fa-envelope-open" style="font-size: 24px; margin-bottom: 10px; opacity: 0.5;"></i><br>
                                    Belum ada pesan masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="skm-foot">
                    @if($messages->hasPages())
                        <div class="info">Menampilkan {{ $messages->firstItem() }} - {{ $messages->lastItem() }} dari {{ $messages->total() }} pesan</div>
                        <div class="skm-pager">{{ $messages->links('pagination::bootstrap-4') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('skmMobileToggle');
            const overlay = document.getElementById('skmOverlay');
            const sidebarWrapper = document.getElementById('skmSidebarWrapper');

            function toggleSidebar() {
                sidebarWrapper.classList.toggle('is-open');
                overlay.classList.toggle('active');
            }

            if(toggleBtn) {
                toggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            if(overlay) {
                overlay.addEventListener('click', function() {
                    sidebarWrapper.classList.remove('is-open');
                    overlay.classList.remove('active');
                });
            }
        });

        function toggleMessage(id, btn) {
            const preview = document.getElementById('msg-preview-' + id);
            preview.classList.toggle('expanded');
            if (preview.classList.contains('expanded')) {
                btn.innerText = 'Tutup';
            } else {
                btn.innerText = 'Baca Selengkapnya';
            }
        }
    </script>
</body>
</html>
