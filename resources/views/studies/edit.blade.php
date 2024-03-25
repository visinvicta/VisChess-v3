@extends('layout')

@section('content')

<div class="content">
    <div class="main">
        <div class="header">
            <h1>Edit the study</h1>
        </div>

        <form method="POST" action="{{ route('studies.update', ['study' => $study->id]) }}">
            @csrf
            @method('PUT')

            <div class="register_container">
                <label for="name"><b>Name</b></label>
                <input class="form-control" type="text" name="name" id="name" required value="{{ $study->name }}">

                <label for="description"><b>Description</b></label>
                <textarea class="form-control" name="description" id="description" required>{{ $study->description }}</textarea>

                <button type="submit" class="btn btn-color-1">Update Study</button>

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
