<?php

namespace App\Http\Livewire;

use App\Models\Attribution;
use App\Models\Classe;
use App\Models\Payment;
use Livewire\Component;

class ShowStudent extends Component
{
    public $eleve;


    public function getCurrentClasse()
{
    // Recherche de l'attribution actuelle de la classe pour l'élève
    $query = Attribution::where('student_id', $this->eleve->id)->first();

    // Vérification si une attribution a été trouvée
    if ($query) {
        // Récupération de l'identifiant de la classe attribuée
        $currentClasseId = $query->classe_id;
        
        // Recherche de la classe correspondant à l'identifiant
        $classeQuery = Classe::find($currentClasseId);

        // Vérification si une classe a été trouvée
        if ($classeQuery) {
            // Retourner le libellé de la classe
            return $classeQuery->libelle;
        } else {
            // Gérer le cas où aucune classe n'est trouvée pour l'identifiant spécifié
            return 'Classe introuvable';
        }
    } else {
        // Gérer le cas où aucune attribution de classe n'est trouvée pour l'élève
        return 'Attribution de classe introuvable';
    }
}


    public function render()
    {
        $studentsLastPayment = Payment::where('student_id', $this->eleve->id)->paginate(3);

        return view('livewire.show-student', compact('studentsLastPayment'));
    }
}
