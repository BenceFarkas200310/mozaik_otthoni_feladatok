<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forduló részletei</title>
</head>
<body>
    <h1>Forduló: {{ $round->name }}</h1>
    <h2>Versenyzők</h2>
    <livewire:add-contestant :round="$round->id" />
    <a href="/">Vissza a főoldalra</a>
</body>
</html>