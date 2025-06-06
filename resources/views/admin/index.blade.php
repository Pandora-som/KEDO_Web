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
        <a class="btn btn-primary" href="{{ route('admin.create') }}">Добавить пользователя</a>
        <div class="container">
            @foreach ($users as $user)
            <li class="list-group-item list-group-item-action mt-3 rounded d-flex align-items-center justify-content-between" aria-current="true">
                <div>
                    <p>Имя: {{ $user->name }}</p>
                    <p>Логин: {{ $user->email }}</p>
                    <p>Роль: {{ $user->role->role_name }}</p>
                    @if ($user->isbanned == true)
                        <h5 class="text-danger">Заблокирован</h5>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('admin.edit', $user->id) }}" title="Изменить"><img src="/img/edit-img.svg" alt="edit"></a>
                    <form action="{{ route('admin.ban', $user->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <button title="Заблокировать" class="btn btn-light delete_button"
                            onclick="return confirm('Вы уверены, что хотите заблокировать пользователя?')">
                            <img src="/img/ban.svg" alt="ban"></button>
                    </form>
                    <form action="{{ route("admin.destroy", $user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button title="Удалить" type="submit"
                            class="btn btn-light delete_button"
                            onclick="return confirm('Вы уверены, что хотите удалить пользователя?')">
                            <img src="/img/delete-imf.svg" alt="delete"></button>
                    </form>
                </div>
            </li>
            @endforeach
        </div>
    </div>
</body>
@endsection
</html>
