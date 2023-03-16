@extends('common.layout')
@section('title', 'マイページ')
@section('content')
@section('css')
<link rel="stylesheet" href="{{ asset('/css/user/mypage.css') }}?1"/>
@endsection
<div class="container-fluid">
    <div class="row">
        <div class="offset-4 col-4 mt-5">
            <div class="info">
                <h1>{{ $user->name }}</h1>
                <p>Login ID: {{ $user->login_id }}</p>
                <p>役職: {{ $user->getRoleName() }}</p>
                <p>誕生日: {{ $user->birthday }}</p>
                <p>星座: {{ $user->getSign() }}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="offset-4 col-4 mt-5">
            <form action="/user/logout" method="post">
                @csrf
                <button class="logout">Logout</button>
            </form>
        </div>
    </div>
</div>
@endsection
