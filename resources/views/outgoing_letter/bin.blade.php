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
    <div class="container">
        <h1>Корзина исходящих документов</h1>
        <p>Здесь отображаются удалённые записи о документах</p>
        <div class="func-block">
            <form class="search__form" action="{{ url()->full() }}" method="GET">
                <a class="btn btn-outline-primary btn-lg" href="{{ url()->current() }}" role="button">Обновить</a>
                <div>
                    <input name="find" type="search" class="form-control" id="searchInput" placeholder="Поиск..."
                        value="{{ $request->query('find') ? $request->query('find') : '' }}">
                </div>
                <button type="submit" class="btn btn-primary">Найти</button>
                {{-- <a href="{{ route('outgoing_letter.index') }}">Сбросить фильтры</a> --}}
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Фильтры
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Фильтры</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{-- <form action="{{ url()->full() }}" method="GET"> --}}
                                    <h3>Классификация</h3>
                                    @foreach ($classificators as $classificator)
                                    <input type="checkbox" id="{{ $classificator->classificator_name }}"
                                        {{ $request->query('classificator_id') == $classificator->id ? ' checked' : '' }}
                                        name="classificator_id" value="{{ $classificator->id }}">
                                    <label
                                        for="{{ $classificator->classificator_name }}">{{ $classificator->classificator_name }}</label>
                                    @endforeach

                                    <div class="date__filter">
                                        <label for="start_date">Срок с:</label>
                                        <input id="start_date" type="date" name="start_date"
                                            value="{{ $request->query('start_date') ? $request->query('start_date') : date('Y-m-d', strtotime('last month')) }}">

                                        <label for="end_date">по:</label>
                                        <input id="end_date" type="date" name="end_date"
                                            value="{{ $request->query('end_date') ? $request->query('end_date') : date('Y-m-d', strtotime('next month'))}}">
                                    </div>

                                    <button class="btn btn-primary">Отфильтровать</button>
                                    <a href="{{ route('outgoing_letter.bin') }}">Сбросить</a>
                                    {{-- </form> --}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Закрыть</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="pagination__div">
        {{ $outgoingLetters->withQueryString()->links() }}
    </div>
    <div class="table_container container">
        <table class="table table-light table-striped">
            <tbody>
                <tr>
                    <th>№</th>
                    <th>Дата регистрации</th>
                    <th>Кому адресован документ</th>
                    <th>Наименование документа</th>
                    <th>Тема документа</th>
                    <th>Подписант</th>
                    <th>Исполнитель</h>
                    <th>Отметка об исполнении (на вх. №)</th>
                    <th>Действия</th>
                </tr>
                @foreach ($outgoingLetters as $outgoingLetter)
                <tr>
                    <td>{{$outgoingLetter->id}}</td>
                    <td>{{date('d-m-Y G:i ', strtotime($outgoingLetter->registration_date))}}</td>
                    <td>{{$outgoingLetter->destination}}</td>
                    <td>{{$outgoingLetter->document_name}}</td>
                    <td>{{$outgoingLetter->document_subject}}</td>
                    <td>{{$outgoingLetter->signer}}</td>
                    <td>{{$outgoingLetter->performer}}</td>
                    <td>{{$outgoingLetter->incoming_number}}</td>
                    <td>
                        <div class="actions">
                            <div class="actions">
                                <form action="{{ route('outgoing_letter.restore', $outgoingLetter->id) }}"
                                    method="post">
                                    @csrf
                                    <button title="Восстановить" type='submit' class="btn btn-light delete_button"
                                        onclick="return confirm('Вы уверны, что хотите восстановить запись?')">
                                        <img src="/img/reset.svg" alt="restore">
                                    </button>
                                </form>
                                {{-- <button class="btn btn-light delete_button"><a href="{{ route('outgoing_letter.edit', $outgoingLetter->id) }}"><img
                                    src="/img/reset.svg" alt="edit"></a>
                                </button> --}}
                                <form action="{{ route('outgoing_letter.destroy', $outgoingLetter->id) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button title="Удалить" class="btn btn-light delete_button" type="submit"
                                        onclick="return confirm('Вы уверны, что хотите удалить запись?')">
                                        <img src="/img/delete-imf.svg" alt="delete">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination__div">
        {{ $outgoingLetters->withQueryString()->links() }}
    </div>
    <script src="/autocomplete/autoComplete.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
@endsection

</html>
