<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Likee | Laravel</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.css') }}">
</head>
    <style>
        ion-icon {
            font-size: 28px;
        }
    </style>
<body>
    <x-navigation />
    <div class="container">
        <main>
            {{ $slot }}
        </main>
    </div>

    <script src="{{ asset('bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('jquery/jquery.js') }}"></script>
    {{-- Ion Icon --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @stack('scripts')
</body>
</html>