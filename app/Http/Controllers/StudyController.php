<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewStudyRequest;
use App\Http\Requests\UpdateStudyRequest;
use App\Models\Study;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Chapter;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\View\View;
use App\Services\StudyUserService;

class StudyController extends Controller
{
    public function __construct(private readonly StudyUserService $studyUserService)
    {
    }

    public function index(): View
    {
        $studies = Study::all();
        return view('studies.index')->with('studies', $studies);
    }

    public function create(): View
    {
        return view('studies.create');
    }

    public function store(StoreNewStudyRequest $request): JsonResponse|RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();

        try {
            $study = Study::create($validatedData);
            $study->users()->attach(Auth::id());
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

    public function edit(Study $study): View
    {
        return view('studies.edit', compact('study'));
    }
    public function update(UpdateStudyRequest $request, Study $study): RedirectResponse
    {
        $validatedData = $request->validated();

        try {
            $study->update($validatedData);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update the study.');
        }

        return redirect('/studies')
            ->with('success', 'Study successfully updated');
    }


    public function destroy(Study $study): JsonResponse|RedirectResponse
    {
        try {
            $study->delete();
            $message = 'Study deleted successfully';
        } catch (\Exception $e) {
            $message = 'Error deleting study: ' . $e->getMessage();
            return response()->json(['error' => $message], 500);
        }

        if (request()->expectsJson()) {
            return response()->json(['message' => $message]);
        } else {
            return redirect('/studies')
                ->with('success', $message);
        }
    }

    public function getChapterPgn(Chapter $chapter): JsonResponse
    {
        return response()->json(['pgn' => $chapter->pgn]);
    }

    public function addUserToStudy(Request $request): RedirectResponse|JsonResponse
    {
        $studyId = $request->input('study_id');
        $userIdsToAdd = $request->input('user_ids');

        if (!$this->studyUserService->userExistsInStudy(Auth::id(), $studyId)) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to add users to the study.'
            ]);
        }

        try {
            $this->studyUserService->addUserToStudy($studyId, $userIdsToAdd);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to add users to the study.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Users added to the study successfully.'
        ]);
    }
}
