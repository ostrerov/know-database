<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Livewire\Component;

class CreateUser extends Component
{
    public $name;

    public $login;

    public $role;

    public $password;

    protected $modal;

    public function mount($modal = false)
    {
        $this->modal = $modal;
    }

    public function render(): View
    {
        $rolesList = Roles::get();

        return view('livewire.dashboard.users.create-user', compact(
            'rolesList'
        ));
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'login' => ['required', 'min:4', 'unique:users'],
            'role' => ['required', 'integer', 'exists:\App\Models\Roles,id'],
            'password' => ['required', 'min:8']
        ];
    }

    public function messages(): array
    {
        return [
            'name' => [
                'required' => 'Это обязательное поле',
                'string' => 'Это поле не должно содержать спец. символов и цифр',
                'min' => 'Минимальное количество символов - :min'
            ],
            'login' => [
                'required' => 'Это обязательное поле',
                'min' => 'Минимальная длинна псевдонима - :min',
                'unique' => 'Этот псевдоним уже занят'
            ],
            'role' => [
                'required' => 'Обязательно нужно выбрать роль',
                'integer' => 'Можно передать только индинтефикатор роли',
                'exists' => 'Роль с эим индинтефикатором не найдена'
            ],
            'password' => [
                'required' => 'Это обязательное после',
                'min' => 'Минимальная длинна пароля - :min'
            ]
        ];
    }

    public function save()
    {
        $this->validate();

        $result = User::create([
            'name' => $this->name,
            'login' => $this->login,
            'role_id' => $this->role,
            'password' => Hash::make($this->password)
        ]);

        if ($result) {
            if (!$this->modal) {
                return redirect()->route('dashboard.users.index');
            }

            $this->dispatch('user-created');
            $this->dispatch('user-created')->component('dashboard.users.users-list');
            $this->reset();
        }

        return false;
    }
}
