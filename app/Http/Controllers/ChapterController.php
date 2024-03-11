<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewChapterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Chapter;

class ChapterController extends Controller
{
    public function store(StoreNewChapterRequest $request): JsonResponse {
        $validatedData = $request->validated();
        Chapter::create($validatedData);
       
        return response()->json(['message' => 'Chapter created successfully'], 201);
    }
}
