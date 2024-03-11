@extends('layout')

@section('content')

<div class="content">
    <div class="main">
        <div class="header">
            <h1>Log in</h1>
        </div>

        <form method="POST" action="/login">
            <div class="register_container">
                @csrf
               
                <label for="email"><b>Email</b></label>
                <input class="registerfield" type="text" name="email" id="email" required value="{{ old('email') }}">

                <label for="password"><b>Password</b></label>
                <input class="registerfield" type="password" name="password" id="password" required><br>

                <button type="submit" class="btn btn-color-1 btn-register">Log in</button>

                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </form>
    </div>


    @endsection