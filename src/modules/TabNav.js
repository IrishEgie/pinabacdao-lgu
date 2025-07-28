export class TabNavigation {
    constructor(container) {
        this.container = container;
        this.tabTriggers = this.container.querySelectorAll('.tab-trigger');
        this.tabContents = this.container.querySelectorAll('.tab-content');
        
        this.init();
    }

    init() {
        this.updateActiveTab();
        window.addEventListener('popstate', () => this.updateActiveTab());
    }

    updateActiveTab() {
        const urlParams = new URLSearchParams(window.location.search);
        const currentTab = urlParams.get('tab') || this.tabTriggers[0]?.dataset.tab;
        
        this.tabTriggers.forEach(trigger => {
            const isActive = trigger.dataset.tab === currentTab;
            trigger.classList.toggle('bg-white', isActive);
            trigger.classList.toggle('text-gray-900', isActive);
            trigger.classList.toggle('shadow-sm', isActive);
            trigger.classList.toggle('text-gray-500', !isActive);
            trigger.classList.toggle('hover:text-gray-700', !isActive);
        });
        
        this.tabContents.forEach(content => {
            const shouldShow = content.dataset.tab === currentTab;
            content.classList.toggle('hidden', !shouldShow);
            content.classList.toggle('block', shouldShow);
        });
    }
}