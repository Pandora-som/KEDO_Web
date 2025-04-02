<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/create_edit.css') }}">
    <link rel="stylesheet" href="{{ asset('autocomplete/css/autoComplete.css') }}">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <title>{{ config('app.name', 'СЭД УрФУ') }}</title>
</head>
<body class="p-3 m-0 border-0 bd-example m-0 border-0">
    <h1>Регистрация исходящего документа</h1>
    <p>Заполните все поля для регистрации документа</p>
    {{-- <a href=" {{ url()->previous() }}"><img src="/img/back-img.svg"></a> --}}
    <div class="incoming_letter_container">
        <form action="{{ route('outgoing_letter.store') }}" method="post">
            @csrf
            <div class="form-div">
                <div class="form-floating mb-3">
                    <input class="form-control" name="registration_number" id="registration_number">
                    <label for="registration_number">Регистрационный номер</label>
                    @error('registration_number')
                    <div class="error">{{ $message }}</div>
                @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="datetime-local" class="form-control" name="registration_date" id="registration_date">
                    <label for="registration_date">Дата регистрации</label>
                    @error('registration_date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input class="form-control" name="destination" id="destination" autocomplete="off">
                    {{-- <label for="destination">Кому поступил документ</label> --}}
                    @error('destination')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <input id="destination_for_js" name="destination_for_js" style="display: none" value="{{ $destinations }}" autocomplete="off">

                <div class="form-floating">
                    <input class="form-control" name="document_name" id="document_name">
                    {{-- <label for="document_name">Наименование документа</label> --}}
                    @error('document_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <input id="document_name_for_js" name="document_name_for_js" style="display: none" value="{{ $document_names }}" autocomplete="off">

                <div class="form-floating">
                    <input class="form-control" name="performer" id="performer">
                    {{-- <label for="performer">Ответственный исполнитель</label> --}}
                    @error('performer')
                    <div class="error">{{ $message }}</div>
                @enderror
                </div>
                <input id="performer_for_js" name="performer_for_js" style="display: none" value="{{ $performers }}">

                <div class="form-floating">
                    <input class="form-control" name="signer" id="signer" autocomplete="off">
                    {{-- <label for="signer">Подписан</label> --}}
                    @error('signer')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <input id="signer_for_js" name="signer_name_for_js" style="display: none" value="{{ $signers }}">

                <div class="form-floating mb-3">
                    <input class="form-control" name="incoming_number" id="incoming_number">
                    <label for="incoming_number">Отметка об исполнении (на вх. №)</label>
                    @error('incoming_number')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating">
                    <select class="form-select" name="classificator_id" id="classificator_id" aria-label="Floating label select example">
                        @foreach ($classificators as $classificator)
                            <option value="{{ $classificator->id }}">{{ $classificator->classificator_name }}</option>
                        @endforeach
                    </select>
                    <label for="classificator_id">Классификатор</label>
                </div>

                <div class="form-floating">
                    <textarea class="form-control" name="document_subject" id="document_subject"></textarea>
                    <label for="document_subject">Тема документа</label>
                    @error('document_subject')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="btns-div mt-3">
                <a class="btn btn-outline-secondary" href=" {{ route('outgoing_letter.index') }}" class="back-link">Назад</a>
                <button class="btn btn-primary" type="submit">Создать</button>
            </div>
        </form>
    </div>
    <script src="/autocomplete/autoComplete.min.js"></script>
    <script src="/js/outgoing_letter/search_fields.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
