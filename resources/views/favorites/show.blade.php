@extends('layout')

@section('content')

<div class="content">
    <div class="main">
        <div class="header">
            <h1>Favorite</h1>
        </div>

        <div class="chessboard">
            
            <div id="analysisboard" style="width: 596px"></div>

            <div class="scrollbuttoncontainer">
                <button id="leftscroll" class="btn btn-color-1 leftscroll"><-</button>
                <button id="rightscroll" class="btn btn-color-2 rightscroll">-></button>
                <button id="flipboard" class="btn flipboard btn-color-5">Flip</button>
            </div>

            <label>Status:</label>
            <div class="statuscontainer" id="status"></div>
            <label>FEN:</label>
            <div class="fencontainer" id="fen"></div>
            <label>PGN:</label>
            <div class="boardgamepgn pgncontainer importpgn test">{{ $favorite['pgn'] }}</div>

            <div>
                <form method="POST">
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $favorite['id'] }}">
                    <button class="btn btn-color-4">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/chessfunctions.js') }}"></script>
<script src="{{ asset('js/game.js') }}"></script>


@endsection
