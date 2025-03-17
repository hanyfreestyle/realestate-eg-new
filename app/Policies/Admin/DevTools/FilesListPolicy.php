<?php

namespace App\Policies\Admin\DevTools;

use App\Models\User;
use App\Models\Admin\DevTools\FilesList;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilesListPolicy {
    use HandlesAuthorization;


    public function viewAny(User $user): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }

    public function view(User $user, FilesList $filesList): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }

    public function create(User $user): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }

    public function update(User $user, FilesList $filesList): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }

    public function delete(User $user, FilesList $filesList): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }

    public function deleteAny(User $user): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }

    public function forceDelete(User $user, FilesList $filesList): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }

    public function forceDeleteAny(User $user): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }

    public function restore(User $user, FilesList $filesList): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }

    public function restoreAny(User $user): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }

    public function replicate(User $user, FilesList $filesList): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }

    public function reorder(User $user): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }
}
