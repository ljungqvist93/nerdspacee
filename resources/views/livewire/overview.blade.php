<div class="text-white mt-10">
    <h2 class="text-3xl font-black">Overview</h2>

    <button wire:click="createFact" class="mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg">
        Create new fact
    </button>

    <div class="mt-8 space-y-2">
        @foreach($facts as $fact)
            <div class="bg-zinc-800 rounded-lg mt-4 pl-4 flex justify-between items-center">
                <div class="font-bold">
                    <a href="{{ route('fact.show', $fact->slug) }}">
                        {{ $fact->title }}
                    </a>
                </div>

                @if($fact->description)
                    <div class="text-zinc-400 text-sm">
                        {{ Str::limit($fact->description, 120) }}
                    </div>
                @endif

                <a href="{{ route('fact.edit', ['id' => $fact->id]) }}"
                    class="block bg-zinc-800 hover:bg-zinc-700 rounded-lg p-4 transition">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
        @endforeach
    </div>
</div>