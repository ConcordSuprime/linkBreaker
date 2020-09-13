@extends('layouts.page')
@section('content')
    <div class="title m-b-md">
        LinkBreaker
    </div>
    <div style="display: flex;justify-content: center;align-items: center;flex-direction: column;">

        @if($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: red">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('create-short-link')}}" method="post" style="display: flex;flex-direction: column; min-width: 400px;">
            @csrf
            <label>
                Целевая ссылка
            </label>
            <input name="original_link" type="text" value="{{old('original_link')}}">

            <label>
                Дата истечения срока действия
            </label>
            <input name="expiry_date" type="date" value="{{old('expiry_date')?:$currentDate}}">

            <label>
                Свой текст для ссылки
            </label>
            <input name="custom_link" type="text"  value="{{old('custom_link')}}">

            <label style="color: black">
                <input name="is_commercial" type="checkbox">
                Комерческая
            </label>

            <button type="submit" style="padding: 10px;border-radius: 5px; font-size: 18px">Уменьшить</button>
        </form>
    </div>

@endsection
