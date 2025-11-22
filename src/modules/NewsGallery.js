/**
 * News Gallery Module
 * Instagram-style gallery with touch/swipe support, Looping, and Lightbox
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

        // Lightbox state
        this.lightboxOpen = false;
        this.lightboxEl = null;
        
        if (this.totalSlides > 0) {
            this.init();
        }
    }

    init() {
        this.attachEventListeners();
        this.updateGallery(0, false); // Initialize
    }

    attachEventListeners() {
        // Navigation buttons (Main Gallery)
        if (this.prevBtn) this.prevBtn.addEventListener('click', (e) => { e.stopPropagation(); this.prev(); });
        if (this.nextBtn) this.nextBtn.addEventListener('click', (e) => { e.stopPropagation(); this.next(); });

        // Dot indicators
        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', (e) => { e.stopPropagation(); this.goToSlide(index); });
        });

        // Click to Open Lightbox
        this.slides.forEach((slide, index) => {
            slide.addEventListener('click', () => this.openLightbox(index));
            slide.style.cursor = 'zoom-in'; // UX hint
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (this.lightboxOpen) {
                if (e.key === 'ArrowLeft') this.prev();
                if (e.key === 'ArrowRight') this.next();
                if (e.key === 'Escape') this.closeLightbox();
            } else {
                // Only control main gallery if focused or generally viewing
                if (e.key === 'ArrowLeft') this.prev();
                if (e.key === 'ArrowRight') this.next();
            }
        });

        // Touch events (Main Gallery)
        this.imagesWrapper.addEventListener('touchstart', (e) => this.touchStart(e), { passive: true });
        this.imagesWrapper.addEventListener('touchmove', (e) => this.touchMove(e), { passive: true });
        this.imagesWrapper.addEventListener('touchend', () => this.touchEnd());
    }

    // --- Navigation Logic with Looping ---

    prev() {
        if (this.currentIndex === 0) {
            // Loop to end
            this.goToSlide(this.totalSlides - 1);
        } else {
            this.goToSlide(this.currentIndex - 1);
        }
    }

    next() {
        if (this.currentIndex === this.totalSlides - 1) {
            // Loop to start
            this.goToSlide(0);
        } else {
            this.goToSlide(this.currentIndex + 1);
        }
    }

    goToSlide(index) {
        this.currentIndex = index;
        this.updateGallery(index, true);
        
        // Update Lightbox if open
        if (this.lightboxOpen) {
            this.updateLightboxContent(index);
        }
    }

    updateGallery(index, animate = true) {
        const slideWidth = this.slides[0].offsetWidth;
        const translateValue = -slideWidth * index;
        
        if (animate) {
            this.imagesWrapper.style.transition = 'transform 300ms ease-out';
        } else {
            this.imagesWrapper.style.transition = 'none';
        }
        
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
                dot.classList.remove('bg-gray-600', 'hover:bg-gray-400');
            } else {
                dot.classList.remove('bg-primary-600', 'w-8');
                dot.classList.add('bg-gray-600', 'hover:bg-gray-400');
            }
        });
    }

    // --- Touch Logic ---
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
        
        if (movedBy < -50) this.next();
        else if (movedBy > 50) this.prev();
        else this.goToSlide(this.currentIndex);
        
        this.isDragging = false;
    }

    // --- Lightbox Logic ---

    createLightboxDOM() {
        const div = document.createElement('div');
        div.className = 'fixed inset-0 z-50 bg-black/95 backdrop-blur-sm flex items-center justify-center opacity-0 transition-opacity duration-300';
        div.id = 'news-lightbox';
        
        div.innerHTML = `
            <button class="absolute top-4 right-4 text-white/70 hover:text-white p-2 z-50" id="lb-close">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            
            <button class="absolute left-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white p-2 hidden md:block z-50" id="lb-prev">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            
            <button class="absolute right-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white p-2 hidden md:block z-50" id="lb-next">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>

            <div class="relative w-full h-full max-w-7xl mx-auto flex flex-col items-center justify-center p-4">
                <div class="relative max-h-[85vh] w-auto">
                    <img id="lb-img" src="" class="max-h-[80vh] max-w-full object-contain shadow-2xl rounded-sm" alt="">
                </div>
                <div id="lb-caption" class="mt-4 text-white/90 text-center text-sm md:text-base font-light max-w-2xl"></div>
            </div>
        `;

        document.body.appendChild(div);
        
        // Lightbox Listeners
        div.querySelector('#lb-close').addEventListener('click', () => this.closeLightbox());
        div.querySelector('#lb-prev').addEventListener('click', (e) => { e.stopPropagation(); this.prev(); });
        div.querySelector('#lb-next').addEventListener('click', (e) => { e.stopPropagation(); this.next(); });
        div.addEventListener('click', (e) => {
            if (e.target === div) this.closeLightbox();
        });

        return div;
    }

    openLightbox(index) {
        this.lightboxEl = document.getElementById('news-lightbox') || this.createLightboxDOM();
        this.lightboxOpen = true;
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
        
        this.updateLightboxContent(index);
        
        // Show with fade
        requestAnimationFrame(() => {
            this.lightboxEl.classList.remove('opacity-0');
        });
    }

    closeLightbox() {
        if (!this.lightboxEl) return;
        
        this.lightboxEl.classList.add('opacity-0');
        document.body.style.overflow = '';
        this.lightboxOpen = false;
        
        setTimeout(() => {
            if (this.lightboxEl) this.lightboxEl.remove();
        }, 300);
    }

    updateLightboxContent(index) {
        const currentSlide = this.slides[index];
        const img = currentSlide.querySelector('img.relative'); // Select the main image, not the background blur
        const captionDiv = currentSlide.querySelector('.absolute.bottom-0'); 
        const captionText = captionDiv ? captionDiv.textContent.trim() : '';

        const lbImg = this.lightboxEl.querySelector('#lb-img');
        const lbCap = this.lightboxEl.querySelector('#lb-caption');

        // Prefer high-res full URL
        const fullUrl = img.getAttribute('data-full-url') || img.src;
        lbImg.src = fullUrl;
        lbCap.textContent = captionText;
    }
}

export default NewsGallery;