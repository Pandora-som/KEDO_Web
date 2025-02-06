<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/incomingLetter.css') }}">
    <title>Document</title>
</head>
<body>
    <h1>Регистрация исходящего документа</h1>
    <p>Заполните все поля для регистрации документа</p>
    <div class="incoming_letter_container">
        <form action="{{ route('outgoing_letter.store') }}" method="post" class="incoming_letter_form">
            @csrf
            <label for="registarion_date">Дата регистрации</label>
            <input type="datetime-local" name="registarion_date" id="registarion_date">

            <label for="destination_id">Кому поступил документ</label>
            <select name="destination_id" id="destination_id">
                @foreach ($destinations as $destination)
                    <option value="{{ $destination->id }}">{{ $destination->destination_name }}</option>
                @endforeach
            </select>

            <label for="document_name_id">Наименование документа</label>
            <select name="document_name_id" id="document_name_id">
                @foreach ($document_names as $document_name)
                    <option value="{{ $document_name->id }}">{{ $document_name->name }}</option>
                @endforeach
            </select>

            <label for="document_subject">Тема документа</label>
            <textarea name="document_subject" id="document_subject"></textarea>

            <label for="signer_id">Подписант</label>
            <select name="signer_id" id="signer_id">
                @foreach ($signers as $signer)
                    <option value="{{ $signer->id }}">{{ $signer->signer_name }}</option>
                @endforeach
            </select>

            <label for="performer_id">Исполнитель</label>
            <select name="performer_id" id="performer_id">
                @foreach ($performers as $performer)
                    <option value="{{ $performer->id }}">{{ $performer->performer_name }}</option>
                @endforeach
            </select>

            <label for="incoming_number">Отметка об исполнении (на вх. №)</label>
            <input type="number" name="incoming_number" id="incoming_number">

            <label for="classificator_id">Классификатор</label>
            <select name="classificator_id" id="classificator_id">
                @foreach ($classificators as $classificator)
                    <option value="{{ $classificator->id }}">{{ $classificator->classificator_name }}</option>
                @endforeach
            </select>

            <button type="submit">Создать</button>
        </form>
    </div>
</body>
</html>
