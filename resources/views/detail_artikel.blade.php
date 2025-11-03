<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $article->title }} - Sikemas</title>
    <style>
    :root { --skm-blue:#0E4B63; --skm-blue-2:#0B3D52; --skm-accent:#F28C28; --skm-gray:#475B63; --skm-bg:#F6FAFB; --skm-teal:#23C8B8; }
        body.skm-page { margin:0; font-family: system-ui,-apple-system,Segoe UI,Roboto,Arial,"Noto Sans",sans-serif; color:#0F2A34; background:#fff; }
        .skm-hero{ background:#ffffff; padding:38px 16px; border-bottom:none; }
        .skm-hero-inner{ max-width:900px; margin:0 auto; }
        .skm-breadcrumb{ display:none; }
    .skm-topline{ display:flex; align-items:center; justify-content:space-between; gap:16px; margin-top:12px; }
    .skm-back{ display:inline-flex; align-items:center; gap:8px; text-decoration:none; color:var(--skm-blue); background:#EAF1F3; border:1px solid #E3EEF1; padding:8px 12px; border-radius:10px; font-weight:700; margin-bottom:12px; box-shadow:0 1px 0 rgba(14,75,99,0.05) }
    .skm-back:hover{ background:#E3EEF1 }
    .skm-badges{ display:flex; align-items:center; gap:10px; flex-wrap:wrap }
    .skm-badge{ display:inline-flex; align-items:center; padding:8px 14px; font-weight:800; font-size:12px; letter-spacing:.5px; border-radius:999px; text-transform:uppercase; color:#fff }
    /* Force light blue for Published badge regardless of global :root overrides */
    .skm-badge.is-pub{ background:#23C8B8 !important }
    .skm-badge.is-cat{ background:var(--skm-accent) }
    .skm-info{ color:#6B8791; font-size:13.5px; display:flex; align-items:center; gap:22px; flex-wrap:wrap }
    .skm-info .item{ display:inline-flex; align-items:center; gap:8px }
    .skm-info svg{ width:16px; height:16px; fill:#6B8791 }
        .skm-title{ margin:8px 0 6px; font-size:clamp(28px,4.2vw,40px); line-height:1.2; color:var(--skm-blue); font-weight:800 }
        .skm-author{ color:#6B8791; font-size:14px; margin:0 }
        .skm-author .skm-author-name{ color:var(--skm-blue); font-weight:700 }
        .skm-divider{ height:3px; background:#0B3D52; margin-top:14px; border-radius:2px }
        .skm-wrap{ max-width:900px; margin:0 auto; padding:26px 16px 40px }
        .skm-cover{ width:100%; margin:0; border-radius:12px; overflow:hidden; border:1px solid #E3EEF1; background:#EAF1F3 }
        .skm-cover img{ width:100%; height:auto; display:block; object-fit:cover; aspect-ratio:16/9 }
        .skm-content{ margin-top:22px; color:var(--skm-gray); line-height:1.8; font-size:clamp(15px,1.7vw,16.5px) }
    .skm-content h2{ color:var(--skm-blue); margin:28px 0 12px; font-size:clamp(20px,2.6vw,24px); font-weight:800; position:relative; padding-left:16px }
    .skm-content h2::before{ content:""; position:absolute; left:0; top:0.2em; bottom:0.2em; width:6px; background:#ff5722; border-radius:3px }
        .skm-content p{ margin:0 0 14px }
        .skm-hr{ height:1px; background:#E6EEF1; border:0; margin:22px 0 }

        /* Comments placeholder */
        .skm-comments{ margin-top:28px; border:1px solid #E6EEF1; border-radius:12px; padding:16px }
        .skm-comments h3{ margin:0 0 6px; color:var(--skm-blue); font-size:18px }
        .skm-login-note{ text-align:center; color:#6B8791; font-size:13px }
        .skm-login-note a{ color:var(--skm-accent); font-weight:800; text-decoration:none }
        .skm-login-note a:hover{ text-decoration:underline }
        @media(max-width:640px){ 
            .skm-content h2{ padding-left:12px }
            .skm-content h2::before{ width:4px; top:0.25em; bottom:0.25em }
        }
    </style>
    </head>
<body class="skm-page">
@include('layouts.navbar')

<header class="skm-hero" role="banner">
    <div class="skm-hero-inner">
        <a href="{{ route('artikel') }}" class="skm-back" aria-label="Kembali ke daftar artikel">
            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path fill="currentColor" d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
            <span>Kembali</span>
        </a>
        <div class="skm-topline">
            <div class="skm-badges">
                @if($article->isPublished())
                    <span class="skm-badge is-pub">Published</span>
                @endif
                @php
                    $catName = null;
                    if(isset($hasCategoryTables) && $hasCategoryTables && isset($article->categories)){
                        $catName = optional($article->categories->first())->name;
                    }
                @endphp
                @if($catName)
                    <span class="skm-badge is-cat">{{ Str::upper($catName) }}</span>
                @endif
            </div>
            @php
                // Gunakan tanggal created_at agar konsisten dengan daftar artikel
                $dateRef = $article->created_at ?? now();
                try {
                    $tgl = \Carbon\Carbon::parse($dateRef)->locale('id')->translatedFormat('d F Y');
                } catch (\Exception $e) {
                    $tgl = optional($article->created_at)->format('d F Y') ?? '';
                }
                $viewCount = number_format((int) $article->views, 0, ',', '.');
            @endphp
            <div class="skm-info">
                <span class="item" aria-label="Tanggal publikasi">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 2a1 1 0 0 1 1 1v1h8V3a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v3H2V6a2 2 0 0 1 2-2h1V3a1 1 0 1 1 2 0v1zM2 11h20v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7zm5 3a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H7z"/></svg>
                    <span>{{ $tgl ?? '' }}</span>
                </span>
                <span class="item" aria-label="Jumlah dilihat">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5c5.523 0 10 4.477 10 7s-4.477 7-10 7S2 14.523 2 12s4.477-7 10-7zm0 2C8.134 7 4.612 9.94 3.465 12 4.612 14.06 8.134 17 12 17s7.388-2.94 8.535-5C19.388 9.94 15.866 7 12 7zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/></svg>
                    <span>Dilihat: {{ $viewCount }}</span>
                </span>
            </div>
        </div>
        <h1 class="skm-title">{{ $article->title }}</h1>
        <p class="skm-author">Ditulis oleh <span class="skm-author-name">{{ optional($article->editor)->name ?? 'Admin Sikemas' }}</span></p>
        <div class="skm-divider" role="presentation"></div>
    </div>
</header>

<main class="skm-wrap">
    <figure class="skm-cover">
        <img src="{{ $article->thumbnail_url }}" alt="Gambar artikel: {{ $article->title }}" />
    </figure>

    <article class="skm-content">
    @forelse($article->contents as $block)
            @if($block->content_type === 'heading')
                <hr class="skm-hr"/>
                <h2>{{ $block->content }}</h2>
            @else
                @php
                    $raw = (string) $block->content;
                    $isNumbered = preg_match('/^\d+\.\s+/u', trim($raw)) === 1;
                @endphp
                @if($isNumbered)
                    <hr class="skm-hr"/>
                    <h2>{{ $raw }}</h2>
                @else
                    <p>{!! nl2br(e($raw)) !!}</p>
                @endif
            @endif
        @empty
            @if(!empty($article->excerpt))
                <p>{!! nl2br(e($article->excerpt)) !!}</p>
            @else
                <p>Konten artikel belum tersedia.</p>
            @endif
        @endforelse
    </article>

    @php($comments = $article->comments)
    <section class="skm-comments" aria-labelledby="comments-title">
        <h3 id="comments-title">Komentar ({{ $comments->count() }})</h3>

        @auth
            <form action="{{ route('comments.store', $article) }}" method="POST" style="margin-bottom:16px">
                @csrf
                <label for="comment-content" class="sr-only">Tulis komentar</label>
                <textarea id="comment-content" name="content" rows="3" required placeholder="Tulis komentar kamu..." style="width:100%; padding:10px; border:1px solid #E6EEF1; border-radius:8px; resize:vertical"></textarea>
                @error('content')
                    <div style="color:#b00020; font-size:12px; margin-top:6px">{{ $message }}</div>
                @enderror
                <div style="display:flex; justify-content:flex-end; margin-top:8px">
                    <button type="submit" style="background:#0E4B63; color:#fff; border:none; padding:8px 14px; border-radius:8px; cursor:pointer">Kirim</button>
                </div>
            </form>
        @else
            <p class="skm-login-note">Silakan <a href="{{ route('login') }}">login</a> untuk memberikan komentar.</p>
        @endauth

        @if(session('status'))
            <div style="background:#EAF8F6; color:#0E4B63; border:1px solid #BFE7E2; padding:8px 12px; border-radius:8px; margin-bottom:10px">{{ session('status') }}</div>
        @endif

        @if($comments->isEmpty())
            <p class="skm-login-note" style="margin-top:8px; font-style:italic">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
        @else
            <ul style="list-style:none; padding:0; margin:0">
                @foreach($comments as $c)
                    <li style="border-top:1px solid #E6EEF1; padding:12px 0">
                        <div style="display:flex; gap:10px; align-items:flex-start">
                            <img src="{{ optional($c->user)->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(optional($c->user)->name ?? 'U').'&size=64&background=074159&color=fff&bold=true' }}" alt="avatar" style="width:36px; height:36px; border-radius:50%; object-fit:cover"/>
                            <div style="flex:1">
                                <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px">
                                    <strong style="color:#0E4B63">{{ optional($c->user)->name ?? 'Pengguna' }}</strong>
                                    <span style="color:#6B8791; font-size:12px">{{ optional($c->created_at)->diffForHumans() }}</span>
                                </div>
                                <div style="color:#475B63; margin-bottom:6px">{!! nl2br(e($c->content)) !!}</div>
                                <div style="display:flex; align-items:center; gap:10px; color:#6B8791; font-size:13px; margin-bottom:4px">
                                    <form action="{{ route('comments.like', $c) }}" method="POST" style="display:inline" onsubmit="this.querySelector('button').disabled=true;">
                                        @csrf
                                        <button type="submit" title="Suka" aria-label="Suka komentar" style="display:inline-flex; align-items:center; gap:6px; background:transparent; border:1px solid #E6EEF1; color:#0E4B63; padding:4px 8px; border-radius:999px; cursor:pointer">
                                            <svg viewBox="0 0 24 24" width="16" height="16" aria-hidden="true"><path fill="currentColor" d="M2 21h4V9H2v12zM22 10c0-1.1-.9-2-2-2h-5.31l.95-4.57.03-.32a1 1 0 0 0-.29-.7L14 2 7.59 8.41C7.22 8.78 7 9.3 7 9.83V19c0 1.1.9 2 2 2h7c.82 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.21.14-.43.14-.66V10z"/></svg>
                                            <span>{{ (int) $c->likes_count }}</span>
                                        </button>
                                    </form>
                                </div>

                                @php($replies = $c->replies)
                                @if($replies->isNotEmpty())
                                    <ul style="list-style:none; padding-left:46px; margin:8px 0 0">
                                        @foreach($replies as $r)
                                            <li style="padding:8px 0; border-left:3px solid #E6EEF1; padding-left:10px">
                                                <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px">
                                                    <strong style="color:#0E4B63">{{ optional($r->user)->name ?? 'Pengguna' }}</strong>
                                                    <span style="color:#6B8791; font-size:12px">{{ optional($r->created_at)->diffForHumans() }}</span>
                                                </div>
                                                <div style="color:#475B63; margin-bottom:4px">{!! nl2br(e($r->content)) !!}</div>
                                                <div style="display:flex; align-items:center; gap:10px; color:#6B8791; font-size:12px">
                                                    <form action="{{ route('replies.like', $r) }}" method="POST" style="display:inline" onsubmit="this.querySelector('button').disabled=true;">
                                                        @csrf
                                                        <button type="submit" title="Suka" aria-label="Suka balasan" style="display:inline-flex; align-items:center; gap:6px; background:transparent; border:1px solid #E6EEF1; color:#0E4B63; padding:3px 8px; border-radius:999px; cursor:pointer">
                                                            <svg viewBox="0 0 24 24" width="14" height="14" aria-hidden="true"><path fill="currentColor" d="M2 21h4V9H2v12zM22 10c0-1.1-.9-2-2-2h-5.31l.95-4.57.03-.32a1 1 0 0 0-.29-.7L14 2 7.59 8.41C7.22 8.78 7 9.3 7 9.83V19c0 1.1.9 2 2 2h7c.82 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.21.14-.43.14-.66V10z"/></svg>
                                                            <span>{{ (int) $r->likes_count }}</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                @auth
                                    <form action="{{ route('comments.reply', $c) }}" method="POST" style="margin-top:8px; padding-left:46px">
                                        @csrf
                                        <label for="reply-{{ $c->id }}" class="sr-only">Balas komentar</label>
                                        <textarea id="reply-{{ $c->id }}" name="content" rows="2" required placeholder="Tulis balasan..." style="width:100%; padding:8px; border:1px solid #E6EEF1; border-radius:8px; resize:vertical"></textarea>
                                        <div style="display:flex; justify-content:flex-end; margin-top:6px">
                                            <button type="submit" style="background:#0B3D52; color:#fff; border:none; padding:6px 12px; border-radius:8px; cursor:pointer">Balas</button>
                                        </div>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>
</main>

@include('layouts.footer')
</body>
</html>
