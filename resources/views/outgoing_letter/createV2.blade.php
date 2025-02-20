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
    <h1>Регистрация исходящего документа</h1>
    <p>Заполните все поля для регистрации документа</p>
    <div class="incoming_letter_container">
        <form action="{{ route('outgoing_letter.store') }}" method="post" class="form-div">
            @csrf
                <div class="form-floating mb-3">
                    <input type="datetime-local" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Дата регистрации</label>
                </div>
           
                <div class="form-floating">
                    <input class="form-control" placeholder="Docs">
                    <label for="floatingPassword">Кому поступил документ</label>
                </div>

                <div class="form-floating">
                    <input class="form-control" placeholder="Namedocs">
                    <label for="floatingPassword">Наименование документа</label>
                </div>

                <div class="form-floating">
                    <input class="form-control" placeholder="Signature">
                    <label for="floatingPassword">Подписан</label>
                </div>

                <div class="form-floating">
                    <input class="form-control" placeholder="Executor">
                    <label for="floatingPassword">Ответственный исполнитель</label>
                </div>

                <div class="form-floating">
                    <input class="form-control" placeholder="Executor">
                    <label for="floatingPassword">Отметка об исполнении (на вх. №)</label>
                </div>

                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option selected>Откройте это меню выбора</option>
                        <option value="1">Dr.</option>
                        <option value="2">Prof.</option>
                        <option value="3">Ms.</option>
                        <option value="4">Mr.</option>
                        <option value="5">Mrs.</option>
                    </select>
                    <label for="floatingSelect">Классификатор</label>
                </div>

                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Тема документа</label>
                </div>     
        </form>

            <div>
                <div class="btn-div"><button type="submit">Создать</button></div>
            </div>
            
    </div>
    <script src="/autocomplete/autoComplete.min.js"></script>
    <script src="/js/outgoing_letter/search_fields.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
