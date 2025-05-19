<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesIndex extends Component
{
    use WithPagination;

    // optional: customize the Tailwind pagination theme
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $roles = Role::withCount('permissions')
                     ->orderBy('name')
                     ->paginate(10);

        return view('livewire.admin.roles-index', [
            'roles' => $roles,
        ]);
    }
}
