@extends('layout')

@section('content')

<div class="content">
    <div class="main">
        <div class="header">
            <h1>Favorites</h1>
        </div>

        <div class="dbgames">
            <table>
                <thead>
                    <tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($favorites as $favorite)
                    <div class="gamecontainer">
                        <div class="gameboard" id="gameboard-{{ $favorite->id }}"></div>
                        <div class="gameinfocontainer">
                            <div class="gameusername">{{ $favorite->user->name }}</div>
                            <div class="gamepgn">{{ $favorite->pgn }}</div>
                            <div class="buttoncontainer">
                                <a href="{{ route('favorites.show', ['favorite' => $favorite])}}" class="btn btn-color-1">Open in analysisboard</a>

                                <form action="{{ route('favorites.destroy', ['favorite' => $favorite]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-color-4 delete-button">
                                        <i class="material-symbols-outlined delete-icon">delete</i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $favorites->links() }}
    </div>
</div>

<script src="{{ asset('/js/gamesindex.js') }}"></script>

@endsection