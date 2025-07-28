export class ContactForm {
    constructor(formElement) {
        this.form = formElement;
        this.submitBtn = this.form.querySelector('#submit-btn');
        this.submitText = this.submitBtn?.querySelector('.submit-text');
        this.loadingText = this.submitBtn?.querySelector('.loading-text');
        
        this.init();
    }

    init() {
        if (!this.form) return;
        
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
    }

    handleSubmit(e) {
        if (!this.submitBtn || !this.submitText || !this.loadingText) return;
        
        // Show loading state
        this.submitBtn.disabled = true;
        this.submitText.classList.add('hidden');
        this.loadingText.classList.remove('hidden');
        
        // You could add additional validation here if needed
        // or make an AJAX request instead of standard form submission
    }

    resetFormState() {
        if (!this.submitBtn || !this.submitText || !this.loadingText) return;
        
        this.submitBtn.disabled = false;
        this.submitText.classList.remove('hidden');
        this.loadingText.classList.add('hidden');
    }
}