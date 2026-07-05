import './bootstrap';

import Quill from 'quill';
import 'quill/dist/quill.snow.css';

window.Quill = Quill;

// Custom iframe blot
const BlockEmbed = Quill.import('blots/block/embed');

class IframeBlot extends BlockEmbed {
    static create(value) {
        const node = super.create();
        node.innerHTML = value;
        return node;
    }

    static value(node) {
        return node.innerHTML;
    }
}

IframeBlot.blotName = 'iframe';
IframeBlot.tagName = 'div';
IframeBlot.className = 'quill-iframe';

Quill.register(IframeBlot);

function initQuill() {
    const editor = document.querySelector('#quill-editor');
    const toolbar = document.querySelector('#quill-toolbar');
    const hiddenInput = document.querySelector('#hidden-quill-input');

    if (!editor || !toolbar) {
        return;
    }

    // Prevent duplicate initialization
    if (editor.__quill) {
        return;
    }

    const quill = new Quill(editor, {
        theme: 'snow',
        placeholder: 'Start typing...',
        modules: {
            toolbar: {
                container: toolbar,
                handlers: {
                    image() {
                        const url = prompt('Enter image URL');

                        if (!url) {
                            return;
                        }

                        const range = this.quill.getSelection(true);

                        this.quill.insertEmbed(
                            range.index,
                            'image',
                            url,
                            Quill.sources.USER
                        );
                    },

                    youtube() {
                        const embedCode = prompt(
                            'Paste YouTube embed iframe:'
                        );

                        if (
                            !embedCode ||
                            !embedCode.includes('<iframe')
                        ) {
                            return;
                        }

                        const range = this.quill.getSelection(true);

                        this.quill.insertEmbed(
                            range.index,
                            'iframe',
                            embedCode,
                            Quill.sources.USER
                        );
                    },
                },
            },
        },
    });

    window.quillInstance = quill;

    if (hiddenInput?.value) {
        quill.clipboard.dangerouslyPasteHTML(hiddenInput.value);
    }

    quill.on('text-change', () => {
        if (hiddenInput) {
            hiddenInput.value = quill.root.innerHTML;
        }
    });
}

// First page load
document.addEventListener('DOMContentLoaded', initQuill);

// Livewire navigation
document.addEventListener('livewire:navigated', initQuill);