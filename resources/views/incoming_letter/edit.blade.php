<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/outcomingLetter.css') }}">
    <title>Document</title>
</head>
<body>
    <h1>Изменение сведений входящего документа</h1>
    <p>Заполните все поля для изменения сведений</p>
    <div class="outgoing_letter_container">
        <form action="{{ route('incoming_letter.update', $incomingLetter->id) }}" method="post" class="form-div">
            @csrf
            @method('patch')
            <div class="incoming_letter_form">
            <label for="registration_date">Дата регистрации</label>
            <input type="date" name="registration_date" id="registration_date" value="{{ $incomingLetter->registration_date }}">

            <label for="document_from_id">От кого поступил документ</label>
            <select name="document_from_id" id="document_from_id">
                @foreach ($document_froms as $document_from)
                    <option
                    {{ $document_from->id === $incomingLetter->document_from->id ? ' selected' : '' }}
                    value="{{ $document_from->id }}">{{ $document_from->organisation_name }}</option>
                @endforeach
            </select>

            <label for="document_name_id">Наименование документа</label>
            <select name="document_name_id" id="document_name_id">
                @foreach ($document_names as $document_name)
                <option
                {{ $document_name->id === $incomingLetter->document_name->id ? ' selected' : '' }}
                value="{{ $document_name->id }}">{{ $document_name->name }}</option>
                @endforeach
            </select>

            <label for="document_number">Номер документа</label>
            <input type="number" name="document_number" id="document_number" value="{{ $incomingLetter->document_number }}">

            <label for="document_date">Дата документа</label>
            <input type="date" name="document_date" id="document_date" value="{{ $incomingLetter->document_date }}">

            <label for="document_subject">Тема документа</label>
            <textarea name="document_subject" id="document_subject">{{ $incomingLetter->document_subject }}</textarea></div>

            <div class="incoming_letter_form">
            <label for="resolution">Резолюция</label>
            <textarea name="resolution" id="resolution">{{ $incomingLetter->resolution }}</textarea>

            <label for="performer_id">Ответственный исполнитель</label>
            <select name="performer_id" id="performer_id">
                @foreach ($performers as $performer)
                <option
                {{ $performer->id === $incomingLetter->performer->id ? ' selected' : '' }}
                value="{{ $performer->id }}">{{ $performer->performer_name }}</option>
                @endforeach
            </select>

            <label for="deadline">Срок исполнения</label>
            <input type="date" name="deadline" id="deadline" value="{{ $incomingLetter->deadline }}">

            <label for="status_id">Статус</label>
            <select name="status_id" id="status_id">
                @foreach ($statuses as $status)
                <option
                {{ $status->id === $incomingLetter->status->id ? ' selected' : '' }}
                value="{{ $status->id }}">{{ $status->status_name }}</option>
                @endforeach
            </select>

            <label for="classificator_id">Классификатор</label>
            <select name="classificator_id" id="classificator_id">
                @foreach ($classificators as $classificator)
                <option
                {{ $classificator->id === $incomingLetter->classificator->id ? ' selected' : '' }}
                value="{{ $classificator->id }}">{{ $classificator->classificator_name }}</option>
                @endforeach
            </select></div>

            <div class="btn-div"><button type="submit">Изменить</button></div>
        </form>
    </div>
</body>
</html>
