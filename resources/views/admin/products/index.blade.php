<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manage Products - Sikemas Admin</title>

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
		body { font-family: 'Besley', system-ui, sans-serif; background: var(--skm-bg); min-height: 100vh; }

		/* keep spacing consistent with sidebar */
		.skm-admin-main { margin-left: 240px; padding: 24px; }

		/* card wrapper */
		.skm-content-wrapper { background: #fff; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,.04); overflow: hidden; }

		/* header */
		.skm-header { padding: 24px; }
		.skm-header h1 { color: var(--skm-blue); font-size: 28px; font-weight: 800; margin-bottom: 8px; }
		.skm-header p { color: #23C8B8; font-size: 14px; }

		/* controls */
		.skm-controls-card { padding: 24px; }
		.skm-actions { display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap; margin-bottom: 20px; }
		.skm-btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 13px; text-decoration: none; cursor: pointer; border: none; transition: all .15s ease; }
		.skm-btn-primary { background: var(--skm-accent); color: #fff; box-shadow: 0 4px 12px rgba(255,87,34,.3); }
		.skm-btn-primary:hover { background: #e64a19; transform: translateY(-1px); }

		.skm-table-header-bar { display: flex; justify-content: space-between; align-items: center; }
		.skm-table-title { font-size: 20px; font-weight: 800; color: var(--skm-blue); }
		.skm-filters { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
		.skm-filters select { padding: 8px 12px; border: 1.5px solid #E5E7EB; border-radius: 8px; font-size: 13px; font-family: inherit; }

		/* table */
		.skm-table-wrap { overflow: hidden; }
		.skm-table { width: 100%; border-collapse: collapse; }
		.skm-table thead { background: #F9FAFB; color: #23C8B8; }
		.skm-table th { padding: 14px 16px; text-align: left; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: .5px; }
		.skm-table td { padding: 14px 16px; border-bottom: 1px solid #E5E7EB; font-size: 13px; }
		.skm-table tbody tr:last-child td { border-bottom: none; }
		.skm-table tbody tr:hover { background: #F9FAFB; }

		.skm-thumb { width: 80px; height: 60px; border-radius: 6px; overflow: hidden; }
		.skm-thumb img { width: 100%; height: 100%; object-fit: cover; }

		.skm-action-btns { display: flex; gap: 8px; }
		.skm-icon-btn { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; border: none; cursor: pointer; transition: all .15s ease; background: transparent; }
		.skm-icon-btn:hover { background: #F0F5FF; }
		.skm-icon-btn img { width: 32px; height: 32px; }

		.skm-pagination { display: flex; justify-content: space-between; align-items: center; gap: 8px; padding: 20px 16px; }
		.skm-pagination .skm-page-summary { font-size: 13px; color: #6B8791; }
		/* Compact square pager like the screenshot */
		.skm-pager{ list-style:none; display:flex; align-items:center; gap:8px; margin:0; padding:0; }
		.skm-pager li a, .skm-pager li span{ display:inline-flex; width:28px; height:28px; align-items:center; justify-content:center; border:1px solid #E1E7EA; border-radius:6px; background:#fff; color:#6B8791; text-decoration:none; font-weight:700; font-size:12px; }
		.skm-pager li.active span{ background:#23C8B8; color:#fff; border-color:#23C8B8; }
		.skm-pager li.disabled span{ background:#F3F6F8; color:#A7B4BA; border-color:#EAEFF2; }
		.skm-pager li a:hover{ background:#F6FBFA; border-color:#BFE9E3; color:#1F6D72; }

		/* Footer info/pager (matches testimonies) */
		.skm-foot{ padding:12px 16px; display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap; }
		.skm-foot .info{ font-size:13px; line-height:1.4; color:#23C8B8; font-weight:700; }

		.skm-alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
		.skm-alert.success { background: #D4EDDA; color: #155724; border: 1px solid #C3E6CB; }

		@media (max-width: 767px) {
			.skm-admin-main { 
				margin-left: 0; 
				margin-top: 72px; 
				padding: 12px; 
			}

			.skm-content-wrapper {
				border-radius: 8px;
			}

			.skm-header {
				padding: 16px;
			}

			.skm-header h1 {
				font-size: 22px;
			}

			.skm-header p {
				font-size: 13px;
			}

			.skm-controls-card {
				padding: 16px;
			}

			.skm-actions { 
				flex-direction: column; 
				align-items: stretch;
				margin-bottom: 16px;
			}

			.skm-btn {
				width: 100%;
				justify-content: center;
				padding: 12px 16px;
			}

			.skm-table-header-bar { 
				flex-direction: column;
				align-items: stretch;
				gap: 12px;
			}

			.skm-table-title {
				font-size: 18px;
			}

			.skm-filters {
				flex-direction: column;
				align-items: stretch;
				width: 100%;
			}

			.skm-filters select {
				width: 100%;
			}

			/* Hide default table display on mobile */
			.skm-table-wrap {
				overflow: visible;
			}

			.skm-table thead {
				display: none;
			}

			.skm-table,
			.skm-table tbody,
			.skm-table tr {
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
				border-bottom: none;
				padding: 0;
			}

			/* Image - Full width at top */
			.skm-table td:first-child {
				padding: 0;
			}

			.skm-thumb {
				width: 100%;
				height: 180px;
				border-radius: 0;
			}

			.skm-thumb img {
				width: 100%;
				height: 100%;
				object-fit: cover;
			}

			/* Product Name */
			.skm-table td:nth-child(2) {
				padding: 16px;
			}

			.skm-table td:nth-child(2) strong {
				font-size: 16px;
				line-height: 1.4;
				display: block;
				color: var(--skm-blue);
			}

			/* Date */
			.skm-table td:nth-child(3) {
				padding: 0 16px 16px 16px;
				font-size: 13px;
				color: #666;
			}

			/* Action buttons - Full width at bottom */
			.skm-table td:nth-child(4) {
				padding: 16px;
				background: #F9FAFB;
				border-top: 1px solid #E5E7EB;
			}

			.skm-action-btns {
				display: flex;
				justify-content: center;
				gap: 20px;
				width: 100%;
			}

			.skm-icon-btn {
				width: 44px;
				height: 44px;
				border-radius: 8px;
				background: transparent;
				border: none;
				display: flex;
				align-items: center;
				justify-content: center;
			}

			.skm-icon-btn img {
				width: 32px;
				height: 32px;
			}

			.skm-icon-btn:hover {
				background: #E5E7EB;
			}

			/* Pagination responsive */
			.skm-foot {
				flex-direction: column;
				gap: 12px;
				padding: 16px;
			}

			.skm-foot .info {
				font-size: 12px;
				text-align: center;
			}

			.skm-pager {
				width: 100%;
				justify-content: center;
				flex-wrap: wrap;
			}

			.skm-pager li a,
			.skm-pager li span {
				width: 28px;
				height: 28px;
				font-size: 11px;
			}

			.skm-alert {
				font-size: 13px;
				padding: 10px 12px;
				right: 8px !important;
				bottom: 8px !important;
			}
		}

		@media (max-width: 480px) {
			.skm-admin-main {
				padding: 8px;
			}

			.skm-header {
				padding: 12px;
			}

			.skm-header h1 {
				font-size: 20px;
			}

			.skm-controls-card {
				padding: 12px;
			}

			.skm-thumb {
				height: 160px;
			}

			.skm-table td:nth-child(2) strong {
				font-size: 15px;
			}

			.skm-table td:nth-child(3) {
				font-size: 12px;
			}

			.skm-action-btns {
				gap: 16px;
			}

			.skm-icon-btn {
				width: 40px;
				height: 40px;
			}

			.skm-icon-btn img {
				width: 28px;
				height: 28px;
			}

			.skm-foot {
				padding: 12px;
			}
		}

		/* Tablet adjustments */
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
			<h1>Manage Your Product</h1>
			<p>Manage your products here</p>
		</div>

		<div class="skm-controls-card">
			<!-- Add button should appear ABOVE the "All Products" title -->
			<div class="skm-actions">
				<a href="{{ route('admin.products.create') }}" class="skm-btn skm-btn-primary">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
					</svg>
					Add New Product
				</a>
			</div>

			<div class="skm-table-header-bar">
				<h2 class="skm-table-title">All Products</h2>
				<form method="GET" class="skm-filters">
					<span style="font-size: 13px; color: #23C8B8; margin-right: 4px;">Sort by:</span>
					<select name="sort_by" onchange="this.form.submit()">
						<option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Newest</option>
						<option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Oldest</option>
					</select>
				</form>
			</div>
		</div>

		<div class="skm-table-wrap">
			<table class="skm-table">
				<thead>
					<tr>
						<th>Image</th>
						<th>Product Name</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if(isset($products) && $products->count())
						@foreach($products as $product)
							<tr>
								<td>
									<div class="skm-thumb">
										@if(!empty($product->image))
											<img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
										@else
											<img src="{{ asset('assets/img/Article-image.png') }}" alt="Default">
										@endif
									</div>
								</td>
								<td style="max-width: 300px;"><strong>{{ Str::limit($product->name ?? '—', 50) }}</strong></td>
								<td>{{ optional($product->created_at)->format('d - m - Y') }}</td>
								<td>
									<div class="skm-action-btns">
										<a href="{{ route('admin.products.show', $product) }}" class="skm-icon-btn" title="View"><img src="{{ asset('assets/img/view.svg') }}" alt="View"></a>
										<a href="{{ route('admin.products.edit',$product) }}" class="skm-icon-btn" title="Edit"><img src="{{ asset('assets/img/edit.svg') }}" alt="Edit"></a>
										<form action="{{ route('admin.products.destroy',$product) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this product?')">
											@csrf
											@method('DELETE')
											<button type="submit" class="skm-icon-btn" title="Delete"><img src="{{ asset('assets/img/delete.svg') }}" alt="Delete"></button>
										</form>
									</div>
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4" style="text-align:center; padding: 40px; color: #6B8791;">
								No products found. <a href="{{ route('admin.products.create') }}">Add your first product</a>
							</td>
						</tr>
					@endif
				</tbody>
			</table>

			<div class="skm-foot">
				@if(isset($products))
					<div class="info">Showing data {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries</div>
					<div class="skm-pager" aria-label="Pagination">{!! $products->links('pagination::sikemas') !!}</div>
				@endif
			</div>
		</div>
	</div>
</main>

<!-- Success flash if any -->
@if(session('success'))
<div class="skm-alert success" role="status" style="position: fixed; right: 16px; bottom: 16px;">
	{{ session('success') }}
</div>
@endif

</body>
</html>