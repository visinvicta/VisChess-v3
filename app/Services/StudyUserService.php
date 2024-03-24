<?php

namespace App\Services;

use App\Models\User;

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
}
