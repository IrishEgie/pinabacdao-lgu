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
        
        // Initialize if there is at least one slide (for lightbox support)
        if (this.totalSlides > 0) {
            this.init();
        }
    }

    init() {
        this.attachEventListeners();
        this.updateGallery(0, false); // Initialize without animation
    }

    attachEventListeners() {
        // Navigation buttons (Main Gallery) only if more than 1 slide
        if (this.totalSlides > 1) {
            if (this.prevBtn) this.prevBtn.addEventListener('click', () => this.prev());
            if (this.nextBtn) this.nextBtn.addEventListener('click', () => this.next());

            // Dot indicators
            this.dots.forEach((dot, index) => {
                dot.addEventListener('click', () => this.goToSlide(index));
            });

            // Touch events
            this.imagesWrapper.addEventListener('touchstart', (e) => this.touchStart(e), { passive: true });
            this.imagesWrapper.addEventListener('touchmove', (e) => this.touchMove(e), { passive: true });
            this.imagesWrapper.addEventListener('touchend', () => this.touchEnd());
        }

        // Click to Open Lightbox (works even for 1 slide)
        this.slides.forEach((slide, index) => {
            slide.addEventListener('click', () => this.openLightbox(index));
        });

        // Keyboard navigation (for Lightbox)
        document.addEventListener('keydown', (e) => {
            if (this.lightboxOpen) {
                if (e.key === 'ArrowLeft') this.prev();
                if (e.key === 'ArrowRight') this.next();
                if (e.key === 'Escape') this.closeLightbox();
            }
        });
    }

    // --- Navigation ---

    prev() {
        // Continuous Loop: Go to last slide if currently at the first
        const newIndex = (this.currentIndex - 1 + this.totalSlides) % this.totalSlides;
        this.goToSlide(newIndex);
    }

    next() {
        // Continuous Loop: Go to first slide if currently at the last
        const newIndex = (this.currentIndex + 1) % this.totalSlides;
        this.goToSlide(newIndex);
    }

    goToSlide(index) {
        this.currentIndex = index;
        this.updateGallery(index, true);
        
        if (this.lightboxOpen) {
            this.updateLightboxContent(index);
        }
    }

    updateGallery(index, animate = true) {
        if (this.totalSlides === 0) return;

        // Calculate slide width dynamically to handle responsiveness
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
        
        // Update dots (only if they exist)
        this.dots.forEach((dot, i) => {
            if (i === index) {
                dot.classList.add('bg-primary-600', 'w-8');
                dot.classList.remove('bg-gray-700', 'hover:bg-gray-600');
            } else {
                dot.classList.remove('bg-primary-600', 'w-8');
                dot.classList.add('bg-gray-700', 'hover:bg-gray-600');
            }
        });
        
        // REMOVED: Button disable logic, as the gallery is now looping continuously
    }

    // --- Touch Logic ---
    touchStart(e) {
        if (this.totalSlides <= 1) return;
        this.touchStartX = e.touches[0].clientX;
        this.isDragging = true;
        this.startPos = e.touches[0].clientX;
        this.imagesWrapper.style.transition = 'none';
    }

    touchMove(e) {
        if (!this.isDragging || this.totalSlides <= 1) return;
        const currentPosition = e.touches[0].clientX;
        // Calculate movement and keep within bounds for visual dragging
        const deltaX = currentPosition - this.startPos;
        this.currentTranslate = this.prevTranslate + deltaX;
        this.imagesWrapper.style.transform = `translateX(${this.currentTranslate}px)`;
    }

    touchEnd() {
        if (!this.isDragging || this.totalSlides <= 1) return;
        
        const movedBy = this.currentTranslate - this.prevTranslate;
        
        if (movedBy < -50) this.next(); // Swipe Left
        else if (movedBy > 50) this.prev(); // Swipe Right
        else this.goToSlide(this.currentIndex); // Snap back to current slide
        
        this.isDragging = false;
    }

    // --- Lightbox Logic ---

    createLightboxDOM() {
        const div = document.createElement('div');
        div.className = 'fixed inset-0 z-[9999] bg-black/95 backdrop-blur-sm flex items-center justify-center opacity-0 transition-opacity duration-300';
        div.id = 'news-lightbox';
        
        // Added: Counter (Top Left) and Dots Container (Bottom)
        div.innerHTML = `
            <div class="absolute top-4 left-4 text-white/80 font-mono text-sm z-50 bg-black/50 px-3 py-1 rounded-full border border-white/10">
                <span id="lb-current">1</span> / <span id="lb-total">${this.totalSlides}</span>
            </div>

            <button class="absolute top-4 right-4 text-white/70 hover:text-white p-2 z-50 transition-colors" id="lb-close" aria-label="Close Lightbox">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            
            ${this.totalSlides > 1 ? `
            <button class="absolute left-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white p-2 hidden md:block z-50 hover:bg-white/10 rounded-full transition-all" id="lb-prev" aria-label="Previous Image">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            
            <button class="absolute right-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white p-2 hidden md:block z-50 hover:bg-white/10 rounded-full transition-all" id="lb-next" aria-label="Next Image">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>` : ''}

            <div class="relative w-full h-full flex flex-col items-center justify-center p-4 md:p-12">
                <img id="lb-img" src="" class="max-h-[80vh] max-w-full object-contain shadow-2xl transition-opacity duration-200" alt="">
                <div id="lb-caption" class="mt-4 text-white/90 text-center text-sm md:text-base font-light max-w-2xl transition-opacity duration-200"></div>
            </div>

            <!-- Lightbox Dots (only if more than 1 slide) -->
            ${this.totalSlides > 1 ? `
            <div class="absolute bottom-6 left-0 right-0 flex justify-center gap-2 z-50" id="lb-dots">
                ${Array.from({length: this.totalSlides}).map((_, i) => 
                    `<button class="lb-dot w-2 h-2 rounded-full transition-all duration-300 ${i === 0 ? 'bg-white scale-125' : 'bg-gray-600 hover:bg-gray-400'}" data-index="${i}" aria-label="Go to image ${i + 1}"></button>`
                ).join('')}
            </div>` : ''}
        `;

        document.body.appendChild(div);
        
        // Listeners
        div.querySelector('#lb-close').addEventListener('click', () => this.closeLightbox());
        
        if (this.totalSlides > 1) {
            div.querySelector('#lb-prev').addEventListener('click', (e) => { e.stopPropagation(); this.prev(); });
            div.querySelector('#lb-next').addEventListener('click', (e) => { e.stopPropagation(); this.next(); });
            
            // Add listeners to lightbox dots
            div.querySelectorAll('.lb-dot').forEach((dot, idx) => {
                dot.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.goToSlide(idx);
                });
            });
        }

        // Allow clicking background to close
        div.addEventListener('click', (e) => {
            if (e.target === div) this.closeLightbox();
        });

        return div;
    }

    openLightbox(index) {
        this.currentIndex = index; // Ensure current index is set to the clicked slide
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
        if (!this.lightboxEl) return;
        
        const currentSlide = this.slides[index];
        const img = currentSlide.querySelector('img'); 
        const captionDiv = currentSlide.querySelector('.absolute.bottom-0 p'); 
        const captionText = captionDiv ? captionDiv.textContent.trim() : '';

        const lbImg = this.lightboxEl.querySelector('#lb-img');
        const lbCap = this.lightboxEl.querySelector('#lb-caption');
        const lbCounter = this.lightboxEl.querySelector('#lb-current');
        const lbDots = this.lightboxEl.querySelectorAll('.lb-dot');

        // Add fade transition classes before changing src
        lbImg.classList.add('opacity-0');
        lbCap.classList.add('opacity-0');

        setTimeout(() => {
            // Update Image
            const fullUrl = img.getAttribute('data-full-url') || img.src;
            lbImg.src = fullUrl;
            lbCap.textContent = captionText;

            // Remove fade transition classes after changing src
            lbImg.classList.remove('opacity-0');
            lbCap.classList.remove('opacity-0');
        }, 200); // Shorter than CSS transition to cover the transition period

        // Update Counter
        if (lbCounter) lbCounter.textContent = index + 1;

        // Update Dots (only if they exist)
        lbDots.forEach((dot, i) => {
            if (i === index) {
                dot.classList.add('bg-white', 'scale-125');
                dot.classList.remove('bg-gray-600', 'hover:bg-gray-400');
            } else {
                dot.classList.remove('bg-white', 'scale-125');
                dot.classList.add('bg-gray-600', 'hover:bg-gray-400');
            }
        });
    }
}

export default NewsGallery;