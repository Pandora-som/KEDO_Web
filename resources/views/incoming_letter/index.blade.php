<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset(path: 'css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="/autocomplete/css/autoComplete.css">

</head>
<body>
    <div class="header_line">
        <div class="logo-nav"><img src="img/logo.svg">
        <nav class="nav">
            <a href="{{route('outgoing_letter.index')}}" class="link">Исходящие документы</a>
            <a href="{{route('incoming_letter.index')}}" class="link">Входящие документы</a>
        </nav></div>
        <div class="circle">
            <img src="img/User.svg" height="35px" width="35px" alt="user">
        </div>
    </div>
    <h1>Реестр регистрации входящих документов</h1>

    <div class="func-block">
        <div class="dropdown">
            <button name="choiser" class="choiser dropbtn">Фильтры  ⮟</button>
            <div class="dropdown__content">
                <form action="{{ url()->full() }}" method="GET">
                    <h3>Классификация</h3>
                    @foreach ($classificators as $classificator)
                    <input type="radio" id="{{ $classificator->classificator_name }}"
                        {{ $request->query('classificator_id') == $classificator->id ? ' checked' : '' }} name="classificator_id"
                        value="{{ $classificator->id }}">
                        <label for="{{ $classificator->classificator_name }}">{{ $classificator->classificator_name }}</label>
                    @endforeach
                    <a href="{{ request()->fullUrlWithoutQuery('classificator_id') }}">Очистить классификацию</a>

                    <div class="date__filter">
                        <label for="start_date">Дата с:</label>
                        <input id="start_date" type="date" name="start_date" value="{{ $request->query('start_date') ? $request->query('start_date') : date('Y-m-d', strtotime('last month'))}}">

                        <label for="end_date">по:</label>
                        <input id="end_date" type="date" name="end_date" value="{{ $request->query('end_date') ? $request->query('end_date') : now()->format('Y-m-d') }}">
                    </div>

                    <button>Отфильтровать</button>
                </form>
            </div>
        </div>
        <input id="autoComplete" type="text" name="search">
        <input id="incomingLettersForJs" type="text" style="display: none" value="{{ $incomingLetters }}">
        <a class="bin-btn" href="#"><img src="img/bin.svg">корзина</a>
        <a class="create-btn" href="{{route('incoming_letter.create')}}"><img src="img/plus (1).svg">Создать</a>
    </div>

    <table class="table-info">
        <tbody>
          <tr>
            <td class="title-table">Регистрационный номер</td>
            <td class="title-table">Дата регистрации</td>
            <td class="title-table">От кого поступил документ</td>
            <td class="title-table">Наименование документа</td>
            <td class="title-table">Номер документа</td>
            <td class="title-table">Дата документа</td>
            <td class="title-table">Тема документа</td>
            <td class="title-table">Резолюция</td>
            <td class="title-table">Ответственный исполнитель </td>
            <td class="title-table">Срок исполнения</td>
            <td class="title-table">Отметка об исполнении</td>
          </tr>
          @foreach ($incomingLetters as $incomingLetter)
            <tr>
                <td>{{$incomingLetter->id}}</td>
                <td>{{$incomingLetter->registration_date}}</td>
                <td>{{$incomingLetter->document_from->organisation_name}}</td>
                <td>{{$incomingLetter->document_name->name}}</td>
                <td>{{$incomingLetter->document_number}}</td>
                <td>{{$incomingLetter->document_date}}</td>
                <td>{{$incomingLetter->document_subject}}</td>
                <td>{{$incomingLetter->resolution}}</td>
                <td>{{$incomingLetter->performer->performer_name}}</td>
                <td>{{$incomingLetter->deadline}}</td>
                <td>
                    {{$incomingLetter->status->status_name}}
                    <div>
                        <a href="{{ route('incoming_letter.edit', $incomingLetter->id) }}"><img src="/img/edit-img.svg" alt="edit"></a>
                        <form action="{{ route('incoming_letter.delete', $incomingLetter->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"><img src="/img/delete-imf.svg" alt="delete"></button>
                        </form>
                    </div>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <script src="/autocomplete/autoComplete.min.js"></script>
      <script src="/js/search.js"></script>
</body>
</html>
