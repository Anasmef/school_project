<!-- livewire/create-parent.blade.php -->

<div>
    <form wire:submit.prevent="store">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" wire:model="email" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" wire:model="nom" required>
            @error('nom') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" wire:model="prenom" required>
            @error('prenom') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="contact">Contact:</label>
            <input type="text" id="contact" wire:model="contact" required>
            @error('contact') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Ajouter Parent</button>
    </form>
</div>
