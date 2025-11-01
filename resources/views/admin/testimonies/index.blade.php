<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manage Testimonies - Admin</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;700;800&display=swap" rel="stylesheet">
	<style>
		:root{ --skm-teal:#1F6D72; --skm-blue:#074159; --skm-blue-2:#053244; --skm-accent:#ff5722; --skm-bg:#F4F7F6; }
		* , *::before, *::after{ box-sizing:border-box; }
		body{ font-family:'Besley',system-ui,sans-serif; background:var(--skm-bg); min-height:100vh; }
		.skm-admin-main{ margin-left:240px; padding:24px; }

		/* container + sections (mirror Products) */
		.skm-content-wrapper{ background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,.04); overflow:hidden; }
		.skm-header{ padding:24px; }
		.skm-header h1{ color:var(--skm-blue); font-weight:800; font-size:28px; margin:0 0 8px; }
		.skm-header p{ color:#23C8B8; font-size:14px; margin:0; }
		.skm-controls-card{ padding:24px; }

		/* top actions (Add New) - mimic Products page */
		.skm-actions{ display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; margin:0 0 16px; }
		.skm-btn{ display:inline-flex; align-items:center; gap:8px; padding:10px 20px; border-radius:10px; font-weight:700; font-size:13px; text-decoration:none; border: none; cursor: pointer; transition: all .15s ease; }
		.skm-btn-primary{ background: var(--skm-accent); color: #fff; box-shadow: 0 4px 12px rgba(255,106,36,.30); }
		.skm-btn-primary:hover { filter:brightness(0.98); transform: translateY(-1px); }

		/* header bar and filters like Products */
		.skm-table-header-bar { display:flex; justify-content: space-between; align-items: center; }
		.skm-table-title { font-size: 20px; font-weight: 800; color: var(--skm-blue); }
		.skm-filters { display:flex; gap:12px; align-items:center; flex-wrap:wrap; }
		.skm-filters select { padding: 8px 12px; border: 1.5px solid #E5E7EB; border-radius: 8px; font-size: 13px; font-family: inherit; }

		/* table like Products */
		.skm-table-wrap{ overflow:hidden; }
		.skm-table{ width:100%; border-collapse:collapse; }
		.skm-table thead{ background:#F9FAFB; color:#23C8B8; }
		.skm-table th{ padding:14px 16px; text-align:left; font-weight:700; font-size:12px; text-transform:uppercase; letter-spacing:.5px; }
		.skm-table td{ padding:14px 16px; border-bottom:1px solid #E5E7EB; font-size:13px; }
		.skm-table tbody tr:last-child td{ border-bottom:none; }
		.skm-table tbody tr:hover{ background:#F9FAFB; }
		.skm-portrait{ width:44px; height:44px; border-radius:8px; overflow:hidden; flex:0 0 auto; }
		.skm-portrait img{ width:100%; height:100%; object-fit:cover; display:block; }
		.skm-name{ font-weight:800; color:#074159; }
		.skm-date{ color:#7aa4b9; font-weight:700; }
		/* clamp long names nicely */
		.skm-name-cell{ max-width:300px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

		/* action buttons like Products */
		.skm-action-btns{ display:flex; gap:8px; }
		.skm-icon-btn{ width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px; border:none; cursor:pointer; transition:all .15s ease; background:transparent; }
		.skm-icon-btn:hover{ background:#F0F5FF; }
		.skm-icon-btn img{ width:32px; height:32px; }

		/* footer */
		.skm-foot{ margin-top:18px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; padding:12px 16px; }
		.skm-foot .info{ color:#23C8B8; font-size:13px; line-height:1.4; font-weight:700; }
		/* unified pager like Products */
		.skm-pager{ list-style:none; display:flex; align-items:center; gap:8px; margin:0; padding:0; }
		.skm-pager li a, .skm-pager li span{ display:inline-flex; width:28px; height:28px; align-items:center; justify-content:center; border:1px solid #E1E7EA; border-radius:6px; background:#fff; color:#6B8791; text-decoration:none; font-weight:700; font-size:12px; }
		.skm-pager li.active span{ background:#23C8B8; color:#fff; border-color:#23C8B8; }
		.skm-pager li.disabled span{ background:#F3F6F8; color:#A7B4BA; border-color:#EAEFF2; }
		.skm-pager li a:hover{ background:#F6FBFA; border-color:#BFE9E3; color:#1F6D72; }

		@media(max-width:1024px){
			.skm-admin-main{ margin-left:0; padding:20px; }
			.skm-header, .skm-controls-card{ padding:20px; }
		}
		@media(max-width:767px){
			.skm-admin-main{ margin-left:0; margin-top:72px; padding:16px; }
			.skm-header, .skm-controls-card{ padding:16px; }
			.skm-actions{ flex-direction:column; align-items:stretch; }
			.skm-table-wrap{ overflow-x:auto; -webkit-overflow-scrolling:touch; }
			.skm-table-header-bar { flex-wrap: wrap; gap: 16px; }
		}
	</style>
	</head>
<body>
	@include('layouts.sidebar_admin')
	<main class="skm-admin-main">
		<div class="skm-content-wrapper">
			<div class="skm-header">
				<h1>Manage Your Testimonies</h1>
				<p>Manage your testimonies here</p>
			</div>

			<div class="skm-controls-card">
				<div class="skm-actions">
					<a href="{{ route('admin.testimonials.create') }}" class="skm-btn skm-btn-primary">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
						</svg>
						Add New Testimonies
					</a>
				</div>

				<div class="skm-table-header-bar">
					<h2 class="skm-table-title">All Testimonies</h2>
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
			<table class="skm-table" role="table" aria-label="Testimonies list">
				<thead>
					<tr>
						<th style="width:120px;">Portrait</th>
						<th>Name</th>
						<th style="width:160px;">Date</th>
						<th style="width:160px;">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach(($testimonies ?? []) as $it)
					<tr>
						<td>
							<span class="skm-portrait">
								@if(is_array($it))
									<img src="{{ $it['image'] ? asset('storage/'.$it['image']) : asset('assets/img/Article-image.png') }}" alt="Portrait">
								@else
									<img src="{{ $it->image ? asset('storage/'.$it->image) : asset('assets/img/Article-image.png') }}" alt="Portrait">
								@endif
							</span>
						</td>
						<td class="skm-name-cell"><strong>{{ is_array($it) ? ($it['name'] ?? '—') : ($it->name ?? '—') }}</strong></td>
						<td>{{ is_array($it) ? ($it['date'] ?? '—') : (optional($it->created_at)->format('d - m - Y')) }}</td>
						<td>
							<div class="skm-action-btns">
								<a href="{{ route('admin.testimonials.show', is_array($it) ? ($it['id'] ?? 0) : $it) }}" class="skm-icon-btn" title="View"><img src="{{ asset('assets/img/view.svg') }}" alt="View"></a>
								<a href="{{ route('admin.testimonials.edit', is_array($it) ? ($it['id'] ?? 0) : $it) }}" class="skm-icon-btn" title="Edit"><img src="{{ asset('assets/img/edit.svg') }}" alt="Edit"></a>
								<form action="{{ route('admin.testimonials.destroy', is_array($it) ? ($it['id'] ?? 0) : $it) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this testimony?')">
									@csrf
									@method('DELETE')
									<button type="submit" class="skm-icon-btn" title="Delete"><img src="{{ asset('assets/img/delete.svg') }}" alt="Delete"></button>
								</form>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="skm-foot">
				@if(isset($testimonies))
					<div class="info">Showing data {{ $testimonies->firstItem() }} to {{ $testimonies->lastItem() }} of {{ $testimonies->total() }} entries</div>
					<div class="skm-pager" aria-label="Pagination">{!! $testimonies->links('pagination::sikemas') !!}</div>
				@endif
			</div>
			</div>

		</div>
	</main>
</body>
</html>
