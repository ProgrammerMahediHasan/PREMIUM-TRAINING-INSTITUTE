<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Training Institute</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .auth-page { min-height: 100vh; width: 100vw; display:flex; align-items:center; justify-content:center; position:relative; overflow:hidden; }
        .auth-bg { position:absolute; inset:0; background:
            radial-gradient(circle at 15% 15%, rgba(21,112,239,0.12) 0%, transparent 40%),
            radial-gradient(circle at 85% 85%, rgba(6,187,204,0.10) 0%, transparent 38%),
            linear-gradient(135deg, #0a2540 0%, #091a3d 100%);
        }
        .auth-shape-1, .auth-shape-2 {
            position:absolute; border-radius:50%; filter: blur(40px);
        }
        .auth-shape-1 { width:340px; height:340px; background:#0f5ec433; top:-80px; left:-80px; animation: float1 10s ease-in-out infinite alternate; }
        .auth-shape-2 { width:380px; height:380px; background:#06bbcc33; bottom:-100px; right:-100px; animation: float2 11s ease-in-out infinite alternate; }
        @keyframes float1 { from { transform: translate(0,0); } to { transform: translate(20px,10px); } }
        @keyframes float2 { from { transform: translate(0,0); } to { transform: translate(-15px,-10px); } }
        .card-auth { width: 100%; max-width: 520px; backdrop-filter: blur(10px); background: rgba(255,255,255,0.95); border-radius: 16px; box-shadow: 0 20px 60px rgba(12, 18, 27, 0.15); }
        .brand-top { display:flex; align-items:center; gap:12px; }
        .brand-top img { height:40px; }
        .btn-primary { background:#1570ef; border-color:#1570ef; }
        .btn-primary:hover { background:#0f5ec4; border-color:#0f5ec4; }
        .input-icon { position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#667; }
        .form-control.padded { padding-left:36px; height:46px; }
        .link-muted { color:#5b6b7a; text-decoration:none; }
        .link-muted:hover { color:#0f5ec4; }
    </style>
</head>
<body class="bg-light">
@if (!request()->is('login') && !request()->is('register') && !request()->is('logout'))
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="/images/logo.svg" alt="Logo" style="height:28px"></a>
            <div class="d-flex align-items-center gap-2">
                @auth
                    <span class="text-white-50 small">Hello, {{ auth()->user()->name }}</span>
                    <a href="/dashboard" class="btn btn-outline-light btn-sm">Dashboard</a>
                    <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
                @endauth
            </div>
        </div>
    </nav>
@endif
<main class="{{ (request()->is('login') || request()->is('register') || request()->is('logout')) ? 'container-fluid p-0' : 'container py-4' }}">
    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
