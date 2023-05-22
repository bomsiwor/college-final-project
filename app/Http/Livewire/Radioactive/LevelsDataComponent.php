<?php

namespace App\Http\Livewire\Radioactive;

use App\Actions\GetNuclideAction;
use Livewire\Component;

class LevelsDataComponent extends Component
{
    public $slug;
    public $apiData;

    public function loadData(GetNuclideAction $action)
    {
        $this->apiData = $action->handle($this->slug, 'levels');
    }

    public function render()
    {
        return view('livewire.radioactive.levels-data-component');
    }
}
