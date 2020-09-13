@extends('layouts.page')
@section('content')
  <div>
        Информация по ссылке {{$link->short}}
  </div>
    <ul>
        <li>Оригинальная ссылка: {{$link->original}}</li>
        <li>Короткая ссылка: {{$link->short}}</li>
        <li>Дата истечения срока действия: {{date('d.m.Y',strtotime($link->expiry_date))}}</li>
        <li>Дата создания: {{date('d.m.Y',strtotime($link->created_at))}}</li>
    </ul>

@endsection
