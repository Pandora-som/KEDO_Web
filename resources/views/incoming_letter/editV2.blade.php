<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/create_edit.css') }}">
    <link rel="stylesheet" href="{{ asset('autocomplete/css/autoComplete.css') }}">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body class="p-3 m-0 border-0 bd-example m-0 border-0">
    <h1>Изменение сведений входящего документа</h1>
    <p>Заполните все поля для изменения сведений</p>
    <div class="incoming_letter_container">
        <form action="{{ route('incoming_letter.update', $incomingLetter->id) }}" method="post">
            @csrf
            @method('patch')
                <div class="form-div">
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" name="registration_date" id="registration_date" value="{{ $incomingLetter->registration_date }}">
                        <label for="registration_date">Дата регистрации</label>
                    @error('registration_date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="document_date" id="document_date" value="{{ $incomingLetter->document_date }}">
                        <label for="document_date">Дата документа</label>
                        @error('document_date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="form-floating">
                        <input class="form-control" name="document_from" id="document_from"  value="{{ $incomingLetter->document_from }}" autocomplete="off">
                        {{-- <label for="document_from">От кого поступил документ</label> --}}
                        @error('document_from')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                    <input id="document_from_for_js" name="document_from_for_js" style="display: none" value="{{ $document_froms }}">

                    <div class="form-floating">
                        <input class="form-control" name="performer" id="performer" value="{{ $incomingLetter->performer }}" autocomplete="off">
                        {{-- <label for="performer">Ответственный исполнитель</label> --}}
                        @error('performer')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                    <input id="performer_for_js" name="performer_for_js" style="display: none" value="{{ $performers }}">

                    <div class="form-floating">
                        <input class="form-control" name="document_name" id="document_name" value="{{ $incomingLetter->document_name }}" autocomplete="off">
                        {{-- <label for="document_name">Наименование документа</label> --}}
                        @error('document_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                    <input id="document_name_for_js" name="document_name_for_js" style="display: none" value="{{ $document_names }}">

                    <div class="form-floating">
                        <select class="form-select" name="classificator_id" id="classificator_id" aria-label="Floating label select example">
                            @foreach ($classificators as $classificator)
                                <option value="{{ $classificator->id }}" {{ $incomingLetter->classificator_id === $classificator->id ? 'selected' : '' }}>{{ $classificator->classificator_name }}</option>
                            @endforeach
                        </select>
                        <label for="classificator_id">Классификатор</label>
                    </div>

                    <div class="form-floating">
                        <input class="form-control" name="document_number" id="document_number" value="{{ $incomingLetter->document_number }}">
                        <label for="document_number">Номер документа</label>
                        @error('document_number')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <select class="form-select" name="status_id" id="status_id">
                            @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" {{ $incomingLetter->status_id === $status->id ? 'selected' : '' }}>{{ $status->status_name }}</option>
                    @endforeach
                        </select>
                        <label for="status_id">Статус</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="deadline" id="deadline">
                        <label for="deadline">Срок исполнения</label>
                        @error('deadline')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>


                    <div class="form-floating">
                        <textarea class="form-control" name="resolution" id="resolution">{{ $incomingLetter->resolution }}</textarea>
                        <label for="resolution">Резолюция</label>
                        @error('resolution')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" name="document_subject" id="document_subject">{{ $incomingLetter->document_subject }}</textarea>
                        <label for="document_subject">Тема документа</label>
                        @error('document_subject')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="btns-div">
                    <a class="btn btn-outline-secondary" href=" {{ route('incoming_letter.index') }}" class="back-link">Назад</a>
                    <button class="btn btn-primary" type="submit">Изменить</button>
                </div>
        </form>

    </div>
    <script src="/autocomplete/autoComplete.min.js"></script>
    <script src="/js/incoming_letter/search_fields.js"></script>
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
