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
        <a href="/overview/"
            class="fixed left-0 top-0 m-4 bg-zinc-900 p-2 rounded-md text-red-300 hover:bg-black transition ease-in-out">
            Go back
        </a>
        <ul class="fixed top-0 m-4 text-white right-0 mr-6 text-3xl">
            <li class="mt-6">
                <button wire:click="toggleSettings">
                    <i class="fa-solid fa-cog"></i>
                </button>
                <a href="{{ route('fact.preview', $fact->slug) }}" target="_blank" rel="noopener noreferrer">
                    Open
                </a>
                <button wire:click="togglePublished"
                    class="{{ $fact->published ? 'bg-red-500' : 'bg-green-500' }} text-white px-4 py-2 rounded">
                    {{ $fact->published ? 'Unpublish' : 'Publish' }}
                </button>
                <button wire:click="toggleTitleCase" class="px-3 py-2 rounded bg-zinc-700 text-white">
                    {{ $fact->title_case ? 'Disable Title Case' : 'Enable Title Case' }}
                </button>
            </li>

        </ul>
        <div class="max-w-[1000px] m-auto mt-4">
            <div class="mb-4">
                <div class="flex flex-wrap gap-3">

                    @foreach($images as $image)
                        <div class="relative group inline-block">
                            <img src="{{ asset('/media/images/' . $image->name) }}"
                                class="w-[300px] h-[400px] object-cover rounded border border-white/20" />

                            <button wire:click="deleteImage({{ $image->id }})"
                                class="absolute top-1 right-1 bg-red-600 text-white px-1 py-0.5 rounded text-xs opacity-0 group-hover:opacity-100 transition">
                                ✕
                            </button>
                        </div>
                    @endforeach

                    <label
                        class="cursor-pointer w-[100px] h-[100px] border border-dashed border-white/20 rounded flex items-center justify-center text-xs text-white/60 hover:bg-white/10 transition">
                        Upload
                        <input type="file" wire:model="photo" accept=".webp" class="hidden" />
                    </label>

                </div>

            </div>

            <form action="">

                <div id="quill-title" wire:ignore class="title">
                    {!! $title !!}
                </div>

                <input type="hidden" id="hidden-title-input" wire:model.defer="title">

                <div class="" wire:ignore>
                    <div id="quill-title-toolbar" class="mb-6 text-white">
                        <!-- Text Color -->
                        <select class="ql-color">
                            <option value=""></option>
                            <option value="red"></option>
                            <option value="blue"></option>
                            <option value="green"></option>
                            <option value="amber"></option>
                            <option value="violet"></option>
                            <option value="white"></option>
                            <option value="black"></option>
                        </select>

                        <span class="ql-formats">
                            <button class="ql-bold"></button>
                            <button class="ql-italic"></button>
                            <button class="ql-underline"></button>
                        </span>

                        <span class="ql-formats">
                            <button class="ql-clean"></button>
                        </span>
                    </div>
                </div>

                <div class=" pb-40">
                    <div class="mt-10">
                        <div id="quill-editor-container" class="relative text-white" wire:ignore>
                            <div id="quill-editor"
                                class="text-white border-none !text-xl bg-transparent overflow-hidden">
                                {!! $text !!}
                            </div>
                            <input type="hidden" id="hidden-quill-input" name="text" class="text-white p-0 m-0">
                        </div>
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
                        if (typeof Quill === 'undefined') {
                            console.error('❌ Quill is not loaded');
                            return;
                        }

                        /*
                         * Register class-based colors before loading the saved HTML
                         */
                        const ColorClass = Quill.import('attributors/class/color');

                        ColorClass.whitelist = [
                            'red',
                            'blue',
                            'green',
                            'amber',
                            'violet',
                            'white',
                            'black'
                        ];

                        Quill.register(ColorClass, true);

                        /*
                         * The body editor has already been created elsewhere
                         */
                        const quill = window.quillInstance;

                        if (!quill) {
                            console.error('❌ Body Quill is not initialized');
                            return;
                        }

                        const Delta = Quill.import('delta');

                        const titleCaseEnabled = @json($fact->title_case);
                        const initialTitleHtml = @json($title);
                        const initialBodyHtml = @json($text);

                        const hiddenTitleInput =
                            document.getElementById('hidden-title-input');

                        const hiddenBodyInput =
                            document.getElementById('hidden-quill-input');

                        /*
                         * Create title editor after class colors are registered
                         */
                        const titleQuill = new Quill('#quill-title', {
                            theme: 'snow',
                            placeholder: 'Title...',
                            modules: {
                                toolbar: '#quill-title-toolbar',
                            },
                        });

                        /*
                         * Reload both saved HTML values after registering ColorClass.
                         * This makes the body editor recognize ql-color-red,
                         * ql-color-blue, etc.
                         */
                        titleQuill.clipboard.dangerouslyPasteHTML(
                            initialTitleHtml || ''
                        );

                        quill.clipboard.dangerouslyPasteHTML(
                            initialBodyHtml || ''
                        );

                        /*
                         * Title-case settings
                         */
                        const smallWords = [
                            'a',
                            'an',
                            'and',
                            'as',
                            'at',
                            'but',
                            'by',
                            'for',
                            'from',
                            'in',
                            'nor',
                            'of',
                            'on',
                            'or',
                            'the',
                            'to',
                            'up',
                            'with'
                        ];

                        const toTitleCase = (text) => {
                            const words = text.match(/\S+|\s+/g) || [];

                            const wordIndexes = words
                                .map((part, index) => {
                                    return /\S/.test(part) ? index : null;
                                })
                                .filter((index) => index !== null);

                            return words
                                .map((part, index) => {
                                    if (!/\S/.test(part)) {
                                        return part;
                                    }

                                    const clean = part.toLowerCase();

                                    const isFirstWord =
                                        index === wordIndexes[0];

                                    const isLastWord =
                                        index === wordIndexes[wordIndexes.length - 1];

                                    if (
                                        !isFirstWord &&
                                        !isLastWord &&
                                        smallWords.includes(clean)
                                    ) {
                                        return clean;
                                    }

                                    return (
                                        clean.charAt(0).toUpperCase() +
                                        clean.slice(1)
                                    );
                                })
                                .join('');
                        };

                        /*
                         * Autosave
                         */
                        let typingTimer;
                        let updatingTitle = false;

                        const debounceDelay = 2000;

                        const triggerAutosave = () => {
                            clearTimeout(typingTimer);

                            typingTimer = setTimeout(() => {
                                const title = titleQuill.root.innerHTML;
                                const subtitle = '';
                                const text = quill.root.innerHTML;

                                if (hiddenTitleInput) {
                                    hiddenTitleInput.value = title;
                                }

                                if (hiddenBodyInput) {
                                    hiddenBodyInput.value = text;
                                }

                                console.log('[autosave after 2s pause]', {
                                    title,
                                    text: text.slice(0, 100) + '...',
                                });

                                @this.autoSave(title, subtitle, text);
                            }, debounceDelay);
                        };

                        /*
                         * Preserve formatting while applying title case
                         */
                        const normalizeTitle = () => {
                            if (!titleCaseEnabled) {
                                triggerAutosave();
                                return;
                            }

                            if (updatingTitle) {
                                return;
                            }

                            const selection = titleQuill.getSelection();
                            const currentText = titleQuill.getText();

                            const textWithoutFinalNewline =
                                currentText.endsWith('\n')
                                    ? currentText.slice(0, -1)
                                    : currentText;

                            const converted =
                                toTitleCase(textWithoutFinalNewline);

                            if (converted === textWithoutFinalNewline) {
                                triggerAutosave();
                                return;
                            }

                            updatingTitle = true;

                            let patch = new Delta();
                            let cursor = 0;

                            for (
                                let i = 0;
                                i < textWithoutFinalNewline.length;
                                i++
                            ) {
                                const oldChar =
                                    textWithoutFinalNewline[i];

                                const newChar =
                                    converted[i];

                                if (oldChar === newChar) {
                                    cursor++;
                                    continue;
                                }

                                if (cursor > 0) {
                                    patch = patch.retain(cursor);
                                    cursor = 0;
                                }

                                const formats =
                                    titleQuill.getFormat(i, 1);

                                patch = patch
                                    .delete(1)
                                    .insert(newChar, formats);
                            }

                            if (patch.ops.length > 0) {
                                titleQuill.updateContents(
                                    patch,
                                    'api'
                                );
                            }

                            if (selection) {
                                titleQuill.setSelection(
                                    selection.index,
                                    selection.length,
                                    'silent'
                                );
                            }

                            updatingTitle = false;

                            triggerAutosave();
                        };

                        titleQuill.on(
                            'text-change',
                            (delta, oldDelta, source) => {
                                if (source === 'api') {
                                    return;
                                }

                                normalizeTitle();
                            }
                        );

                        quill.on(
                            'text-change',
                            (delta, oldDelta, source) => {
                                if (source === 'api') {
                                    return;
                                }

                                triggerAutosave();
                            }
                        );
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
                    <button id="insert-hr-button"
                        class="bg-zinc-800 text-white text-sm px-2 py-1 rounded hover:bg-zinc-700">
                        +
                    </button><br>

                    <!-- 👇 Text Color Picker -->
                    <select class="ql-color">
                        <option value=""></option>
                        <option value="red"></option>
                        <option value="blue"></option>
                        <option value="green"></option>
                        <option value="amber"></option>
                        <option value="violet"></option>
                        <option value="white"></option>
                        <option value="black"></option>
                    </select><br>
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

                #quill-editor {
                    border: none;
                }

                #quill-title.ql-container {
                    border: none !important;
                }

                #quill-title .ql-editor {
                    font-size: 36px;
                    font-weight: 800;
                    line-height: 1.1;
                    padding: 0;
                }

                .title,
                .title .ql-editor {
                    font-family: "Fredoka", sans-serif;
                    font-weight: 900;
                }

                #quill-editor .ql-editor {
                    color: white;
                    font-family: "Fredoka", sans-serif;
                    font-size: 20px;
                    font-weight: 400;
                    line-height: 1.7;
                    padding: 0;
                }
            </style>

        </div>
    </div>
</div>