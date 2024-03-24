<?php

namespace App\Services;

use App\Models\User;
use App\Models\Study;

class StudyUserService
{
    public static function userExistsInStudy(int $userId, int $studyId): bool
    {
        $user = User::find($userId);
        if (!$user) {
            return false;
        }

        return $user->studies()->where('studies.id', $studyId)->exists();
    }

    public static function addUserToStudy(int $studyId, array $userIdsToAdd): void
    {
        $study = Study::findOrFail($studyId);

        $userIdsToAdd = array_diff($userIdsToAdd, $study->users()->pluck('id')->toArray());

        $study->users()->attach($userIdsToAdd);
    }
}
