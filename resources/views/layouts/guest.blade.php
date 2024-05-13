<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Likee | Laravel</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.css') }}">
</head>
<body class="bg-white">
    <div class="container">
        <main>
            {{ $slot }}
        </main>
    </div>

    <script src="{{ asset('bootstrap/bootstrap.js') }}"></script>
</body>
</html>