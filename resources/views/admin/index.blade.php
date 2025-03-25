<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset(path: 'css/main.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}"> --}}
    <link rel="stylesheet" href="/autocomplete/css/autoComplete.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
</head>
@extends('layouts.header')

@section('content')
<body>
    <div class="list-group mt-3 container d-flex flex-column align-items-end">
        <a class="btn btn-primary" href="#">Добавить пользователя</a>
        <div class="container">
            @foreach ($users as $user)
            <li href="#" class="list-group-item list-group-item-action mt-3 rounded d-flex align-items-center justify-content-between" aria-current="true">
                <div>
                    <p>Имя: {{ $user->name }}</p>
                    <p>Логин: {{ $user->email }}</p>
                    <p>Роль: {{ $user->role->role_name }}</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a title="Изменить" class="btn btn-secondary"><img src="" alt="edit"></a>
                    <form action="">
                        <button title="Забанить" class="btn btn-secondary"><img src="" alt="ban"></button>
                    </form>
                    <form action="{{ route("admin.destroy", $user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button title="Удалить" type="submit" class="btn btn-secondary"><img src="" alt="delete"></button>
                    </form>
                </div>
            </li>
            @endforeach
        </div>
    </div>
</body>
@endsection
</html>
