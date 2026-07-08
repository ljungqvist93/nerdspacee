<div x-data="{
        installed: window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone,
        showButtons: false, 

        init() {
            window.addEventListener('scroll', () => {
                this.showButtons = window.scrollY > window.innerHeight * 0.5;
            });

            Livewire.on('fact-changed', ({ url }) => {
                history.pushState({}, '', url);

                // Optional: always jump back to the top
                window.scrollTo({
                    top: 0,
                    behavior: 'instant'
                });
            });

            window.addEventListener('popstate', () => {
                location.reload();
            });
        }
    }">
    @if($fact->coverImage)
        <section wire:click="randomFact" class="relative min-h-[100svh] cursor-pointer group overflow-hidden">

            <img src="{{ asset('media/images/' . $fact->coverImage->name) }}" alt="{{ $fact->title }}"
                class="absolute inset-0 h-full w-full object-cover bg-black">

            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent"></div>

            <div class="absolute bottom-0 left-0 right-0 p-6">

                @if($fact->category)
                    <div class="mb-4">
                        <span
                            class="inline-flex items-center gap-2 text-xl rounded-full bg-{{ $fact->category->color }}-200 px-4 py-2 text-sm font-bold text-black">
                            <i class="fas fa-{{ $fact->category->icon }}"></i>
                            {{ $fact->category->name }}
                        </span>
                    </div>
                @endif

                <h1 class="text-4xl font-black leading-tight text-white">
                    {{ $fact->title }}
                </h1>

                <div class="text-center mt-8 text-zinc-400">
                    <span>Scroll for Info</span>
                    <i class="fas fa-arrow-down"></i>
                </div>

            </div>

        </section>
    @endif

    <article id="fact-content" class="max-w-3xl mx-auto px-5 py-10">

        <div class="text-lg leading-8 text-zinc-100 [&>p:last-child]:mb-0">
            {!! $fact->text !!}
        </div>

        @if($fact->tags->isNotEmpty())
            <div class="mt-10 flex flex-wrap gap-2">
                @foreach($fact->tags as $tag)
                    <span class="rounded-full bg-zinc-800 px-3 py-1 text-sm text-zinc-300">
                        #{{ $tag->name }}
                    </span>
                @endforeach
            </div>
        @endif

    </article>

    <div x-show="showButtons" x-transition.opacity.duration.250ms
        class="fixed right-6 bottom-4 flex flex-col gap-3 z-50">

        <button x-show="!installed"
            class="bg-blue-300 hover:bg-blue-400 transition p-3 rounded-full w-[60px] h-[60px] shadow-lg">
            <i class="fas fa-download"></i>
        </button>

        <button wire:click="randomFact"
            class="bg-green-300 hover:bg-green-400 transition p-3 rounded-full w-[60px] h-[60px] shadow-lg">
            <i class="fas fa-random"></i>
        </button>

    </div>

</div>