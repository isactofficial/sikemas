<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Kesalahan Server</title>
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

        /* * CSS untuk .error-icon, .broken-gear, .gear, .crack, 
         * @keyframes wobble, dan @keyframes blink telah dihapus.
         */

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

        .btn-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-home {
            background: #074159;
            color: white;
            box-shadow: 0 4px 15px rgba(7, 65, 89, 0.3);
        }

        .btn-home:hover {
            background: #0a5c7a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(7, 65, 89, 0.4);
        }

        .btn-reload {
            background: white;
            color: #074159;
            border: 2px solid #074159;
        }

        .btn-reload:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
        }

        .btn:active {
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

            /* * CSS media query untuk .error-icon telah dihapus.
             */

            .btn-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">500</div>
        <h1 class="error-title">Kesalahan Server Internal</h1>
        <p class="error-message">
            Maaf, terjadi kesalahan pada server kami.<br>
            Tim kami telah diberitahu dan sedang memperbaikinya. Silakan coba lagi nanti.
        </p>
        <div class="btn-group">
            <a href="javascript:window.location.reload()" class="btn btn-reload">Muat Ulang</a>
            <a href="{{ url('/') }}" class="btn btn-home">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>