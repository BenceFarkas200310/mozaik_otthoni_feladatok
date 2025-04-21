<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Versenykezelő</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @livewireStyles
</head>
<body>

    @auth
        <h2>Bejelentkeztél, üdv {{auth()->user()->name}}</h2>
        <form action="/logout" method="POST">
            @csrf
            <button class="btn btn-primary">Kijelentkezés</button>
        </form>

        @if (auth()->user()->is_admin == 1)
            <livewire:add-competition />
            <livewire:competitions-list />

        @else
        <livewrie:rounds />
        @endif
    @else
        <livewire:login />
    @endauth
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @livewireScripts
</body>
</html>