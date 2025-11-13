export class QuillEditor {
    constructor(editorSelector, hiddenInputSelector) {
        this.editorElement = document.querySelector(editorSelector);
        this.hiddenInput = document.querySelector(hiddenInputSelector);
        this.quill = null;

        if (this.editorElement) {
            this.init();
        }
    }

    init() {
        // Initialize Quill with FULL toolbar + syntax highlighting
        this.quill = new Quill(this.editorElement, {
            theme: 'snow',
            modules: {
                toolbar: [
                    // Headers
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                    // Font size
                    [{ 'size': ['small', false, 'large', 'huge'] }],

                    // Text formatting
                    ['bold', 'italic', 'underline', 'strike'],

                    // Text color and background
                    [{ 'color': [] }, { 'background': [] }],

                    // Lists
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],

                    // Alignment
                    [{ 'align': [] }],

                    // Code blocks en quotes
                    ['blockquote', 'code-block'],

                    // Links, images, video
                    ['link', 'image', 'video'],

                    // Clean formatting
                    ['clean']
                ],
                syntax: {
                    highlight: (text) => {
                        return hljs.highlightAuto(text).value;
                    }
                }
            },
            placeholder: 'Schrijf hier je bericht...'
        });

        // Load existing content if any
        if (this.hiddenInput.value) {
            this.quill.root.innerHTML = this.hiddenInput.value;
        }

        // Setup form submit handler
        this.setupFormSubmit();
    }

    setupFormSubmit() {
        const form = this.editorElement.closest('form');
        if (form) {
            form.addEventListener('submit', (e) => {
                this.syncContent();
            });
        }
    }

    syncContent() {
        // Copy Quill content to hidden input
        this.hiddenInput.value = this.quill.root.innerHTML;
    }

    getContent() {
        return this.quill.root.innerHTML;
    }

    setContent(html) {
        this.quill.root.innerHTML = html;
    }

    clear() {
        this.quill.setText('');
    }
}
