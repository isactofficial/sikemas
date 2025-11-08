<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>400 - Permintaan Tidak Valid</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            padding: 60px 40px;
            text-align: center;
            position: relative;
            z-index: 1;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-code {
            font-size: 72px;
            font-weight: 700;
            color: #074159;
            margin-bottom: 20px;
            letter-spacing: -2px;
        }

        .error-title {
            font-size: 28px;
            font-weight: 600;
            color: #074159;
            margin-bottom: 15px;
        }

        .error-message {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn-home {
            display: inline-block;
            background: #074159;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(7, 65, 89, 0.3);
        }

        .btn-home:hover {
            background: #0a5c7a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(7, 65, 89, 0.4);
        }

        .btn-home:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .container {
                padding: 40px 30px;
            }

            .error-code {
                font-size: 56px;
            }

            .error-title {
                font-size: 24px;
            }

            .error-message {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">400</div>
        <h1 class="error-title">Permintaan Tidak Valid</h1>
        <p class="error-message">
            Maaf, server tidak dapat memproses permintaan Anda karena format yang salah.<br>
            Mohon periksa kembali masukan Anda atau coba lagi nanti.
        </p>

        <a href="{{ url('/') }}" class="btn-home">Kembali ke Beranda</a>
    </div>
</body>
</html>
