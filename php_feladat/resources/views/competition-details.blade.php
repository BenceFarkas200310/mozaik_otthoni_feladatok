<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$competition->name}} - Részletek</title>
</head>
<body>
    <h1>{{$competition->name}} - Részletek</h1>
    <p><strong>Év:</strong> {{$competition->year}}</p>
    <p><strong>Nyelv:</strong> {{$competition->available_languages}}</p>
    <p><strong>Jó válaszért járó pont:</strong> {{$competition->points_for_right_answer}}</p>
    <p><strong>Rossz válaszért járó pont:</strong> {{$competition->points_for_wrong_answer}}</p>
    <p><strong>Üres válaszért járó pont:</strong> {{$competition->points_for_empty_answer}}</p>

    <a href="/">Vissza a versenyekhez</a>
</body>
</html>