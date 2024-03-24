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
                <button id="firstmove" class="btn btn-color-5 material-symbols-outlined">keyboard_double_arrow_left</button>
                <button id="previousmove" class="btn btn-color-5 material-symbols-outlined">chevron_left</button>
                <button id="nextmove" class="btn btn-color-5 material-symbols-outlined">chevron_right</button>
                <button id="lastmove" class="btn btn-color-5 material-symbols-outlined">keyboard_double_arrow_right</button>
                <button id="flipboard" class="btn btn-color-5 material-symbols-outlined">cached</button>
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
                    <button type="submit" class="btn btn-color-4 delete-button">
                        <i class="material-symbols-outlined delete-icon">delete</i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/chessfunctions.js') }}"></script>
<script src="{{ asset('js/game.js') }}"></script>


@endsection