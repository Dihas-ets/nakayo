@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto" x-data="galleryHandler()">
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- HEADER (inchangé) -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.services.index') }}" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1B2E58] shadow-sm transition-all">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div>
                    <h2 class="text-2xl font-black text-[#1B2E58]">Nouveau Service</h2>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest italic">Catalogue NAKAYO</p>
                </div>
            </div>
            <button type="submit" class="bg-[#1B2E58] text-white px-10 py-3 rounded-2xl font-black shadow-xl hover:bg-[#00261C] transition-all">
                PUBLIER LA FICHE
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- GAUCHE : INFOS & GALERIE (inchangé) -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100">
                    <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Nom de la prestation</label>
                    <input type="text" name="titre" placeholder="Titre..." class="w-full text-3xl font-black text-[#1B2E58] border-none focus:ring-0 p-0 mb-8 placeholder:text-gray-100">
                    <textarea name="courte_description" rows="2" class="w-full bg-gray-50 border-none rounded-2xl p-6 text-gray-600 font-medium mb-6" placeholder="Résumé..."></textarea>
                    <textarea name="description" rows="10" class="w-full border-2 border-gray-50 rounded-[2rem] p-6 text-gray-500 font-medium focus:border-[#FF9F29] outline-none transition-all" placeholder="Description complète..."></textarea>
                </div>

                {{-- Bloc Galerie (inchangé) --}}
                <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-black text-[#1B2E58] mb-6">Galerie Photos & Vidéos</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Section Photos --}}
                        <div class="grid grid-cols-3 gap-2">
                            <template x-for="(preview, index) in imagePreviews" :key="index">
                                <div class="aspect-square rounded-xl overflow-hidden border-2 border-[#FF9F29] relative">
                                    <img :src="preview" class="w-full h-full object-cover">
                                    <button type="button" @click="removeImage(index)" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-[8px]"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </template>
                            <label class="aspect-square rounded-xl border-2 border-dashed border-gray-100 flex items-center justify-center cursor-pointer hover:bg-gray-50">
                                <input type="file" name="gallery_images[]" multiple class="hidden" @change="handleImageUpload($event)">
                                <i class="fa-solid fa-plus text-gray-300"></i>
                            </label>
                        </div>
                        {{-- Section Vidéos --}}
                        <div class="space-y-2">
                            <button type="button" @click="addVideoRow()" class="text-[9px] font-bold text-[#FF9F29]">+ VIDÉO</button>
                            <template x-for="(video, index) in videoRows" :key="index">
                                <input type="url" name="gallery_videos[]" x-model="video.url" placeholder="URL Youtube" class="w-full bg-gray-50 border-none rounded-xl px-4 py-2 text-xs mb-2">
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DROITE : SIDEBAR AVEC IMAGE PAR DÉFAUT -->
            <div class="space-y-6">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-6 border-b pb-4">Visuel de couverture</h3>
                    
                    {{-- Aperçu dynamique du visuel principal --}}
                    <div class="relative group rounded-[2rem] overflow-hidden mb-4 bg-gray-50 border border-gray-100 h-48">
                        {{-- Si coverPreview est nul, on affiche l'image par défaut des assets --}}
                        <img :src="coverPreview ? coverPreview : '{{ url('assets/images/default-service.jpg') }}'" 
                             class="w-full h-full object-cover transition-all duration-500"
                             :class="!coverPreview ? 'opacity-40 grayscale' : ''">
                        
                        <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity">
                            <label class="cursor-pointer bg-white text-[#1B2E58] px-4 py-2 rounded-xl font-bold text-xs shadow-xl">
                                CHANGER L'IMAGE
                                <input type="file" name="media" class="hidden" @change="handleCoverUpload($event)">
                            </label>
                        </div>
                    </div>
                    <p class="text-[9px] text-center font-bold text-gray-400 uppercase">
                        <span x-text="coverPreview ? 'Image personnalisée' : 'Utilisation de l\'image par défaut'"></span>
                    </p>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <label class="block text-[10px] font-black text-gray-300 uppercase mb-3 tracking-widest">Statut de publication</label>
                    <select name="status" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                        <option value="publié" {{ (isset($service) && $service->status == 'publié') ? 'selected' : '' }}>✅ Publié</option>
                        <option value="brouillon" {{ (isset($service) && $service->status == 'brouillon') ? 'selected' : '' }}>⏳ Brouillon</option>
                    </select>
                </div>

                <div class="bg-[#1B2E58] rounded-[2.5rem] p-8 text-white shadow-xl italic text-sm opacity-80">
                    Conseil : Utilisez une image de haute qualité (1200x800px) pour un meilleur rendu sur le site public.
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function galleryHandler() {
        return {
            imagePreviews: [],
            coverPreview: null, // Pour l'image principale
            videoRows: [],
            
            // Gérer l'upload de la couverture
            handleCoverUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => { this.coverPreview = e.target.result; };
                    reader.readAsDataURL(file);
                }
            },

            // Gérer la galerie (multiple)
            handleImageUpload(event) {
                const files = Array.from(event.target.files);
                files.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = (e) => { this.imagePreviews.push(e.target.result); };
                    reader.readAsDataURL(file);
                });
            },
            removeImage(index) { this.imagePreviews.splice(index, 1); },
            addVideoRow() { this.videoRows.push({ url: '' }); },
            removeVideoRow(index) { this.videoRows.splice(index, 1); }
        }
    }
</script>
@endsection