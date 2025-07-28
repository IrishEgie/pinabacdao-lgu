/**
 * Search.js - Modern WordPress Search Overlay with Tailwind CSS
 * Features:
 * - Fullscreen overlay with animated transitions
 * - Three-column results layout
 * - Keyboard shortcuts (Ctrl/Cmd+Q to open, ESC to close)
 * - Loading state
 * - Responsive design
 */
export default class Search {
  constructor() {
    // Initialize properties
    this.isOpen = false;
    this.isLoading = false;
    this.previousValue = '';
    this.typingTimer = null;
    
    // DOM elements
    this.searchToggle = document.querySelector('.js-search-toggle');
    this.searchOverlay = null;
    this.searchInput = null;
    this.searchResults = null;
    
    // Initialize if toggle exists
    if (this.searchToggle) {
      this.init();
    }
  }

  init() {
    this.createSearchOverlay();
    this.setupEventListeners();
  }

  createSearchOverlay() {
    // Create overlay container
    this.searchOverlay = document.createElement('div');
    this.searchOverlay.className = 'fixed inset-0 z-[100] hidden bg-black/75 backdrop-blur-sm transition-opacity duration-300';
    this.searchOverlay.style.opacity = '0';

    // Create inner container
    const container = document.createElement('div');
    container.className = 'relative w-full h-full flex flex-col items-center pt-16 px-4 overflow-y-auto';

    // Close button
    const closeButton = document.createElement('button');
    closeButton.className = 'absolute top-4 right-4 p-2 text-white hover:text-gray-300 transition-colors';
    closeButton.innerHTML = `
      <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
      <span class="sr-only">Close search</span>
    `;
    closeButton.addEventListener('click', () => this.close());

    // Search input container
    const inputContainer = document.createElement('div');
    inputContainer.className = 'w-full max-w-3xl mb-8';

    // Search input
    this.searchInput = document.createElement('input');
    this.searchInput.type = 'text';
    this.searchInput.placeholder = 'Search the municipality website...';
    this.searchInput.className = 'w-full px-6 py-4 text-lg rounded-lg border-0 focus:ring-2 focus:ring-primary-500 focus:outline-none bg-white/90 placeholder-gray-500 shadow-lg';
    this.searchInput.autocomplete = 'off';

    inputContainer.appendChild(this.searchInput);

    // Results container
    this.searchResults = document.createElement('div');
    this.searchResults.className = 'w-full max-w-6xl flex-1 pb-20';

    // Assemble the overlay
    container.appendChild(closeButton);
    container.appendChild(inputContainer);
    container.appendChild(this.searchResults);
    this.searchOverlay.appendChild(container);

    // Add to DOM
    document.body.appendChild(this.searchOverlay);
  }

  setupEventListeners() {
    // Toggle search overlay
    this.searchToggle.addEventListener('click', (e) => {
      e.preventDefault();
      this.toggle();
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
      // Ctrl/Cmd + Q to open
      if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'q' && !this.isOpen) {
        e.preventDefault();
        this.open();
      }
      
      // ESC to close
      if (e.key === 'Escape' && this.isOpen) {
        this.close();
      }
    });

    // Search input events
    this.searchInput.addEventListener('keyup', () => this.handleTyping());

    // Focus input when overlay opens
    this.searchOverlay.addEventListener('transitionend', () => {
      if (this.isOpen) {
        this.searchInput.focus();
      }
    });
  }

  handleTyping() {
    const currentValue = this.searchInput.value;
    
    // Only proceed if value changed
    if (currentValue !== this.previousValue) {
      clearTimeout(this.typingTimer);
      
      if (currentValue) {
        // Show loading state
        if (!this.isLoading) {
          this.searchResults.innerHTML = `
            <div class="flex justify-center py-12">
              <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-primary-500"></div>
            </div>
          `;
          this.isLoading = true;
        }
        
        // Debounce search
        this.typingTimer = setTimeout(() => this.performSearch(), 500);
      } else {
        this.clearResults();
      }
      
      this.previousValue = currentValue;
    }
  }

  performSearch() {
    // This is where you would implement actual search functionality
    // For now, we'll use placeholder results
    this.showPlaceholderResults();
    
    // In a real implementation, you would:
    // 1. Make a fetch request to WordPress REST API
    // 2. Process the results
    // 3. Display them in the three-column layout
    // Example:
    // fetch(`${wpApiSettings.root}wp/v2/search?search=${encodeURIComponent(this.searchInput.value)}`)
    //   .then(response => response.json())
    //   .then(results => this.displayResults(results))
    //   .catch(error => console.error('Search error:', error))
    //   .finally(() => this.isLoading = false);
  }

  showPlaceholderResults() {
    this.isLoading = false;
    this.searchResults.innerHTML = `
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Column 1: General Information -->
        <div>
          <h2 class="text-xl font-bold text-white mb-4 pb-2 border-b border-white/20">General Information</h2>
          <ul class="space-y-3">
            <li><a href="#" class="text-white/90 hover:text-white hover:underline">Municipal Services</a></li>
            <li><a href="#" class="text-white/90 hover:text-white hover:underline">Public Announcements</a></li>
            <li><a href="#" class="text-white/90 hover:text-white hover:underline">Contact Information</a></li>
          </ul>
        </div>
        
        <!-- Column 2: Departments & Services -->
        <div>
          <h2 class="text-xl font-bold text-white mb-4 pb-2 border-b border-white/20">Departments</h2>
          <ul class="space-y-3">
            <li><a href="#" class="text-white/90 hover:text-white hover:underline">Mayor's Office</a></li>
            <li><a href="#" class="text-white/90 hover:text-white hover:underline">Treasurer's Office</a></li>
            <li><a href="#" class="text-white/90 hover:text-white hover:underline">Public Works</a></li>
          </ul>
          
          <h2 class="text-xl font-bold text-white mt-8 mb-4 pb-2 border-b border-white/20">Services</h2>
          <ul class="space-y-3">
            <li><a href="#" class="text-white/90 hover:text-white hover:underline">Business Permits</a></li>
            <li><a href="#" class="text-white/90 hover:text-white hover:underline">Marriage License</a></li>
          </ul>
        </div>
        
        <!-- Column 3: News & Events -->
        <div>
          <h2 class="text-xl font-bold text-white mb-4 pb-2 border-b border-white/20">News & Events</h2>
          <div class="space-y-4">
            <div class="bg-white/10 p-4 rounded-lg">
              <h3 class="font-semibold text-white">Town Fiesta 2023</h3>
              <p class="text-white/80 text-sm mt-1">June 15-20, 2023</p>
              <p class="text-white/90 mt-2">Annual celebration of our town's patron saint.</p>
            </div>
            <div class="bg-white/10 p-4 rounded-lg">
              <h3 class="font-semibold text-white">Public Hearing</h3>
              <p class="text-white/80 text-sm mt-1">July 5, 2023</p>
              <p class="text-white/90 mt-2">Discussion of new municipal ordinances.</p>
            </div>
          </div>
        </div>
      </div>
    `;
  }

  clearResults() {
    this.searchResults.innerHTML = '';
    this.isLoading = false;
  }

  toggle() {
    this.isOpen ? this.close() : this.open();
  }

open() {
  if (this.isOpen) return;
  
  this.isOpen = true;
  document.body.style.overflow = 'hidden';
  document.documentElement.style.overflow = 'hidden';
  this.searchOverlay.classList.remove('hidden');
  
  // Trigger opacity transition
  requestAnimationFrame(() => {
    this.searchOverlay.style.opacity = '1';
  });
}

close() {
  if (!this.isOpen) return;
  
  this.isOpen = false;
  this.searchOverlay.style.opacity = '0';
  
  setTimeout(() => {
    this.searchOverlay.classList.add('hidden');
    document.body.style.overflow = '';
    document.documentElement.style.overflow = '';
    this.searchInput.value = '';
    this.clearResults();
  }, 300);
}
}