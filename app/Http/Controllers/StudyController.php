<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewStudyRequest;
use App\Models\Study;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\View\View;
use App\Services\StudyUserService;

class StudyController extends Controller
{
    public function index(): View
    {
        $studies = Study::all();
        return view('studies/index')->with('studies', $studies);
    }

    public function create(): View
    {
        return view('studies/create');
    }

    public function store(StoreNewStudyRequest $request): JsonResponse|RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();

        try {
            Study::create($validatedData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return redirect('/studies')
            ->with('success', 'Study created succesfully');
    }

    public function show(Study $study): View
    {
        $study = Study::with('chapters.comments')
            ->findOrFail($study->id);

        $users = User::all();

        return view('studies.show', compact('study', 'users'));
    }


    public function update()
    {
    }

    public function getChapterPgn(Chapter $chapter): JsonResponse
    {
        return response()->json(['pgn' => $chapter->pgn]);
    }

    public function addUserToStudy(Request $request): RedirectResponse
    {
        $studyId = $request->input('study_id');
        $userIdsToAdd = $request->input('user_ids');

        try {
            StudyUserService::addUserToStudy($studyId, $userIdsToAdd);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add users to the study.');
        }

        return redirect()->back()->with('success', 'Users added to the study successfully.');
    }
}
