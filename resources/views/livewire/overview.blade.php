<div class="text-white mt-10">
    <div class="text-white mt-10">
        <h2 class="text-3xl font-black">Overview</h2>

        <button wire:click="createFact" class="mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg">
            Create new fact
        </button>

        {{-- Unpublished --}}
        <div class="mt-10">
            <h3 class="text-2xl font-black text-red-400">
                Unpublished ({{ $unpublishedFacts->count() }})
            </h3>

            <div class="mt-4 space-y-2">
                @forelse($unpublishedFacts as $fact)
                    <div class="bg-zinc-800 rounded-lg mt-4 pl-4 flex justify-between items-center">
                        <div class="font-bold">
                            <a href="{{ route('fact.preview', $fact->slug) }}" class="fact-title title">
                                {!! $fact->title !!}
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
                @empty
                    <div class="text-zinc-500 italic">
                        No unpublished facts.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Published --}}
        <div class="mt-20">
            <h3 class="text-2xl font-black text-green-400">
                Published ({{ $publishedFacts->count() }})
            </h3>

            <div class="mt-4 space-y-2">
                @forelse($publishedFacts as $fact)
                    <div class="bg-zinc-800 rounded-lg mt-4 pl-4 flex justify-between items-center">
                        <div class="font-bold">
                            <a href="{{ route('fact.show', $fact->slug) }}" class="fact-title title">
                                {!! $fact->title !!}
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
                @empty
                    <div class="text-zinc-500 italic">
                        No published facts.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>