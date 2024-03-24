<?php

namespace App\Services;

use App\Models\Study;

class StudyUserService
{
    public static function addUserToStudy(int $studyId, array $userIdsToAdd): void
    {
        Study::findOrFail($studyId)->users()->attach($userIdsToAdd);
    }
}