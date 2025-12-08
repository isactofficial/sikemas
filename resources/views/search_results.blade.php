<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hasil Pencarian: {{ $query }} - SIKEMAS</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-sikemas-2-removebg.png') }}">
    <script src="{{ asset('js/dynamic-favicon.js') }}" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        :root {
            --skm-teal: #1F6D72;
            --skm-blue: #074159;
            --skm-accent: #ff5722;
            --skm-bg: #F4F7F6;
        }

        body {
            font-family: 'Besley', serif;
            background-color: var(--skm-bg);
            color: var(--skm-blue);
            margin: 0;
            padding: 0;
        }

        .skm-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .skm-search-header {
            padding: 40px 0;
            border-bottom: 2px solid #e0e0e0;
            margin-bottom: 30px;
        }
        
        .skm-search-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: var(--skm-blue);
        }

        .skm-search-header p {
            font-size: 1.1rem;
            color: #555;
        }

        .skm-search-results-section {
            margin-bottom: 40px;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .skm-search-results-section h2 {
            border-bottom: 3px solid var(--skm-teal);
            padding-bottom: 10px;
            margin-bottom: 25px;
            font-size: 1.8rem;
            color: var(--skm-teal);
        }
        
        .skm-result-item {
            border: 1px solid #eee;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
            display: flex;
            align-items: flex-start;
            gap: 20px;
            text-decoration: none;
            color: inherit;
        }
        
        .skm-result-item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .skm-result-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
            flex-shrink: 0;
        }

        .skm-result-item-content {
            flex-grow: 1;
        }

        .skm-result-item-content h3 {
            margin-top: 0;
            font-size: 1.3rem;
            color: var(--skm-accent);
        }

        .skm-result-item-content p {
            margin-top: 5px;
            color: #666;
            line-height: 1.4;
            font-size: 0.95rem;
        }

        .skm-no-results {
            text-align: center;
            color: #888;
            padding: 30px;
            font-size: 1.1rem;
        }

        .skm-result-type {
            font-size: 0.85rem;
            color: var(--skm-teal);
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .skm-summary {
            text-align: center;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .skm-summary h3 {
            color: var(--skm-blue);
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .skm-container {
                padding: 20px 15px;
            }
            .skm-search-header h1 {
                font-size: 2rem;
            }
            .skm-result-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .skm-result-item img {
                width: 100%;
                max-width: 200px;
                height: auto;
                margin-bottom: 10px;
            }
            .skm-result-item-content h3 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navbar') 

    <div class="skm-container">
        <header class="skm-search-header">
            <h1>Hasil Pencarian</h1>
            <p>Menampilkan hasil untuk kata kunci: <strong>"{{ $query }}"</strong></p>
        </header>

        {{-- Ringkasan Total Hasil --}}
        @php
            $totalResults = $articles->count() + $products->count() + $testimonies->count() + $pages->count();
        @endphp
        
        @if($totalResults > 0)
            <div class="skm-summary">
                <h3>Ditemukan {{ $totalResults }} hasil</h3>
                <p>{{ $articles->count() }} Artikel, {{ $products->count() }} Produk, {{ $testimonies->count() }} Testimoni, {{ $pages->count() }} Halaman</p>
            </div>
        @endif

        {{-- BAGIAN 1: HALAMAN STATIS --}}
        @if($pages->count() > 0)
        <section class="skm-search-results-section">
            <h2><i class="fas fa-file"></i> Halaman ({{ $pages->count() }})</h2>
            @foreach ($pages as $page)
                <a href="{{ $page['url'] }}" class="skm-result-item">
                    <div class="skm-result-item-content">
                        <span class="skm-result-type">{{ $page['type'] }}</span>
                        <h3>{{ $page['title'] }}</h3>
                        <p>{{ $page['description'] }}</p>
                    </div>
                </a>
            @endforeach
        </section>
        @endif

        {{-- BAGIAN 2: HASIL ARTIKEL --}}
        @if($articles->count() > 0)
        <section class="skm-search-results-section">
            <h2><i class="fas fa-file-alt"></i> Artikel ({{ $articles->count() }})</h2>
            @foreach ($articles as $article)
                <a href="{{ route('detail_artikel', $article->slug) }}" class="skm-result-item">
                    @php
                        $articleImage = null;
                        if (!empty($article->thumbnail_path)) {
                            $articleImage = asset('storage/' . $article->thumbnail_path);
                        } elseif (!empty($article->image)) {
                            $articleImage = asset('storage/' . $article->image);
                        } elseif (!empty($article->featured_image)) {
                            $articleImage = asset('storage/' . $article->featured_image);
                        } elseif (!empty($article->thumbnail)) {
                            $articleImage = asset('storage/' . $article->thumbnail);
                        } else {
                            $articleImage = asset('assets/img/Article-image.png');
                        }
                    @endphp
                    <img src="{{ $articleImage }}" alt="Thumbnail: {{ $article->title }}" onerror="this.src='{{ asset('assets/img/Article-image.png') }}'">
                    <div class="skm-result-item-content">
                        <span class="skm-result-type">Artikel</span>
                        <h3>{{ $article->title }}</h3>
                        @php
                            $preview = '';
                            if (!empty($article->deskripsi)) {
                                $preview = $article->deskripsi;
                            }
                        @endphp
                        <p>{{ Str::limit(strip_tags($preview), 150) }}</p> 
                    </div>
                </a>
            @endforeach
        </section>
        @endif

        {{-- BAGIAN 3: HASIL PRODUK --}}
        @if($products->count() > 0)
        <section class="skm-search-results-section">
            <h2><i class="fas fa-box"></i> Produk ({{ $products->count() }})</h2>
            @foreach ($products as $product)
                <a href="{{ route('produk') }}" class="skm-result-item">
                    @php
                        $productImage = null;
                        if (!empty($product->image)) {
                            $productImage = asset('storage/' . $product->image);
                        } elseif (!empty($product->image_path)) {
                            $productImage = asset('storage/' . $product->image_path);
                        } elseif (!empty($product->featured_image)) {
                            $productImage = asset('storage/' . $product->featured_image);
                        } elseif (!empty($product->thumbnail)) {
                            $productImage = asset('storage/' . $product->thumbnail);
                        } else {
                            $productImage = asset('assets/img/Rectangle12.png');
                        }
                    @endphp
                    <img src="{{ $productImage }}" alt="Gambar: {{ $product->name }}" onerror="this.src='{{ asset('assets/img/Rectangle12.png') }}'">
                    <div class="skm-result-item-content">
                        <span class="skm-result-type">Produk</span>
                        <h3>{{ $product->name }}</h3>
                        <p>
                            @if(!empty($product->price))
                                <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong><br>
                            @endif
                            {{ Str::limit($product->description ?? 'Produk berkualitas dari Sikemas', 150) }}
                        </p> 
                    </div>
                </a>
            @endforeach
        </section>
        @endif

        {{-- BAGIAN 4: HASIL TESTIMONI --}}
        @if($testimonies->count() > 0)
        <section class="skm-search-results-section">
            <h2><i class="fas fa-comments"></i> Testimoni ({{ $testimonies->count() }})</h2>
            @foreach ($testimonies as $testimony)
                <a href="{{ route('portofolio') }}" class="skm-result-item">
                    @php
                        $testimonyImage = $testimony->image 
                            ? asset('storage/' . $testimony->image) 
                            : asset('assets/img/Container.png');
                    @endphp
                    <img src="{{ $testimonyImage }}" alt="Foto: {{ $testimony->name }}" onerror="this.src='{{ asset('assets/img/Container.png') }}'">
                    <div class="skm-result-item-content">
                        <span class="skm-result-type">Testimoni</span>
                        <h3>{{ $testimony->name }}</h3>
                        <p>
                            <strong>{{ $testimony->job ?? 'Klien' }}</strong><br>
                            {{ Str::limit($testimony->testimony ?? '', 150) }}
                        </p> 
                    </div>
                </a>
            @endforeach
        </section>
        @endif

        {{-- JIKA TIDAK ADA HASIL SAMA SEKALI --}}
        @if ($totalResults === 0)
            <section class="skm-search-results-section">
                <h2>Ringkasan</h2>
                <div class="skm-no-results" style="font-size: 1.2rem; color: var(--skm-accent);">
                    <i class="fas fa-exclamation-circle fa-2x" style="margin-bottom: 10px;"></i>
                    <p>Maaf, kami tidak menemukan hasil untuk <strong>"{{ $query }}"</strong>.</p>
                    <p style="font-size: 0.9rem; margin-top: 15px; color: #666;">
                        Coba gunakan kata kunci yang lebih umum atau periksa kembali ejaan Anda.
                    </p>
                </div>
            </section>
        @endif

    </div>

    @include('layouts.footer')
    @include('components.chatbot')

</body>
</html>