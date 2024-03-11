<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewGameRequest;
use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller {
    public function store(StoreNewGameRequest $request): JsonResponse|RedirectResponse {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        try {
            Game::create($validatedData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }   
        return response()->json(['message' => 'Game saved successfully'], 201);
    }

    public function destroy(Game $game): JsonResponse|RedirectResponse { 
        try {
            $game->delete();
            $message = 'Game deleted successfully';
        } catch (\Exception $e) {
            $message = 'Error deleting game: ' . $e->getMessage();
            return response()->json(['error' => $message], 500);
        }
            
        if(request()->expectsJson()) {
            return response()->json(['message' => $message]);
        } else {
            return redirect('/games')
            ->with('success', $message);
        }
    }

    public function show(Game $game): View {
        return view('games/show')
        ->with('game', $game);
    }

    public function index(): View {
        $games = Game::with('user')->paginate(8);        
        return view('games/index')
        ->with('games', $games);
    }
}
