@extends('layouts.admin')

@section('title', 'Boîte de réception')

@section('content')
<div x-data="{ 
    view: 'list', 
    showDelete: false,
    selected: {},
    
    openMessage(msg) {
        this.selected = msg;
        this.view = 'details';
        // Marquer comme lu côté serveur
        if(!msg.is_read) {
            fetch(`/admin/messages/${msg.id}/read`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(() => msg.is_read = true);
        }
    }
}" class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase italic">Messages</h2>
            <p class="text-gray-500 font-medium">Gérez les demandes de contact de vos visiteurs.</p>
        </div>
        <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100">
            <span class="text-[#1B2E58] font-bold">Total : {{ $messages->count() }}</span>
            <span class="mx-2 text-gray-300">|</span>
            <span class="text-orange-500 font-bold">{{ $messages->where('is_read', false)->count() }} non lus</span>
        </div>
    </div>

    <!-- ==========================================
         VUE 1 : LISTE DES MESSAGES
    =========================================== -->
    <div x-show="view === 'list'" x-transition class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#00261C] text-white font-black uppercase text-[10px] tracking-widest">
                    <th class="px-8 py-6">Expéditeur</th>
                    <th class="px-8 py-6">Objet</th>
                    <th class="px-8 py-6 text-center">Date</th>
                    <th class="px-8 py-6 text-center">Statut</th>
                    <th class="px-8 py-6 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($messages as $msg)
                <tr class="hover:bg-gray-50 transition-all cursor-pointer {{ !$msg->is_read ? 'bg-orange-50/30' : '' }}" @click="openMessage({{ $msg }})">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-[#1B2E58] font-bold">
                                {{ strtoupper(substr($msg->nom, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-black text-[#1B2E58] uppercase text-sm">{{ $msg->nom }} {{ $msg->prenom }}</p>
                                <p class="text-xs text-gray-400 font-medium">{{ $msg->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <p class="text-[#1B2E58] font-bold truncate max-w-xs">{{ $msg->objet }}</p>
                    </td>
                    <td class="px-8 py-5 text-center text-xs font-bold text-gray-400 uppercase">
                        {{ $msg->created_at->format('d M Y à H:i') }}
                    </td>
                    <td class="px-8 py-5 text-center">
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest {{ $msg->is_read ? 'bg-gray-100 text-gray-400' : 'bg-orange-100 text-orange-600 animate-pulse' }}">
                            {{ $msg->is_read ? 'Lu' : 'Nouveau' }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right" @click.stop>
                        <button @click="selected = { id: {{ $msg->id }}, nom: '{{ addslashes($msg->nom) }}' }; showDelete = true" class="w-9 h-9 rounded-xl bg-red-50 text-red-500 hover:bg-red-600 hover:text-white transition-all">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-20 text-center text-gray-400 italic">Aucun message reçu.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ==========================================
         VUE 2 : DÉTAILS DU MESSAGE
    =========================================== -->
    <div x-show="view === 'details'" x-cloak x-transition>
        <button @click="view = 'list'" class="mb-6 flex items-center gap-2 text-[#1B2E58] font-bold hover:text-orange-500 transition-all">
            <i class="fa-solid fa-arrow-left"></i> Retour à la liste
        </button>

        <div class="bg-white rounded-[3rem] shadow-xl overflow-hidden border border-gray-100">
            <div class="p-10 border-b border-gray-50 bg-gray-50/50 flex justify-between items-start">
                <div>
                    <h3 class="text-2xl font-black text-[#1B2E58] uppercase italic" x-text="selected.objet"></h3>
                    <p class="text-gray-500 font-medium mt-1">Reçu le <span x-text="new Date(selected.created_at).toLocaleString()"></span></p>
                </div>
                <div class="text-right">
                    <p class="font-black text-[#1B2E58] text-lg uppercase"><span x-text="selected.nom"></span> <span x-text="selected.prenom"></span></p>
                    <p class="text-orange-500 font-bold" x-text="selected.email"></p>
                    <p class="text-gray-400 font-bold" x-text="selected.phone"></p>
                </div>
            </div>
            <div class="p-10">
                <div class="bg-gray-50 p-8 rounded-[2rem] text-[#1B2E58] leading-relaxed whitespace-pre-line font-medium text-lg italic" x-text="selected.description"></div>
                
                <!-- <div class="mt-10 flex gap-4">
                    <a :href="'mailto:' + selected.email" class="bg-[#1B2E58] text-white px-8 py-4 rounded-2xl font-black shadow-lg hover:bg-[#00261C] transition-all">
                        RÉPONDRE PAR EMAIL
                    </a>
                    <a :href="'tel:' + selected.phone" class="bg-white border border-gray-100 text-[#1B2E58] px-8 py-4 rounded-2xl font-black hover:bg-gray-50 transition-all">
                        APPELER
                    </a>
                </div> -->
            </div>
        </div>
    </div>

    <!-- MODAL DE SUPPRESSION -->
    <div x-show="showDelete" class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white w-full max-w-sm rounded-[3rem] p-12 text-center shadow-2xl">
            <i class="fa-solid fa-trash-can text-5xl text-red-500 mb-6"></i>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-2 tracking-tight">Supprimer ?</h3>
            <p class="text-gray-500 mb-10 leading-relaxed font-medium">Ce message de <span class="text-red-600 font-bold" x-text="selected.nom"></span> sera définitivement supprimé.</p>
            <div class="flex gap-4">
                <button @click="showDelete = false" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-xl font-bold">Annuler</button>
                <form :action="'/admin/messages/' + selected.id" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold shadow-lg">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection