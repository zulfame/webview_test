<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#010101" />

    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Webview - Transform Your Site" />
    <meta property="og:title" content="Webview - Transform Your Site" />
    <meta property="og:description" content="Turn your website into a fully functional Android app in no time." />
    <meta property="og:url" content="{{ env('APP_URL') }}" />
    <meta property="og:image" content="https://sipebri.bprbangunarta.co.id/simontok.png" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="400" />
    <meta property="og:image:type" content="image/png" />

    @stack('style')
</head>

<body>
    @yield('content')
    <div class="appBottomMenu">
        <a href="/" class="item {{ Request::is('/', 'testing/upload', 'testing/embed'. 'testing/webcam') ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="/contact" class="item {{ Request::is('contact') ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="mail-outline"></ion-icon>
                <strong>Contact</strong>
            </div>
        </a>
    </div>

    @if (session('success'))
    <div id="toast-success" class="toast-box toast-center" data-message="{{ session('success') }}">
        <div class="in">
            <ion-icon name="checkmark-circle" class="text-success"></ion-icon>
            <div class="text">
                <div class="text">{{ session('success') }}</div>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-text-light close-button">CLOSE</button>
    </div>
    @endif

    @if (session('error'))
    <div id="toast-error" class="toast-box toast-center" data-message="{{ session('error') }}">
        <div class="in">
            <ion-icon name="ban-outline" class="text-danger"></ion-icon>
            <div class="text">
                <div class="text">{{ session('error') }}</div>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-text-light close-button">CLOSE</button>
    </div>
    @endif

    <script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="{{ asset('assets/js/plugins/splide/splide.min.js') }}"></script>
    <script src="{{ asset('assets/js/base.js') }}"></script>
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = document.getElementById('toast-success');
            var errorMessage = document.getElementById('toast-error');

            if (successMessage) {
                toastbox('toast-success', 3000); // Auto close in 3 seconds
            }

            if (errorMessage) {
                toastbox('toast-error', 3000); // Auto close in 3 seconds
            }
        });

        function toastbox(id, timeout) {
            var toast = document.getElementById(id);
            toast.classList.add('show');
            setTimeout(function() {
                toast.classList.remove('show');
            }, timeout || 3000);
        }
    </script>

    @stack('script')
</body>

</html>