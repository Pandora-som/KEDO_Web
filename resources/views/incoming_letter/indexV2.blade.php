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
    <div class="container">
        <h1 class="page__title">Реестр регистрации входящих документов</h1>

        <div class="func-block incoming_func_block">
            <div class="table__legend">
                <p>
                    <button class="btn btn-danger"></button> - просроченный срок документа
                </p>
                <p>
                    <button class="btn btn-warning"></button> - срок документа выходит через 3 дня
                </p>
                <p>
                    <button class="btn btn-success"></button> - документ со сроком
                </p>
                <p>
                    <button class="btn btn-secondary"></button> - документ без срока
                </p>
            </div>
            <form name="filters_form" class="search__form" action="{{ url()->full() }}" method="GET">
                <a class="btn btn-outline-primary btn-lg" href="{{ url()->current() }}" role="button">Обновить</a>
                <div>
                    <input name="find" type="search" class="form-control" id="searchInput" placeholder="Поиск..."
                        value="{{ $request->query('find') ? $request->query('find') : '' }}">
                </div>
                <button type="submit" class="btn btn-primary">Найти</button>
                {{-- <a href="{{ route('incoming_letter.index') }}">Сбросить фильтры</a> --}}
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

                                    <div class="btn-group mb-4" role="group"
                                        aria-label="Basic checkbox toggle button group">
                                        @foreach ($classificators as $classificator)
                                        <input type="checkbox" class="btn-check"
                                            id="{{ $classificator->classificator_name }}"
                                            {{ $request->query('classificator_id') ? (in_array($classificator->id, $request->query('classificator_id')) ? ' checked' : '' ) : ''}}
                                            name="classificator_id[]" value="{{ $classificator->id }}">
                                        <label class="btn btn-outline-primary"
                                            for="{{ $classificator->classificator_name }}">{{ $classificator->classificator_name }}</label>
                                        @endforeach
                                    </div>

                                    <div class="date__filter">
                                        <label for="start_date">Срок с:</label>
                                        <input id="start_date" type="date" name="start_date"
                                            value="{{ $request->query('start_date') ? $request->query('start_date') : date('Y-m-d', strtotime('last month')) }}">

                                        <label for="end_date">по:</label>
                                        <input id="end_date" type="date" name="end_date"
                                            value="{{ $request->query('end_date') ? $request->query('end_date') : date('Y-m-d', strtotime('next month'))}}">
                                    </div>

                                    <button class="btn btn-primary">Отфильтровать</button>
                                    <a href="{{ route('incoming_letter.index') }}">Сбросить</a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Закрыть</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->role_id !== 3)
                <a class="btn btn-primary" href="{{ route('incoming_letter.bin') }}" role="button">Корзина</a>
                <a class="btn btn-primary" href="{{ route('incoming_letter.create') }}" role="button">Создать</a>
                @endif
        </div>
    </div>
    <div class="letters_group_pagination_div">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input onclick="filters_form.submit()" type="radio" class="btn-check" id="isAll" autocomplete="off" name="lettersGroup" value='all' checked
                {{ $request->query('lettersGroup') == 'all' ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="isAll">Все документы</label>

            <input onclick="filters_form.submit()" type="radio" class="btn-check" id="isExpired" autocomplete="off" name="lettersGroup" value='expired'
                {{ $request->query('lettersGroup') == 'expired' ? 'checked' : '' }}>
            <label class="btn btn-outline-danger" for="isExpired">Просроченные документы</label>

            <input onclick="filters_form.submit()" type="radio" class="btn-check" id="isEndless" autocomplete="off" name="lettersGroup" value='endless'
                {{ $request->query('lettersGroup') == 'endless' ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary" for="isEndless">Бессрочные документы</label>
        </div>
        <div class="pagination__div">
            {{ $incomingLetters->withQueryString()->links() }}
        </div>
    </div>
    </form>
    <div class="table_container container">
        <table class="table table-light table-striped table-hover table-sm">
            <tbody>
                <tr>
                    <th>№</th>
                    <th>Дата регистрации</th>
                    <th>От кого поступил документ</th>
                    <th>Наименование документа</th>
                    <th>Номер документа</th>
                    <th>Дата документа</th>
                    <th>Тема документа</th>
                    <th>Резолюция</th>
                    <th>Ответственный исполнитель </th>
                    <th>Срок исполнения</th>
                    <th>Отметка об исполнении</th>
                    @if (auth()->user()->role_id !== 3)
                    <th>Действия</th>
                    @endif
                </tr>
                @foreach ($incomingLetters as $incomingLetter)
                <tr
                    {{ $incomingLetter->deadline !== null ? ($incomingLetter->deadline < now()->format('Y-m-d') ? "class=table-danger" : (strtotime($incomingLetter->deadline) - strtotime(now()->format('Y-m-d')) < 3 * 86400 ? "class=table-warning" : 'class=table-success')) : '' }}>
                    <td>{{$incomingLetter->registration_number}}</td>
                    <td>{{date('d-m-Y G:i ', strtotime($incomingLetter->registration_date))}}</td>
                    <td>{{$incomingLetter->document_from}}</td>
                    <td>{{$incomingLetter->document_name}}</td>
                    <td>{{$incomingLetter->document_number}}</td>
                    <td>{{date('d-m-Y', strtotime($incomingLetter->document_date))}}</td>
                    <td>{{$incomingLetter->document_subject}}</td>
                    <td>{{$incomingLetter->resolution}}</td>
                    <td>{{$incomingLetter->performer}}</td>
                    <td>{{$incomingLetter->deadline ? date('d-m-Y', strtotime($incomingLetter->deadline)) : ''}}</td>
                    <td>{{$incomingLetter->status->status_name}}</td>
                    @if (auth()->user()->role_id !== 3)
                    <td>
                        <div class="actions">
                            <a title="Изменить" href="{{ route('incoming_letter.edit', $incomingLetter->id) }}"><img
                                    src="/img/edit-img.svg" alt="edit"></a>
                            <form action="{{ route('incoming_letter.delete', $incomingLetter->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button title="Удалить" class="btn btn-light delete_button" type="submit"
                                    onclick="return confirm('Вы уверены, что хотите удалить запись?')">
                                    <img src="/img/delete-imf.svg" alt="delete">
                                </button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination__div">
        {{ $incomingLetters->withQueryString()->links() }}
    </div>
    <script src="/autocomplete/autoComplete.min.js"></script>
    {{-- <script src="/bootstrap/js/bootstrap.min.js"></script> --}}
    <script src="/js/search.js"></script>
</body>
@endsection

</html>
