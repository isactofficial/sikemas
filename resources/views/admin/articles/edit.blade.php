<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Article - Sikemas Admin</title>
	
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
		
		.skm-form-group { margin-bottom: 24px; }
		.skm-form-label { display: block; color: var(--skm-green); font-weight: 700; font-size: 14px; margin-bottom: 8px; }
		.skm-form-input, .skm-form-textarea, .skm-form-select { width: 100%; padding: 12px 16px; border: 2px solid var(--skm-accent); border-radius: 10px; font-size: 14px; font-family: inherit; transition: border-color .15s ease; }
		.skm-form-input:focus, .skm-form-textarea:focus, .skm-form-select:focus { outline: none; border-color: var(--skm-blue); }
		.skm-form-textarea { min-height: 100px; resize: vertical; }
		
		.skm-upload-box { border: 2px dashed var(--skm-accent); border-radius: 10px; padding: 40px; text-align: center; cursor: pointer; transition: all .15s ease; position: relative; }
		.skm-upload-box:hover { border-color: var(--skm-blue); background: #F9FAFB; }
		.skm-upload-box input[type="file"] { position: absolute; opacity: 0; width: 100%; height: 100%; cursor: pointer; top: 0; left: 0; }
		.skm-upload-preview { max-width: 200px; margin: 0 auto 12px; border-radius: 8px; overflow: hidden; }
		.skm-upload-preview img { width: 100%; height: auto; display: block; }
		
		.skm-radio-group { display: flex; gap: 24px; margin-top: 8px; }
		.skm-radio-item { display: flex; align-items: center; gap: 8px; }
		.skm-radio-item input[type="radio"] { width: 18px; height: 18px; cursor: pointer; }
		.skm-radio-item label { font-size: 14px; cursor: pointer; color: #374151; font-weight: 600; }
		
		.skm-content-section { border: 2px solid #E5E7EB; border-radius: 10px; padding: 20px; margin-bottom: 16px; }
		.skm-content-item { margin-bottom: 16px; padding: 16px; background: #F9FAFB; border-radius: 8px; position: relative; }
		.skm-remove-btn { position: absolute; top: 8px; right: 8px; background: #E53935; color: #fff; border: none; width: 28px; height: 28px; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: 700; }
		.skm-remove-btn:hover { background: #C62828; }
		
		.skm-btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 10px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; transition: all .15s ease; text-decoration: none; }
		.skm-btn-primary { background: var(--skm-accent); color: #fff; box-shadow: 0 4px 12px rgba(255,87,34,.3); }
		.skm-btn-primary:hover { background: #e64a19; transform: translateY(-1px); }
		.skm-btn-secondary { background: var(--skm-green); color: #fff; box-shadow: 0 4px 12px rgba(32,200,181,.3); }
		.skm-btn-secondary:hover { background: #1BA89A; transform: translateY(-1px); }
		
		.skm-form-actions { display: flex; gap: 12px; justify-content: flex-end; margin-top: 32px; }
		
		.skm-error { color: #E53935; font-size: 12px; margin-top: 4px; }
		
		@media (max-width: 767px) {
			.skm-admin-main { margin-left: 0; margin-top: 72px; padding: 16px; }
			.skm-form-container { padding: 20px; }
		}
	</style>
</head>
<body>
@include('layouts.sidebar_admin')
	
	<main class="skm-admin-main">
		<div class="skm-form-container">
			<h1 style="color: var(--skm-blue); font-size: 28px; margin-bottom: 24px;">Edit Article</h1>
			
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
			
			<form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				
				<!-- Thumbnail -->
				<div class="skm-form-group">
					<label class="skm-form-label">Thumbnail</label>
					<div class="skm-upload-box" id="uploadBox">
						<input type="file" name="thumbnail" accept="image/*" id="thumbnailInput">
						@if($article->thumbnail)
						<div class="skm-upload-preview">
							<img src="{{ asset('storage/' . $article->thumbnail) }}" alt="Current thumbnail" id="previewImg">
						</div>
						<p class="skm-upload-text">Click to change thumbnail</p>
						@else
						<svg class="skm-upload-icon" width="48" height="48" viewBox="0 0 24 24" fill="none">
							<path d="M12 5v14M5 12h14" stroke="#20C8B5" stroke-width="2" stroke-linecap="round"/>
						</svg>
						<p class="skm-upload-text">Click to upload thumbnail image</p>
						@endif
					</div>
					@error('thumbnail')
					<span class="skm-error">{{ $message }}</span>
					@enderror
				</div>
				
				<!-- Title -->
				<div class="skm-form-group">
					<label class="skm-form-label">Title</label>
					<input type="text" name="title" class="skm-form-input" value="{{ old('title', $article->title) }}" required>
					@error('title')
					<span class="skm-error">{{ $message }}</span>
					@enderror
				</div>
				
				<!-- Editor -->
				<div class="skm-form-group">
					<label class="skm-form-label">Editor</label>
					<select name="editor_id" class="skm-form-select">
						<option value="">Select Editor (Optional)</option>
						@foreach($users as $user)
						<option value="{{ $user->id }}" {{ old('editor_id', $article->editor_id) == $user->id ? 'selected' : '' }}>
							{{ $user->name }}
						</option>
						@endforeach
					</select>
				</div>
				
				<!-- Description -->
				<div class="skm-form-group">
					<label class="skm-form-label">Description</label>
					<textarea name="deskripsi" class="skm-form-textarea" required>{{ old('deskripsi', $article->deskripsi) }}</textarea>
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
								{{ old('status', $article->status) == 'draft' ? 'checked' : '' }}>
							<label for="statusDraft">Draft</label>
						</div>
						<div class="skm-radio-item">
							<input type="radio" name="status" value="published" id="statusPublished"
								{{ old('status', $article->status) == 'published' ? 'checked' : '' }}>
							<label for="statusPublished">Published</label>
						</div>
					</div>
					@error('status')
					<span class="skm-error">{{ $message }}</span>
					@enderror
				</div>
				
				<!-- Dynamic Content -->
				<div class="skm-content-section">
					<h3 style="color: var(--skm-green); margin-bottom: 16px;">Article Content</h3>
					
					<div id="contentContainer">
						@if($article->contents->count() > 0)
							@php
								$contentGroups = [];
								$currentGroup = ['subheading' => null, 'paragraph' => null];
								
								foreach($article->contents as $content) {
									if($content->content_type === 'subheading') {
										if($currentGroup['subheading'] !== null || $currentGroup['paragraph'] !== null) {
											$contentGroups[] = $currentGroup;
											$currentGroup = ['subheading' => null, 'paragraph' => null];
										}
										$currentGroup['subheading'] = $content->content;
									} else {
										$currentGroup['paragraph'] = $content->content;
									}
								}
								
								if($currentGroup['subheading'] !== null || $currentGroup['paragraph'] !== null) {
									$contentGroups[] = $currentGroup;
								}
							@endphp
							
							@foreach($contentGroups as $index => $group)
							<div class="skm-content-item" data-index="{{ $index }}">
								@if($index > 0)
								<button type="button" class="skm-remove-btn" onclick="this.parentElement.remove()">×</button>
								@endif
								<div class="skm-form-group" style="margin-bottom: 12px;">
									<label class="skm-form-label">Sub Heading</label>
									<input type="text" name="subheadings[]" class="skm-form-input" value="{{ $group['subheading'] }}">
								</div>
								<div class="skm-form-group" style="margin-bottom: 0;">
									<label class="skm-form-label">Paragraph</label>
									<textarea name="paragraphs[]" class="skm-form-textarea">{{ $group['paragraph'] }}</textarea>
								</div>
							</div>
							@endforeach
						@else
							<div class="skm-content-item" data-index="0">
								<div class="skm-form-group" style="margin-bottom: 12px;">
									<label class="skm-form-label">Sub Heading</label>
									<input type="text" name="subheadings[]" class="skm-form-input">
								</div>
								<div class="skm-form-group" style="margin-bottom: 0;">
									<label class="skm-form-label">Paragraph</label>
									<textarea name="paragraphs[]" class="skm-form-textarea"></textarea>
								</div>
							</div>
						@endif
					</div>
					
					<button type="button" class="skm-btn skm-btn-secondary" id="addContentBtn">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none">
							<path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
						</svg>
						Add Subheading & Paragraph
					</button>
				</div>
				
				<!-- Submit Actions -->
				<div class="skm-form-actions">
					<a href="{{ route('admin.articles.index') }}" class="skm-btn" style="background: #6B8791; color: #fff;">Cancel</a>
					<button type="submit" class="skm-btn skm-btn-primary">Update Article</button>
				</div>
			</form>
		</div>
	</main>
	
	<script>
		let contentIndex = {{ $article->contents->count() > 0 ? count($contentGroups) : 1 }};
		
		document.getElementById('addContentBtn').addEventListener('click', function() {
			const container = document.getElementById('contentContainer');
			const newItem = document.createElement('div');
			newItem.className = 'skm-content-item';
			newItem.dataset.index = contentIndex;
			newItem.innerHTML = `
				<button type="button" class="skm-remove-btn" onclick="this.parentElement.remove()">×</button>
				<div class="skm-form-group" style="margin-bottom: 12px;">
					<label class="skm-form-label">Sub Heading</label>
					<input type="text" name="subheadings[]" class="skm-form-input">
				</div>
				<div class="skm-form-group" style="margin-bottom: 0;">
					<label class="skm-form-label">Paragraph</label>
					<textarea name="paragraphs[]" class="skm-form-textarea"></textarea>
				</div>
			`;
			container.appendChild(newItem);
			contentIndex++;
		});
		
		document.getElementById('thumbnailInput').addEventListener('change', function(e) {
			const file = e.target.files[0];
			if (file) {
				const reader = new FileReader();
				reader.onload = function(e) {
					const previewImg = document.getElementById('previewImg');
					if (previewImg) {
						previewImg.src = e.target.result;
					} else {
						const uploadBox = document.getElementById('uploadBox');
						const newPreview = document.createElement('div');
						newPreview.className = 'skm-upload-preview';
						newPreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
						uploadBox.insertBefore(newPreview, uploadBox.firstChild);
					}
				}
				reader.readAsDataURL(file);
			}
		});
	</script>
</body>
</html>