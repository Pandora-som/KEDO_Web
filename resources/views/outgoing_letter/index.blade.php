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
    <h1>Реестр регистрации исходящих документов</h1>

    <div class="func-block">
        <input list="organisationName" type="text" name="choiser" placeholder="  Классификация" class="choiser">
    <datalist id="organisationName">
        <option value="Все">
        <option value="УрФУ">
        <option value="МИНОБРНАУКИ">
        <option value="НТИ(филиал)">
        <option value="Сторонние">
    </datalist>
        <p><img src="img/search.svg" height="35px" width="35px" alt="search"><input type="text" name="search" placeholder=" Поиск по параметру"></p>
        <button class="filter-btn"><img src="img/filter.svg">фильтры</button>
        <a class="create-btn" href="{{route('outgoing_letter.create')}}"><img src="img/plus (1).svg">Создать</a>
    </div>

    <table class="table-info">
        <tbody>
          <tr>
            <td class="title-table">Регистрационный номер</td>
            <td class="title-table">Дата регистрации</td>
            <td class="title-table">Кому адресован документ</td>
            <td class="title-table">Наименование документа</td>
            <td class="title-table">Тема документа</td>
            <td class="title-table">Подписант</td>
            <td class="title-table">Исполнитель</td>
            <td class="title-table">Отметка об исполнении (на вх. №)</td>
          </tr>
          @foreach ($outgoingLetters as $outgoingLetter)
            <tr>
                <td>{{$outgoingLetter->id}}</td>
                <td>{{$outgoingLetter->registarion_date}}</td>
                <td>{{$outgoingLetter->destination->destination_name}}</td>
                <td>{{$outgoingLetter->document_name->name}}</td>
                <td>{{$outgoingLetter->document_subject}}</td>
                <td>{{$outgoingLetter->signer->signer_name}}</td>
                <td>{{$outgoingLetter->performer->performer_name}}</td>
                <td>
                    {{$outgoingLetter->incoming_number}}
                    <div>
                        <a href="{{ route('outgoing_letter.edit', $outgoingLetter->id) }}"><img src="/img/edit-img.svg" alt="edit"></a>
                        <form action="{{ route('outgoing_letter.delete', $outgoingLetter->id) }}" method="post">
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
