export class Accordion {
    constructor(container) {
        // console.log('Accordion module initialized');
        
        this.container = container;
        this.items = Array.from(this.container.querySelectorAll('.accordion-item'));
        this.triggers = Array.from(this.container.querySelectorAll('.accordion-trigger'));
        this.contents = Array.from(this.container.querySelectorAll('.accordion-content'));
        
        this.init();
    }

    init() {
        this.triggers.forEach((trigger, index) => {
            trigger.addEventListener('click', (e) => {
                this.toggleItem(e.currentTarget);
            });
            
            trigger.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.toggleItem(e.currentTarget);
                }
            });
        });

        this.items.forEach((item, index) => {
            const trigger = item.querySelector('.accordion-trigger');
            const content = item.querySelector('.accordion-content');
            
            if (trigger.getAttribute('aria-expanded') !== 'true') {
                content.classList.add('hidden');
            }
        });
    }

    toggleItem(trigger) {
        const item = trigger.closest('.accordion-item');
        const content = item.querySelector('.accordion-content');
        const isExpanded = trigger.getAttribute('aria-expanded') === 'true';
        const icon = trigger.querySelector('svg');

        // Toggle the current item
        trigger.setAttribute('aria-expanded', !isExpanded);
        content.classList.toggle('hidden');
        
        // Rotate the icon
        if (icon) {
            icon.classList.toggle('rotate-180');
        }

        // Close other items if needed (optional)
        if (!isExpanded && this.container.hasAttribute('data-accordion-single')) {
            this.closeOtherItems(item);
        }
    }

    closeOtherItems(currentItem) {
        this.items.forEach(item => {
            if (item !== currentItem) {
                const trigger = item.querySelector('.accordion-trigger');
                const content = item.querySelector('.accordion-content');
                const icon = trigger.querySelector('svg');
                
                trigger.setAttribute('aria-expanded', 'false');
                content.classList.add('hidden');
                
                if (icon) {
                    icon.classList.remove('rotate-180');
                }
            }
        });
    }
}