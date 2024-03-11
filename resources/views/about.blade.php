@extends('layout')

@section('content')

<div class="content">
    <div class="main">
        <div class="header">
            <h1>About</h1>
        </div>
        <?= dd(auth()->user()); ?>
</div>


@endsection