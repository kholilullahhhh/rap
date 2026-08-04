<?php

namespace App\Policies;

use App\Models\Folder;
use App\Models\User;

class FolderPolicy
{
    /**
     * Role yang boleh mengelola seluruh folder (semua user).
     * Konsisten dengan DokumenPolicy.
     */
    private const MANAGER_ROLES = ['admin', 'kepala_kantor'];

    /**
     * Apakah user dapat mengelola folder ini.
     * Admin/Kepala Kantor: semua folder. Selain itu: hanya punyanya sendiri.
     */
    public function manage(User $user, Folder $folder): bool
    {
        if (in_array($user->role, self::MANAGER_ROLES, true)) {
            return true;
        }

        return (int) $user->id === (int) $folder->user_id;
    }

    public function update(User $user, Folder $folder): bool
    {
        return $this->manage($user, $folder);
    }

    public function delete(User $user, Folder $folder): bool
    {
        return $this->manage($user, $folder);
    }

    public function create(User $user): bool
    {
        return true;
    }
}
