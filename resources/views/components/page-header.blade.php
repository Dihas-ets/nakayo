@props(['title', 'buttonText', 'modalName'])

<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-black text-[#1B2E58] tracking-tight">{{ $title }}</h1>
        <div class="w-12 h-1 bg-[#FF9F29] mt-1 rounded-full"></div>
    </div>
    
    <x-button 
        @click="$dispatch('open-modal', { name: '{{ $modalName }}' })" 
        variant="orange" 
        icon="fa-solid fa-plus">
        {{ $buttonText }}
    </x-button>
</div>