<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/outcomingLetter.css') }}">
    <link rel="stylesheet" href="{{ asset('autocomplete/css/autoComplete.css') }}">
    <title>СЭД УрФУ</title>
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
                <input type="datetime-local" name="registration_date" id="registration_date" value="{{ $incomingLetter->registration_date }}">
                @error('registration_date')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="document_from">От кого поступил документ</label>
                <input name="document_from" id="document_from" value="{{ $incomingLetter->document_from }}">
                <input id="document_from_for_js" name="document_from_for_js" style="display: none" value="{{ $document_froms }}">
                @error('document_from')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="document_name">Наименование документа</label>
                <input name="document_name" id="document_name" value="{{ $incomingLetter->document_name }}">
                <input id="document_name_for_js" name="document_name_for_js" style="display: none" value="{{ $document_names }}">
                @error('document_name')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="document_number">Номер документа</label>
                <input type="number" name="document_number" id="document_number" value="{{ $incomingLetter->document_number }}">
                @error('document_number')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="document_date">Дата документа</label>
                <input type="date" name="document_date" id="document_date" value="{{ $incomingLetter->document_date }}">
                @error('document_date')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="document_subject">Тема документа</label>
                <textarea name="document_subject" id="document_subject">{{ $incomingLetter->document_subject }}</textarea>
                @error('document_subject')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="incoming_letter_form">
                <label for="resolution">Резолюция</label>
                <textarea name="resolution" id="resolution">{{ $incomingLetter->resolution }}</textarea>
                @error('resolution')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="performer">Ответственный исполнитель</label>
                <input name="performer" id="performer" value="{{ $incomingLetter->performer }}">
                <input id="performer_for_js" name="performer_for_js" style="display: none" value="{{ $performers }}">
                @error('performer')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="deadline">Срок исполнения</label>
                <input type="date" name="deadline" id="deadline" value="{{ $incomingLetter->deadline }}">
                @error('deadline')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="status_id">Статус</label>
                <select name="status_id" id="status_id">
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" {{ $incomingLetter->status_id === $status->id ? 'selected' : '' }}>{{ $status->status_name }}</option>
                    @endforeach
                </select>

                <label for="classificator_id">Классификатор</label>
                <select name="classificator_id" id="classificator_id">
                    @foreach ($classificators as $classificator)
                        <option value="{{ $classificator->id }}" {{ $incomingLetter->classificator_id === $classificator->id ? 'selected' : '' }}>{{ $classificator->classificator_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="btn-div"><button type="submit">Изменить</button></div>
        </form>
    </div>
    <script src="/autocomplete/autoComplete.min.js"></script>
    <script src="/js/incoming_letter/search_fields.js"></script>
</body>
</html>
