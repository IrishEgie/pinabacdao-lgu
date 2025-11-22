/**
 * News Gallery Module
 * Instagram-style gallery with touch/swipe support
 * 
 * Location: src/modules/NewsGallery.js
 */

export class NewsGallery {
    constructor(container) {
        this.container = container;
        this.imagesWrapper = container.querySelector('.gallery-images');
        this.slides = container.querySelectorAll('.gallery-slide');
        this.dots = container.querySelectorAll('.gallery-dot');
        this.prevBtn = container.querySelector('.gallery-prev');
        this.nextBtn = container.querySelector('.gallery-next');
        this.currentSlideEl = container.querySelector('.current-slide');
        
        this.currentIndex = 0;
        this.totalSlides = this.slides.length;
        
        // Touch/swipe properties
        this.touchStartX = 0;
        this.touchEndX = 0;
        this.isDragging = false;
        this.startPos = 0;
        this.currentTranslate = 0;
        this.prevTranslate = 0;
        
        // Only initialize if we have multiple slides
        if (this.totalSlides > 1) {
            this.init();
        }
    }

    init() {
        this.attachEventListeners();
        this.updateGallery(0, false); // Initialize without animation
    }

    attachEventListeners() {
        // Navigation buttons
        if (this.prevBtn) {
            this.prevBtn.addEventListener('click', () => this.prev());
        }
        
        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', () => this.next());
        }

        // Dot indicators
        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', () => this.goToSlide(index));
        });

        // Keyboard navigation
        this.container.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') this.prev();
            if (e.key === 'ArrowRight') this.next();
        });

        // Touch events for swipe
        this.imagesWrapper.addEventListener('touchstart', (e) => this.touchStart(e), { passive: true });
        this.imagesWrapper.addEventListener('touchmove', (e) => this.touchMove(e), { passive: true });
        this.imagesWrapper.addEventListener('touchend', () => this.touchEnd());

        // Mouse events for desktop drag
        this.imagesWrapper.addEventListener('mousedown', (e) => this.dragStart(e));
        this.imagesWrapper.addEventListener('mousemove', (e) => this.dragMove(e));
        this.imagesWrapper.addEventListener('mouseup', () => this.dragEnd());
        this.imagesWrapper.addEventListener('mouseleave', () => this.dragEnd());

        // Prevent context menu on long press
        this.imagesWrapper.addEventListener('contextmenu', (e) => {
            if (this.isDragging) e.preventDefault();
        });

        // Show/hide arrows on hover (desktop only)
        if (window.innerWidth > 768) {
            this.container.addEventListener('mouseenter', () => {
                if (this.prevBtn) this.prevBtn.style.opacity = '1';
                if (this.nextBtn) this.nextBtn.style.opacity = '1';
            });
            
            this.container.addEventListener('mouseleave', () => {
                if (this.prevBtn) this.prevBtn.style.opacity = '0';
                if (this.nextBtn) this.nextBtn.style.opacity = '0';
            });
        }
    }

    // Touch handlers
    touchStart(e) {
        this.touchStartX = e.touches[0].clientX;
        this.isDragging = true;
        this.startPos = e.touches[0].clientX;
        this.imagesWrapper.style.transition = 'none';
    }

    touchMove(e) {
        if (!this.isDragging) return;
        
        const currentPosition = e.touches[0].clientX;
        this.currentTranslate = this.prevTranslate + currentPosition - this.startPos;
        this.imagesWrapper.style.transform = `translateX(${this.currentTranslate}px)`;
    }

    touchEnd() {
        this.touchEndX = this.currentTranslate;
        const movedBy = this.currentTranslate - this.prevTranslate;
        
        // Swipe threshold: 50px
        if (movedBy < -50 && this.currentIndex < this.totalSlides - 1) {
            this.next();
        } else if (movedBy > 50 && this.currentIndex > 0) {
            this.prev();
        } else {
            this.goToSlide(this.currentIndex);
        }
        
        this.isDragging = false;
    }

    // Mouse drag handlers (desktop)
    dragStart(e) {
        this.isDragging = true;
        this.startPos = e.clientX;
        this.imagesWrapper.style.cursor = 'grabbing';
        this.imagesWrapper.style.transition = 'none';
    }

    dragMove(e) {
        if (!this.isDragging) return;
        
        e.preventDefault();
        const currentPosition = e.clientX;
        this.currentTranslate = this.prevTranslate + currentPosition - this.startPos;
        this.imagesWrapper.style.transform = `translateX(${this.currentTranslate}px)`;
    }

    dragEnd() {
        if (!this.isDragging) return;
        
        const movedBy = this.currentTranslate - this.prevTranslate;
        
        // Drag threshold: 100px
        if (movedBy < -100 && this.currentIndex < this.totalSlides - 1) {
            this.next();
        } else if (movedBy > 100 && this.currentIndex > 0) {
            this.prev();
        } else {
            this.goToSlide(this.currentIndex);
        }
        
        this.isDragging = false;
        this.imagesWrapper.style.cursor = 'grab';
    }

    // Navigation methods
    prev() {
        if (this.currentIndex > 0) {
            this.goToSlide(this.currentIndex - 1);
        }
    }

    next() {
        if (this.currentIndex < this.totalSlides - 1) {
            this.goToSlide(this.currentIndex + 1);
        }
    }

    goToSlide(index) {
        this.currentIndex = index;
        this.updateGallery(index, true);
    }

    updateGallery(index, animate = true) {
        const slideWidth = this.slides[0].offsetWidth;
        const translateValue = -slideWidth * index;
        
        // Enable/disable transition
        if (animate) {
            this.imagesWrapper.style.transition = 'transform 300ms ease-out';
        } else {
            this.imagesWrapper.style.transition = 'none';
        }
        
        // Update transform
        this.imagesWrapper.style.transform = `translateX(${translateValue}px)`;
        this.prevTranslate = translateValue;
        this.currentTranslate = translateValue;
        
        // Update counter
        if (this.currentSlideEl) {
            this.currentSlideEl.textContent = index + 1;
        }
        
        // Update dots
        this.dots.forEach((dot, i) => {
            if (i === index) {
                dot.classList.add('bg-primary-600', 'w-8');
                dot.classList.remove('bg-gray-300', 'hover:bg-gray-400');
            } else {
                dot.classList.remove('bg-primary-600', 'w-8');
                dot.classList.add('bg-gray-300', 'hover:bg-gray-400');
            }
        });
        
        // Update button states
        if (this.prevBtn) {
            this.prevBtn.disabled = index === 0;
            this.prevBtn.style.opacity = index === 0 ? '0.5' : '';
        }
        
        if (this.nextBtn) {
            this.nextBtn.disabled = index === this.totalSlides - 1;
            this.nextBtn.style.opacity = index === this.totalSlides - 1 ? '0.5' : '';
        }
    }
}

export default NewsGallery;