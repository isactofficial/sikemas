<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Create Testimony - Admin</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;700;800&display=swap" rel="stylesheet">
	<style>
		:root{ --skm-blue:#074159; --skm-accent:#ff6a24; --skm-bg:#F7FAFB; --skm-border:#FFA46E; --label:#6EA8C8; --plus:#2FBF73; }
		* , *::before, *::after{ box-sizing:border-box; }
		body{ font-family:'Besley',system-ui,sans-serif; background:var(--skm-bg); color:#21494a; }
		.skm-admin-main{ margin-left:240px; padding:28px; overflow-x:hidden; }
		.skm-card{ background:#fff; border-radius:14px; box-shadow:0 6px 18px rgba(12,30,44,0.05); padding:28px; overflow:hidden; max-width:100%; }
		.skm-card h1{ color:var(--skm-blue); font-weight:800; font-size:20px; margin-bottom:18px; }
		.skm-form{ display:grid; gap:14px; max-width:960px; width:100%; }
		.skm-form label{ display:block; font-weight:600; color:var(--label); font-size:12px; margin-bottom:6px; }
		.skm-input, .skm-textarea{ width:100%; padding:12px 14px; border:1.6px solid var(--skm-border); border-radius:18px; font-family:inherit; outline:none; background:#fff; }
		.skm-input::placeholder, .skm-textarea::placeholder{ color:#caa79a; }
		.skm-input:focus, .skm-textarea:focus{ box-shadow:0 6px 18px rgba(255,164,110,0.12); border-color:var(--skm-border); }
		.skm-actions{ display:flex; gap:12px; margin-top:8px; justify-content:flex-end; padding-right:0; }
		.skm-btn{ display:inline-flex; align-items:center; gap:8px; padding:12px 36px; border-radius:999px; font-weight:700; border:0; text-decoration:none; cursor:pointer; transition:all .15s ease; font-size:15px; }
		.skm-btn-primary{ background:linear-gradient(180deg,#FF7E3E 0%, #FF5A12 100%); color:#fff; box-shadow:inset 0 1px 0 rgba(255,255,255,.45), inset 0 -1px 0 rgba(0,0,0,.06), 0 8px 20px rgba(255,86,8,.22); }
		.skm-btn-primary:hover{ filter:brightness(1.03); transform:translateY(-1px); }
		.skm-btn-primary:active{ transform:translateY(0); box-shadow:inset 0 1px 0 rgba(0,0,0,.05), 0 4px 12px rgba(255,86,8,.18); }
		.dropzone{ border:1.6px solid var(--skm-border); border-radius:18px; min-height:180px; display:flex; align-items:center; justify-content:center; gap:12px; padding:20px; background:#fff; cursor:pointer; }
		.dropzone .drop-plus{ font-size:48px; color:var(--plus); line-height:1; }
		.thumbs{ display:flex; gap:8px; margin-top:6px; }
		.thumb{ width:100%; max-width:240px; height:120px; border-radius:12px; overflow:hidden; border:1px solid #FFD1B2; background:#FFF6F1; display:flex; align-items:center; justify-content:center; }
		.thumb img{ width:100%; height:100%; object-fit:cover; }
		@media (max-width: 1024px){ .skm-admin-main{ margin-left:0; padding:20px; } .skm-card{ padding:22px; } }
		@media(max-width:767px){ .skm-admin-main{ margin-left:0; margin-top:72px; padding:16px; } .skm-card{ padding:16px; } .skm-card h1{ font-size:18px; } .dropzone{ min-height:130px; padding:14px; } .skm-actions{ justify-content:center; } .skm-actions .skm-btn{ width:100%; max-width:280px; } }

		img, video{ max-width:100%; height:auto; }
	</style>
</head>
<body>
@include('layouts.sidebar_admin')
<main class="skm-admin-main">
	<div class="skm-card">
		<h1>Add New Testimony</h1>
		<form class="skm-form" action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div>
				<label for="image">Customer Portrait</label>
				<div id="dropzone" class="dropzone" onclick="document.getElementById('image').click()">
					<div class="drop-plus">+</div>
				</div>
				<input type="file" name="image" id="image" accept="image/*" style="display:none">
				@error('image')<div style="color:#e53935; font-size:12px;">{{ $message }}</div>@enderror
				<div id="thumbs" class="thumbs" aria-live="polite"></div>
			</div>
			<div>
				<label for="name">Name</label>
				<input class="skm-input" type="text" name="name" id="name" value="{{ old('name') }}" required>
			</div>
			<div>
				<label for="job">Job</label>
				<input class="skm-input" type="text" name="job" id="job" value="{{ old('job') }}">
			</div>
			<div>
				<label for="testimony">Testimony</label>
				<textarea class="skm-textarea" name="testimony" id="testimony" rows="6">{{ old('testimony') }}</textarea>
			</div>
			<div class="skm-actions">
				<button type="submit" class="skm-btn skm-btn-primary">Submit</button>
			</div>
		</form>
	</div>
</main>
<script>
(function(){
	const dz = document.getElementById('dropzone');
	const input = document.getElementById('image');
	const thumbs = document.getElementById('thumbs');
	if(!dz || !input || !thumbs) return;
	const showPreview = (file) => {
		thumbs.innerHTML = '';
		if(!file) return;
		const reader = new FileReader();
		reader.onload = e => {
			const box = document.createElement('div');
			box.className = 'thumb';
			const img = document.createElement('img');
			img.src = e.target.result; img.alt = 'Preview';
			box.appendChild(img); thumbs.appendChild(box);
		};
		reader.readAsDataURL(file);
	};
	input.addEventListener('change', () => { if(input.files && input.files[0]) showPreview(input.files[0]); });
	['dragenter','dragover'].forEach(evt => dz.addEventListener(evt, e => { e.preventDefault(); e.stopPropagation(); dz.classList.add('is-dragover'); }));
	['dragleave','drop'].forEach(evt => dz.addEventListener(evt, e => { e.preventDefault(); e.stopPropagation(); dz.classList.remove('is-dragover'); }));
	dz.addEventListener('drop', e => { const file = e.dataTransfer.files && e.dataTransfer.files[0]; if(file){ input.files = e.dataTransfer.files; showPreview(file); } });
})();
</script>
</body>
</html>
