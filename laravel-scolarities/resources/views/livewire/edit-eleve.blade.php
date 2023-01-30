<div class="p-2 bg-white shadow-sm">

    <form method="POST" wire:submit.prevent="update">
        @csrf
        @method('post')

        @if (Session::get('error'))
            <div class="p-5">
                <div class="p-4 border-red-500 bg-red-400 animate-bounce text-white">{{ Session::get('error') }}</div>
            </div>
        @endif

        <div class="p-5 flex flex-col gap-4">
            <div class="block mb-5">
                <x-jet-label value="{{ __('Matricule') }}" />
                <input type="text"
                    class="block mt-1 rounded-md border-gray-300 w-full @error('code')
            border-red-500 bg-red-100 animate-bounce
        @enderror"
                    wire:model="matricule" name="matricule">

                @error('matricule')
                    <div class="text text-red-500 mt-1"> {{ $message }}</div>
                @enderror
            </div>
            <div class="block mb-5">
                <x-jet-label value="{{ __('Nom') }}" />
                <input type="text"
                    class="block mt-1 rounded-md border-gray-300 w-full @error('code')
            border-red-500 bg-red-100 animate-bounce
        @enderror"
                    wire:model="nom" name="nom">

                @error('nom')
                    <div class="text text-red-500 mt-1">*Le champ nom de l'élève est requis</div>
                @enderror
            </div>
            <div class="block mb-5">
                <x-jet-label value="{{ __('Prenom') }}" />
                <input type="text"
                    class="block mt-1 rounded-md border-gray-300 w-full @error('prenom')
            border-red-500 bg-red-100 animate-bounce
        @enderror"
                    wire:model="prenom" name="prenom">

                @error('scolarite')
                    <div class="text text-red-500 mt-1">*Le champ Prenom est requis</div>
                @enderror
            </div>
            <div class="block mb-5">
                <x-jet-label value="{{ __('Date de naissance') }}" />
                <input type="date"
                    class="block mt-1 rounded-md border-gray-300 w-full @error('naissance')
                border-red-500 bg-red-100 animate-bounce
            @enderror"
                    wire:model="naissance" name="naissance">

                @error('scolarite')
                    <div class="text text-red-500 mt-1">*Le champ Date de naissance est requis</div>
                @enderror
            </div>

            <div class="block mb-5">
                <x-jet-label value="{{ __('Contact du parent') }}" />
                <input type="text"
                    class="block mt-1 rounded-md border-gray-300 w-full @error('prenom')
                        border-red-500 bg-red-100 animate-bounce
                    @enderror"
                    wire:model="contact_parent" name="contact_parent">

                @error('scolarite')
                    <div class="text text-red-500 mt-1">*Le champ Contact est requis</div>
                @enderror
            </div>
        </div>

</div>

</div>

<div class="p-5 flex justify-between items-center bg-gray-100">
    <button class="bg-red-600 p-3 rounded-sm text-white text-sm">Annuler</button>
    <button class="bg-green-600 p-3 rounded-sm text-white text-sm" type="submit">Mettre a jour</button>
</div>


</form>
</div>
