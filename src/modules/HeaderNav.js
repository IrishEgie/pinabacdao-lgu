export class HeaderNavigation {
    constructor(headerElement) {
        this.header = headerElement;
        this.mobileMenu = this.header.querySelector('#mobile-menu');
        this.mobileMenuButton = this.header.querySelector('#mobile-menu-button');
        this.menuIcon = this.header.querySelector('#mobile-menu-icon');
        this.closeIcon = this.header.querySelector('#mobile-close-icon');
        this.isMobileMenuOpen = false;
        this.navItems = this.header.querySelectorAll('.nav-item');

        this.init();
    }

    init() {
        this.setupMobileMenu();
        this.setupDesktopDropdowns();
    }

    setupMobileMenu() {
        if (!this.mobileMenuButton) return;

        this.mobileMenuButton.addEventListener('click', () => this.toggleMobileMenu());

        // Close menu when clicking on links
        const mobileLinks = this.mobileMenu?.querySelectorAll('a');
        mobileLinks?.forEach(link => {
            link.addEventListener('click', () => this.closeMobileMenu());
        });
    }

    toggleMobileMenu() {
        this.isMobileMenuOpen = !this.isMobileMenuOpen;

        if (this.isMobileMenuOpen) {
            this.mobileMenu.classList.remove('hidden');
            this.menuIcon.classList.add('hidden');
            this.closeIcon.classList.remove('hidden');
        } else {
            this.closeMobileMenu();
        }
    }

    closeMobileMenu() {
        this.mobileMenu.classList.add('hidden');
        this.menuIcon.classList.remove('hidden');
        this.closeIcon.classList.add('hidden');
        this.isMobileMenuOpen = false;
    }

    setupDesktopDropdowns() {
        this.navItems.forEach(item => {
            const dropdown = item.querySelector('.dropdown-menu');
            if (!dropdown) return;

            // Show dropdown on hover
            item.addEventListener('mouseenter', () => {
                dropdown.classList.add('show');
            });

            item.addEventListener('mouseleave', () => {
                dropdown.classList.remove('show');
            });

            // Keep dropdown open when hovering over it
            dropdown.addEventListener('mouseenter', () => {
                dropdown.classList.add('show');
            });

            dropdown.addEventListener('mouseleave', () => {
                dropdown.classList.remove('show');
            });
        });
    }
}