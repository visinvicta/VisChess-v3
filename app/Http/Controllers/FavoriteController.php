<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewFavoriteRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $favorites = $user->favorites()->with('user')->paginate(8);
        return view('favorites/index', compact('favorites'));
    }

    public function store(StoreNewFavoriteRequest $request): JsonResponse|RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        try {
            Favorite::create($validatedData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json(['message' => 'Favorite game saved successfully'], 201);
    }
    public function show(Favorite $favorite): View
    {
        return view('favorites/show')
            ->with('favorite', $favorite);
    }

    public function destroy(Favorite $favorite): JsonResponse|RedirectResponse
    {
        try {
            $favorite->delete();
            $message = 'Favorite game deleted successfully';
        } catch (\Exception $e) {
            $message = 'Error deleting favorite game: ' . $e->getMessage();
            return response()->json(['error' => $message], 500);
        }

        if (request()->expectsJson()) {
            return response()->json(['message' => $message]);
        } else {
            return redirect('/favorites')
                ->with('success', $message);
        }
    }
}
