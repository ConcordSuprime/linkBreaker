@extends('layouts.page')
@section('content')
    <div style="display: flex; justify-content: center;flex-direction: column;align-items: center;margin-top: 100px;">
        <img  src="{{$img}}" width="200" height="200">
        <br>
        <h1>
            Пожалуйста подождите 5 секунд. Мы перенаправим вас  на целевую страницу.
        </h1>
    </div>

    <script>
        function redirect(){
            window.location.href = "{{$href}}"
        }

        setTimeout(redirect, 5000);
    </script>
@endsection

