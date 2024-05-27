<?php

namespace App\Http\Livewire;

use App\Models\Attribution;
use App\Models\Classe;
use App\Models\Payment;
use App\Models\SchoolFees;
use App\Models\SchoolYear;
use App\Models\Student;
use Exception;
use Livewire\Component;

class CreatePayments extends Component
{
    public $matricule;
    public $montant;
    public $fullname;
    public $student_id;
    public $success;
    public $haveSuccess = false;
    public $error;
    public $haveError = false;

    public function store(Payment $payment)
    {
        $activeSchoolYear = SchoolYear::where('active', '1')->first();

        $getClasseQuery = Attribution::where('student_id', $this->student_id)
                                      ->where('school_year_id', $activeSchoolYear->id)
                                      ->first();

        // Vérifier si $getClasseQuery est null
        if ($getClasseQuery !== null) {
            $studentClasseId = $getClasseQuery->classe_id;
            $classData = Classe::with('level')->find($studentClasseId);

            // Vérifier si $classData est null
            if ($classData !== null) {
                $studentLevelId = $classData->level->id;

                $query = SchoolFees::where('level_id', $studentLevelId)
                                   ->where('school_year_id', $activeSchoolYear->id)
                                   ->first();

                // Vérifier si $query est null
                if ($query !== null) {
                    $montantScolarite = $query->montant;

                    $totalPaid = Payment::where('student_id', $this->student_id)
                                        ->where('school_year_id', $activeSchoolYear->id)
                                        ->sum('montant');

                    // Vérifier si le montant total de la scolarité est inférieur au montant déja payé + le montant du paiement en cours
                    if (($totalPaid + $this->montant) > $montantScolarite) {
                        // Erreur
                        $this->error = 'Attention. Il reste à payer ' . ($montantScolarite - $totalPaid) . ' Euro/Dollar';
                        $this->haveError = true;
                    } else if ($this->montant <= 0) {
                        // Handle the case where the payment amount is zero or negative
                        $this->error = 'Attention tu n\'a rien payé Le montant du paiement doit être supérieur à zéro.';
                        $this->haveError = true;
                    } else {
                        // Enregistrer le paiement de la scolarité
                        $payment->student_id = $this->student_id;
                        $payment->classe_id = $getClasseQuery->classe_id;
                        $payment->school_year_id = $activeSchoolYear->id;
                        $payment->montant = $this->montant;
                        $payment->save();
                    
                        $this->success = 'Paiement de scolarité effectué';
                        $this->haveSuccess = true;
                        return redirect()->route('payments')->with('success', 'Paiement de scolarité effectué');
                    }
                    } else {
                        // Gérer le cas où aucun montant de scolarité n'est trouvé
                        $this->error = 'Aucun montant de scolarité trouvé pour cette classe.';
                        $this->haveError = true;
                    }
                    } else {
                        // Gérer le cas où aucune classe n'est trouvée
                        $this->error = 'Aucune classe trouvée pour cet élève.';
                        $this->haveError = true;
                    }
                    } else {
                        // Gérer le cas où aucune attribution n'est trouvée pour cet élève
                        $this->error = 'Aucune attribution trouvée pour cet élève.';
                        $this->haveError = true;
                    }
                    
    }

    public function render()
    {
        if (isset($this->matricule)) {
            $currentStudent = Student::where('matricule', $this->matricule)->first();

            if ($currentStudent) {
                // Retourner le nom complet
                $this->fullname = $currentStudent->nom . ' ' . $currentStudent->prenom;

                // Sauvegarder l'id de l'élève
                $this->student_id = $currentStudent->id;
            } else {
                $this->fullname = '';
            }
        }

        return view('livewire.create-payments');
    }
}
