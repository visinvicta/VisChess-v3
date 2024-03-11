@extends('layout')

@section('content')
<div class="content">
    <div class="main">
        <div class="header">
            <h1>Analysis</h1>
        </div>

        <div class="chessboard">

            <div id="analysisboard" style="width: 596px"></div>

            <div class="scrollbuttoncontainer">
                <button id="firstmove" class="btn btn-color-5"><<-</button>
                <button id="previousmove" class="btn btn-color-5"><-</button>
                <button id="nextmove" class="btn btn-color-5">-></button>
                <button id="lastmove" class="btn btn-color-5">->></button>
                <button id="flipboard" class="btn btn-color-5">Flip</button>
            </div>
            
            <label>Status:</label>
            <div class="statuscontainer" id="status"></div>
            <label>FEN:</label>
            <div class="fencontainer" id="fen"></div>
            <label>PGN:</label>
            <textarea class="boardgamepgn pgncontainer importpgn" id="importpgn" type="text"></textarea><br>
            
            <div class="actionbuttoncontainer">
                <button class="btn btn-color-1" id="importpgnsubmit">Import PGN</button>
                <button class="btn btn-color-1 posttodb" id="posttodb">Add to Games</button>
                <button class="btn btn-color-1 posttomygames" id="posttomygames">Add to Favorites</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/chessfunctions.js') }}"></script>
<script src="{{ asset('js/analysis.js') }}"></script>

@endsection
