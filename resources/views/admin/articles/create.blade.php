<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Article - Sikemas Admin</title>
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;700;800&display=swap" rel="stylesheet">

	<style>
		:root {
			--skm-teal: #1F6D72;
			--skm-blue: #074159;
			--skm-accent: #ff5722;
			--skm-green: #20C8B5;
			--skm-bg: #F4F7F6;
		}
		* { box-sizing: border-box; margin: 0; padding: 0; }
		body { font-family: 'Besley', system-ui, sans-serif; background: var(--skm-bg); min-height: 100vh; }
		
		.skm-admin-main { margin-left: 240px; padding: 24px; }
		
		.skm-form-container { max-width: 900px; background: #fff; border-radius: 12px; padding: 32px; box-shadow: 0 2px 10px rgba(0,0,0,.04); }
		
		.skm-form-row {
			display: flex;
			gap: 24px;
			align-items: flex-start;
		}
		.skm-form-row .skm-form-group {
			flex: 1;
		}
		
		.skm-form-group { margin-bottom: 24px; }
		.skm-form-label { display: block; color: var(--skm-green); font-weight: 700; font-size: 14px; margin-bottom: 8px; }
		.skm-form-input, .skm-form-textarea, .skm-form-select { width: 100%; padding: 12px 16px; border: 2px solid var(--skm-accent); border-radius: 10px; font-size: 14px; font-family: inherit; transition: border-color .15s ease; }
		.skm-form-input:focus, .skm-form-textarea:focus, .skm-form-select:focus { outline: none; border-color: var(--skm-blue); }
		.skm-form-textarea { min-height: 100px; resize: vertical; }
		
		.skm-upload-box { 
			border: 2px dashed var(--skm-accent); 
			border-radius: 10px; 
			padding: 40px; 
			text-align: center; 
			cursor: pointer; 
			transition: all .15s ease; 
			position: relative; 
			display: flex;
			align-items: center;
			justify-content: center;
			min-height: 150px;
		}
		.skm-upload-box:hover { border-color: var(--skm-blue); background: #F9FAFB; }
		.skm-upload-box input[type="file"] { position: absolute; opacity: 0; width: 100%; height: 100%; cursor: pointer; top: 0; left: 0; }
		
		.skm-upload-plus {
			font-size: 60px;
			color: var(--skm-green);
			font-weight: 400;
			line-height: 1;
			transition: all .15s ease;
		}
		.skm-upload-box:hover .skm-upload-plus {
			color: var(--skm-blue);
		}
		
		.skm-radio-group { display: flex; gap: 24px; margin-top: 8px; }
		.skm-radio-item { display: flex; align-items: center; gap: 8px; }
		.skm-radio-item input[type="radio"] { width: 18px; height: 18px; cursor: pointer; }
		.skm-radio-item label { font-size: 14px; cursor: pointer; color: #374151; font-weight: 600; }
		
		.skm-btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 10px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; transition: all .15s ease; text-decoration: none; }
		.skm-btn-primary { background: var(--skm-accent); color: #fff; box-shadow: 0 4px 12px rgba(255,87,34,.3); }
		.skm-btn-primary:hover { background: #e64a19; transform: translateY(-1px); }
		.skm-btn-secondary { background: var(--skm-green); color: #fff; box-shadow: 0 4px 12px rgba(32,200,181,.3); }
		.skm-btn-secondary:hover { background: #1BA89A; transform: translateY(-1px); }
		
		.skm-add-buttons {
			display: flex;
			flex-direction: column;
			gap: 12px;
			align-items: center;
			margin-top: 24px;
			margin-bottom: 32px;
		}
		
		.skm-form-actions { display: flex; gap: 12px; justify-content: flex-end; margin-top: 32px; }
		
		.skm-error { color: #E53935; font-size: 12px; margin-top: 4px; }
		
		.skm-remove-btn {
			font-size: 12px;
			color: var(--skm-accent);
			background: none;
			border: none;
			cursor: pointer;
			margin-top: 8px;
			padding: 0;
			font-family: inherit;
			font-weight: 700;
		}
		
		@media (max-width: 767px) {
			.skm-admin-main { margin-left: 0; margin-top: 72px; padding: 16px; }
			.skm-form-container { padding: 20px; }
			.skm-form-row { flex-direction: column; gap: 0; }
		}
	</style>
</head>
<body>
@include('layouts.sidebar_admin')
	
	<main class="skm-admin-main">
		<div class="skm-form-container">
			<h1 style="color: var(--skm-blue); font-size: 28px; margin-bottom: 24px;">Add New Article</h1>
			
			{{-- Alert untuk error umum --}}
			@if(session('error'))
				<div style="background:#FFE5E5; border:1px solid #FF5252; color:#C62828; padding:12px 16px; border-radius:12px; margin-bottom:16px; font-size:14px;">
					<strong>Error:</strong> {{ session('error') }}
				</div>
			@endif

			{{-- Alert untuk success --}}
			@if(session('success'))
				<div style="background:#E8F5E9; border:1px solid #4CAF50; color:#2E7D32; padding:12px 16px; border-radius:12px; margin-bottom:16px; font-size:14px;">
					<strong>Berhasil!</strong> {{ session('success') }}
				</div>
			@endif
			
			<form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				
				<div class="skm-form-group">
					<label class="skm-form-label">Thumbnail</label>
					<div class="skm-upload-box" id="uploadBox">
						<input type="file" name="thumbnail" accept="image/*" id="thumbnailInput">
						<span class="skm-upload-plus" id="uploadPlus">+</span>
					</div>
					@error('thumbnail')
					<span class="skm-error">{{ $message }}</span>
					@enderror
				</div>
				
				<div class="skm-form-row">
					<div class="skm-form-group">
						<label class="skm-form-label">Title</label>
						<input type="text" name="title" class="skm-form-input" value="{{ old('title') }}" required>
						@error('title')
						<span class="skm-error">{{ $message }}</span>
						@enderror
					</div>
					
					<div class="skm-form-group">
						<label class="skm-form-label">Editor</label>
						<select name="editor_id" class="skm-form-select">
							<option value="">Select </option>
							@foreach($users as $user)
							<option value="{{ $user->id }}" {{ old('editor_id') == $user->id ? 'selected' : '' }}>
								{{ $user->name }}
							</option>
							@endforeach
						</select>
						@error('editor_id')
						<span class="skm-error">{{ $message }}</span>
						@enderror
					</div>
				</div>
				
				<div class="skm-form-group">
					<label class="skm-form-label">Description</label>
					<textarea name="deskripsi" class="skm-form-textarea" required>{{ old('deskripsi') }}</textarea>
					@error('deskripsi')
					<span class="skm-error">{{ $message }}</span>
					@enderror
				</div>
				
				<!-- Status -->
				<div class="skm-form-group">
					<label class="skm-form-label">Status</label>
					<div class="skm-radio-group">
						<div class="skm-radio-item">
							<input type="radio" name="status" value="draft" id="statusDraft" 
								{{ old('status', 'draft') == 'draft' ? 'checked' : '' }}>
							<label for="statusDraft">Draft</label>
						</div>
						<div class="skm-radio-item">
							<input type="radio" name="status" value="published" id="statusPublished"
								{{ old('status') == 'published' ? 'checked' : '' }}>
							<label for="statusPublished">Published</label>
						</div>
					</div>
					@error('status')
					<span class="skm-error">{{ $message }}</span>
					@enderror
				</div>
				
				<div id="contentContainer">
					<div class="skm-form-group">
						<label class="skm-form-label">Sub Heading</label>
						<input type="text" name="subheadings[]" class="skm-form-input" placeholder="e.g., Introduction">
					</div>
					<div class="skm-form-group">
						<label class="skm-form-label">Paragraph</label>
						<textarea name="paragraphs[]" class="skm-form-textarea" placeholder="Write paragraph content..."></textarea>
					</div>
				</div>
				
				<div class="skm-add-buttons">
					<button type="button" class="skm-btn skm-btn-primary" id="addParagraphBtn">
						Add Paragraph
					</button>
					<button type="button" class="skm-btn skm-btn-secondary" id="addSubheadingBtn">
						Add Subheading
					</button>
				</div>
			
				<div class="skm-form-actions">
					<button type="submit" class="skm-btn skm-btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</main>
	
	<script>
		const container = document.getElementById('contentContainer');
		
		document.getElementById('addParagraphBtn').addEventListener('click', function() {
			const newItem = document.createElement('div');
			newItem.className = 'skm-form-group';
			
			newItem.innerHTML = `
				<label class="skm-form-label">Paragraph</label>
				<textarea name="paragraphs[]" class="skm-form-textarea" placeholder="Write paragraph content..."></textarea>
				<button type="button" class="skm-remove-btn" onclick="this.parentElement.remove()">Remove Paragraph</button>
			`;
			
			container.appendChild(newItem);
		});
		
		document.getElementById('addSubheadingBtn').addEventListener('click', function() {
			const newItem = document.createElement('div');
			newItem.className = 'skm-form-group';
			
			newItem.innerHTML = `
				<label class="skm-form-label">Sub Heading</label>
				<input type="text" name="subheadings[]" class="skm-form-input" placeholder="e.g., Next Step">
				<button type="button" class="skm-remove-btn" onclick="this.parentElement.remove()">Remove Subheading</button>
			`;
			
			container.appendChild(newItem);
		});
		
		document.getElementById('thumbnailInput').addEventListener('change', function(e) {
			const file = e.target.files[0];
			if (file) {
				const reader = new FileReader();
				reader.onload = function(e) {
					const uploadBox = document.getElementById('uploadBox');
					const plusSign = document.getElementById('uploadPlus');
					
					uploadBox.style.backgroundImage = `url(${e.target.result})`;
					uploadBox.style.backgroundSize = 'cover';
					uploadBox.style.backgroundPosition = 'center';
					
					if (plusSign) {
						plusSign.style.display = 'none';
					}
				}
				reader.readAsDataURL(file);
			}
		});
	</script>
</body>
</html>