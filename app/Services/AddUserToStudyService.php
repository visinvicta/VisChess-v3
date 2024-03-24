<?php

namespace App\Services;

use App\Models\Study;

class AddUserToStudyService
{
    public static function addUserToStudy(int $studyId, array $userIdsToAdd): void
    {
        $study = Study::findOrFail($studyId);

        $userIdsToAdd = array_diff($userIdsToAdd, $study->users()->pluck('id')->toArray());

        $study->users()->attach($userIdsToAdd);
    }
}
