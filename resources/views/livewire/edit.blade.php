<div class="">
    @if ($showSettings)
        <div id="settings" class="w-[1000px] m-auto">
            <div class="mb-4">
                <h3 class="text-xl font-semibold text-white mb-2">Category</h3>
                <input type="text" wire:model="searchCategory" wire:keyup="$refresh" placeholder="Filter categories..."
                    class="w-full px-2 py-1 rounded text-black">
                <div class="mt-2 space-y-1">
                    @foreach ($filteredCategories as $category)
                        <div class="flex items-center space-x-2">
                            <input type="radio" wire:model="selectedCategoryId" wire:change="AutoSaveCatTag"
                                value="{{ $category->id }}">
                            <span class="text-white">{{ $category->name }}</span>
                            <button wire:click="deleteCategory({{ $category->id }})"
                                class="text-red-400 ml-2 text-sm">🗑️</button>
                        </div>
                    @endforeach
                </div>
                <div class="mt-2">
                    <button wire:click="addCategory" class="text-blue-400 text-sm">
                        + Add "{{ $searchCategory }}"
                    </button>
                </div>
            </div>

            {{-- Tag Picker --}}
            <div>
                <h3 class="text-xl font-semibold text-white mb-2">Tags</h3>
                <input type="text" wire:model="searchTag" wire:keyup="$refresh" placeholder="Filter tags..."
                    class="w-full px-2 py-1 rounded text-black">
                <div class="mt-2 space-y-1">
                    @foreach ($filteredTags as $tag)
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" value="{{ $tag->id }}" wire:change="AutoSaveCatTag"
                                wire:model="selectedTagIds">
                            <span class="text-white">{{ $tag->name }}</span>
                            <button wire:click="deleteTag({{ $tag->id }})" class="text-red-400 ml-2 text-sm">🗑️</button>
                        </div>
                    @endforeach
                </div>
                <div class="mt-2">
                    <button wire:click="addTag" class="text-blue-400 text-sm">
                        + Add "{{ $searchTag }}"
                    </button>
                </div>

            </div>
            <button wire:click="saveTagsAndCategory" class="text-white">Force Save Tags/Categories</button>
        </div>
    @endif

    <div class="h-[1000px]">
        @if ($showImages)
            <div class=" text-white text-center py-4 fixed bg-black top-0 w-full">
                <form wire:submit.prevent="uploadImage">
                    <input type="file" wire:model="photo" accept=".webp">
                    @error('photo') <div class="text-red-500">{{ $message }}</div> @enderror
                    <button type="submit" class="mt-2">Upload Image</button>
                </form>

                @if (session()->has('message'))
                    <div class="text-green-500">{{ session('message') }}</div>
                @endif

                <div id="images" class="">
                    @foreach ($images as $image)
                        <div class="relative group max-w-[400px] m-auto">
                            <img src="{{ asset('/public/media/images/' . $image->name) }}" alt="topic image" class="w-[100px]">
                            <button wire:click="deleteImage({{ $image->id }})"
                                class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded text-xs opacity-0 group-hover:opacity-100 transition">
                                Delete
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <a href="/public/"
            class="fixed left-0 top-0 m-4 bg-zinc-900 p-2 rounded-md text-red-300 hover:bg-black transition ease-in-out">Go
            back</a>
        <ul class="fixed top-0 m-4 text-white right-0 mr-6 text-3xl">
            <li wire:click="toggleImagePanel" class="cursor-pointer hover:text-green-400">
                <i class="fas fa-image"></i>
            </li>
            <li class="mt-6"><button wire:click="togglePathMenu"><i class="fa-solid fa-note-sticky"></i></button></li>
            <li class="mt-6">
            <li class="mt-6">
                <button wire:click="toggleSettings">
                    <i class="fa-solid fa-cog"></i>
                </button>
            </li>
            </li>
            <button wire:click="createNote" class="fixed right-20 m-4 top-0">
                <i class="fa-solid fa-plus p-2 text-3xl bg-blue-300 rounded-md hover:bg-blue-500 cursor-pointer"></i>
            </button>

        </ul>
        <div class="max-w-[1000px] m-auto mt-4">
            <div class="mb-4">
                @if ($fact && $fact->thumb)
                    <div class="relative group inline-block">
                        <img src="{{ asset('/public/media/thumb/' . $fact->thumb) }}"
                            class="w-[100px] h-[100px] object-cover rounded border border-white/20" />

                        <button wire:click="removeThumb"
                            class="absolute top-1 right-1 bg-red-600 text-white px-1 py-0.5 rounded text-xs opacity-0 group-hover:opacity-100 transition">
                            ✕
                        </button>
                    </div>
                @else
                    <label
                        class="cursor-pointer w-[100px] h-[100px] border border-dashed border-white/20 rounded flex items-center justify-center text-xs text-white/60 hover:bg-white/10 transition">
                        Upload
                        <input type="file" wire:model="thumbUpload" accept=".webp" class="hidden" />
                    </label>
                @endif

            </div>

            <form action="">

                <input type="text" id="input-title" wire:model.defer="title"
                    class="text-5xl text-red-300 font-black border-none outline-none w-full focus:outline-none focus:ring-0 bg-transparent p-0 m-0" />

                <input type="text" id="input-subtitle" wire:model.defer="subtitle"
                    class="text-2xl text-zinc-300 font-black border-none outline-none w-full focus:outline-none focus:ring-0 bg-transparent p-0 m-0 my-4" />

                <div class="">
                    <div id="quill-editor-container" class="relative text-white" wire:ignore>
                        <div id="quill-editor" class="text-white border-none !text-xl bg-transparent overflow-hidden">
                            {!! $text !!}
                        </div>
                        <input type="hidden" id="hidden-quill-input" name="text" class="text-white p-0 m-0">
                    </div>
                </div>

                <style>
                    .ql-editor {
                        margin: 0;
                        padding: 0;
                    }
                </style>

                <script>
                    window.addEventListener('load', () => {
                        const quill = window.quillInstance;
                        if (!quill) return console.warn('❌ Quill not initialized');

                        const titleInput = document.getElementById('input-title');
                        const subtitleInput = document.getElementById('input-subtitle');
                        const hiddenInput = document.getElementById('hidden-quill-input');

                        let typingTimer;
                        const debounceDelay = 2000;

                        const triggerAutosave = () => {
                            clearTimeout(typingTimer);
                            typingTimer = setTimeout(() => {
                                const title = titleInput?.value || '';
                                const subtitle = subtitleInput?.value || '';

                                // 🧠 Always update hidden input before autosaving
                                hiddenInput.value = quill.root.innerHTML;

                                const text = hiddenInput.value;

                                console.log('[autosave after 2s pause]', {
                                    title,
                                    subtitle,
                                    text: text.slice(0, 100) + '...'
                                });

                                @this.autoSave(title, subtitle, text);
                            }, debounceDelay);
                        };

                        // Listen to typing in Quill (the input is updated via Quill's event in app.js)
                        quill.on('text-change', triggerAutosave);
                        titleInput?.addEventListener('input', triggerAutosave);
                        subtitleInput?.addEventListener('input', triggerAutosave);
                    });
                </script>

            </form>

            <div class="" wire:ignore>
                <div id="quill-toolbar" class="fixed bottom-0 text-white">
                    <span class="ql-formats">
                        <select class="ql-header bg-zinc-800 text-white">
                            <option selected></option>
                            <option value="1"></option>
                            <option value="2"></option>
                            <option value="3"></option>
                        </select>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-bold"></button>
                        <button class="ql-italic"></button>
                        <button class="ql-underline"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-list" value="ordered"></button>
                        <button class="ql-list" value="bullet"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-link"></button>
                        <button class="ql-image"></button>
                        <button class="ql-youtube">📺</button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-clean"></button>
                    </span>
                </div>
            </div>

            <style>
                /* Force the heading picker to open upwards */
                .ql-toolbar .ql-picker.ql-header .ql-picker-options {
                    top: auto !important;
                    bottom: 100% !important;
                    margin-bottom: 0.5rem;
                    /* Optional spacing */
                    z-index: 50;
                    /* Make sure it sits above other content */
                }

                .ql-editor .quill-iframe iframe {
                    width: 100%;
                    height: 400px;
                    margin: 1rem 0;
                    border-radius: 0.5rem;
                }


                .ql-toolbar button svg {
                    fill: white !important;
                }

                .ql-toolbar .ql-stroke {
                    stroke: white !important;
                }

                .ql-toolbar .ql-fill {
                    fill: white !important;
                }

                #quill-editor {
                    border: none;
                }

                #quill-editor a {
                    color: red;
                }

                #quill-editor .ql-editor {
                    background-color: transparent;
                }
            </style>

        </div>
    </div>
</div>