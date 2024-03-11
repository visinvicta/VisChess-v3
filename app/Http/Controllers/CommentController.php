<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNewCommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller {

    public function store(StoreNewCommentRequest $request): JsonResponse {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        Comment::create($validatedData);
        return response()->json(['message' => 'Comment created successfully'], 201);
    }

    public function destroy(Comment $comment): JsonResponse {
        try {
            $comment->delete();
            $message = 'Comment deleted successfully';
            return response()->json(['message' => $message]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Comment not found'], 404);
        }
    }
}
