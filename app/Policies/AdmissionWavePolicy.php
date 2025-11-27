<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AdmissionWave;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdmissionWavePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AdmissionWave');
    }

    public function view(AuthUser $authUser, AdmissionWave $admissionWave): bool
    {
        return $authUser->can('View:AdmissionWave');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AdmissionWave');
    }

    public function update(AuthUser $authUser, AdmissionWave $admissionWave): bool
    {
        return $authUser->can('Update:AdmissionWave');
    }

    public function delete(AuthUser $authUser, AdmissionWave $admissionWave): bool
    {
        return $authUser->can('Delete:AdmissionWave');
    }

    public function restore(AuthUser $authUser, AdmissionWave $admissionWave): bool
    {
        return $authUser->can('Restore:AdmissionWave');
    }

    public function forceDelete(AuthUser $authUser, AdmissionWave $admissionWave): bool
    {
        return $authUser->can('ForceDelete:AdmissionWave');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AdmissionWave');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AdmissionWave');
    }

    public function replicate(AuthUser $authUser, AdmissionWave $admissionWave): bool
    {
        return $authUser->can('Replicate:AdmissionWave');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AdmissionWave');
    }

}