import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import './bootstrap';
import { QuillEditor } from './quill-editor';


document.addEventListener('DOMContentLoaded', () => {

    if (document.querySelector('#topic-editor')) {
        new QuillEditor('#topic-editor', '#topic-body-input');
    }


    if (document.querySelector('#reply-editor')) {
        new QuillEditor('#reply-editor', '#reply-body-input');
    }


    if (document.querySelector('#thread-editor')) {
        new QuillEditor('#thread-editor', '#thread-description-input');
    }
});
