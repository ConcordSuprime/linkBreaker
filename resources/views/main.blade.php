@extends('layouts.page')
@section('content')
    <div style="font-size: 72px; text-align: center;width: 100%;">
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
            <label for="original_link">
                Целевая ссылка
            </label>
            <input class="form-control" id="original_link" name="original_link" type="text" value="{{old('original_link')}}">

            <label for="expiry_date">
                Дата истечения срока действия
            </label>
            <input class="form-control" id="expiry_date" name="expiry_date" type="date" value="{{old('expiry_date')?:$currentDate}}">

            <label for="basic-url">Свой текст для ссылки</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">http://linkbreaker/</span>
                </div>
                <input type="text" class="form-control" name="custom_link" id="basic-url" aria-describedby="basic-addon3" value="{{old('custom_link')}}">
            </div>

            <label style="color: black">
                <input  name="is_commercial" type="checkbox">
                Комерческая
            </label>

            <button type="submit" style="padding: 10px;border-radius: 5px; font-size: 18px">Уменьшить</button>
        </form>
    </div>

@endsection
