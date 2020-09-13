@extends('layouts.page')
@section('content')
    <div style="display: flex;flex-direction: column; align-items: center;">
        <h1>Стаистика посещений за последние 14 дней</h1>
        <div style="width: 100%">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Коротка ссылка</th>
                    <th scope="col">Целевая ссылка</th>
                    <th scope="col">Комерческая</th>
                    <th scope="col">Кол. переходов</th>
                    <th scope="col">Дествия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($links as $key => $link)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <td><a href="{{$link['short']}}">{{$link['short']}}</a></td>
                    <td><a href="{{$link['original']}}">{{$link['original']}}</a></td>
                    <td>{{$link['is_commercial']?'Да':'Нет'}}</td>
                    <td>{{$link['count']}}</td>
                    <td><a href="{{$link['info_link']}}" class="btn btn-sm btn-success" style="color: white">Инфо</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
