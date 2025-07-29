<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserViews extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
        ->when($this->search, function ($query) {
            $query->where('name', 'like', '%'.$this->search.'%')
                  ->orWhere('email', 'like', '%'.$this->search.'%');
        })
        ->orderByRaw('CASE WHEN id = ? THEN 0 ELSE 1 END', [Auth::id()])
        ->orderBy('id', 'asc')
        ->paginate(9);

        return view('livewire.userViews', [
            'users' => $users,
        ]);
    }
}
