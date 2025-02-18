<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/incomingLetter.css') }}">
    <link rel="stylesheet" href="{{ asset('autocomplete/css/autoComplete.css') }}">
    <title>Document</title>
</head>
<body>
    <h1>Изменение сведений исходящего документа</h1>
    <p>Заполните все поля для изменения сведений</p>
    <div class="incoming_letter_container">
        <form action="{{ route('outgoing_letter.update', $outgoingLetter->id) }}" method="post" class="form-div">
            @csrf
            @method('patch')
            <div class="incoming_letter_form">
                <label for="registration_date">Дата регистрации</label>
                <input type="datetime-local" name="registration_date" id="registration_date"
                    value="{{ $outgoingLetter->registration_date }}">
                @error('registration_date')
                <div class="error">{{ $message }}</div>
                @enderror

                <label for="destination">Кому поступил документ</label>
                <input name="destination" id="destination" value="{{ $outgoingLetter->destination }}">
                <input id="destination_for_js" name="destination_for_js" style="display: none" value="{{ $destinations }}">
                @error('destination')
                <div class="error">{{ $message }}</div>
                @enderror

                <label for="document_name">Наименование документа</label>
                <input name="document_name" id="document_name" value="{{ $outgoingLetter->document_name }}">
                <input id="document_name_for_js" name="document_name_for_js" style="display: none"
                    value="{{ $document_names }}">
                @error('document_name')
                <div class="error">{{ $message }}</div>
                @enderror

                <label for="document_subject">Тема документа</label>
                <textarea name="document_subject" id="document_subject">{{ $outgoingLetter->document_subject }}</textarea>
                @error('document_subject')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>


            <div class="incoming_letter_form">
                <label for="signer">Подписант</label>
                <input name="signer" id="signer" value="{{ $outgoingLetter->signer }}">
                <input name="signer_for_js" id="signer_for_js" style="display: none" value="{{ $signers }}">
                @error('signer')
                <div class="error">{{ $message }}</div>
                @enderror

                <label for="performer">Ответственный исполнитель</label>
                <input name="performer" id="performer" value="{{ $outgoingLetter->performer }}">
                <input id="performer_for_js" name="performer_for_js" style="display: none" value="{{ $performers }}">
                @error('performer')
                <div class="error">{{ $message }}</div>
                @enderror

                <label for="incoming_number">Отметка об исполнении (на вх. №)</label>
                <input type="text" name="incoming_number" id="incoming_number"
                    value="{{ $outgoingLetter->incoming_number }}">
                @error('incoming_number')
                <div class="error">{{ $message }}</div>
                @enderror

                <label for="classificator_id">Классификатор</label>
                <select name="classificator_id" id="classificator_id">
                    @foreach ($classificators as $classificator)
                    <option value="{{ $classificator->id }}"
                        {{ $classificator->id === $outgoingLetter->classificator_id ? 'selected' : '' }}>
                        {{ $classificator->classificator_name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="btn-div"><button type="submit">Изменить</button></div>
        </form>
    </div>
    <script src="/autocomplete/autoComplete.min.js"></script>
    <script src="/js/outgoing_letter/search_fields.js"></script>
</body>
</html>
