@extends('layout')

@section('content')

<div class="content">
    <div class="main">
        <div class="header">
            <h1>Register a new user</h1>
        </div>

        <form method="POST" action="/register">
            <div class="register_container">
                @csrf

                <label for="username"><b>Username</b></label>
                <input class="registerfield" type="username" name="username" id="username" required value="{{ old('username') }}">

                <label for="email"><b>Email</b></label>
                <input class="registerfield" type="text" name="email" id="email" required value="{{ old('email') }}">

                <label for="password"><b>Password</b></label>
                <input class="registerfield" type="password" name="password" id="password" required><br>

                <!-- <label for="password-repeat"><b>Repeat Password</b></label>
                <input type="password" name="password-repeat" id="password-repeat" required> -->

                <button type="submit" class="btn btn-color-1 btn-register">Register</button>

                <div class="signin_container">
                    <p>Already have an account? <a class="btn btn-color-1" href="/login">Sign in</a></p>
                </div>

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