@extends('layout')

@section('content')

<div class="content">
    <div class="main">
        <div class="header">
            <h1>Studies</h1>
        </div>

        <a href="/studies/create" class="btn btn-color-1 btn-study btn-study-create">Study +</a>

        <div class="studies-container">
            @foreach ($studies as $study)
            <div class="study">
                <div class="study-info">
                    <div class="study-name">{{ $study->name }}</div>
                    <div class="study-description">{{ $study->description }}</div>
                </div>
                <a href="/study/{{ $study->id }}" class="btn btn-color-1 btn-study">View study</a>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script src="{{ asset('/js/games.js') }}"></script>

@endsection
