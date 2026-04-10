@props(['headers'])

<div class="overflow-x-auto bg-white rounded-[1.5rem] shadow-sm border border-gray-100">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50/50 border-b border-gray-100">
                @foreach($headers as $header)
                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-[#1B2E58] opacity-70">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            {{ $slot }}
        </tbody>
    </table>
</div>