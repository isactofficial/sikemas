<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Testimony - Admin</title>
    <style> body{font-family:system-ui, sans-serif; background:#F7FAFB} .skm-admin-main{margin-left:240px; padding:24px;} .card{background:#fff;border-radius:12px;padding:20px;box-shadow:0 6px 18px rgba(12,30,44,0.05);} .portrait{width:120px;height:120px;border-radius:12px;overflow:hidden;margin-bottom:12px;} .portrait img{width:100%;height:100%;object-fit:cover;} .name{font-weight:800;color:#074159;font-size:20px;margin:0 0 6px;} .job{color:#6EA8C8;margin:0 0 12px;} .text{white-space:pre-wrap;color:#21494a} </style>
</head>
<body>
@include('layouts.sidebar_admin')
<main class="skm-admin-main">
    <div class="card">
        <div class="portrait">@if($testimony->image)<img src="{{ asset('storage/'.$testimony->image) }}" alt="Portrait">@endif</div>
        <h1 class="name">{{ $testimony->name }}</h1>
        <p class="job">{{ $testimony->job }}</p>
        <div class="text">{{ $testimony->testimony }}</div>
    </div>
</main>
</body>
</html>
