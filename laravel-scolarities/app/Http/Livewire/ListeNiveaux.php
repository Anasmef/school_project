<?php

namespace App\Http\Livewire;

use App\Models\Level;
use App\Models\SchoolFees;
use App\Models\SchoolYear;
use Livewire\Component;
use Livewire\WithPagination;

class ListeNiveaux extends Component
{
    use WithPagination;

    public $search = '';


    public function delete(Level $level)
    {
        $level->delete();
        return redirect()->route('niveaux')->with('success', 'Niveau supprimé');
    }


    public function getScolaritieAmount($levelId)
{
    // Vérifier si une année scolaire active existe
    $activeSchoolYear = SchoolYear::where('active', '1')->first();
    if (!$activeSchoolYear) {
        // Gérer le cas où aucune année scolaire active n'est trouvée
        return null;
    }

    // Rechercher les frais de scolarité pour le niveau spécifié et l'année scolaire active
    $query = SchoolFees::where('level_id', $levelId)
                        ->where('school_year_id', $activeSchoolYear->id)
                        ->first();

    // Vérifier si des frais de scolarité ont été trouvés
    if ($query) {
        return $query->montant;
    } else {
        // Gérer le cas où aucun frais de scolarité n'est trouvé pour le niveau spécifié et l'année scolaire active
        return null;
    }
}


    public function render()
    {
        if (!empty($this->search)) {
            $levels = Level::where('libelle', 'like', '%' . $this->search . '%')->orWhere('code', 'like', '%' . $this->search . '%')->paginate(10);
        } else {


            $activeSchoolYear = SchoolYear::where('active', '1')->first();

            $levels = Level::with('schoolFees')->paginate(10);
        }


        return view('livewire.liste-niveaux', compact('levels'));
    }
}
