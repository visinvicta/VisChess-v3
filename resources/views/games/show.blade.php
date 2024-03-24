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
                <button id="firstmove" class="btn btn-color-5 material-symbols-outlined">keyboard_double_arrow_left</button>
                <button id="previousmove" class="btn btn-color-5 material-symbols-outlined">chevron_left</button>
                <button id="nextmove" class="btn btn-color-5 material-symbols-outlined">chevron_right</button>
                <button id="lastmove" class="btn btn-color-5 material-symbols-outlined">keyboard_double_arrow_right</button>
                <button id="flipboard" class="btn btn-color-5 material-symbols-outlined">cached</button>
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
                    <button type="submit" class="btn btn-color-4 delete-button">
                        <i class="material-symbols-outlined delete-icon">delete</i>
                    </button>
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