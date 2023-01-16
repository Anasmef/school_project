<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\SchoolYear;
use Livewire\Component;
use Livewire\WithPagination;

class ListeClasse extends Component
{
    use WithPagination;

    public $search = '';

    public function delete(Classe $classe)
    {
        $classe->delete();
        return redirect()->route('classes')->with('success', 'Classe supprimé');
    }


    public function render()
    {
        //classesList
        if (!empty($this->search)) {
            $classesList = Classe::where('libelle', 'like', '%' . $this->search . '%')->orWhere('code', 'like', '%' . $this->search . '%')->paginate(10);
        } else {


            $activeSchoolYear = SchoolYear::where('active', '1')->first();

            $classesList = Classe::with('level')->whereRelation('level', 'school_year_id', $activeSchoolYear->id)->paginate(10);
        }


        return view('livewire.liste-classe', compact('classesList'));
    }
}
