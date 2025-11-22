/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/modules/Accordion.js":
/*!**********************************!*\
  !*** ./src/modules/Accordion.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Accordion: () => (/* binding */ Accordion)
/* harmony export */ });
class Accordion {
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
      trigger.addEventListener('click', e => {
        this.toggleItem(e.currentTarget);
      });
      trigger.addEventListener('keydown', e => {
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

/***/ }),

/***/ "./src/modules/ContactForm.js":
/*!************************************!*\
  !*** ./src/modules/ContactForm.js ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   ContactForm: () => (/* binding */ ContactForm)
/* harmony export */ });
class ContactForm {
  constructor(formElement) {
    this.form = formElement;
    this.submitBtn = this.form.querySelector('#submit-btn');
    this.submitText = this.submitBtn?.querySelector('.submit-text');
    this.loadingText = this.submitBtn?.querySelector('.loading-text');
    this.init();
  }
  init() {
    if (!this.form) return;
    this.form.addEventListener('submit', e => this.handleSubmit(e));
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

/***/ }),

/***/ "./src/modules/HeaderNav.js":
/*!**********************************!*\
  !*** ./src/modules/HeaderNav.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   HeaderNavigation: () => (/* binding */ HeaderNavigation)
/* harmony export */ });
class HeaderNavigation {
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

/***/ }),

/***/ "./src/modules/NewsGallery.js":
/*!************************************!*\
  !*** ./src/modules/NewsGallery.js ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   NewsGallery: () => (/* binding */ NewsGallery),
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/**
 * News Gallery Module
 * Instagram-style gallery with touch/swipe support
 * 
 * Location: src/modules/NewsGallery.js
 */

class NewsGallery {
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
    this.container.addEventListener('keydown', e => {
      if (e.key === 'ArrowLeft') this.prev();
      if (e.key === 'ArrowRight') this.next();
    });

    // Touch events for swipe
    this.imagesWrapper.addEventListener('touchstart', e => this.touchStart(e), {
      passive: true
    });
    this.imagesWrapper.addEventListener('touchmove', e => this.touchMove(e), {
      passive: true
    });
    this.imagesWrapper.addEventListener('touchend', () => this.touchEnd());

    // Mouse events for desktop drag
    this.imagesWrapper.addEventListener('mousedown', e => this.dragStart(e));
    this.imagesWrapper.addEventListener('mousemove', e => this.dragMove(e));
    this.imagesWrapper.addEventListener('mouseup', () => this.dragEnd());
    this.imagesWrapper.addEventListener('mouseleave', () => this.dragEnd());

    // Prevent context menu on long press
    this.imagesWrapper.addEventListener('contextmenu', e => {
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
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (NewsGallery);

/***/ }),

/***/ "./src/modules/Search.js":
/*!*******************************!*\
  !*** ./src/modules/Search.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Search)
/* harmony export */ });
class Search {
  constructor() {
    this.searchToggle = document.querySelector('.js-search-toggle');
    this.searchOverlay = null;
    this.searchInput = null;
    this.closeButton = null;
    this.resultsDiv = null;
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue = '';
    this.typingTimer = null;
    this.currentPage = 1;
    this.totalPages = 1;
    this.currentResults = {};
    this.hasSearched = false; // Track if user has performed a search

    if (this.searchToggle) {
      this.init();
    }
  }
  init() {
    this.createOverlay();

    // Event listeners
    this.searchToggle.addEventListener('click', () => {
      this.openOverlay();
      if (!this.hasSearched) {
        this.getDefaultContent();
      }
    });
    this.closeButton.addEventListener('click', this.closeOverlay.bind(this));

    // Close when clicking outside or pressing Escape
    this.searchOverlay.addEventListener('click', e => {
      if (e.target === this.searchOverlay) {
        this.closeOverlay();
      }
    });
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape' && this.isOverlayOpen) {
        this.closeOverlay();
      }
      if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'q' && !this.isOverlayOpen) {
        e.preventDefault();
        this.openOverlay();
        if (!this.hasSearched) {
          this.getDefaultContent();
        }
      }
    });

    // Typing logic
    this.searchInput.addEventListener('input', this.typingLogic.bind(this));
  }

  // Add new method to get default content
  getDefaultContent() {
    this.resultsDiv.innerHTML = '<div class="flex justify-center py-8"><div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-primary"></div></div>';
    this.isSpinnerVisible = true;
    fetch(`${wpvars.home}/wp-json/custom/v1/search/default`).then(response => {
      if (!response.ok) throw new Error('Network response was not ok');
      return response.json();
    }).then(data => {
      this.currentResults = data.results;
      this.displayResults();
      this.paginationDiv.classList.add('hidden');
    }).catch(error => {
      console.error('Error loading default content:', error);
      this.resultsDiv.innerHTML = `
          <div class="text-center py-8">
            <h3 class="text-lg font-medium text-gray-900">Browse Latest Content</h3>
            <p class="mt-2 text-gray-500">Start typing to search the site</p>
          </div>
        `;
    }).finally(() => {
      this.isSpinnerVisible = false;
    });
  }

  // Modify typingLogic to track searches
  typingLogic() {
    if (this.searchInput.value !== this.previousValue) {
      clearTimeout(this.typingTimer);
      if (this.searchInput.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="flex justify-center py-8"><div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-primary"></div></div>';
          this.isSpinnerVisible = true;
        }
        this.currentPage = 1;
        this.typingTimer = setTimeout(() => {
          this.hasSearched = true;
          this.getResults();
        }, 300);
      } else {
        // When clearing search, show default content again if not already searching
        if (this.hasSearched) {
          this.resultsDiv.innerHTML = '';
          this.paginationDiv.classList.add('hidden');
          this.isSpinnerVisible = false;
          this.hasSearched = false;
          this.getDefaultContent();
        }
      }
      this.previousValue = this.searchInput.value;
    }
  }
  createOverlay() {
    const homeUrl = typeof wpvars !== 'undefined' && wpvars.home ? wpvars.home : '/';
    const overlayHTML = `
      <div class="search-overlay fixed inset-0 z-[9999] bg-white bg-opacity-95 invisible opacity-0 scale-[1.09] transition-all duration-300 overflow-y-auto overflow-x-hidden pointer-events-none">
        <div class="container mx-auto px-4 py-8 relative pointer-events-auto">
          <!-- Search Header -->
          <div class="flex justify-between items-center mb-8 bg-gray-100 p-4 rounded-lg">
            <div class="flex items-center w-full">
              <svg class="search-overlay__icon w-8 h-8 mr-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
              <input type="text" id="search-term" class="search-term flex-grow bg-transparent border-none focus:outline-none text-gray-800 text-xl placeholder-gray-400" placeholder="What are you looking for?" autocomplete="off">
            </div>
            <button class="search-overlay__close text-3xl text-primary hover:text-[#1e5a3e] transition-colors">
              &times;
            </button>
          </div>
          
          <!-- Results Container -->
          <div id="search-overlay__results" class="advanced-search__result"></div>
          
          <!-- Pagination -->
          <div id="search-pagination" class="mt-8 flex justify-center items-center hidden">
            <button id="prev-page" class="px-4 py-2 bg-primary text-white rounded-l-md hover:bg-[#1e5a3e] disabled:opacity-50 disabled:cursor-not-allowed" disabled>
              Previous
            </button>
            <span class="px-4 py-2 bg-gray-100">
              Page <span id="current-page">1</span> of <span id="total-pages">1</span>
            </span>
            <button id="next-page" class="px-4 py-2 bg-primary text-white rounded-r-md hover:bg-[#1e5a3e] disabled:opacity-50 disabled:cursor-not-allowed" disabled>
              Next
            </button>
          </div>
        </div>
      </div>
    `;
    document.body.insertAdjacentHTML('beforeend', overlayHTML);

    // Cache elements
    this.searchOverlay = document.querySelector('.search-overlay');
    this.searchInput = document.getElementById('search-term');
    this.closeButton = document.querySelector('.search-overlay__close');
    this.resultsDiv = document.getElementById('search-overlay__results');
    this.paginationDiv = document.getElementById('search-pagination');
    this.prevButton = document.getElementById('prev-page');
    this.nextButton = document.getElementById('next-page');
    this.currentPageEl = document.getElementById('current-page');
    this.totalPagesEl = document.getElementById('total-pages');

    // Pagination event listeners
    this.prevButton.addEventListener('click', () => {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.getResults();
      }
    });
    this.nextButton.addEventListener('click', () => {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.getResults();
      }
    });
  }
  typingLogic() {
    if (this.searchInput.value !== this.previousValue) {
      clearTimeout(this.typingTimer);
      if (this.searchInput.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="flex justify-center py-8"><div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-primary"></div></div>';
          this.isSpinnerVisible = true;
        }
        this.currentPage = 1; // Reset to first page on new search
        this.typingTimer = setTimeout(this.getResults.bind(this), 300); // 300ms debounce
      } else {
        this.resultsDiv.innerHTML = '';
        this.paginationDiv.classList.add('hidden');
        this.isSpinnerVisible = false;
      }
      this.previousValue = this.searchInput.value;
    }
  }
  getResults() {
    const searchTerm = this.searchInput.value.trim();
    if (!searchTerm) {
      this.resultsDiv.innerHTML = '';
      this.paginationDiv.classList.add('hidden');
      return;
    }
    fetch(`${wpvars.home}/wp-json/custom/v1/search?term=${encodeURIComponent(searchTerm)}&page=${this.currentPage}`).then(response => {
      if (!response.ok) throw new Error('Network response was not ok');
      return response.json();
    }).then(data => {
      this.currentResults = data.results;
      this.totalPages = Math.max(Math.ceil(data.total.general / 10), Math.ceil(data.total.news / 10), Math.ceil(data.total.documents / 10));
      this.displayResults();
      this.updatePagination();
    }).catch(error => {
      console.error('Search error:', error);
      this.resultsDiv.innerHTML = `
          <div class="text-center py-8 text-red-600">
            Error loading search results. Please try again.
          </div>
        `;
    }).finally(() => {
      this.isSpinnerVisible = false;
    });
  }
  displayResults() {
    let html = `
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Site Search -->
        <div class="advanced-search__column">
          <section id="siteSearch" class="advanced-search__section">
            <h2 class="advanced-search__heading text-2xl font-semibold text-primary mb-4 pb-2 border-b border-gray-200">Site Search</h2>
            <ul class="advanced-search__list space-y-3">
    `;

    // General Results (Left Column)
    if (this.currentResults.general?.length) {
      this.currentResults.general.forEach(item => {
        html += `
          <li class="advanced-search__list-item">
            <a href="${item.link}" class="advanced-search__list-link group block p-3 hover:bg-gray-50 rounded-lg transition-colors">
              <h3 class="advanced-search__list-title text-lg font-medium text-gray-900 group-hover:text-primary">${item.title}</h3>
              <div class="advanced-search__list-subtitle text-gray-600 text-sm mt-1 line-clamp-2">${item.excerpt}</div>
              <div class="advanced-search__list-meta text-xs text-gray-500 mt-1">${item.post_type}</div>
            </a>
          </li>
        `;
      });
    } else {
      html += `
        <li class="text-gray-500 py-4">
          No general results found
        </li>
      `;
    }
    html += `
            </ul>
          </section>
        </div>
        
        <!-- Middle Column - News -->
        <div class="advanced-search__column">
          <section id="newsroom" class="advanced-search__section">
            <h2 class="advanced-search__heading text-2xl font-semibold text-primary mb-4 pb-2 border-b border-gray-200">Newsroom</h2>
            <div class="space-y-4">
    `;

    // News Results (Middle Column)
    if (this.currentResults.news?.length) {
      this.currentResults.news.forEach(item => {
        html += `
          <article class="advanced-search__news-item">
            <a href="${item.link}" class="group block">
              ${item.image ? `
                <figure class="advanced-search__news-figure overflow-hidden rounded-lg mb-2">
                  <img src="${item.image}" 
                       class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300"
                       alt="${item.title}">
                </figure>
              ` : ''}
              <h3 class="advanced-search__news-title text-lg font-medium text-gray-900 group-hover:text-primary mb-1">${item.title}</h3>
              <div class="advanced-search__news-excerpt text-gray-600 text-sm line-clamp-2">${item.excerpt}</div>
            </a>
          </article>
        `;
      });
    } else {
      html += `
        <div class="text-gray-500 py-4">
          No news results found
        </div>
      `;
    }
    html += `
            </div>
          </section>
        </div>
        
        <!-- Right Column - Documents -->
        <div class="advanced-search__column">
          <section id="documents" class="advanced-search__section">
            <h2 class="advanced-search__heading text-2xl font-semibold text-primary mb-4 pb-2 border-b border-gray-200">Documents</h2>
            <ul class="advanced-search__list space-y-3">
    `;

    // Documents Results (Right Column)
    if (this.currentResults.documents?.length) {
      // Group documents by type (assuming type is available in the results)
      const groupedDocuments = {};
      this.currentResults.documents.forEach(doc => {
        if (!groupedDocuments[doc.type]) {
          groupedDocuments[doc.type] = [];
        }
        groupedDocuments[doc.type].push(doc);
      });

      // Render each document group
      for (const [type, docs] of Object.entries(groupedDocuments)) {
        html += `
      <div class="document-group">
        <h3 class="text-lg font-medium text-gray-800 mb-3">${type}</h3>
        <ul class="space-y-3">
    `;
        docs.forEach(item => {
          html += `
        <li class="document-item bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
          <a href="${item.link}" 
             target="_blank"
             rel="noopener noreferrer"
             class="block p-4 group">
            <div class="flex justify-between items-start">
              <div class="flex-1">
                <h4 class="text-lg font-medium text-gray-900 group-hover:text-primary mb-1">${item.title}</h4>
                <div class="flex items-center gap-3 text-sm">
                  <span class="text-gray-500">${item.date}</span>
                  <span class="text-gray-400">•</span>
                  <span class="text-gray-500">${item.file_size || 'PDF'}</span>
                </div>
              </div>
              <div class="ml-4 flex-shrink-0">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
              </div>
            </div>
          </a>
        </li>
      `;
        });
        html += `
        </ul>
      </div>
    `;
      }
      html += `
      </div>
    </section>
  `;
    }
    html += `
            </ul>
          </section>
        </div>
      </div>
    `;

    // No results message (fallback)
    if (!this.currentResults.general?.length && !this.currentResults.news?.length && !this.currentResults.documents?.length) {
      html = `
        <div class="text-center py-12 col-span-3">
          <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <h3 class="mt-2 text-lg font-medium text-gray-900">No results found</h3>
          <p class="mt-1 text-gray-500">Try different search terms</p>
        </div>
      `;
    }
    this.resultsDiv.innerHTML = html;
  }
  updatePagination() {
    this.currentPageEl.textContent = this.currentPage;
    this.totalPagesEl.textContent = this.totalPages;
    this.prevButton.disabled = this.currentPage <= 1;
    this.nextButton.disabled = this.currentPage >= this.totalPages;
    if (this.totalPages > 1) {
      this.paginationDiv.classList.remove('hidden');
    } else {
      this.paginationDiv.classList.add('hidden');
    }
  }
  openOverlay() {
    this.searchOverlay.classList.remove('invisible', 'pointer-events-none');
    this.searchOverlay.classList.add('visible', 'pointer-events-auto');
    this.searchOverlay.style.opacity = '1';
    this.searchOverlay.style.transform = 'scale(1)';
    document.body.classList.add('overflow-hidden');
    setTimeout(() => this.searchInput.focus(), 350);
    this.isOverlayOpen = true;
  }
  closeOverlay() {
    this.searchOverlay.style.opacity = '0';
    this.searchOverlay.style.transform = 'scale(1.09)';
    setTimeout(() => {
      this.searchOverlay.classList.remove('visible', 'pointer-events-auto');
      this.searchOverlay.classList.add('invisible', 'pointer-events-none');
      document.body.classList.remove('overflow-hidden');
    }, 300);
    this.isOverlayOpen = false;
  }
}

/***/ }),

/***/ "./src/modules/TabNav.js":
/*!*******************************!*\
  !*** ./src/modules/TabNav.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   TabNavigation: () => (/* binding */ TabNavigation)
/* harmony export */ });
class TabNavigation {
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

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_TabNav__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/TabNav */ "./src/modules/TabNav.js");
/* harmony import */ var _modules_HeaderNav__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/HeaderNav */ "./src/modules/HeaderNav.js");
/* harmony import */ var _modules_ContactForm__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/ContactForm */ "./src/modules/ContactForm.js");
/* harmony import */ var _modules_Accordion__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./modules/Accordion */ "./src/modules/Accordion.js");
/* harmony import */ var _modules_Search_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./modules/Search.js */ "./src/modules/Search.js");
/* harmony import */ var _modules_NewsGallery__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./modules/NewsGallery */ "./src/modules/NewsGallery.js");





 // Add this line

document.addEventListener('DOMContentLoaded', () => {
  // Initialize all tab navigations on the page
  document.querySelectorAll('[data-tab-navigation]').forEach(container => {
    new _modules_TabNav__WEBPACK_IMPORTED_MODULE_0__.TabNavigation(container);
  });

  // Initialize header navigation
  const header = document.querySelector('header');
  if (header) {
    new _modules_HeaderNav__WEBPACK_IMPORTED_MODULE_1__.HeaderNavigation(header);
  }

  // Initialize contact forms
  document.querySelectorAll('#contact-form').forEach(form => {
    new _modules_ContactForm__WEBPACK_IMPORTED_MODULE_2__.ContactForm(form);
  });

  // Initialize accordions with verification
  const accordionContainers = document.querySelectorAll('.divide-y.divide-gray-200');
  console.log(`Found ${accordionContainers.length} accordion containers`);
  accordionContainers.forEach(container => {
    new _modules_Accordion__WEBPACK_IMPORTED_MODULE_3__.Accordion(container);
  });

  // Initialize search functionality
  new _modules_Search_js__WEBPACK_IMPORTED_MODULE_4__["default"]();
  document.querySelectorAll('[data-news-gallery]').forEach(gallery => {
    new _modules_NewsGallery__WEBPACK_IMPORTED_MODULE_5__.NewsGallery(gallery);
  });
});
})();

/******/ })()
;
//# sourceMappingURL=index.js.map