<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;

class UsersList extends Component
{
    #[On('user-created')]
    public function render(): View|Application|Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $usersList = User::query()->paginate(20);
        $rolesList = Roles::get();

        return view(
            'livewire.dashboard.users.users-list',
            compact(
                'usersList',
                'rolesList'
            )
        );
    }

    public function editRole($userID, $roleID)
    {
        $role = User::where('id', $userID)->update(['role_id' => $roleID]);

        if ($role) {
            $this->dispatch('user-edited');
        }

        return false;
    }
}
