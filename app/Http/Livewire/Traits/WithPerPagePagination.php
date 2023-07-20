<?php

namespace App\Http\Livewire\Traits;

use Livewire\WithPagination;

trait WithPerPagePagination
{
    use WithPagination;

    public $perPage = 9;

    public function mountWithPerPagePagination()
    {
        $this->perPage = session()->get('perPage', config('app.perPage'));
    }

    public function updatedPerPage($value)
    {
        session()->put('perPage', $value);
    }

    public function applyPagination($query)
    {
        return $query->paginate($this->perPage);
    }
}
