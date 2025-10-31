<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manage Articles - Sikemas Admin</title>
	
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
		* { box-sizing: border-box; margin: 0; padding: 0; }
		/* */
		body { font-family: 'Besley', system-ui, sans-serif; background: var(--skm-bg); min-height: 100vh; }
		
		.skm-admin-main { margin-left: 240px; padding: 24px; }
		
		/* Wrapper Konten Utama */
		.skm-content-wrapper {
			background: #fff;
			border-radius: 12px;
			box-shadow: 0 2px 10px rgba(0,0,0,.04);
			overflow: hidden; 
		}
		
		/* Header */
		.skm-header { 
			padding: 24px; 
		}
		.skm-header h1 { color: var(--skm-blue); font-size: 28px; font-weight: 800; margin-bottom: 8px; }
		.skm-header p { color: #23C8B8; font-size: 14px; }
		
		/* Actions Bar (Only for Add New button) */
		.skm-actions { display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap; }
		.skm-btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 13px; text-decoration: none; cursor: pointer; border: none; transition: all .15s ease; }
		.skm-btn-primary { background: var(--skm-accent); color: #fff; box-shadow: 0 4px 12px rgba(255,87,34,.3); }
		.skm-btn-primary:hover { background: #e64a19; transform: translateY(-1px); }
		
		/* Filters */
		.skm-filters { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
		/* */
		.skm-filters select, .skm-filters input { padding: 8px 12px; border: 1.5px solid #E5E7EB; border-radius: 8px; font-size: 13px; font-family: inherit; }
		.skm-filters input { min-width: 200px; }

		/* Container for table title and filters */
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
		
		/* Container untuk tombol & filter */
		.skm-controls-card {
			padding: 24px;
		}
		
		.skm-controls-card .skm-actions {
			margin-bottom: 20px; 
		}
		
		.skm-controls-card .skm-table-header-bar {
			margin-bottom: 0; 
		}
		
		/* Table */
		.skm-table-wrap { overflow: hidden; }
		.skm-table { width: 100%; border-collapse: collapse; }
		/* Kita beri background di thead agar tetap terlihat 'header' tabel */
		.skm-table thead { background: #F9FAFB; color: #23C8B8; }
		.skm-table th { padding: 14px 16px; text-align: left; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: .5px; }
		.skm-table td { padding: 14px 16px; border-bottom: 1px solid #E5E7EB; font-size: 13px; }
		/* Hapus border terakhir di baris tabel agar menyatu dgn pagination */
		.skm-table tbody tr:last-child td { border-bottom: none; }
		.skm-table tbody tr:hover { background: #F9FAFB; }
		
		/* Thumbnail */
		.skm-thumb { width: 80px; height: 60px; border-radius: 6px; overflow: hidden; }
		.skm-thumb img { width: 100%; height: 100%; object-fit: cover; }
		
		/* Badge */
		.skm-badge { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 800; text-transform: uppercase; }
		.skm-badge.is-published { background: #20C8B5; color: #fff; }
		.skm-badge.is-draft { background: #FFA726; color: #fff; }
		
		/* Action buttons */
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
			background: transparent; /* Transparan */
		}
		
		/* Efek hover diganti menjadi background abu-abu muda */
		.skm-icon-btn:hover { 
			background: #F9FAFB; /* Warna sama seperti hover tabel */
		}
		
		/* === CSS UKURAN IKON DIPERBAIKI DI SINI === */
		/* Ukuran ikon disamakan dengan ukuran tombol */
		.skm-icon-btn img {
			width: 32px;
			height: 32px;
			/* (Opsional) tambahkan padding jika ikonnya terlihat terlalu penuh */
			/* padding: 4px; */ 
		}
		/* === AKHIR PERBAIKAN === */
		
		/* Pagination */
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
		}
		.skm-pagination nav { 
			display: flex; 
			gap: 4px; 
			align-items: center; 
		}
		.skm-pagination nav a, 
		.skm-pagination nav span { 
			padding: 6px 10px; 
			border-radius: 6px; 
			text-decoration: none; 
			color: #23C8B8; 
			font-weight: 600; 
			font-size: 13px; 
			min-width: 32px;
			height: 32px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			transition: all 0.2s ease;
		}
		.skm-pagination nav a:hover { 
			background: #F9FAFB; 
		}
		.skm-pagination nav .active { 
			background: #23C8B8; 
			color: #fff; 
		}
		.skm-pagination nav .disabled { 
			opacity: 0.5; 
			cursor: not-allowed; 
			pointer-events: none; 
			color: #23C8B8;
		}
		/* Styling untuk Previous dan Next */
		.skm-pagination nav a[rel="prev"],
		.skm-pagination nav a[rel="next"] {
			font-size: 12px;
			padding: 6px 12px;
			color: #23C8B8;
		}
		
		/* Alert */
		.skm-alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
		.skm-alert.success { background: #D4EDDA; color: #155724; border: 1px solid #C3E6CB; }
		
		@media (max-width: 767px) {
			.skm-admin-main { margin-left: 0; margin-top: 72px; padding: 16px; }
			.skm-actions { flex-direction: column; align-items: stretch; }
			.skm-table-header-bar { flex-wrap: wrap; gap: 16px; }
			/* Beri overflow-x pada wrapper tabel, BUKAN wrapper konten */
			.skm-table-wrap { overflow-x: auto; } 
		}
	</style>
</head>
<body>
@include('layouts.sidebar_admin')
	
	<main class="skm-admin-main">
		@if(session('success'))
		<div class="skm-alert success">{{ session('success') }}</div>
		@endif
		
		<div class="skm-content-wrapper">
		
			<div class="skm-header">
				<h1>Manage Your Article</h1>
				<p>Manage your published and draft articles</p>
			</div>
			
			<div class="skm-controls-card">
				<div class="skm-actions">
					<a href="{{ route('admin.articles.create') }}" class="skm-btn skm-btn-primary">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
						</svg>
						Add New Article
					</a>
				</div>
				
				<div class="skm-table-header-bar">
					<h2 class="skm-table-title">All Article</h2>
					
					<form method="GET" class="skm-filters">
						
						<span style="font-size: 13px; color: #23C8B8; margin-right: 4px;">Short by:</span>
						<select name="sort_by" onchange="this.form.submit()">
							<option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Newest</option>
							<option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Oldest</option>
							<option value="popular" {{ request('sort_by') == 'popular' ? 'selected' : '' }}>Most Popular</option>
						</select>
					</form>
				</div>
			</div>

			<div class="skm-table-wrap">
				<table class="skm-table">
					<thead>
						<tr>
							<th>Thumbnail</th>
							<th>Title</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@forelse($articles as $article)
						<tr>
							<td>
								<div class="skm-thumb">
									@if($article->thumbnail)
									<img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}">
									@else
									<img src="{{ asset('assets/img/Article-image.png') }}" alt="Default">
									@endif
								</div>
							</td>
							<td style="max-width: 300px;">
								<strong>{{ Str::limit($article->title, 50) }}</strong>
							</td>
							<td>{{ $article->created_at->format('d - m - Y') }}</td>
							
							<td>
								<div class="skm-action-btns">
									
									<a href="{{ route('artikel', $article->id) }}" target="_blank" class="skm-icon-btn view" title="View">
										<img src="{{ asset('assets/img/view.svg') }}" alt="View">
									</a>
									
									<a href="{{ route('admin.articles.edit', $article->id) }}" class="skm-icon-btn edit" title="Edit">
										<img src="{{ asset('assets/img/edit.svg') }}" alt="Edit">
									</a>
									
									<form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this article?')">
										@csrf
										@method('DELETE')
										<button type="submit" class="skm-icon-btn delete" title="Delete">
											<img src="{{ asset('assets/img/delete.svg') }}" alt="Delete">
										</button>
									</form>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="4" style="text-align:center; padding: 40px; color: #6B8791;">
								No articles found. <a href="{{ route('admin.articles.create') }}">Create your first article</a>
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
				
				@if($articles->hasPages())
				<div class="skm-pagination">
					<span class="skm-page-summary">
						Showing data {{ $articles->firstItem() }} to {{ $articles->lastItem() }} of {{ $articles->total() }} entries
					</span>
					<nav>
						{{-- Previous Page Link --}}
						@if ($articles->onFirstPage())
							<span class="disabled">« Previous</span>
						@else
							<a href="{{ $articles->previousPageUrl() }}" rel="prev">« Previous</a>
						@endif

						{{-- Pagination Elements --}}
						@foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
							@if ($page == $articles->currentPage())
								<span class="active">{{ $page }}</span>
							@else
								<a href="{{ $url }}">{{ $page }}</a>
							@endif
						@endforeach

						{{-- Next Page Link --}}
						@if ($articles->hasMorePages())
							<a href="{{ $articles->nextPageUrl() }}" rel="next">Next »</a>
						@else
							<span class="disabled">Next »</span>
						@endif
					</nav>
				</div>
				@endif
			</div>

		</div> </main>
</body>
</html>