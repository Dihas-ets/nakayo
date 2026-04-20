@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto" x-data="galleryHandler()">
    <form action="{{ route('admin.services.update', $service->id_service) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.services.index') }}" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1B2E58] shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h2 class="text-2xl font-black text-[#1B2E58]">Modifier : {{ $service->titre }}</h2>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.services.show', $service->id_service) }}" class="bg-gray-100 text-[#1B2E58] px-6 py-3 rounded-2xl font-black">APERÇU</a>
                <button type="submit" class="bg-[#1B2E58] text-white px-10 py-3 rounded-2xl font-black shadow-xl hover:bg-[#00261C]">METTRE À JOUR</button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- GAUCHE : CONTENU & GALERIE -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100">
                    <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Nom de la prestation</label>
                    <input type="text" name="titre" value="{{ $service->titre }}" class="w-full text-3xl font-black text-[#1B2E58] border-none focus:ring-0 p-0 mb-8">

                    <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Résumé (Accroche)</label>
                    <textarea name="courte_description" rows="2" class="w-full bg-gray-50 border-none rounded-2xl p-6 text-gray-600 font-medium mb-6">{{ $service->courte_description }}</textarea>

                    <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Description complète</label>
                    <textarea name="description" rows="10" class="w-full border-2 border-gray-50 rounded-[2rem] p-6 text-gray-500 font-medium focus:border-[#FF9F29] outline-none">{{ $service->description }}</textarea>
                </div>

                <!-- GALERIE DYNAMIQUE -->
                <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-black text-[#1B2E58] mb-6">Médias de la galerie</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Photos existantes et nouvelles --}}
                        <div class="space-y-4">
                            <label class="block text-[10px] font-black uppercase text-gray-400">Photos de réalisation</label>
                            <div class="grid grid-cols-3 gap-3">
                                {{-- Photos en base --}}
                                @foreach($service->galleries->where('type_media', 'image') as $img)
                                    <div class="relative aspect-square rounded-xl overflow-hidden group">
                                        <img src="{{url('storage/' . $img->image_url) }}" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-red-600/80 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all">
                                            <i class="fa-solid fa-trash text-white"></i>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- Previews Alpine --}}
                                <template x-for="(preview, index) in imagePreviews" :key="index">
                                    <div class="aspect-square rounded-xl overflow-hidden border-2 border-[#FF9F29] relative">
                                        <img :src="preview" class="w-full h-full object-cover">
                                    </div>
                                </template>
                                <label class="aspect-square rounded-xl border-2 border-dashed border-gray-100 flex items-center justify-center cursor-pointer hover:bg-orange-50">
                                    <input type="file" name="gallery_images[]" multiple class="hidden" @change="handleImageUpload($event)">
                                    <i class="fa-solid fa-plus text-gray-300"></i>
                                </label>
                            </div>
                        </div>

                        {{-- Vidéos --}}
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <label class="block text-[10px] font-black uppercase text-gray-400">Liens Vidéos</label>
                                <button type="button" @click="addVideoRow()" class="text-[9px] font-bold text-[#FF9F29]">+ AJOUTER</button>
                            </div>
                            <div class="space-y-2">
                                {{-- Vidéos en base --}}
                                @foreach($service->galleries->where('type_media', 'video') as $vid)
                                    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                                        <i class="fa-solid fa-circle-play text-[#1B2E58] opacity-30"></i>
                                        <span class="text-[10px] font-bold truncate flex-1">{{ $vid->link }}</span>
                                    </div>
                                @endforeach
                                <template x-for="(video, index) in videoRows" :key="index">
                                    <input type="url" name="gallery_videos[]" x-model="video.url" placeholder="Lien Youtube..." class="w-full bg-gray-50 border-none rounded-xl px-4 py-2 text-xs focus:ring-1 focus:ring-[#FF9F29]">
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DROITE : SIDEBAR -->
            <div class="space-y-6">
                {{-- LIAISON PRODUIT --}}
                <!-- <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-4">Produit lié</h3>
                    <select name="id_produit" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58]" required>
                        @foreach($produits as $p)
                            <option value="{{ $p->id_produit }}" {{ $service->galleries->first()?->id_produit == $p->id_produit ? 'selected' : '' }}>
                                {{ $p->nom }}
                            </option>
                        @endforeach
                    </select>
                </div> -->

                
                {{-- IMAGE PRINCIPALE --}}
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 text-center">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-6 text-left">Couverture Actuelle</h3>
                    
                    <!-- On utilise :src pour lier à Alpine.js -->
                    <img :src="mainPreview" class="rounded-3xl h-48 w-full object-cover mb-6">
                    
                    <label class="block w-full py-3 bg-gray-100 rounded-xl text-[10px] font-black cursor-pointer hover:bg-[#FF9F29] hover:text-white transition-all">
                        CHANGER L'IMAGE
                        <!-- On ajoute @change pour déclencher la preview -->
                        <input type="file" name="media" class="hidden" @change="handleMainPreview($event)">
                    </label>
                </div>


                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <label class="block text-[10px] font-black text-gray-300 uppercase mb-3 tracking-widest">Statut de publication</label>
                    <select name="status" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                        <option value="publié" {{ (isset($service) && $service->status == 'publié') ? 'selected' : '' }}>✅ Publié</option>
                        <option value="brouillon" {{ (isset($service) && $service->status == 'brouillon') ? 'selected' : '' }}>⏳ Brouillon</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function galleryHandler() {
        return {
            // On initialise la preview avec l'image actuelle venant de la base de données
            mainPreview: "{{ url('storage/'.$service->media) }}",
            imagePreviews: [], 
            videoRows: [],

            // Fonction pour gérer l'image principale
            handleMainPreview(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.mainPreview = e.target.result; // On met à jour la source de l'image
                    };
                    reader.readAsDataURL(file);
                }
            },

            handleImageUpload(event) {
                Array.from(event.target.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = (e) => this.imagePreviews.push(e.target.result);
                    reader.readAsDataURL(file);
                });
            },
            addVideoRow() { this.videoRows.push({ url: '' }); },
            removeVideoRow(index) { this.videoRows.splice(index, 1); }
        }
    }
</script>
@endsection