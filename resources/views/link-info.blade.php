@extends('layouts.page')
@section('content')


    <div  style="display: flex; flex-direction: column; align-items: center">
        <div class="col-sm-10">
            <div class="card" style="margin: 20px;">
                <div class="card-header">
                    Информация по ссылке <a href="{{config('app.url').'/'.$link->short}}">{{config('app.url').'/'.$link->short}}</a>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        Оригинальная ссылка:
                        <br>
                        <a href="{{$link->original}}">{{$link->original}}</a>
                    </li>
                    <li class="list-group-item">Короткая ссылка: <a href="{{$link->shortLink()}}">{{$link->shortLink()}}</a></li>
                    <li class="list-group-item">Ссылка Для проверки статистики: <a href="{{config('app.url').'/'.$link->infoLink().'/info'}}"> {{config('app.url').'/'.$link->info_link.'/info'}}</a></li>
                    <li class="list-group-item">Дата истечения срока действия: {{date('d.m.Y',strtotime($link->expiry_date))}}</li>
                    <li class="list-group-item">Дата создания: {{date('d.m.Y',strtotime($link->created_at))}}</li>
                    <li class="list-group-item">Количества переходов: {{count($link->redirectHistories)}}</li>
                </ul>
            </div>
        </div>
        <div class="col-sm-10" style="margin: 30px;">
            <div style=" display: flex;justify-content: space-between;">
                <h3>Посещения</h3>
                <div style="right: 20px;">
                    {{$redirectHistories->links()}}
                </div>
            </div>
            <div style="display: flex;padding: 20px; flex-wrap: wrap;">
                @foreach($redirectHistories as $history)
                    <div class="card col-sm-2" style="margin: 20px;display: flex; flex-direction: column;align-items: center">
                        @if($history->img != null)
                            <img src="/{{$history->img}}"  width="200" height="200">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">ip пользователя: {{$history->user_ip}}</h5>
                            <p class="card-text">Дата перехода: {{$history->transitionTime()}}</p>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>

    </div>



@endsection
