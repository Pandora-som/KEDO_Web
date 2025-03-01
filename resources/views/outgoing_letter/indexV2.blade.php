<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>СЭД УрФУ</title>
    <link rel="stylesheet" href="{{ asset(path: 'css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="/autocomplete/css/autoComplete.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
</head>

@extends('layouts.header')

@section('content')

<body>
    <div class="container">
        <h1 class="page__title">Реестр регистрации исходящих документов</h1>
        <div class="func-block">
            {{-- <a href="{{ route('outgoing_letter.index') }}">Сбросить фильтры</a> --}}
            <form class="search__form" action="{{ url()->full() }}" method="GET">
                <a class="btn btn-outline-primary btn-lg" href="{{ url()->current() }}" role="button">Обновить</a>
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

                                    <button type="submit" class="btn btn-primary">Отфильтровать</button>
                                    <a href="{{ route('outgoing_letter.index') }}">Сбросить</a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Закрыть</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <input name="find" type="search" class="form-control" id="searchInput" placeholder="Поиск..."
                        value="{{ $request->query('find') ? $request->query('find') : '' }}">
                </div>
                <button type="submit" class="btn btn-primary">Найти</button>
            </form>
            <a class="btn btn-primary" href="{{ route('outgoing_letter.bin') }}" role="button">Корзина</a>
            <a class="btn btn-primary" href="{{ route('outgoing_letter.create') }}" role="button">Создать</a>
        </div>
    </div>
    <div class="pagination__div">
        {{ $outgoingLetters->withQueryString()->links() }}
    </div>
    <div class="table_container container">
        <table class="table table-light table-striped table-hover" style="width: 100%">
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
                            <a title="Изменить" href="{{ route('outgoing_letter.edit', $outgoingLetter->id) }}"><img
                                    src="/img/edit-img.svg" alt="edit"></a>
                            <form action="{{ route('outgoing_letter.delete', $outgoingLetter->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button title="Удалить" class="btn btn-light delete_button" type="submit"
                                    onclick="return confirm('Вы уверны, что хотите удалить запись?')"><img
                                        src="/img/delete-imf.svg" alt="delete">
                                </button>
                            </form>
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
    {{-- <script src="/bootstrap/js/bootstrap.min.js"></script> --}}
    <script src="/js/search.js"></script>
</body>
@endsection

</html>
