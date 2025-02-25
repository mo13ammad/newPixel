<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atlantis Retro</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @style("/assets/admin/css/style.min.css")
    @style("/assets/admin/css/rtl.css")
    @style("https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v27.2.1/dist/font-face.css")

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url('https://uploadkon.ir/uploads/d88a22_25download.jpeg');
            background-size: cover;
            background-attachment: fixed;
            overflow: hidden;
            height: 100vh;
            box-sizing: border-box;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        html {
            --color-bg: #161923;
            --color-bg-a25: rgba(22,26,35,0.25);
            --color-bg-a50: rgba(22,26,35,0.5);
            --color-bg-a80: rgba(22,26,35,0.8);
            --color-text: ivory;
            --color-text-a10: hsla(60,93%,94%,0.1);
            --color-text-a20: hsla(60,93%,94%,0.2);
            --color-text-a50: hsla(60,93%,94%,0.5);
            --color-text-a75: hsla(60,93%,94%,0.75);
            --color-shadow: rgba(54,20,0,0.2);
            --color-accent-1: #f40552;
            --color-accent-1-a75: rgba(244,5,82,0.75);
            --color-accent-1-a50: rgba(244,5,82,0.5);
            --color-accent-1-a10: rgba(244,5,82,0.1);
            --color-accent-1-s90: #e7064f;
            --color-accent-2: #007892;
            --color-accent-2-a10: rgba(0,120,146,0.1);
            --f1: "Rubik";
            --f2: "Montserrat";
            --fs08: 0.8rem;
            --fs1: 1rem;
            --fs2: 1.2rem;
            --fs3: 1.5rem;
            --fs4: 1.75rem;
            --fs5: 2rem;
            --q: 1rem;
            --qh: .5rem;
            --q2: calc(var(--q)*2);
            --q3: calc(var(--q)*3);
            --q4: calc(var(--q)*4);
            --q5: calc(var(--q)*5);
            --q6: calc(var(--q)*6);
            --q7: calc(var(--q)*7);
            --q8: calc(var(--q)*8);
            --q9: calc(var(--q)*9);
            --q10: calc(var(--q)*10);
            --q11: calc(var(--q)*11);
            --q12: calc(var(--q)*12);
            --q13: calc(var(--q)*13);
            --padding-sides: var(--q4);
            --padding-sides-half: calc(var(--padding-sides)/2);
            --blur-radius: 10px;
            color: var(--color-text);
            font-family: var(--f1);
            font-size: 16px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: rgba(0, 0, 0, 0.7);
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
        }

        .navbar-brand img {
            width: 80px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.1);
            transition: background-color 0.3s ease;
        }

        .nav-links a:hover {
            background-color: #f40552;
        }

        .centered-content {
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            position: absolute;
            top: 50%;  /* قرار دادن در وسط صفحه */
            left: 50%;
            transform: translate(-50%, -50%); /* جابه‌جایی برای وسط‌چین کردن دقیق */
            z-index: 1;
        }

        .main-text {
            font-size: 2.5rem;
            color: white;
            font-weight: bold;
            margin-bottom: 20px;
        }

        #client-download {
            padding: 15px 40px;
            font-size: 1.2rem;
            background-color: #f40552;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        #client-download:hover {
            background-color: #e7064f;
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.6);
            position: relative;
            bottom: 0;
            width: 100%;
            text-align: center;
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .main-text {
                font-size: 2rem;
            }
            #client-download {
                font-size: 1rem;
                padding: 12px 30px;
            }
            .header {
                flex-direction: column;
                align-items: center;
            }
            .nav-links {
                flex-direction: column;
            }
        }
    </style>
</head>
<body dir="rtl">
    <div class="header">
        <a href="#" class="navbar-brand">
            <img src="https://uploadkon.ir/uploads/fc2e22_25atlantisrr.png" alt="logo">
        </a>
        <div class="nav-links">
            @if (env('FIVEMLINK', false))
                <a href="{{ env('FIVEMLINK') }}">ورود به سرور</a>
            @endif
            @if (env('DISCORD', false))
                <a href="{{ env('DISCORD') }}">دیسکورد</a>
            @endif
        </div>
    </div>

    <div class="centered-content">
         <h2 class="main-text">جهت استفاده از امکانات سایت وارد حساب کاربری خود شوید</h2>
        @if (Route::has('login'))
            <a href="{{ route('login') }}" id="client-download">ورود به حساب کاربری</a>
        @endif
    </div>

    <footer class="footer-text">
        <p>حقوق محفوظ است | 2025 Atlantis Retro</p>
    </footer>

    @script("/assets/admin/js/jquery.min.js")
    @script("/assets/admin/js/popper.min.js")
    @script("/assets/admin/js/bootstrap.min.js")
    @script("/assets/admin/js/perfect-scrollbar.jquery.min.js")
    @script("/assets/admin/js/app-style-switcher.min.js")
    @script("/assets/admin/js/feather.min.js")
    @script("/assets/admin/js/sidebarmenu.min.js")
    @script("/assets/admin/js/custom.min.js")
</body>
</html>
