<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
        <h3 class="text-2xl text-gray-700 font-bold mb-6 -ml-3">Miley</h3>

        <ol class="border-l-2 border-purple-600">
            @foreach ($footprints as $footprint)
                <x-footprint :footprint="$footprint"></x-footprint>
            @endforeach
        </ol>
    </div>
</x-app-layout>
