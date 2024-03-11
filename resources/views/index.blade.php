@extends('layout')

@section('content')

<div class="content">
    <div class="main">
        @auth
        <div class="header">
            <h1>Welcome, {{ auth()->user()->username }}</h1>
        </div>
        @endauth

        <div class="chessboard">
            <div id="myBoard" style="width: 596px"></div>
            <label>Status:</label>
            <div class="statuscontainer" id="status"></div>
            <label>FEN:</label>
            <div class="fencontainer" id="fen"></div>
            <label>PGN:</label>
            <div class="importpgn pgncontainer" id="pgn" type="text"></div>
        </div>
    </div>

    
</div>
<div class="flash-message" style="display: none;">
    @if(session('success'))
    <p>{{ session('success') }}</p>
    @endif
</div>

<script src="{{ asset('js/chessfunctions.js') }}"></script>
<script src="{{ asset('js/homepage.js') }}"></script>
<script src="{{ asset('js/flashmessage.js') }}"></script>
@endsection
