<div class="mt-5">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
        {{-- Titre et Boutton crée --}}

        <div class="flex justify-between items-center">
            <div class="w-1/3">

                <input type="text" class="block mt-1 rounded-md border-gray-300 w-full " placeholder="Rechercher"
                    wire:model="search">
            </div>

            <a href="{{ route('payments.create') }}" class="bg-blue-500 rounded-md p-2 text-sm text-white">
                Faire un paiement</a>
        </div>



        <div class="flex flex-col">
            {{-- Message qui apparaitra après operation --}}



            @if (Session::get('success'))
                <div class="p-5">
                    <div class="block p-2 bg-green-500 text-white rounded-sm shadow-sm mt-2">
                        {{ Session::get('success') }}</div>
                </div>
            @endif

            {{-- Styliser le tableau --}}

            <div class="overflow-x-auto ">
                <div class="py-4 inline-block min-w-full">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-center">

                            <thead class="border-b bg-gray-50">
                                <tr>
                                    <th class="text-sm font-medium text-gray-900 px-6 py-6">Date</th>
                                    <th class="text-sm font-medium text-gray-900 px-6 py-6">Matricule</th>
                                    <th class="text-sm font-medium text-gray-900 px-6 py-6">Nom</th>
                                    <th class="text-sm font-medium text-gray-900 px-6 py-6">Prenom</th>
                                    <th class="text-sm font-medium text-gray-900 px-6 py-6">Classe</th>
                                    <th class="text-sm font-medium text-gray-900 px-6 py-6">Montant</th>

                                    <th class="text-sm font-medium text-gray-900 ">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $item)
                                    <tr class="border-b-2 border-gray-100">
                                        <td class="text-sm font-medium text-gray-900 px-6 py-6">{{ $item->created_at }}
                                        </td>

                                        <td class="text-sm font-medium text-gray-900 px-6 py-6">
                                            {{ $item->student->matricule }}
                                        </td>
                                        <td class="text-sm font-medium text-gray-900 px-6 py-6">
                                            {{ $item->student->nom }}</td>
                                        <td class="text-sm font-medium text-gray-900 px-6 py-6">
                                            {{ $item->student->prenom }}
                                        </td>
                                        <td class="text-sm font-medium text-gray-900 px-6 py-6">
                                            {{ $item->classe->libelle }}
                                        </td>
                                        <td class="text-sm font-medium text-gray-900 px-6 py-6">
                                            {{ $item->montant }}
                                        </td>

                                        <td class="flex">
                                            <a href="{{ route('inscriptions.edit', $item->id) }}"
                                                class="text-sm bg-blue-500 p-1 text-white rounded-sm">Imprimer</a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr class="w-full">
                                        <td class=" flex-1 w-full items-center justify-center" colspan="4">
                                            <div>
                                                <p class="flex justify-center content-center p-4"> 
                                                <div>Aucun élément trouvé!</div>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse


                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $payments->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
