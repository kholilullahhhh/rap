<?php

namespace App\Policies;

use App\Models\Folder;
use App\Models\User;

class FolderPolicy
{
    /**
     * Apakah user dapat mengelola folder ini.
     * Folder bersifat pribadi milik pembuatnya.
     */
    public function manage(User $user, Folder $folder): bool
    {
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