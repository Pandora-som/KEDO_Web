<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset(path: 'css/main.css') }}">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
</head>
@extends('layouts.header')

@section('content')
<body>
    <h1>Корзина</h1>
    <p>Здесь отображаются удалённые записи о документах</p>
    <div class="pagination__div">
        {{ $incomingLetters->withQueryString()->links() }}
    </div>
    <table class="table table-light table-striped">
        <tbody>
            <tr>
                <th scope="row">№</th>
                <th scope="row">Дата регистрации</th>
                <th scope="row">От кого поступил документ</th>
                <th scope="row">Наименование документа</th>
                <th scope="row">Номер документа</th>
                <th scope="row">Дата документа</th>
                <th scope="row">Тема документа</th>
                <th scope="row">Резолюция</th>
                <th scope="row">Ответственный исполнитель </th>
                <th scope="row">Срок исполнения</th>
                <th scope="row">Отметка об исполнении</th>
                <th scope="row">Действия</th>
            </tr>
            @foreach ($incomingLetters as $incomingLetter)
            <tr
                {{ $incomingLetter->deadline < now()->format('Y-m-d') ? "class=table-danger" : ($incomingLetter->deadline === now()->format('Y-m-d') ? "class=table-warning" : '')}}>
                <td>{{$incomingLetter->id}}</td>
                <td>{{$incomingLetter->registration_date}}</td>
                <td>{{$incomingLetter->document_from}}</td>
                <td>{{$incomingLetter->document_name}}</td>
                <td>{{$incomingLetter->document_number}}</td>
                <td>{{$incomingLetter->document_date}}</td>
                <td>{{$incomingLetter->document_subject}}</td>
                <td>{{$incomingLetter->resolution}}</td>
                <td>{{$incomingLetter->performer}}</td>
                <td>{{$incomingLetter->deadline}}</td>
                <td>{{$incomingLetter->status->status_name}}</td>
                <td>
                    <div class="actions">
                        <button class="btn btn-light delete_button"><a href="{{ route('incoming_letter.edit', $incomingLetter->id) }}"><img src="/img/reset.svg"
                                alt="edit"></a></button>
                        <form action="{{ route('incoming_letter.delete', $incomingLetter->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-light delete_button" type="submit" onclick="return confirm('Вы уверны, что хотите удалить запись?')">
                                <img src="/img/delete-imf.svg" alt="delete">
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination__div">
        {{ $incomingLetters->withQueryString()->links() }}
    </div>
    <script src="/autocomplete/autoComplete.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
@endsection
</html>
