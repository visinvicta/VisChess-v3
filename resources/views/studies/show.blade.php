@extends('layout')

@section('content')
<div class="content">
    <div class="main">
        <div class="header">
            <h1>Study</h1>
            <div class="study-title">
                <h2>{{ $study->name }}</h2>
            </div>
        </div>
       
        <a href="#" class="btn btn-color-1 btn-study btn-study-create" data-toggle="modal" data-target="#createChapterModal">Chapter +</a>

        <div class="study-container">
            <div class="sidebar">
                <h3>Chapters</h3>
                <ul class="chapter-list">
                @forelse ($study->chapters as $chapter)
                    <li id="{{ $chapter->id}}">{{ $chapter->name }}</li>
                    @empty
                    <li>No chapters available</li>
                    @endforelse
                </ul>
            </div>

            <div class="main-content">
                <div class="study-board">
                    <div class="study-chessboard">
                        <div id="studyboard" style="width: 600px"></div>
                        <div class="study-btn-container">
                        <button id="firstmove" class="btn btn-color-5"><<</button>
                            <button id="previousmove" class="btn btn-color-5"><</button>
                            <button id="nextmove" class="btn btn-color-5">></button>
                            <button id="lastmove" class="btn btn-color-5">>></button>
                            <button id="flipboard" class="btn btn-color-5">Flip</button>
                            <button id="toggle-pgn-btn" class="btn btn-color-5">PGN</button>
                            <button id="toggle-comments-btn" class="btn btn-color-5">Comments</button>
                        </div>
                        <div class="toggle-pgn">
                            <label>PGN:</label>
                            <div class="comment studypgn" id="pgn" type="text">
                            </div>
                        </div>
                        <div class="toggle-comments">
                            <label>Comments:</label>
                            <div class="comment" id="comment" type="text">
                                @isset($study->chapter->comments)
                                @foreach ($study->chapter->comments as $comment)
                                <div class="move-{{ $comment->move_number }} chapter-{{ $comment->chapter_id }} comment-item" style="display: none;">
                                    {{ $comment->comment }}
                                    <a href="#" class="btn-delete-comment btn btn-color-4" data-comment-id="{{ $comment->id }}">Delete</a>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <button id="addcomment" class="btn btn-color-5">Add comment</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="game-table">
                <div class="game-headers">
                    <table>
                        <thead>
                            <tr>
                                <th>Move</th>
                                <th>White</th>
                                <th>Black</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="game-moves">
                    <div class="moves-table-container">
                        <table class="moves-table">
                            <tbody class="moves-table-body" id="moves-table-body">
                                <!-- Move rows will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <div class="modal-overlay" id="modalOverlay"></div>


    <div class="modal fade" id="createChapterModal" tabindex="-1" role="dialog" aria-labelledby="createChapterModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="createChapterModalLabel">Create New Chapter</h2>

                </div>
                <div class="modal-body">

                    <form id="createChapterForm">
                        <input type="hidden" name="study_id" value="{{ $study->id }}">

                        <div class="form-group">
                            <label for="chapterName">Chapter Name</label>
                            <input type="text" class="form-control" id="chapterName" name="name">
                        </div>
                        <div class="form-group">
                            <label for="pgn">PGN</label>
                            <textarea class="form-control" id="modalpgn" name="pgn"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="startingMove">Starting Move</label>
                            <input type="text" class="form-control" id="startingMove" name="startingMove">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-color-1 btn-secondary close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-color-1 btn-primary" id="createChapterBtn">Create Chapter</button>
                </div>
            </div>
        </div>
    </div>

    @if(isset($chapter))

    <div class="modal fade" id="addCommentModal" tabindex="-1" role="dialog" aria-labelledby="addCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="addCommentModalLabel">Add Comment</h2>

                </div>
                <div class="modal-body">
                    <form id="addCommentForm">
                        <input type="hidden" name="study_id" value="{{ $study->id }}">
                        <input type="hidden" name="chapter_id" value="{{ $chapter->id }}">

                        <div class="form-group">
                            <label for="moveNumber">Move Number</label>
                            <input type="number" class="form-control" id="moveNumber" name="move_number" min="1">
                        </div>
                        <div class="form-group">
                            <label for="commentText">Comment</label>
                            <textarea class="form-control comment-modal" id="commentText" name="comment"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-color-1 btn-secondary close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-color-1 btn-primary" id="addCommentBtn">Add Comment</button>
                </div>
            </div>
        </div>
    </div>

    @endif

    <footer>
        <script src="{{ asset('/js/chessfunctions.js') }}"></script>
        <script src="{{ asset('/js/study.js') }}"></script>
        <script src="{{ asset('/js/deletecomment.js') }}"></script>
        <script src="{{ asset('/js/studyChapterModal.js') }}"></script>
        <script src="{{ asset('/js/studyCommentModal.js') }}"></script>
    </footer>
    @endsection