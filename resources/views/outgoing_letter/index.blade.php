<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset(path: 'css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="/autocomplete/css/autoComplete.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="header_line">
        <div class="logo-nav"><img src="img/logo.svg">
            <nav class="nav">
                <a href="{{route('outgoing_letter.index')}}" class="link">Исходящие документы</a>
                <a href="{{route('incoming_letter.index')}}" class="link">Входящие документы</a>
            </nav>
        </div>
        <div class="circle">
            <img src="img/User.svg" height="35px" width="35px" alt="user">
        </div>
    </div>
    <h1 class="page__title">Реестр регистрации входящих документов</h1>

    <div class="func-block">
        <div class="dropdown">
            <button name="choiser" class="choiser dropbtn">Фильтры ⮟</button>
            <div class="dropdown__content">
                <form action="{{ url()->full() }}" method="GET">
                    <h3>Классификация</h3>
                    @foreach ($classificators as $classificator)
                    <input type="checkbox" id="{{ $classificator->classificator_name }}"
                        {{ $request->query('classificator_id') == $classificator->id ? ' checked' : '' }}
                        name="classificator_id" value="{{ $classificator->id }}">
                    <label
                        for="{{ $classificator->classificator_name }}">{{ $classificator->classificator_name }}</label>
                    @endforeach

                    <div class="date__filter">
                        <label for="start_date">Дата с:</label>
                        <input id="start_date" type="date" name="start_date"
                            value="{{ $request->query('start_date') ? $request->query('start_date') : date('Y-m-d', strtotime('last month'))}}">

                        <label for="end_date">по:</label>
                        <input id="end_date" type="date" name="end_date"
                            value="{{ $request->query('end_date') ? $request->query('end_date') : now()->format('Y-m-d') }}">
                    </div>

                    <a href="{{ route('outgoing_letter.index') }}">Очистить классификацию</a>
                    <button>Отфильтровать</button>
                </form>
            </div>
        </div>
        <input id="autoComplete" type="text" name="search">
        <a class="bin-btn" href="#"><img src="img/bin.svg">корзина</a>
        <a class="create-btn" href="{{route('outgoing_letter.create')}}"><img src="img/plus (1).svg">Создать</a>
    </div>

    <div class="table__legend">
        <p>
            <button class="btn btn-danger"></button> - просроченный срок документа
        </p>
        <p>
            <button class="btn btn-warning"></button> - срок документа выходит сегодня
        </p>
    </div>
    <div class="pagination__div">
        {{ $outgoingLetters->withQueryString()->links() }}
    </div>
    <table class="table table-info table-light table-striped">
        <tbody>
            <tr>
                <td class="title-table">№</td>
                <td class="title-table">Дата регистрации</td>
                <td class="title-table">Кому адресован документ</td>
                <td class="title-table">Наименование документа</td>
                <td class="title-table">Тема документа</td>
                <td class="title-table">Подписант</td>
                <td class="title-table">Исполнитель</td>
                <td class="title-table">Отметка об исполнении (на вх. №)</td>
                <td class="title-table">Действия</td>
            </tr>
            @foreach ($outgoingLetters as $outgoingLetter)
            <tr>
                <td>{{$outgoingLetter->id}}</td>
                <td>{{$outgoingLetter->registration_date}}</td>
                <td>{{$outgoingLetter->destination}}</td>
                <td>{{$outgoingLetter->document_name}}</td>
                <td>{{$outgoingLetter->document_subject}}</td>
                <td>{{$outgoingLetter->signer}}</td>
                <td>{{$outgoingLetter->performer}}</td>
                <td>{{$outgoingLetter->incoming_number}}</td>
                <td>
                    <div class="actions">
                        <a href="{{ route('outgoing_letter.edit', $outgoingLetter->id) }}"><img src="/img/edit-img.svg"
                                alt="edit"></a>
                        <form action="{{ route('outgoing_letter.delete', $outgoingLetter->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-light delete_button" type="submit"><img src="/img/delete-imf.svg"
                                    alt="delete"></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination__div">
        {{ $outgoingLetters->withQueryString()->links() }}
    </div>
    <script src="/autocomplete/autoComplete.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/search.js"></script>
</body>

</html>
