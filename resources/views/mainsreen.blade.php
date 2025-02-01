<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset(path: 'css/main.css') }}">
</head>
<body>
    {{--@foreach ($w as $i)
        {{$i->organisation_name}}
    @endforeach--}}

    <div class="header_line">
        <nav class="nav">
            <a href="#" class="link">Исходящие документы</a>
            <a href="#" class="link">Входящие документы</a>
        </nav>
        <div class="circle"></div>
    </div>

</body>
</html>
