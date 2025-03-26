<!DOCTYPE html>
<html lang="ru">
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
    <form class="container w-25 mt-3" action="{{ route('admin.update', $user->id) }}" method="post">
        @csrf
        @method('patch')
        <div class="mb-3">
          <label for="email" class="form-label">Почта</label>
          <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ $user->email }}">
        </div>
        @error('email')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror

        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input name="name" class="form-control" id="name" aria-describedby="emailHelp" value="{{ $user->name }}">
        </div>
        @error('name')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror

        <div class="mb-3">
          <label for="password" class="form-label">Пароль</label>
          <input name="password" type="password" class="form-control" id="password">
        </div>
        @error('password')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror

        <select name="role_id" class="form-select mb-3" aria-label="Default select example">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->role_name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
</body>
@endsection
</html>
