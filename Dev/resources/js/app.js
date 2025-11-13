import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import './bootstrap';
import { QuillEditor } from './quill-editor';

// Initialize Quill editors when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // For topics/create and topics/edit
    if (document.querySelector('#topic-editor')) {
        new QuillEditor('#topic-editor', '#topic-body-input');
    }

    // For replies
    if (document.querySelector('#reply-editor')) {
        new QuillEditor('#reply-editor', '#reply-body-input');
    }

    // For threads (if you want rich text there too)
    if (document.querySelector('#thread-editor')) {
        new QuillEditor('#thread-editor', '#thread-description-input');
    }
});
