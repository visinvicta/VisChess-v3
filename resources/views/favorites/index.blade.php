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
                                <div class="gameusername">{{ $favorite->user_id }}</div>
                                <div class="gamepgn">{{ $favorite->pgn }}</div>
                                <div class="buttoncontainer">
                                    <a href="/favorite/{{ $favorite->id }}" class="btn btn-color-1">Open in analysisboard</a>
                                    

                                    <form action="/favorites/{{ $favorite->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-color-4" value="Delete">
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
