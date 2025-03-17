<?php

namespace App\Policies\Admin\DevTools;

use App\Models\User;
use App\Models\Admin\DevTools\FilesListGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilesListGroupPolicy {
    use HandlesAuthorization;


    public function viewAny(User $user): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }


    public function view(User $user, FilesListGroup $filesListGroup): bool {
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


    public function update(User $user, FilesListGroup $filesListGroup): bool {
        if (config('app.env') == 'local') {
            return $user->hasRole('super_admin');
        } else {
            return false;
        }
    }


    public function delete(User $user, FilesListGroup $filesListGroup): bool {
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


    public function forceDelete(User $user, FilesListGroup $filesListGroup): bool {
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


    public function restore(User $user, FilesListGroup $filesListGroup): bool {
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


    public function replicate(User $user, FilesListGroup $filesListGroup): bool {
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
