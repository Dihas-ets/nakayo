@props(['label', 'name', 'type' => 'text', 'placeholder' => ''])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-bold text-[#1B2E58] mb-2 uppercase tracking-wide">
        {{ $label }}
    </label>
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => "w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FF9F29] focus:ring-4 focus:ring-[#FF9F29]/10 outline-none transition-all font-medium"]) }}
    >
</div>