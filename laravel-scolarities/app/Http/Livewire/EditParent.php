<?php



namespace App\Http\Livewire;

use App\Models\Family;
use App\Notifications\SendParentRegistrationNotification;
use Exception;
use Livewire\Component;

class CreateParent extends Component
{
    public $email;
    public $nom;
    public $prenom;
    public $contact;
    public $parent_id; // Ajout d'une propriété pour stocker l'ID du parent à mettre à jour

    public function mount($parent_id = null)
    {
        $this->parent_id = $parent_id;

        if ($this->parent_id) {
            $parent = Family::findOrFail($this->parent_id);
            $this->nom = $parent->nom;
            $this->prenom = $parent->prenom;
            $this->email = $parent->email;
            $this->contact = $parent->contact;
        }
    }

    public function store()
    {
        $this->validate([
            'email' => 'email|required|unique:parents,email,' . $this->parent_id,
            'nom' => 'string|required',
            'prenom' => 'string|required',
            'contact' => 'string|required',
        ]);

        try {
            if ($this->parent_id) {
                $parent = Family::findOrFail($this->parent_id);
            } else {
                $parent = new Family();
            }

            $parent->nom = $this->nom;
            $parent->prenom = $this->prenom;
            $parent->email = $this->email;
            $parent->contact = $this->contact;

            $parent->save();

            // Envoyer un email au parent une fois ajouté dans la BD
            $parent->notify(new SendParentRegistrationNotification());

            session()->flash('success', 'Parent ajouté avec succès.');

            return redirect()->route('parents.index');
        } catch (Exception $e) {
            // Gérer les erreurs
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.create-parent');
    }
}
