@extends('common.layout')
@section('title', 'Login')
@section('css')
<link rel="stylesheet" href="{{ asset('/css/user/login.css') }}"/>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form action="/user/login" method="POST">
                <h1>TC<span>Practice</span></h1>
                <input placeholder="Login ID" name='login_id' type="text"/>
                <input placeholder="Password" name='password' type="password"/>
                <button class="btn">Login</button>
                @csrf
            </form>
        </div>
    <div>
</div>
@endsection
