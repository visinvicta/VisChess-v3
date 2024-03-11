@extends('layout')

@section('content')
<div class="content">
    <div class="main">
        <div class="header">
            <h1>Game</h1>
        </div>

        <div class="chessboard">
            <div id="analysisboard" style="width: 596px"></div>
            <div class="scrollbuttoncontainer">
                <button id="leftscroll" class="btn btn-color-1"><-</button>
                <button id="rightscroll" class="btn btn-color-2">-></button>
            </div>
            <h3>Status:</h3>
            <div class="statuscontainer" id="status"></div>
            <h3>FEN:</h3>
            <div class="fencontainer" id="fen"></div>
            <h3>PGN:</h3>
            <div class="boardgamepgn pgncontainer importpgn test">{{ $game['pgn'] }}</div>

            <div>
                <form method="POST">
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $game['id'] }}">
                    <button class="btn btn-color-4">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<footer>
<script src="{{ asset('js/chessfunctions.js') }}"></script>
<script src="{{ asset('/js/game.js') }}"></script>
   
</footer>
@endsection
