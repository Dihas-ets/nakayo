@props(['name', 'title'])

<div
    x-data="{ show: false, name: '{{ $name }}' }"
    x-show="show"
    x-on:open-modal.window="if ($event.detail.name === name) show = true"
    x-on:close-modal.window="show = false"
    x-on:keydown.escape.window="show = false"
    style="display: none;"
    class="fixed inset-0 z-[100] overflow-y-auto"
>
    <!-- Overlay -->
    <div x-show="show" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

    <!-- Panel -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            class="relative bg-white w-full max-w-2xl rounded-[2rem] shadow-2xl overflow-hidden"
        >
            <!-- Header -->
            <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-xl font-black text-[#1B2E58]">{{ $title }}</h3>
                <button @click="show = false" class="text-gray-400 hover:text-red-500 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>