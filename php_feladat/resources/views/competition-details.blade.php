<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$competition->name}} - Részletek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @livewireStyles
</head>
<body>
    @if(auth()->user()->is_admin == 1)
    <div class="container">
        <h1>{{$competition->name}} - Részletek</h1>
        <p><strong>Év:</strong> {{$competition->year}}</p>
        <p><strong>Nyelv:</strong> {{$competition->available_languages}}</p>
        <p><strong>Jó válaszért járó pont:</strong> {{$competition->points_for_right_answer}}</p>
        <p><strong>Rossz válaszért járó pont:</strong> {{$competition->points_for_wrong_answer}}</p>
        <p><strong>Üres válaszért járó pont:</strong> {{$competition->points_for_empty_answer}}</p>
    
    

        <livewire:rounds :competition="$competition" />

        <a href="/">Vissza a versenyekhez</a>
    </div>
    @else
    <livewire:unauthorized />
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @livewireScripts
</body>
</html>