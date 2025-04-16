<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Versenykezelő</title>
    @livewireStyles
</head>
<body>

    @auth
        <h2>Bejelentkeztél, üdv {{auth()->user()->name}}</h2>
        <form action="/logout" method="POST">
            @csrf
            <button>Kijelentkezés</button>
        </form>

        @if (auth()->user()->is_admin == 1)
            <h2>Admin vagy</h2>
            <livewire:add-competition />
            <livewire:competitions-list />
        @endif
    @else
        <livewire:login />
    @endauth
    @livewireScripts
</body>
</html>