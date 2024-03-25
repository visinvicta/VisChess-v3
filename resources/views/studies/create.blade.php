@extends('layout')

@section('content')

<div class="content">
    <div class="main">
        <div class="header">
            <h1>Create a study</h1>
        </div>

        <form method="POST" action="/studies">
            <div class="register_container">
                @csrf

                <label for="name"><b>Name</b></label>
                <input class="form-control" type="text" name="name" id="name" required value="{{ old('name') }}">

                <label for="description"><b>Description</b></label>
                <textarea class="form-control" name="description" id="description" required>{{ old('description') }}</textarea>

                <button type="submit" class="btn btn-color-1">Create Study</button>

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
</div>
@endsection