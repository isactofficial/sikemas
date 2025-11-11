<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manage Products - Sikemas Admin</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

		/* SUCCESS ALERT */
		.skm-alert {
			padding: 14px 18px;
			border-radius: 8px;
			font-size: 14px;
			font-weight: 600;
			margin-bottom: 20px;
			border: 1px solid;
			display: flex;
			align-items: center;
			gap: 12px;
			animation: slideDown 0.3s ease;
		}

		.skm-alert.success {
			background: #D4EDDA;
			color: #155724;
			border-color: #C3E6CB;
		}

		.skm-alert i {
			font-size: 18px;
		}

		@keyframes slideDown {
			from {
				opacity: 0;
				transform: translateY(-20px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
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
			background: #FF611A;
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

		.delete-modal-preview {
			display: flex;
			align-items: center;
			gap: 16px;
			background: #f8f9fa;
			border-radius: 12px;
			padding: 16px;
			margin-bottom: 20px;
			border-left: 4px solid #FF611A;
		}

		.delete-modal-preview-img {
			width: 80px;
			height: 80px;
			border-radius: 8px;
			overflow: hidden;
			flex-shrink: 0;
		}

		.delete-modal-preview-img img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		.delete-modal-preview-info {
			flex: 1;
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
			}

			/* MODAL RESPONSIVE */
			.delete-modal {
				width: 95%;
				max-width: none;
				border-radius: 16px;
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

			.delete-modal-subtitle {
				font-size: 13px;
			}

			.delete-modal-body {
				padding: 16px;
			}

			.delete-modal-preview {
				padding: 12px;
				gap: 12px;
			}

			.delete-modal-preview-img {
				width: 60px;
				height: 60px;
			}

			.delete-info-value {
				font-size: 14px;
			}

			.delete-modal-warning {
				padding: 12px;
			}

			.delete-modal-warning i {
				font-size: 18px;
			}

			.delete-modal-warning-text {
				font-size: 12px;
			}

			.delete-modal-actions {
				flex-direction: column;
				gap: 10px;
			}

			.delete-modal-btn {
				width: 100%;
				padding: 12px 16px;
				font-size: 13px;
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

	@if(session('success'))
		<div class="skm-alert success">
			<i class="fas fa-check-circle"></i>
			<span>{{ session('success') }}</span>
		</div>
	@endif

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
					<span style="font-size: 13px; color: #23C8B8; margin-right: 4px; font-weight: 700;">Sort by:</span>
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
										<button type="button" class="skm-icon-btn" title="Delete"
											onclick="openDeleteModal(
												'{{ $product->id }}',
												'{{ $product->name }}',
												'{{ !empty($product->image) ? asset('storage/' . $product->image) : asset('assets/img/Article-image.png') }}'
											)">
											<img src="{{ asset('assets/img/delete.svg') }}" alt="Delete">
										</button>
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

<!-- DELETE MODAL -->
<div class="delete-modal-overlay" id="deleteModalOverlay" onclick="closeDeleteModal()"></div>
<div class="delete-modal" id="deleteModal">
	<div class="delete-modal-header">
		<div class="delete-modal-icon">
			<i class="fas fa-trash-alt"></i>
		</div>
		<h3 class="delete-modal-title">Hapus Produk?</h3>
		<p class="delete-modal-subtitle">Tindakan ini tidak dapat dibatalkan</p>
	</div>
	<div class="delete-modal-body">
		<div class="delete-modal-preview">
			<div class="delete-modal-preview-img">
				<img id="modalProductImage" src="" alt="Product">
			</div>
			<div class="delete-modal-preview-info">
				<div class="delete-info-label">Nama Produk</div>
				<div class="delete-info-value" id="modalProductName">-</div>
			</div>
		</div>
		<div class="delete-modal-warning">
			<i class="fas fa-exclamation-triangle"></i>
			<div class="delete-modal-warning-text">
				Data produk akan dihapus permanen dari database. Pastikan Anda yakin sebelum melanjutkan.
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

	function openDeleteModal(productId, productName, productImage) {
		currentDeleteId = productId;
		document.getElementById('modalProductName').textContent = productName;
		document.getElementById('modalProductImage').src = productImage;
		document.getElementById('deleteForm').action = `/admin/products/${productId}`;
		
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