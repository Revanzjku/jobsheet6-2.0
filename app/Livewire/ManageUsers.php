<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUsers extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function delete($id)
    {
        $user = User::findOrfail($id);
        
        if ($user->role !== 'admin') {
            $user->delete();
            session()->flash('message', 'User berhasil dihapus');
        } else {
            session()->flash('error', 'Tidak dapat menghapus admin');
        }
    }

    public function render()
    {
        $users = User::query()
        ->where('role', '!=', 'admin') // Exclude admin users
        ->when($this->search, function ($query) {
            $query->where(function($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            });
        })
        ->orderBy('name', 'asc')
        ->paginate(10);

        return view('livewire.manage-users', [
            'users' => $users,
        ]);
    }
}
