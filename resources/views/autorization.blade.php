<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset(path: 'css/autorization.css') }}">
</head>
<body>
    <div class="header_line">
        <div class="logo-nav"><img src="img/logo.svg"></div>

        <a href="{{route('autorization')}}">
            <div class="circle">
                <img src="img/User.svg" height="35px" width="35px" alt="user">
            </div>
        </a>
    </div>
    <h1>СИСТЕМА РЕГИСТРАЦИИ ДОКУМЕНТОВ</h1>
    <form method="post" action="{{route("auth")}}">
        @csrf
        <div class="autorization-block">
        <p class="title-p">Вход</p>
    <div class="all-div">
        <div class="small-div">
            <div class="input-block">
                <div class="login-group">
                    <img src="img/login-img.svg">
                    <div class="login-div">
                        <label>Логин</label>
                        <input type="text" class="input-style">
                    </div>
                </div>
                <div class="password-group">
                    <img src="img/GroupKey (1).svg">
                    <div class="password-div">
                        <label>Пароль</label>
                        <input type="password" class="input-pwd-style">
                    </div>
                </div>
            </div>
        </div>
        <div class="checkbox-div">
            <input type="checkbox" id="remember_me" class="checkbox-style"> <label for="remember_me">запомнить меня</label>
        </div>
        <button class="enter-btn" type="submit">ВОЙТИ</button>
    </div>
    </div></form>
</body>
</html>
