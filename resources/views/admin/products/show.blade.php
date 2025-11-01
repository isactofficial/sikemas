<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        :root{ --skm-blue:#074159; --skm-bg:#F4F7F6; --skm-teal:#16b0a4; --skm-accent:#ff5722; }
        *{box-sizing:border-box}
        body{font-family:'Besley',system-ui,sans-serif;background:var(--skm-bg)}
        .skm-admin-main{margin-left:240px;padding:24px}
        .card{background:#fff;border-radius:12px;padding:24px;box-shadow:0 6px 18px rgba(12,30,44,.05)}
        .head{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:16px}
        .title{font-weight:800;color:var(--skm-blue);font-size:24px;margin:0}
        .meta{color:#6B8791;font-size:13px}
        .grid{display:grid;grid-template-columns:180px 1fr;gap:20px}
        .thumb{width:180px;height:135px;border-radius:10px;overflow:hidden;background:#F2F6F8;}
        .thumb img{width:100%;height:100%;object-fit:cover;display:block}
        .name{font-weight:800;color:#074159;font-size:20px;margin:0 0 6px}
        .row{margin:8px 0}
        .label{display:inline-block;min-width:120px;color:#6EA8C8;font-weight:700}
        .value{color:#21494a}
        .desc{white-space:pre-wrap;color:#21494a;line-height:1.55}
        .actions{margin-top:16px;display:flex;gap:8px}
        .btn{display:inline-flex;align-items:center;gap:8px;padding:10px 16px;border-radius:10px;text-decoration:none;font-weight:700}
        .btn-outline{border:1.5px solid #D8E6ED;color:#074159;background:#fff}
        .btn-primary{background:var(--skm-accent);color:#fff; box-shadow:0 4px 12px rgba(255,87,34,.30)}
        .btn-primary:hover{ background:#e64a19; transform:translateY(-1px); }
        @media(max-width:1024px){.skm-admin-main{margin-left:0}}
        @media(max-width:767px){.skm-admin-main{margin-left:0;margin-top:72px;padding:16px}.grid{grid-template-columns:1fr}.thumb{width:100%;height:180px}}
    </style>
</head>
<body>
@include('layouts.sidebar_admin')
<main class="skm-admin-main">
    <div class="card">
        <div class="head">
            <h1 class="title">Product Detail</h1>
            <div class="meta">Created {{ optional($product->created_at)->format('d - m - Y') }}</div>
        </div>
        <div class="grid">
            <div class="thumb">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                @else
                    <img src="{{ asset('assets/img/Article-image.png') }}" alt="Default">
                @endif
            </div>
            <div>
                <h2 class="name">{{ $product->name }}</h2>
                <div class="row"><span class="label">Category</span> <span class="value">{{ $product->category ?? '—' }}</span></div>
                <div class="row"><span class="label">Price</span> <span class="value">{{ $product->price !== null ? 'Rp '.number_format($product->price,0,',','.') : '—' }}</span></div>
                @if(!empty($product->notes))
                    <div class="row"><span class="label">Notes</span> <span class="value">{{ $product->notes }}</span></div>
                @endif
            </div>
        </div>
        @if(!empty($product->description))
            <hr style="border:none;height:1px;background:#EEF3F6;margin:20px 0"/>
            <div class="desc">{!! nl2br(e($product->description)) !!}</div>
        @endif
        <div class="actions">
            <a class="btn btn-outline" href="{{ route('admin.products.index') }}">Back</a>
            <a class="btn btn-primary" href="{{ route('admin.products.edit',$product) }}">Edit Product</a>
        </div>
    </div>
</main>
</body>
</html>
