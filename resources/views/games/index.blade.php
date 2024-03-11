@extends('layout')

@section('content')

<div class="content">
    <div class="main">
        <div class="header">
            <h1>Games</h1>
        </div>

        <div class="dbgames">
            <table>
                <thead>
                    <tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($games as $game)
                        <div class="gamecontainer">
                            <div class="gameboard" id="gameboard-{{ $game->id }}"></div>
                            <div class="gameinfocontainer">
                                <div class="gameusername">{{ $game->user->username }}</div>
                                <div class="gamepgn">{{ $game->pgn }}</div>
                                <div class="buttoncontainer">
                                    <a href="/game/{{ $game->id }}" class="btn btn-color-1">Open in analysisboard</a>
                                    

                                    <form action="/games/{{ $game->id }}" method="POST">
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
    </div>
</div>

<script src="{{ asset('/js/gamesindex.js') }}"></script>

@endsection
