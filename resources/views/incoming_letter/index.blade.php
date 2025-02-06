<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset(path: 'css/main.css') }}">
</head>
<body>
    <div class="header_line">
        <nav class="nav">
            <a href="{{route('outgoing_letter.index')}}" class="link">Исходящие документы</a>
            <a href="{{route('incoming_letter.index')}}" class="link">Входящие документы</a>
        </nav>
    </div>
    <div class="circle">
        <img src="img/User.svg" height="35px" width="35px" alt="user">
    </div>
    <h1>Реестр регистрации входящих документов</h1>

    <div class="func-block">
        <input list="organisationName" type="text" name="choiser" placeholder="  Классификация" class="choiser">
        <form action="{{ route('incoming_letter.index') }}" method="POST">
            @csrf
            <select name="classificator_id" id="classificator_id">
                <option value="0">Все</option>
                @foreach ($classificators as $classificator)
                    <option value="{{ $classificator->id }}">{{ $classificator->classificator_name }}</option>
                @endforeach
            </select>
            <button type="submit"><img src="/img/search.svg" alt="search"></button>
        </form>
        <p><img src="img/search.svg" height="35px" width="35px" alt="search"><input type="text" name="search" placeholder="              Поиск по параметру"></p>
        <button class="filter-btn"><img src="img/filter.svg">фильтры</button>
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
</body>
</html>
