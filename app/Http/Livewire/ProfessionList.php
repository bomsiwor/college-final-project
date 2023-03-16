<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Profession;
use Illuminate\Support\Facades\DB;

class ProfessionList extends Component
{
    public $profesions;

    public function loadProfesions()
    {
        // sleep(2);

        $this->profesions = Profession::all();
    }

    public function shuffleData()
    {
        $profesions = DB::table('professions')->get();

        $shuffled = $profesions->shuffle();

        foreach ($shuffled as $item) :
            DB::table('professions')->where('id', $item->id)->update(['profession_name' => $item->profession_name]);
        endforeach;
    }

    public function render()
    {
        return view('livewire.profession-list');
    }
}
