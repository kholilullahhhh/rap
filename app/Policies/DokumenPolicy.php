<?php

namespace App\Policies;

use App\Models\Dokumen;
use App\Models\User;

class DokumenPolicy
{
    /**
     * Role yang boleh mengelola seluruh dokumen (semua user).
     */
    private const MANAGER_ROLES = ['admin', 'kepala_kantor'];

    /**
     * Apakah user dapat mengakses dokumen tertentu.
     * Admin & Kepala Kantor: semua dokumen. Selain itu: hanya miliknya.
     */
    public function access(User $user, Dokumen $dokumen): bool
    {
        if (in_array($user->role, self::MANAGER_ROLES, true)) {
            return true;
        }

        return (int) $user->id === (int) $dokumen->user_id;
    }

    public function view(User $user, Dokumen $dokumen): bool
    {
        return $this->access($user, $dokumen);
    }

    public function update(User $user, Dokumen $dokumen): bool
    {
        return $this->access($user, $dokumen);
    }

    public function delete(User $user, Dokumen $dokumen): bool
    {
        return $this->access($user, $dokumen);
    }

    public function create(User $user): bool
    {
        return true;
    }
}